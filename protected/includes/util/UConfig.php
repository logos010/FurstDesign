<?php

Yii::import('application.modules.admin.models.Config');

/**
 * Description of UConfig
 *
 * @author HEO
 */
class UConfig {

    public static function get($name, $attribute = null) {
//        var_dump($name);
        $config = Config::model()->find('name = :name', array(':name' => $name));
//        var_dump($config);
        if ($attribute != null){
            $data = json_decode($config->value);
            $data = $data->$attribute;
            return $data;
        }
        return $config->value;
    }

}
