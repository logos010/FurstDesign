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
    
    public static function loadBreadcrumbs($tid){
        $term = Term::model()->findByPk($tid);
        return self::getParentName($term->parent_id) . " - " . $term->name;
    }
    
    public static function getParentName($parentID){
        $parent = Term::model()->find(array(
            'condition' => 'id=:pid',
            'params' => array(
                ':pid' => $parentID,
            )
        ));
        return (!is_null($parent)) ? $parent->name: '';
    }
            
}
