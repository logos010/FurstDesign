<?php

Yii::import('application.modules.admin.models.Promotion');

class PromotionRightBottom extends CWidget{
    
    public $position = 1;
    
    public function run(){
        $criteria = new CDbCriteria();
        if ($this->position <= 3){
            $criteria->condition = 'position = :position AND status = 1';
            $criteria->params = array(
                ':position' => $this->position
            );
            $promotion = Promotion::model()->find($criteria);
        }else{
            $criteria->condition = 'position >= :position AND status = 1';
            $criteria->params = array(
                ':position' => $this->position
            );
            $promotion = Promotion::model()->findAll($criteria);
        }
        
        $this->render('PromotionRightBottom', array(
            'promotion' => $promotion,
        ));
    }    
}
