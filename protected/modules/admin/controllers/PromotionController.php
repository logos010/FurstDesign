<?php

class PromotionController extends ControllerBase {

    public $defaultAction = 'admin';

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

    public function actionGenerateAlias() {
        echo UString::toAlias($_POST['Promotion']['name']);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Promotion;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Promotion'])) {
            $model->attributes = $_POST['Promotion'];
            $model->alias = $_POST['Promotion']['alias'];
            $model->create_time = date('Y-m-d H:i:s');
           
//            var_dump(CUploadedFile::getInstance($model, 'image'));
            $this->uploadImage($model);
            
            if ($model->save()){
                $this->setFlash('Promotion has been created.');
                $this->refresh();
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }
    
    public function uploadImage($model) {
        $image = CUploadedFile::getInstance($model, 'image');
        if (is_object($image)) {
            Yii::import('application.extensions.image.Image');
            Yii::import('application.extensions.helpers.*');

            $name = date('Ymdhis') . '.' . strtolower($image->extensionName);
            $uri = 'upload/promotion/' . date('Y/m');

            if (!is_dir($uri)) {
                mkdir($uri . '/original', 0777, true);
            }

            $img = new Image($image->tempName);
            $img->save($uri . '/original/' . $name);
            
            $model->image = $uri . '/original/' . $name;
        }
    }
    
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $img = $model->image;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Promotion'])) {
            $model->attributes = $_POST['Promotion'];
            
            if ($_FILES['Promotion']['image'] === null){
                $model->image = $img;                
            }else
                $this->uploadImage($model);
            
            if ($model->save())
                $this->setFlash('Promotion has been updated.');
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Promotion');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Promotion('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Promotion']))
            $model->attributes = $_GET['Promotion'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Promotion the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Promotion::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Promotion $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'promotion-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
