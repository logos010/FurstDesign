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
class GalleryController extends ControllerBase {

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

        if (isset($_GET['ajax']) && preg_match('/(true|1)/', $_GET['ajax'])) {
            $this->layout = '//layouts/none';
        }
    }

    public function actionDelete($id = null) {
        if (Yii::app()->request->isPostRequest) {
            if ($id !== null) {
                $this->loadModel($id)->delete();
                $msg = 'Gallery ID #' . $id . ' has been deleted.';
            } else {
                $ids = $_POST['chk'];
                if (is_array($ids)) {
                    foreach ($ids as $id) {
                        $rs = Gallery::model()->deleteByPk($id);
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
    public function actionIndex($pid) {
        $model = new Gallery('search');
        $model->unsetAttributes();  // clear any default values
//        if (isset($_GET['Gallery']))
//            $model->attributes = $_GET['Gallery'];
        $model->pid = $pid;

        $this->render('index', array(
            'model' => $model,
        ));
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Product::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionUpload($pid) {
        $glue = array(
            'medium' => array('w' => 400, 'h' => 400),            
            'small' => array('w' => 40, 'h' => 40),
        );

        $filedata = $_FILES['Filedata'];
        if ($filedata != '') {
            $name = UString::toAlias($filedata['name']) . '-' . time() . '.' . UFile::getFileExtension($filedata['name']);
            $uri = PATH_UPLOAD . '/thumb/' . date('Y/m/');
            $original = $uri . 'original/';

            if (!is_dir($original)) {
                mkdir($uri . '/original', 0777, true);
            }

            $image = new Image($filedata['tmp_name']);
            $image->save($original . $name);
            //resize
            foreach ($glue as $key => $node) {
                $glue = $uri . $key . '/';
                if (!is_dir($glue)) {
                    mkdir($glue, 0777, true);
                }
                $image->resize($node['w'], $node['h'], Image::WIDTH);
                $image->save($glue . $name);
            }
            list($width, $height, $type, $attr) = getimagesize($filedata['tmp_name']);

            $model = new Gallery();
            $model->attributes = array(
                'pid' => $pid,
                'name' => $filedata['name'],
                'uri' => $original . $name,
                'width' => $width,
                'height' => $height,
                'filesize' => $filedata['size'],
                'create_time' => date('Y-m-d H:i:s', time() + 7 * 3600),
            );
            $model->save(false);
        }
    }

}
