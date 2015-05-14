<?php

/**
 * Description of UTranslate
 *
 * @author HEO
 */
class UTranslate {

    const CATEGORY_LABEL = 'label';
    const CATEGORY_BUTTON = 'button';
    const CATEGORY_MENU = 'menu';
    const CATEGORY_MODEL = 'model';

    public static function t($string, $param = array(), $category = self::CATEGORY_LABEL) {
        Yii::import('application.modules.admin.models.Translate');

        $language = Yii::app()->language;
        $cache_id = sprintf('translations_%s_%s', $language, $category);

        $messages = false;
        if (Yii::app()->cache) {
            $messages = Yii::app()->cache->get($cache_id);
        }

        if ($messages === false) {
            $translations = Translate::model()->findAll('category = :category AND language_code = :language', array(
                ':category' => $category,
                ':language' => $language));
            $messages = array();
            foreach ($translations as $row) {
                $messages[$row->message] = $row->translation;
            }

            if (Yii::app()->cache)
                Yii::app()->cache->set($cache_id, $messages, UConfig::get('cache', 'time'));
        }

        if (isset($messages[$string]))
            return strtr($messages[$string], $param);
        else
            return strtr($string, $param);
    }

}
