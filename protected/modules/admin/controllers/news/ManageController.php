<?php

/**
 * AJAX CRUD Controller Class
 * The following variables are available in this template:
 * - $this: the CrudCode object
 *
 * @author HaoLV
 */
Yii::import('ext.image.Image');
Yii::import('ext.helpers.*');

class ManageController extends ControllerBase {

    public function init() {
        App()->theme = ADMIN_THEME;
        parent::init();
        $this->registerCS();
        if (isset($_GET['ajax']) && $_GET['ajax'] === 'image-grid') {
            $this->loadImage();
        }
    }

    public function loadImage() {
        $this->render('/upload');
        exit;
    }

    public function registerCS() {
        // Add jQuery library
        cs()->registerCoreScript('jquery');

        /*         * * FancyBox ** */
        cs()->registerCssFile(App()->theme->baseUrl . '/fancybox/source/jquery.fancybox.css?v=2.1.5');
        cs()->registerScriptFile(App()->theme->baseUrl . '/fancybox/source/jquery.fancybox.pack.js?v=2.1.5', CClientScript::POS_BEGIN);

        // Editable
        cs()->registerCssFile(App()->theme->baseUrl . '/editable/bootstrap-editable.css');
        cs()->registerScriptFile(App()->theme->baseUrl . '/editable/bootstrap-editable.min.js', CClientScript::POS_BEGIN);

        if (isset($_GET['ajax']) && preg_match('/(true|1)/', $_GET['ajax'])) {
            $this->layout = '//layouts/none';
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array('model' => $this->loadModel($id)));
    }

    /**
     * Creates a new model.
     */
    public function actionCreate() {
        $model = new News;
        $model->publish_time = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
        $model->create_time = gmdate('Y-m-d H:i:s', time() + 7 * 3600);

        $model->strip_tag = true;
        if (isset($_GET['News'])) {
            $model->attributes = $_GET['News'];
            $model->alias = UString::toAlias($model->title);
            $model->quote = ucwords($model->quote);
        }

        $term = Term::buildDataForList(Term::buildTree(3)); // Category

        if (isset($_POST['News'])) {
            $model->attributes = $_POST['News'];
            if ($model->save()) {
                $msg = "Content has been updated: <a href=\"" . url($model->uri) . "\" target=\"_blank\">" . $model->uri . "</a>";
                $this->setFlash($msg);
                $this->redirect(array('update', 'id' => $model->id, 'ajax' => $_GET['ajax']));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'term' => $term
        ));
    }

    /**
     * Updates a particular model.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id, $desc = false) {
        $model = $this->loadModel($id);

        $term = Term::buildDataForList(Term::buildTree(3)); // Category
        $model->cate = CHtml::listData($model->nTerms, 'id', 'id');
        $tag = CHtml::listData($model->tags, 'id', 'name');
        $model->tag = is_array($tag) ? implode(',', $tag) : '';
        if ($model->stream > 0) {
            $model->stream = $model->streams->name . ' - ' . $model->streams->id;
        }

        if (isset($_POST['News'])) {
            $model->attributes = $_POST['News'];
            $model->stripTagContent();

            if (isset($_GET['desc'])) {
                //NewsBase::model()->updateByPk($model->id, array('content' => $model->content));
                $model->update('content');

                $msg = "Content has been updated: <a href=\"" . $model->uri . "\" target=\"_blank\">" . $model->uri . "</a>";
                $this->setFlash($msg);
                $this->refresh();
            } else if ($model->save()) {
                $msg = "Content has been updated: <a href=\"" . $model->uri . "\" target=\"_blank\">" . $model->uri . "</a>";
                $this->setFlash($msg);
                $this->refresh();
                //$this->redirect(array('view', 'id' => $id));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'term' => $term
        ));
    }

    /**
     * Deletes a particular model.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id = null) {
        if (Yii::app()->request->isPostRequest) {
            if ($id !== null) {
                $this->loadModel($id)->delete();
                $msg = 'News ID #' . $id . ' has been deleted.';
            } else {
                $ids = $_POST['chk'];
                if (is_array($ids)) {
                    foreach ($ids as $id) {
                        $rs = News::model()->deleteByPk($id);
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
     * Manages all models.
     */
    public function actionIndex() {
        
        $model = new News('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['search'])) {
            $model->attributes = UString::toArray($_GET['search']);
        }

        if (isset($_GET['News'])) {
            $model->attributes = $_GET['News'];
        }
        
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionAutoCompleteTag($id, $term = '') {
        $term = UString::toAlias($term);
        if (Yii::app()->request->isAjaxRequest && !empty($term)) {
            $variants = array();
            $criteria = new CDbCriteria;
            $criteria->limit = 20;
            $criteria->group = 'alias';
            $criteria->addSearchCondition('alias', $term . '%', false);
            $tags = Tag::model()->findAll($criteria);
            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    $variants[] = $tag->name;
                }
            }
            echo CJSON::encode($variants);
        }
        exit;
    }

    public function actionAutoCompleteEvent($id, $term = '') {
        //$term = UString::toAlias($term);
        if (Yii::app()->request->isAjaxRequest && !empty($term)) {
            $variants = array();

            $model = StreamBase::model()->findAll('name like "%' . $term . '%"');
            if (is_array($model)) {
                foreach ($model as $node) {
                    $variants[] = $node->name . ' - ' . $node->id;
                }
            }
            echo CJSON::encode($variants);
        }
        exit;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = News::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'news-form') {
            echo CActiveForm::validate($model);
            App()->end();
        }
    }

    public static $model = null;
    public static $keo = true;

    public function actionUploadImage($id = 0) {
        $filedata = $_FILES['Filedata'];
        if ($filedata != '') {
            $name = time() . '-' . UFile::getFileName($filedata['name']) . '.' . UFile::getFileExtension($filedata['name']);
            $uri = PATH_UPLOAD . '/news/' . date('Y/m/');
            $orginal = $uri . 'orginal/';

            if (!is_dir($orginal)) {
                mkdir($orginal, 0777, true);
            }

            $image = new Image($filedata['tmp_name']);
            $image->save($orginal . $name);

            if ($id > 0 && self::$model == null) {
                $model = NewsBase::model()->findByPk($id);
                if (empty($model->thumb)) {
                    NewsBase::model()->updateByPk($id, array('thumb' => $orginal . $name));
                }
                self::$model = $model;
                self::$keo = false;
            }

            LastUpload::save($orginal . $name);

            if (self::$keo) {
                $news = new News();
                foreach ($news->glue as $key => $node) {
                    $glue = $uri . $key . '/';
                    if (!is_dir($glue)) {
                        mkdir($glue, 0777, true);
                    }
                    $image->resize($node['w'], $node['h'], Image::WIDTH);
                    $image->save($glue . $name);
                }
            }
        }
    }

    public function actionEditable() {
        $pk = Yii::app()->request->getParam('pk');
        $attribute = Yii::app()->request->getParam('name');
        $value = Yii::app()->request->getParam('value');
        $scenario = Yii::app()->request->getParam('scenario');

        $update = News::model()->updateByPk($pk, array(
            $attribute => $value,
            'update_time' => gmdate('Y-m-d H:i:s', time() + 7 * 3600)
        ));


        if ($update > 0) {
            echo CJSON::encode(array('success' => true));
        } else {
            echo CJSON::encode(array('success' => false, 'msg' => ''));
        }
    }

    public function actionRss($url = 'http://vnexpress.net/rss/tin-moi-nhat.rss') {
        $this->layout = '//layouts/rss';
        $this->render('rss', array('url' => $url));
    }

    public function actionTarget($date = '', $target = 5) {
        if ($date == '') {
            $date = gmdate('Y-m-d', time() + 7 * 3600);
        }
        $this->render('target', array('date' => $date, 'target' => $target));
    }

}
