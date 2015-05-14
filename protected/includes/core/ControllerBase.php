<?php

/**
 * Description of ControllerBase
 *
 * @author HAO
 */
class ControllerBase extends SBaseController {

    const FLASH_SUCCESS = 'success';
    const FLASH_INFO = 'info';
    const FALSH_WARNING = 'warning';
    const FLASH_DANGER = 'danger';

    public $layout = '//layouts/main';
    public $breadcrumbs = array();
    public $menu;

    public function init() {
        App()->language = (isset(App()->request->cookies['lang'])) ? App()->request->cookies['lang']->value : LOCALE;
    }

    public function setFlash($flashes, $category = self::FLASH_SUCCESS) {
        App()->user->setFlash($category, $flashes);
    }

    public function renderFlash() {
        $messages = Yii::app()->user->getFlashes();
        if ($messages) {
            foreach ($messages as $key => $msg) {
                echo '<div class="alert alert-' . $key . ' alert-dismissable">';
                echo $msg;
                echo '</div>';
            }
        }
    }

    public function setParams($params = array()) {
        foreach ($params as $key => $value) {
            $this->$key = $value;
        }
    }

    public function setMeta($params) {
        $this->setParams($params);
    }

}
