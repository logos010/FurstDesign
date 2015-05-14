<?php

/**
 * Description of ConfigController
 *
 * @author HaoLV
 */
class ConfigController extends ControllerBase {

    public $defaultAction = 'update';

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

    public function actionCreate($name = null, $type = 'text') {
        if ($this->check($name)) {
            $model = new Config;
            $model->name = $name;
            $model->type = $type;

            if (isset($_POST['Config'])) {
                if ($model->type == 'text') {
                    // Insert configuration type text
                    $model->attributes = $_POST['Config'];
                    if ($model->save()) {
                        $this->setFlash("Key {{$model->name}} has been created");
//                        $this->redirect(array('update', 'name' => $name));
                    }
                } else {
                    // Insert configuration type serialize
                    $keys = $_POST['Keys'];
                    $values = $_POST['Values'];
                    $data = array();
                    if (is_array($keys)) {
                        foreach ($keys as $k => $v) {
                            if ($v != '')
                                $data[$v] = $values[$k];
                        }
                    }
                    $model->value = json_encode($data);
                    if ($model->save()) {
                        $this->setFlash("Key {{$model->name}} has been created");
//                        $this->redirect(array('update'));
                    }
                }
            }

            $this->render('create', array(
                'model' => $model,
            ));
        }
    }

    public function actionUpdate($name = null) {
        if ($name === null) {
            $model = Config::model()->findAll(array('order' => 'type desc'));
            if (!$model) {
                $this->redirect(array('create', 'name' => $name));
            }
        } else {
            $model = $this->loadModel($name);
            if ($model == null) {
                $this->redirect(array('update'));
            }
        }

        if (isset($_POST['Config'])) {
            // Update configuration type text
            if ($model->type == 'text') {
                $model->attributes = $_POST['Config'];
                if ($model->save()) {
                    $this->setFlash('Params has been updated');
                    $this->refresh();
                }
            }
            // Update configuration type json
            else {
                if ($model instanceof Config) {
                    $keys = $_POST['Keys'];
                    $values = $_POST['Values'];
                    $data = array();
                    if (is_array($keys)) {
                        foreach ($keys as $k => $v) {
                            if ($values[$k] != '')
                                $data[$v] = $values[$k];
                        }
                    }
                    $model->value = json_encode($data);
                    $model->save();
                } else {
                    foreach ($model as $node) {
                        if ($node->type == 'text')
                            $node->value = $_POST[$node->name];
                        else
                            $node->value = json_encode($_POST[$node->name]);
                        $node->save();
                    }
                }
                $this->setFlash('Parameters has been updated');
                $this->refresh();
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($name) {
//        if (Yii::app()->request->isPostRequest) {
        $model = $this->loadModel($name);
        if ($model !== null) {
            $model->delete();
            $this->setFlash("Key {{$name}} has been deleted");
            $this->redirect(array('update'));
        }
//        }
    }

    public function actionClear() {
        Yii::app()->cache->flush();
        $this->setFlash('Cache has been empty');
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function check($name) {
        if ($name == null) {
            $this->render('create', array('name' => false));
            return false;
        }

        $model = $this->loadModel($name);
        if ($model !== null)
            $this->redirect(array('update', 'name' => $name));
        return true;
    }

    public function loadModel($name) {
        $model = Config::model()->findByPk($name);
        return $model;
    }

}

?>
