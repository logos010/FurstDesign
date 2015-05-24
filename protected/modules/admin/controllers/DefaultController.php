<?php

/**
 * Description of DefaultController
 *
 * @author LangVan
 */
class DefaultController extends ControllerBase {

    public function actionGenerateAlias($model, $att) {
        echo UString::toAlias($_POST[$model][$att]);
        App()->end();
    }

    public function actionUpdate_status($model, $pk) {
        $model = $model . 'Base';
        $data = new $model;
        $rs = $data->findByPk($pk);
        if ($rs != null) {
            $rs->status = ($rs->status == 1) ? 0 : 1;
            $rs->update('status');
        }
        if (App()->request->isAjaxRequest) {
            echo CJSON::encode(array('success' => true));
            App()->end();
        }
//        $this->redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function actionUpdate_Promotion($model, $pk) {
        $model = $model . 'Base';
        $data = new $model;
        $rs = $data->findByPk($pk);
        if ($rs != null) {
            $rs->promote = ($rs->promote == 1) ? 0 : 1;
            $rs->update('promote');
        }
        if (App()->request->isAjaxRequest) {
            echo CJSON::encode(array('success' => true));
            App()->end();
        }
    }
}

?>
