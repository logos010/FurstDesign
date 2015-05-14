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
    
    public function getTermParent(){
        $terms = $this->findAll(array(
            'condition' => 'vid = 1 AND status = 1 AND parent_id = 0'
        ));
        return $terms;
    }

    public function hasChild($pid) {
        $child = Term::model()->count(array(
            'condition' => 'vid = 1 AND parent_id = :pid AND status = 1',
            'params' => array(':pid' => $pid)
        ));

        if (intval($child) != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function buildCategory() {
        $terms = $this->findAll(array(
            'condition' => 'vid = 1 AND status = 1 AND parent_id = 0'
        ));
        
        $cate = NULL;
        foreach ($terms as $term => $value){
            $cate .= CHtml::openTag('div', array('class' => 'panel panel-default'));
                $cate .= CHtml::openTag('div', array('class' => 'panel-heading'));
                    $cate .= CHtml::openTag('h4', array('class' => 'panel-title'));
                        if ($this->hasChild($value->id)) {
                            $cate .= CHtml::openTag('a', array('data-toggle' => 'collapse', 'data-parent' => '#accordian', 'href' => "#".$value->alias));
                                $cate .= CHtml::openTag('span', array('class' => 'badge pull-right'));
                                    $cate .= CHtml::openTag('i', array('class' => 'fa fa-plus'));
                                    $cate .= CHtml::closeTag('i');
                                $cate .= CHtml::closeTag('span');
                                $cate .= $value->name;
                            $cate .= CHtml::closeTag('a');
                        }else{
                            $cate .= CHtml::openTag('a', array('href' => App()->createUrl('/product/cate/', array('tid' => $value->id))));                            
                                $cate .= $value->name;
                            $cate .= CHtml::closeTag('a');
                        }                        
                    $cate .= CHtml::closeTag('h4');
                $cate .= CHtml::closeTag('div');
                
                if ($this->hasChild($value->id)) {
                    $CateTree = $this->findAll(array(
                        'select' => 'id, name, alias, url, name_seo',
                        'condition' => 'vid = 1 AND parent_id = :pid AND status = 1',
                        'params' => array(':pid' => $value->id)
                    ));

                    $cate .= CHtml::openTag('div', array('class' => 'panel-collapse collapse', 'id' => $value->alias));
                        $cate .= CHtml::openTag('div', array('class' => 'panel-body'));
                            $cate .= CHtml::openTag('ul', array());
                                foreach ($CateTree as $k => $v) {
                                    $cate .= CHtml::openTag('li');                                    
                                        $cate .= CHtml::link($v->name, Yii::app()->createUrl('/product/cate/', array('tid' => $v->id)), array());
                                    $cate .= CHtml::closeTag('li');
                                }
                            $cate .= CHtml::closeTag('ul');
                        $cate .= CHtml::closeTag('div');
                    $cate .= CHtml::closeTag('div');
                }
                
            $cate .= CHtml::closeTag('div');            
        }
        return $cate;
    }

}

?>