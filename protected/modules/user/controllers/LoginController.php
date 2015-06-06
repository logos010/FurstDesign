<?php

class LoginController extends ControllerBase {

    public $defaultAction = 'login';

    public function init() {
        parent::init();
        $this->layout = '//layouts/user/main';
    }
    
    /**
     * Displays the login page
     */
    public function actionLogin() {        
        if (Yii::app()->user->isGuest) {
            $model = new UserLogin;
            
            // collect user input data
            if (isset($_POST['UserLogin'])) {                
                $model->attributes = $_POST['UserLogin'];
//                var_dump(Yii::app()->user->returnUrl);
//                var_dump(Yii::app()->controller->module->returnUrl); exit();
                // validate user input and redirect to previous page if valid
                
                if ($model->validate()) {
                    $this->lastViset();
                    if (strpos(Yii::app()->user->returnUrl, '/index.php') !== false){
                        $returnUrl = isset(Yii::app()->request->cookies['returnUrl']) ? Yii::app()->request->cookies['returnUrl']->value : '';
                        $this->redirect($returnUrl);
                    }else{
                        $returnUrl = isset(Yii::app()->request->cookies['returnUrl']) ? Yii::app()->request->cookies['returnUrl']->value : '';
                        $this->redirect($returnUrl);
                    }
                }
            }
//            echo Yii::app()->session['userView'.App()->user->id.'returnURL'];
            // display the login form
            $this->render('/user/login', array('model' => $model));
        }
        else    
//            $this->redirect(Yii::app()->session['userView'.App()->user->id.'returnURL']);        
            $this->redirect(Yii::app()->controller->module->returnUrl);
    }

    private function lastViset() {
        $lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
        $lastVisit->lastvisit = time();
        $lastVisit->save();
    }

}