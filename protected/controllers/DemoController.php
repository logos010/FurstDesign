<?php

/**
 * Description of DemoController
 *
 * @author Hao
 */
class DemoController extends ControllerBase {

    public function actionIndex() {
        
        // Criteria or Product class
        $criteria = array(
            'limit' => 2,
        );
        
        $services = UService::call('admin/ProductService/search', $criteria);
        $this->render('index', array(
            'data' => $services->data,
            'page' => $services->page
        ));
    }

}