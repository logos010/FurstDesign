<?php

class OrderController extends ControllerBase {
    
    //clear all positions
    public function actionRemoveItems() {
        App()->shoppingCart->clear();
    }
    
    //clear 1 position
    public function actionRemoveItem() {
        $pid = $_POST['pid'];
        $product = Product::model()->findByPk($pid);
        Yii::app()->shoppingCart->remove($product->getId());
    }
    
    public function actionViewCart() {        
        $shopping = App()->shoppingCart;

        $this->render('viewCart', array(
            'items' => App()->shoppingCart->getPositions(),
            'totalPrice' => $shopping->getCost(),
        ));
    }
    
    public function actionAddToCart() {
        $pid = $_POST['pid'];
        $size = $_POST['size'];
        $quantity = $_POST['quantity'];
        $product = Product::model()->findByPk($pid);
        App()->shoppingCart->put($product, $quantity);
        echo App()->shoppingCart->getCount();
    }
    
    public function actionCheckOut() {
        Yii::app()->session['userView' . App()->user->id . 'returnURL'] = Yii::app()->request->Url;
        if (App()->user->isGuest) {
            $this->redirect(Yii::app()->createUrl('user/login'));
        } else {
            $this->redirect(Yii::app()->createUrl('order/orderConform', array('cid' => App()->user->id)));
        }
    }

    public function actionOrderConform($cid) {        
        scriptFile(App()->theme->baseUrl . "/js/validator.min.js");
        
        $user = User::model()->findByPk($cid);
        if (!is_null($user)) {            
            if (isset($_POST['order'])) {
                var_dump($session['validOrder']);
                $totalOrder = intval(Order::model()->count());
                $purchaseID = OrderService::generate_numbers(995 + $totalOrder, 1, 10);                
                
                $order = new Order();
                $order->customer_id = App()->user->id;
                $order->purchase_id = $purchaseID[0];
                $order->create_time = date('Y-m-d H:i:s', time());
                $order->invoice_total = App()->shoppingCart->getCost();
                $order->shipping_fee = 0;
                $order->grand_total = App()->shoppingCart->getCost();
                $order->save();
                

                $items = App()->shoppingCart->getPositions();
                foreach ($items as $item) {
                    $detail = new OrderDetail;
                    $detail->order_id = $order->order_id;
                    $detail->product_id = $item->id;
                    $detail->price = $item->price;
                    $detail->quantity = $item->getQuantity();
                    $detail->discount = 0;
                    $detail->line_total = $item->getSumPrice();
                    $detail->save();
                }
                Yii::app()->shoppingCart->clear();
                
                $this->render('thankyou', array(
                    'order' => Order::model()->findByPk($order->order_id),
                    'orderDetail' => OrderDetail::model()->findAll(array('condition' => 'order_id=:oid', 'params' => array(':oid' => $order->order_id)))
                ));
            } else {
                $profile = $user->profile;
                $this->render('orderConform', array(
                    'user' => $user,
                    'profile' => $profile,
                    'district' => $this->loadDistrict()
                ));
            }
        } else {
            $this->redirect(Yii::app()->createUrl('user/login'));
        }
    }
    
    public function actionMyOrders(){
        $user = App()->user->id;
        $orders = Order::model()->findAll(array(
            'condition' => 'customer_id = :cid',
            'params' => array(
                ':cid' => $user,
            )
        ));
        
        $this->render('myOrders', array(
            'myOrders' => $orders,
        ));
    }
    
    public function loadDistrict() {
        Yii::import('application.models.District');

        $districts = District::model()->findAll(array(
            'select' => 'district_id, concat(type, " ", name) as district_name',
            'condition' => 'province_id = 79',
            'order' => 'district_name'
        ));

        $option = null;
        
        foreach ($districts as $k => $v) {
            $option .= CHtml::tag('option', array('value' => $v->district_id), $v->district_name, true);
        }
        return $option;
    }

    public function actionLoadWard() {
        $district = $_POST['did'];
        $wards = Ward::model()->findAll(array(
            'select' => 'ward_id, concat(type, " ", name) as ward_name',
            'condition' => 'district_id =:did',
            'params' => array(
                ':did' => $district,
            ),
            'order' => 'ward_name'
        ));

        $option = "<option>-- Chọn Phường/Xã --</option>";
        foreach ($wards as $k => $v) {
            $option .= CHtml::tag('option', array('value' => $v - ward_id), $v->ward_name, true);
        }
        echo $option;
    }
    
    public function actionAjaxUpdateProductCartQty($pid, $qty){
        $shopping = App()->shoppingCart;
        
        $product = Product::model()->findByPk($pid);
        $shopping->update($product, $qty);
    }
}