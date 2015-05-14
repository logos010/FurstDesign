<?php

class AdminController extends ControllerBase {

    private $_model;

    public function init() {
        App()->theme = ADMIN_THEME;
        parent::init();
        $this->registerCS();
    }

    public function registerCS() {
        // Add jQuery library
        cs()->registerCoreScript('jquery');

        /*** FancyBox ** */
        cs()->registerCssFile(App()->theme->baseUrl . '/fancybox/source/jquery.fancybox.css?v=2.1.5');
        cs()->registerScriptFile(App()->theme->baseUrl . '/fancybox/source/jquery.fancybox.pack.js?v=2.1.5', CClientScript::POS_BEGIN);

        cs()->registerScriptFile(App()->theme->baseUrl . '/js/jquery.ba-hashchange.url-encode.js', CClientScript::POS_BEGIN);

        if (isset($_GET['ajax']) && preg_match('/(true|1)/', $_GET['ajax'])) {
            $this->layout = '//layouts/none';
        }
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $criteria = new CDbCriteria();
        if (isset($_GET['search'])) {
            $search = trim($_GET['search']); 
            if(strpos($search, ':') !== false){
				$data = UString::toArray(strtolower($search));
				foreach($data as $key => $value){
					$criteria->compare($key, $value);
				}
			} else {
				$criteria->compare('username', $search, true, 'OR');
				$criteria->compare('email', $search, true, 'OR');
				$criteria->compare('id', $search, false, 'OR');
			}
        }

        $dataProvider = new CActiveDataProvider('User', array(
            'pagination' => array(
                'pageSize' => UConfig::get('page', 'admin')
            ),
            'criteria' => $criteria
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Displays a particular model.
     */
    public function actionView() {
        $model = $this->loadModel();
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;
        $profile = new Profile;
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->activkey = Yii::app()->controller->module->encrypting(microtime() . $model->password);
            $model->createtime = time();
            $model->lastvisit = time();
            $profile->attributes = $_POST['Profile'];
            $profile->user_id = 0;
            if ($model->validate() && $profile->validate()) {
                $model->password = Yii::app()->controller->module->encrypting($model->password);
                if ($model->save()) {
                    $profile->user_id = $model->id;
                    $profile->save();
                }
                $this->setFlash('User has been created.');
                $this->refresh();
            } else
                $profile->validate();
        }

        $this->render('create', array(
            'model' => $model,
            'profile' => $profile,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate() {
        $model = $this->loadModel();
        $profile = $model->profile;
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $profile->attributes = $_POST['Profile'];

            if ($model->validate() && $profile->validate()) {
                $old_password = User::model()->notsafe()->findByPk($model->id);
                if ($old_password->password != $model->password) {
                    $model->password = Yii::app()->controller->module->encrypting($model->password);
                    $model->activkey = Yii::app()->controller->module->encrypting(microtime() . $model->password);
                }
                $model->save();
                $profile->save();
                $this->setFlash('User has been updated.');
                $this->refresh();
            } else
                $profile->validate();
        }

        $this->render('update', array(
            'model' => $model,
            'profile' => $profile,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete($id = null) {
        if (Yii::app()->request->isPostRequest) {
            if ($id != null) {
                $rs = User::model()->deleteByPk($key);
                Profile::model()->deleteByPk($key);
            } else {
                $ids = $_POST['chk'];
                if (is_array($ids)) {
                    foreach ($ids as $key) {
                        $rs = User::model()->deleteByPk($key);
                        Profile::model()->deleteByPk($key);
                    }
                }
            }
            if (Yii::app()->request->isAjaxRequest) {
                echo CJSON::encode(array('success' => true, 'msg' => $msg));
                App()->end();
            } else {
                $this->setFlash($msg);
                $this->redirect(array('index'));
            }
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if ($this->_model === null) {
            if (isset($_GET['id']))
                $this->_model = User::model()->notsafe()->findbyPk($_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

}
