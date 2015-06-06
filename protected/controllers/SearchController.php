<?php
Yii::import('application.modules.admiin.model.*');

class SearchController extends ControllerBase{
    
    public function actionSearchInBasic(){
        if (isset($_REQUEST['search'])){
            var_dump($_REQUEST['search']);  
            $criteria = new CDbCriteria();
            $criteria->compare('name', $_REQUEST['search'], true);
            $criteria->compare('price', $_REQUEST, true, 'OR');
            $criteria->compare('description', $_POST['search'], true, 'OR');
            $criteria->compare('detail', $_POST['search'], true, 'OR'); 
            
            $products = Product::model()->findAll($criteria);            
            if (count($products)){
                $prodSearch = null;
                foreach ($products as $k => $v){
                    $prodSearch .= '<div class="catalogue-itembox" style="width: 27.3%; padding: 3%; height:310px; margin-top: 3.5em">';
                        $prodSearch .= '<div class="item-product-img">';
                        $prodSearch .= '<a href="">';
                        $prodSearch .= '<img src="'.$v->image.'" border="0" class="product-img">';
                        $prodSearch .= "</a>";
                        $prodSearch .= "</div>";
                        
                        $prodSearch .= '<div class="item-desc">';
                            $prodSearch .= '<a href="">';
                                $prodSearch .= '<span><strong></strong></span>';
                                $prodSearch .= '<div class="clear2"></div><span> CK1-70380433</span>';
                            $prodSearch .= '</a>';                        
                            $prodSearch .= '<div class="clear2"></div>';
                            if ($v->discount != 0){
                                $prodSearch .= $v->isProductDiscounted($v);
                            }else{
                                $prodSearch .= '<span class=\'product-price\'>'.number_format($v->price, 0, "", ",").'</span><sup> đ</sup>';
                            }
                            $prodSearch .= '<div class="clear2"></div>';
                            $prodSearch .= '<div class="item-label">NEW </div>';
                            $prodSearch .= '</div>';
                        $prodSearch .= '<div class="clear"></div>';                        
                    $prodSearch .= "</div>";
                } //end foreach
            } // end if            
            echo $prodSearch;
        }
    }
}
