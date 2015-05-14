<?php

/**
 * Description of Term
 *
 * @author HAO
 */
class Term extends TermBase {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function relations() {
        return array(
            'parent' => array(self::BELONGS_TO, 'Term', 'parent_id'),
            'childs' => array(self::HAS_MANY, 'Term', 'parent_id', 'condition' => 'status=1'),
            'voc' => array(self::BELONGS_TO, 'Vocabulary', 'vid'),
            'products' => array(self::MANY_MANY, 'Product', 'tbl_product_term(tid, pid)', 'together' => true, 'joinType' => 'INNER JOIN'),
        );
    }

    public function rules() {
        return array(
            array('vid, alias, name, weight', 'required'),
            array('weight, status', 'numerical', 'integerOnly' => true),
            array('vid, parent_id', 'length', 'max' => 10),
            array('alias, name, url', 'length', 'max' => 255),
            array('level', 'length', 'max' => 155),
            array('description, create_time, update_time', 'safe'),
            array('id, vid, parent_id, alias, name, description, weight, status, level, create_time, update_time', 'safe', 'on' => 'search'),
        );
    }

    public static function buildTree($vid = '') {
        // Retrieve top node.
        if ($vid == '')
            $data = self::model()->weight()->findAll('parent_id = 0');
        else
            $data = self::model()->weight()->findAll('parent_id = 0 AND vid=:vid', array(':vid' => $vid));
        $tree = array();
        foreach ($data as $node) {
            self::processTree(&$tree, $node);
        }
        return $tree;
    }

    public static function buildTreeByTerm($tid) {
        $data = self::model()->findByPk($tid);
        $tree = array();
        self::processTree(&$tree, $data);
        return $tree;
    }

    public static function processTree($tree, $node, $level = 0) {
        $node->level = $level;
        array_push($tree, $node);
        $data = self::model()->weight()->findAllByAttributes(array('parent_id' => $node->id, 'vid' => $node->vid));
        if ($data !== null) {
            foreach ($data as $n) {
                self::processTree(&$tree, $n, $level + 1);
            }
        }
    }

    public static function buildDataForList($tree, $eliminateId = null) {
        $list = (App()->controller->getId() == 'term') ? array('<root>') : array();
        $in_eliminateID = array();
        if ($eliminateId > 0) {
            $terms = Term::buildTreeByTerm($eliminateId);
            if ($terms) {
                $in_eliminateID = CHtml::listData($terms, 'id', 'id');
            }
        }
        foreach ($tree as $node) {
            if ($node->id != $eliminateId && !in_array($node->id, $in_eliminateID)) {
                $list[$node->id] = str_repeat('-', $node['level'] * 5) . $node->name;
            }
        }
        return $list;
    }

    public function scopes() {
        return array(
            'active' => array('condition' => 'status=1'),
            'weight' => array('order' => 'vid, weight desc')
        );
    }

    public function search() {
        $tree = array();
        if (empty($this->name)) {
            $tree = Term::buildTree($this->vid);
        } else {
            $cri = new CDbCriteria();
            $cri->compare('vid', $this->vid);
            $cri->compare('name', $this->name, true);
            $model = self::model()->find($cri);
            if ($model !== null) {
                $tree = Term::buildTreeByTerm($model->id);
            }
        }

        return new CArrayDataProvider($tree, array(
            'id' => 'id',
            'pagination' => array(
                'pageSize' => 500,
            ),
        ));
    }

    public function beforeSave() {
        if ($this->isNewRecord)
            $this->create_time = date('Y-m-d h:i:s');
        else {
            $this->update_time = date('Y-m-d h:i:s');
        }
        return true;
    }

    public function getList() {
        $subitem = array();
        if ($this->childs) {
            foreach ($this->childs as $child) {
                $subitem[] = $child->getList();
            }
        }
        $return_array = array('label' => UTranslate::t($this->name, array(), UTranslate::CATEGORY_MENU), 'url' => App()->createUrl($this->url));

        if ($subitem != array()) {
            $return_array = array_merge($return_array, array('items' => $subitem));
        }
        return $return_array;
    }

}

?>