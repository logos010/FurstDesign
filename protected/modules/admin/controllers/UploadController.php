<?php

/**
 * Description of UploadController
 *
 * @author HAO
 */
Yii::import('ext.image.Image');
Yii::import('ext.helpers.*');

class UploadController extends ControllerBase {

    public $defaultAction = 'uploadImage';

    public function init() {
        App()->theme = ADMIN_THEME;
        parent::init();
    }

    public function actionUploadImage() {
        $filedata = $_FILES['Filedata'];
        if ($filedata != '') {
            $name = UString::toAlias($filedata['name']) . '-' . time() . '.' . UFile::getFileExtension($filedata['name']);
            $uri = PATH_UPLOAD . '/' . date('Y/m/');
            $orginal = $uri . 'orginal/';

            if (!is_dir($orginal)) {
                mkdir($orginal, 0777, true);
            }

            $image = new Image($filedata['tmp_name']);
            $image->save($orginal . $name);

            LastUpload::save($orginal . $name);
        }
    }

}
