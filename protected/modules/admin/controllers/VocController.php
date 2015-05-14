<?php
/**
 * AJAX CRUD Controller Class
 * The following variables are available in this template:
 * - $this: the CrudCode object
 *
 * @author HaoLV
 */
 
class VocController extends ControllerBase
{
	public function init() {
        App()->theme = ADMIN_THEME;
        parent::init();
        $this->registerCS();
    }

    public function registerCS() {
        // Add jQuery library
        cs()->registerCoreScript('jquery');
 
        /*** FancyBox ***/
        cs()->registerCssFile(App()->theme->baseUrl . '/fancybox/source/jquery.fancybox.css?v=2.1.5');
        cs()->registerScriptFile(App()->theme->baseUrl . '/fancybox/source/jquery.fancybox.pack.js?v=2.1.5', CClientScript::POS_BEGIN);

        if(isset($_GET['ajax']) && preg_match('/(true|1)/', $_GET['ajax'])){
            $this->layout = '//layouts/none';
        }
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
                $this->render('view', array('model' => $this->loadModel($id)));
	}

	/**
	 * Creates a new model.
	 */
	public function actionCreate()
	{
		$model=new Vocabulary;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Vocabulary']))
		{
			$model->attributes=$_POST['Vocabulary'];
			if($model->save()){
                            $this->setFlash('Vocabulary has been created.');
                            $this->refresh();
                            //$this->redirect(array('view', 'id' => $id));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Vocabulary']))
		{
			$model->attributes=$_POST['Vocabulary'];
			if($model->save()){
                            $this->setFlash('Vocabulary has been updated.');
                            $this->refresh();
                            //$this->redirect(array('view', 'id' => $id));
                        }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id=null)
	{
		if(Yii::app()->request->isPostRequest)
		{
                    if ($id !== null) {
                        $this->loadModel($id)->delete();
                        $msg = 'Vocabulary ID #' . $id . ' has been deleted.';
                    } else {
                        $ids = $_POST['chk'];
                        if (is_array($ids)){
                            foreach ($ids as $id){
                                $rs = Vocabulary::model()->deleteByPk($id);
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
		}
		else
                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Vocabulary('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vocabulary']))
			$model->attributes=$_GET['Vocabulary'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Vocabulary::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vocabulary-form')
		{
			echo CActiveForm::validate($model);
			App()->end();
		}
	}
        
        public function actionGenerateAlias() {
            echo UString::toAlias($_POST['Vocabulary']['name']);
        }
}
