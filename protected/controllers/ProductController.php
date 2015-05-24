<?php

class ProductController extends ControllerBase {

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionIndex() {
        $terms = Term::model()->findAll(array(
            'condition' => 'status = 1 AND parent_id = 0',
        ));
                
        $this->render('index', array(
            'terms' => $terms
                
        ));
    }

    /**
     * Performs the AJAX validation.
     * @param Product $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function loadProduct() {
        $product = Product::model()->findAll(array(
            'condition' => 'status = 1',
        ));
       
        $grid = $this->generateProduct($product);        
        return $grid;
    }
    
    public function generateProduct($product){
        $grid = NULL;
        if (!is_null($product)) {
            foreach ($product as $k => $v) {
                $grid .= CHtml::openTag('div', array('class' => 'col-sm-4'));
                $grid .= CHtml::openTag('div', array('class' => 'product-image-wrapper'));
                $grid .= CHtml::openTag('div', array('class' => 'single-products'));
                $grid .= CHtml::openTag('div', array('class' => 'productinfo text-center'));
                $grid .= CHtml::link(CHtml::image(BASE_URL . "/" . $v->image, $v->alias, array()), $this->createUrl('detail', array('pid' => $v->id)), array());
                $grid .= CHtml::tag('h2', array(), number_format($v->price, 0, '.', ',') . " " . CHtml::tag('sup', array(), 'đ', TRUE), TRUE);
                $grid .= CHtml::link(CHtml::tag('p', array(), $v->name, TRUE), $this->createUrl('detail', array('pid' => $v->id)), array());
                $grid .= CHtml::openTag('a', array('class' => 'btn btn-default add-to-cart', 'id' => 'product-' . $v->id));
                $grid .= CHtml::tag('i', array('class' => 'fa fa-shopping-cart'), ' ', TRUE);
                $grid .= "Add to card";
                $grid .= CHtml::closeTag('a');
                $grid .= CHtml::closeTag('div');

//                            $grid .= CHtml::openTag('div', array('class' => 'product-overlay'));
//                                $grid .= CHtml::openTag('div', array('class' => 'overlay-content'));
//                                    $grid .= CHtml::tag('h2', array(), $v->price, TRUE);
//                                    $grid .= CHtml::tag('p', array(), $v->description, TRUE);
//                                    $grid .= CHtml::openTag('a', array());
//                                        $grid .= CHtml::tag('i', array('class' => 'fa fa-shopping-cart'), ' ', TRUE);
//                                        $grid .= "Add to card";
//                                $grid .= CHtml::closeTag('a');
//                                $grid .= CHtml::closeTag('div');
//                            $grid .= CHtml::closeTag('div');

                $grid .= CHtml::closeTag('div'); //single product

                $grid .= CHtml::openTag('div', array('class' => 'choose'));
                $grid .= CHtml::openTag('ul', array('class' => 'nav nav-pills nav-justified'));
                $grid .= CHtml::openTag('li');
                $grid .= CHtml::tag('a', array('href' => '#'), CHtml::tag('i', array('class' => 'fa fa-plus-square'), ' ', TRUE) . "Add to wishlist", TRUE);
                $grid .= CHtml::closeTag('li');
                $grid .= CHtml::openTag('li');
                $grid .= CHtml::tag('a', array('href' => '#'), CHtml::tag('i', array('class' => 'fa fa-plus-square'), ' ', TRUE) . "Add to wishlist", TRUE);
                $grid .= CHtml::closeTag('li');

                $grid .= CHtml::closeTag('ul');
                $grid .= CHtml::closeTag('div'); //choose/                       

                $grid .= CHtml::closeTag('div'); //wrapper
                $grid .= CHtml::closeTag('div');
            }
        }
        return $grid;
    }

    public function actionDetail($pid) {
        cssFile(App()->theme->baseUrl . '/css/jquery.jqzoom.css');
        scriptFile(App()->theme->baseUrl . '/js/jquery.browser.js', CClientScript::POS_BEGIN);
        scriptFile(App()->theme->baseUrl . '/js/jquery.jqzoom-core.js', CClientScript::POS_BEGIN);        
        scriptFile(App()->theme->baseUrl . '/js/jquery.ddslick.js', CClientScript::POS_BEGIN);
        
        $product = Product::model()->findByPk($pid);

        $gallery = ProductGallery::model()->findAll(array(
            'condition' => 'pid = :pid',
            'params' => array(
                ':pid' => $pid,
            )
        ));

        //load product's reviews
        $review = ProductReview::model()->findAll(array(
            'select' => 'name, content, SUBSTRING( create_time, 1, 10 ) AS date, SUBSTRING( create_time, 12 ) AS time',
            'condition' => 'pid = :pid',
            'params' => array(':pid' => $pid),
            'order' => 'create_time DESC'
        ));
         
        //load recommend product
        $criteria = new CDbCriteria();
        //$criteria->condition = "t.id != ".intval($pid); 
        
        $prodCate = $product->pTerm;
        foreach ($prodCate as $k => $v){
            $criteria->addCondition('pTerm.id = '.$v->id, 'or');
        }
        
        $criteria->group = "t.id";
        $criteria->having = "t.id <> " . $pid;
                    
        //print_r($criteria);
        $recommendProducts = Product::model()->with('pTerm')->findAll($criteria);
                        
        $this->render('detail', array(
            'product' => $product,
            'gallery' => $gallery,
            'review' => $review,
            'recommendProducts' => $recommendProducts,
            'numOfReview' => count($review)
        ));
    }

    public function actionCate($tid) {
        $product = Product::model()->with('pTerm')->findAll(array(
            'condition' => 'pTerm.id = :tid',
            'params' => array(
                ':tid' => $tid,
            )
        ));
        
        $this->render('loadProductByCate', array(
            'products' => $product,
            'totalProducts' => count($product)
        ));
    }

    public function actionProductReview($pid) {
        $prodReview = new ProductReview();
        $prodReview->pid = $pid;
        $prodReview->name = $_POST['name'];
        $prodReview->email = $_POST['email'];
        $prodReview->content = $_POST['content'];
        $prodReview->create_time = date('Y-m-d H:i:s', time());

        if ($prodReview->save()) {
            echo 'done';
        } else {
            var_dump($prodReview->getErrors());
            echo 'saving error';
        }
    }    

    public function actionLoadProductByPrice(){
        $lowPrice = isset($_POST['lowPrice']) ? $_POST['lowPrice'] : 0;
        $highPrice =  isset($_POST['highPrice']) ? $_POST['highPrice'] : 0;
        
        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition('price', $lowPrice, $highPrice);
        
        $product = Product::model()->findAll($criteria);
        $grid = $this->generateProduct($product);
        echo $grid;    
    }
    
    public function actionSearchProduct(){
        $searchKey = isset($_POST['searchKey']) ? $_POST['searchKey'] : '';
        
        $criteria = new CDbCriteria();
        $criteria->compare('name', $searchKey, true, 'OR');
        $criteria->compare('price', $searchKey, true, 'OR');
        $criteria->compare('sku', $searchKey, true, 'OR');
        $criteria->compare('description', $searchKey, true, 'OR');
        $criteria->compare('detail', $searchKey, true, 'OR');
                
        $product = Product::model()->findAll($criteria);
        echo $grid = (!is_null($product)) ? $grid = $this->generateProduct($product) : '';
    }
}
