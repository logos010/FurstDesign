<?php

/**
 * Description of ElfinderController
 *
 * @author LangVan
 */
class ElfinderController extends ControllerBase {

    public function init() {
        parent::init();
        App()->theme = ADMIN_THEME;
        $this->layout = '//layouts/none';
    }

    public function actions() {
        return array(
            'connector' => array(
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot') . '/upload/',
                    'URL' => Yii::app()->baseUrl . '/upload/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none'
                )
            ),
        );
    }

    public function actionIndex() {
        $this->render('/elfinder');
    }

}

?>
