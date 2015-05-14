<?php

class Promotion extends CWidget{
        
    public function run(){
        $productPromotion = new Product();
        
        $this->render('promotion', array(
            'promotion' => $productPromotion->loadProductPromotion(),
        ));
    }
}