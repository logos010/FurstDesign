<?php

/**
 * Description of News
 *
 * @author HAO
 */
class News extends NewsBase {

    public $cate, $tag, $strip_tag = false;
    public $glue = array(
        'small' => array('w' => 200, 'h' => 120),
//        'medium' => array('w' => 490, 'h' => 294)
    );
    public static $promote = array('' => 'Bình thường', 1 => 'Nổi bật', 2 => 'Top nổi bật');

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('thumb', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 1),
            array('title, alias, teaser, cate', 'required'),
            array('promote, status, create_by, update_by, type, strip_tag', 'numerical', 'integerOnly' => true),
            array('title, alias, thumb, stream, tag, quote, uri', 'length', 'max' => 255),
            array('teaser', 'length', 'max' => 1000),
            array('create_time, publish_time, update_time, content', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, cate, title, alias, thumb, teaser, content, promote, create_time, publish_time, update_time, status, create_by, update_by', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'nTerms' => array(self::MANY_MANY, 'Term', 'tbl_news_term(nid,tid)', 'together' => true, 'joinType' => 'INNER JOIN'),
            'tags' => array(self::HAS_MANY, 'Tag', 'nid'),
            'streams' => array(self::BELONGS_TO, 'StreamBase', 'stream'),
            'profile' => array(self::BELONGS_TO, 'ProfileBase', 'user_id'),
            'term' => array(self::MANY_MANY, 'Term', 'tbl_news_term(nid,tid)', 'together' => true, 'joinType' => 'INNER JOIN', 'order' => 'parent_id'),
        );
    }

    public function behaviors() {
        return array(
            'CAdvancedArBehavior' => array(
                'class' => 'ext.behaviors.CAdvancedArBehavior'
        ));
    }

    public function defaultScope() {
        return array(
            'order' => 't.create_time desc'
        );
    }

    public function beforeSave() {
        $this->nTerms = $this->cate;

        list($stream, $id) = explode(' - ', $this->stream);
        if ($id == '' && strlen($stream) > 1) {
            $stream = new StreamBase();
            $stream->attributes = array(
                'name' => $this->stream,
                'alias' => UString::toAlias($this->stream)
            );
            $stream->save(false);
            $this->stream = $stream->id;
        } else {
            $this->stream = $id;
        }

        if (!$this->isNewRecord) {
            $this->update_time = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
            $this->update_by = App()->user->id;
        } else {
            $this->create_by = App()->user->id;
        }
        $image = CUploadedFile::getInstance($this, 'thumb');
        if (is_object($image)) {
            // Clean up the filename
//            $uglyName = strtolower($this->thumb);
//            $mediocreName = preg_replace('/[^a-zA-Z0-9]+/', '_', $uglyName);
//            $beautifulName = trim($mediocreName, '_') . "." . $image->extensionName;

            $name = time() . '.' . $image->extensionName;
            $uri = PATH_UPLOAD . '/news/' . date('Y/m/');
            $orginal = $uri . 'orginal/';

            if (!is_dir($orginal)) {
                mkdir($orginal, 0777, true);
            }

            $image->saveAs($orginal . $name);
            $this->thumb = $orginal . $name;
            LastUpload::save($orginal . $name);

            $image = new Image($orginal . $name);
            foreach ($this->glue as $key => $node) {
                $glue = $uri . $key . '/';
                if (!is_dir($glue)) {
                    mkdir($glue, 0777, true);
                }
                $image->resize($node['w'], $node['h'], Image::WIDTH);
                $image->save($glue . $name);
            }
        }
        $this->stripTagContent();
        return true;
    }

    public function afterSave() {
        parent::afterSave();

        if ($this->uri == '') {
            $model = self::model()->findByPk($this->id);
            $params = array('cate' => $model->term[0]->alias, 'id' => $this->id, 'alias' => $this->alias);
            $this->uri = url('/site/view', ($model->term[1]->alias != '') ? array_merge($params, array('sub' => $model->term[1]->alias)) : $params);

            self::model()->updateByPk($this->id, array('uri' => $this->uri));
        }

        if ($this->tag != '') {
            $this->tag = explode(',', $this->tag);
            if (is_array($this->tag)) {
                $tags = Tag::model()->findAllByAttributes(array('nid' => $this->id));
                foreach ($this->tag as $k => $value) {
                    if ($tags[$k] instanceof Tag) {
                        $model = $tags[$k];
                    } else {
                        $model = new Tag();
                    }
                    $model->attributes = array(
                        'nid' => $this->id,
                        'name' => trim($value),
                        'alias' => UString::toAlias(trim($value))
                    );
                    $model->save();
                }
            }
        } else {
            Tag::model()->deleteAllByAttributes(array('nid' => $this->id));
        }
    }

    public function search() {
        $criteria = new CDbCriteria;

        if (App()->user->id > 1) {
            $this->create_by = App()->user->id;
        }

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('thumb', $this->thumb, true);
        $criteria->compare('teaser', $this->teaser, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('promote', $this->promote);
        $criteria->compare('stream', $this->stream, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('publish_time', $this->publish_time, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('create_by', $this->create_by);
        $criteria->compare('update_by', $this->update_by);

        if ($this->cate > 0) {
            $criteria->with = array('nTerms');
            $criteria->compare('nTerms.id', $this->cate);
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => UConfig::get('page', 'admin')
            ),
        ));
    }

    public function stripTagContent() {
        if ($this->strip_tag) {
            $this->content = str_replace(array('<div', '</div>'), array('<p', '</p>'), $this->content);
            $this->content = strip_tags($this->content, '<p><img><em><i><b><strong><hr><h1>');
            //$this->content = str_replace(array("\n"), array('</p><p>'), $this->content);
            $this->content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $this->content);
            $this->content = str_replace('<p>&nbsp;</p>', '', $this->content);
        }
    }

    public function getPromote() {
        echo CHtml::link(self::$promote[$this->promote], '#', array(
            'class' => 'option-update',
            'data-type' => 'select',
            'data-pk' => $this->id,
            'data-title' => 'Chọn',
            'data-name' => 'promote',
            'data-value' => $this->promote,
            'data-url' => url('/admin/news/manage/editable'),
        ));
    }

}
