<?php

/**
 * Description of Config
 *
 * @author HAO
 */
class Config extends ConfigurationBase {

    public $key;
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('name', 'required'),
            array('value, key', 'safe'),
            array('name', 'length', 'max' => 40),
            array('type', 'length', 'max' => 9),
        );
    }

}

?>
