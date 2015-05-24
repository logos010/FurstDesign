<?php

class Product extends ProductBase implements IECartPosition {
    
    public $lowPrice = 0;
    public $highPrice = 0;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function relations() {
        return array(
            //'pTerm' => array(self::MANY_MANY, 'Term', 'tbl_product_term(pid,tid)', 'together' => true, 'joinType' => 'INNER JOIN'),            
            'pTerm' => array(self::MANY_MANY, 'Term', 'tbl_product_term(pid,tid)', 'together' => true, 'joinType' => 'INNER JOIN'),
            'gallery' => array(self::HAS_MANY, 'Gallery', 'pid'),
            'orderDeail' => array(self::HAS_MANY, 'OrderDetail', 'pid'),
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('uri', $this->uri, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('sku', $this->sku, true);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('price', $this->price);
        $criteria->compare('wholesale_price', $this->wholesale_price);
        $criteria->compare('bought', $this->bought);
        $criteria->compare('discount', $this->discount);
        $criteria->compare('sale_promotion', $this->sale_promotion);
        $criteria->compare('like', intval($this->like));
        $criteria->compare('subscripbe', $this->subscripbe);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('detail', $this->detail, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_time', $this->update_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function loadProductPromotion() {
        $promotion = Product::model()->findAll(array());

        $slider = NULL;
        $firstItem = 1;
        if (!is_null($promotion)) {
            foreach ($promotion as $k => $v) {
                $firstItem = ($firstItem == 1) ? ' active' : ' ';

                $slider .= CHtml::openTag('div', array('class' => 'item' . $firstItem));
                $slider .= CHtml::openTag('div', array('class' => 'col-sm-6'));
                $slider .= CHtml::tag('h1', array(), $v->name, TRUE);
                $slider .= CHtml::tag('h2', array(), 'Free Shipping', TRUE);
                $slider .= CHtml::tag('p', array(), $v->description, true);
                $slider .= CHtml::button('Dat Hang Ngay', array('class' => 'btn btn-default get add-to-cart', 'id' => 'addToCart-'.$v->id));
                $slider .= CHtml::closeTag('div');
                $slider .= CHtml::openTag('div', array('class' => 'col-sm-6'));
                $slider .= CHtml::image(BASE_URL . "/" . $v->image, $v->name, array('class' => 'girl img-responsive'));
                $slider .= CHtml::image(App()->theme->baseUrl . "/images/home//pricing.png", 'Price', array('class' => 'pricing'));
                $slider .= CHtml::closeTag('div');
                $slider .= CHtml::closeTag('div');

                $firstItem++;
            }
        }
        return $slider;
    }
    
    public function getId() {
        return 'Product ' . $this->id;
    }

    public function getPrice() {
        return $this->price;
    }

    public function isProductDiscounted($product){
        $newPrice = 0;
        if ($product->discount < 1){
            $newPrice = $product->price * (1 - $product->discount);            
        }else{
            $newPrice = $product->price = $product->discount;            
        }
        $newPrice = number_format($newPrice, 0, '', ',');
        return '<del style="font-size: 0.8em">' . number_format($product->price, 0, "", ",") . "</del>" . "<sup> đ</sup>" . 
                "<span class='new-price'>" . $newPrice . "<sup> đ</sup></span>" . " (Saved " . (($product->discount < 1) ? ($product->discount * 100) . "%" : ($product->discount) . "<sup>đ</sup>") . ")";
    }
}
