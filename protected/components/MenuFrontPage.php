<?php

class MenuFrontPage extends CWidget{
    
    public function run(){
        $criteria = new CDbCriteria();
        $criteria->condition = "status = 1 AND type_id = 1";
        $criteria->addCondition("parent_id = 31", "AND");
        $criteria->order = "weight";
        
        $menu = Menu::model()->findAll($criteria);

        $this->render('Menu', array(
           'menu' => $menu
        ));
    }
}