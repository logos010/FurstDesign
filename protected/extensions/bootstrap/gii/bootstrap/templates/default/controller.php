<?php
/**
 * AJAX CRUD Controller Class
 * The following variables are available in this template:
 * - $this: the CrudCode object
 *
 * @author HAOLV
 */
?>
<?php echo "<?php\n"; ?>
/**
 * AJAX CRUD Controller Class
 * The following variables are available in this template:
 * - $this: the CrudCode object
 *
 * @author HaoLV
 */
 
class <?php echo $this->controllerClass; ?> extends <?php echo "ControllerBase\n"; ?>
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
		$model=new <?php echo $this->modelClass; ?>;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save()){
                            $this->setFlash('<?php echo $this->modelClass; ?> has been created.');
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

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save()){
                            $this->setFlash('<?php echo $this->modelClass; ?> has been updated.');
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
                        $msg = '<?php echo $this->modelClass; ?> ID #' . $id . ' has been deleted.';
                    } else {
                        $ids = $_POST['chk'];
                        if (is_array($ids)){
                            foreach ($ids as $id){
                                $rs = <?php echo $this->modelClass; ?>::model()->deleteByPk($id);
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
		$model=new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['<?php echo $this->modelClass; ?>']))
			$model->attributes=$_GET['<?php echo $this->modelClass; ?>'];

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
		$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
		{
			echo CActiveForm::validate($model);
			App()->end();
		}
	}
}
