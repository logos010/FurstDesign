<?php

class UtiService {

    public static function loadCategoryNameById($tid) {
        $term = Term::model()->find(array(
            'condition' => 'id=:tid',
            'params' => array(
                ':tid' => $tid,
            )
        ));

        return $term->name;
    }

    public static function loadProductById($pid) {
        $product = Product::model()->findByPk($pid);
        return $product;
    }

    public static function loadBreadcrumbs($tid) {
        $term = Term::model()->findByPk($tid);
        return self::getParentName($term->parent_id) . " - " . $term->name;
    }

    public static function getParentName($parentID) {
        $parent = Term::model()->find(array(
            'condition' => 'id=:pid',
            'params' => array(
                ':pid' => $parentID,
            )
        ));
        return (!is_null($parent)) ? $parent->name : '';
    }

    public static function termParent($parentID) {
        $parent = Term::model()->findByPk($parentID);
        if (!is_null($parent)) {
            return $parent->name;
        }
    }

    public static function getTermBreadcrumbs($tid) {
        if ($tid !== null) {
            $t = null;
            $term = Term::model()->findByPk($tid);
            if (!is_null($term)) {
                $t = $term->name;
                // parent_id 1 is for Male, 0 for Female, don't take those 2 id as breeadcrumbs reference
                if ($term->parent_id != 1 && $term->parent_id != 0) {
                    $p = self::termParent($term->parent_id);
                } else
                    return null;
                return $p . " - " . $t;
            }
        }else {
            return null;
        }
    }

}
