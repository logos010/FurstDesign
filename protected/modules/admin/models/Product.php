<?php

/**
 * Description of Product
 *
 * @author HAO
 */
class Product extends ProductBase {

    public $cate;
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function uploadImage() {
        $image = CUploadedFile::getInstance($this, 'image');
        if (is_object($image)) {
            Yii::import('application.extensions.image.Image');
            Yii::import('application.extensions.helpers.*');

            $name = date('Ymdhis') . '.' . strtolower($image->extensionName);
//            $uri = 'upload/products/' . date('Y/m');
            $uri =  'upload/' . date('Y/m');
           // $file_path = webroot() . '/' . $uri;

            if (!is_dir($uri)) {
                mkdir($uri . '/original', 0777, true);
                mkdir($uri . '/medium', 0777, true);                
                //mkdir($uri . '/small', 0777, true);
            }

            $img = new Image($image->tempName);            
            $img->save($uri . '/original/' . $name);
            list($width, $height, $type, $attr) = getimagesize($image->tempName);
            $img->resize(400, 400, Image::WIDTH);
            $img->save($uri . '/medium/' . $name);
            //$img->resize(253, 253);
            //$img->save($uri . '/small/' . $name);

            $this->image = $uri . '/medium/' . $name;
        }
    }

    public function beforeSave() {
        $this->pTerm = $this->cate;
        $this->uploadImage();
        return true;
    }

    public function afterSave() {
        parent::afterSave();

        if ($this->uri == '') {
            $model = self::model()->findByPk($this->id);
            foreach ($model->pTerm as $term) {
                if ($term->parent_id == 0) {
                    $root = $term;
                }
                break;
            }
            $this->uri = url('product/view', array('id' => $this->id, 'alias' => $this->alias, 'cate' => $root->alias));
//            $this->update('uri');
        }
    }

    public function behaviors() {
        return array(
            'CAdvancedArBehavior' => array(
                'class' => 'ext.behaviors.CAdvancedArBehavior'
        ));
    }

    public function relations() {
        return array(
            'pTerm' => array(self::MANY_MANY, 'Term', 'tbl_product_term(pid,tid)', 'together' => true, 'joinType' => 'INNER JOIN'),
            'gallery' => array(self::HAS_MANY, 'Gallery', 'pid')
        );
    }

    public function rules() {
        return array(
            array('name, price, description, cate', 'required'),
            array('quantity, bought, like, subscripbe, status', 'numerical', 'integerOnly' => true),
            array('price, wholesale_price, discount, sale_promotion', 'numerical'),
            array('name, alias', 'length', 'max' => 150),
            array('uri, image', 'length', 'max' => 255),
            array('sku', 'length', 'max' => 15),
            array('update', 'safe'),
            array('image', 'file', 'types' => 'jpg, gif, png, jpeg', 'allowEmpty' => !$this->isNewRecord, 'maxSize' => 1024 * 1024 * 1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, alias, uri, image, sku, quantity, price, wholesale_price, bought, discount, sale_promotion, like, subscripbe, description, detail, status, create, update', 'safe', 'on' => 'search'),
        );
    }

}
