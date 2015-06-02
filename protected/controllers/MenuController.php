<?php

class MenuController extends ControllerBase {
    
    public function actionGenerateMenu($mid){
        $criteria = new CDbCriteria();
        $criteria->condition = "status = 1 AND type_id = 1";
        $criteria->addCondition("parent_id = :mid", "AND");
        $criteria->params = array(
            ':mid' => $mid,
        );
        $criteria->order = "weight";
        
        $menuModel = Menu::model()->findAll($criteria);
        $menu = null;
        foreach ($menuModel as $k => $v){
            if ($v->hasChild($v->id)){
                $menu .= '<li class="dropdown"><a href="'.App()->controller->createUrl($v->url).'" class="primary" >'.$v->name.'</a>';
                $menu .= '<ul>';
                $subMenu = $v->hasChild($v->id); 
                    foreach ($subMenu as $sk => $sv){
                        $menu .= '<li><a href="'.App()->controller->createUrl($sv->url).'">'.$sv->name.'</a></li>';
                    }
                $menu .= '</ul>';
                $menu .= '</li>';
            }else{
                $menu .= '<li><a href="'.App()->controller->createUrl($v->url).'">'.$v->name.'</a></li>';
            }
        }
        echo $menu;
    }
    
}