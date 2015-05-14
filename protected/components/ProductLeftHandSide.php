<?php

class ProductLeftHandSide extends CWidget{
    
    public function run() {
        $term = new Term();        
        
        $this->render('ProductLeftHandSide', array(
            'terms' => $term->buildCategory()
        ));
    }
}
