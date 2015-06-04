<?php

class UtiService {
    
    public static function loadCategoryNameById($tid){
        $term = Term::model()->find(array(
            'condition' => 'id=:tid',
            'params' => array(
                ':tid' => $tid,
            )
        ));
        
        return $term->name;
    }
    
    public static function loadProductById($pid){
        $product = Product::model()->findByPk($pid);
        return $product;
    }
}
