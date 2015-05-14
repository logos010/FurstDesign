<?php

/**
 * Description of Menu
 *
 * @author HAO
 */
class Menu extends MenuBase {

    const MAIN_MENU = 1;
    const ADMIN_MENU = 2;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('alias, name', 'required'),
            array('parent_id, weight, status', 'numerical', 'integerOnly' => true),
            array('type_id', 'length', 'max' => 10),
            array('alias, name', 'length', 'max' => 64),
            array('url, level, visible_expression', 'length', 'max' => 128),
            array('id, type_id, parent_id, alias, name, url, weight, level, status, create_time, update_time, visible_expression', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'type' => array(self::BELONGS_TO, 'MenuType', 'menu_type_id'),
            'parent' => array(self::BELONGS_TO, 'Menu', 'parent_id'),
            'childs' => array(self::HAS_MANY, 'Menu', 'parent_id', 'condition' => 'status=1'),
        );
    }

    public function getList() {
        $subitem = array();

        if ($this->childs) {
            foreach ($this->childs as $child) {
                $subitem[] = $child->getList();
            }
        }
        $arr = explode('/tag/', $this->url);
        if (empty($arr[1]))
            $this->url = $arr[0] != '#' ? array($arr[0]) : '';
        else
            $this->url = array($arr[0], 'tag' => $arr[1]);
        $return_array = array('label' => UTranslate::t($this->name, array(), UTranslate::CATEGORY_MENU), 'url' => $this->url, 'visible' => ($this->visible_expression != '') ? eval('return ' . $this->visible_expression . ';') : true);

        if ($subitem != array()) {
            $return_array = array_merge($return_array, array('items' => $subitem));
        }
        return $return_array;
    }

    public static function buildTree($type_id = null) {
        // Retrieve top node.
        if ($type_id === null)
            $data = self::model()->findAll('parent_id = 0');
        else
            $data = self::model()->findAll('parent_id = 0 AND type_id = ' . $type_id);
        $tree = array();
        foreach ($data as $node) {
            self::processTree(&$tree, $node);
        }
        return $tree;
    }

    public static function buildTreeByMenu($id) {
        $data = self::model()->findByPk($id);
        $tree = array();
        self::processTree(&$tree, $data);
        return $tree;
    }

    public static function processTree($tree, $node, $level = 0) {
        $node->level = $level;
        array_push($tree, $node);
        $data = self::model()->findAllByAttributes(array('parent_id' => $node->id, 'type_id' => $node->type_id));
        if ($data !== null) {
            foreach ($data as $n) {
                self::processTree(&$tree, $n, $level + 1);
            }
        }
    }

    public static function buildDataForList($tree, $eliminateId = null) {
        $list = (App()->controller->getId() == 'menu') ? array('<root>') : array();
        $in_eliminateID = array();
        if ($eliminateId > 0) {
            $menu = Menu::buildTreeByMenu($eliminateId);
            if ($menu) {
                $in_eliminateID = CHtml::listData($menu, 'id', 'id');
            }
        }
        foreach ($tree as $node) {
            if ($node->id != $eliminateId && !in_array($node->id, $in_eliminateID)) {
                $list[$node->id] = str_repeat('-', $node['level'] * 5) . $node->name;
            }
        }
        return $list;
    }

    public function search() {
        $tree = array();
        if (empty($this->name)) {
            $tree = Menu::buildTree($this->type_id);
        } else {
            $model = self::model()->find("name like '%{$this->name}%'");
            if ($model !== null) {
                $tree = Menu::buildTreeByMenu($model->id);
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

    public function defaultScope() {
        return array(
            'order' => 'type_id, weight desc'
        );
    }

}
