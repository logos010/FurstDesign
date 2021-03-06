<?php

class ManageController extends ControllerBase {

    public function init() {
        App()->theme = ADMIN_THEME;
        parent::init();
        $this->registerCS();
    }

    public function registerCS() {
        // Add jQuery library
        cs()->registerCoreScript('jquery');

        /*         * * FancyBox ** */
        cs()->registerCssFile(App()->theme->baseUrl . '/fancybox/source/jquery.fancybox.css?v=2.1.5');
        cs()->registerScriptFile(App()->theme->baseUrl . '/fancybox/source/jquery.fancybox.pack.js?v=2.1.5', CClientScript::POS_BEGIN);
        cs()->registerScriptFile(App()->theme->baseUrl . "/js/jquery.number.js", CClientScript::POS_END);

        if (isset($_GET['ajax']) && preg_match('/(true|1)/', $_GET['ajax'])) {
            $this->layout = '//layouts/none';
        }
    }

    public function actionIndex() {
        $criteria = new CDbCriteria();

        $dataProvider = new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 15,
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider
        ));
    }
    
    public function actionView($id){
        $criteria = new CDbCriteria();
        $criteria->condition = "order_id=:oid";
        $criteria->params = array(
            ':oid' => $id,
        );
        
        $orderDetail = new CActiveDataProvider('OrderDetail', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 15,
            )            
        ));
        
        $order = Order::model()->findByPk($id);
        
        $this->render('view', array(
            'dataProvider' => $orderDetail,
            'order' => $order
        ));
    }

}
