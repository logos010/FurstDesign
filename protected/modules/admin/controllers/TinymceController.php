<?php

/**
 * Description of TinyMceController
 *
 * @author LangVan
 */

class TinymceController extends ControllerBase {

    public function init() {
        parent::init();
        App()->theme = ADMIN_THEME;
        $this->layout = '//layouts/none';
    }

    public function actions() {
        return array(
            'compressor' => array(
                'class' => 'TinyMceCompressorAction',
                'settings' => array(
                    'compress' => true,
                    'disk_cache' => true,
                )
            ),
            'spellchecker' => array(
                'class' => 'TinyMceSpellcheckerAction',
            ),
        );
    }

    public function actionIndex() {
        $this->render('/tinymce');
    }

}

?>
