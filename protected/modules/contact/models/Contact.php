<?php

/**
 * Description of Contact
 *
 * @author HAO
 */
class Contact extends ContactBase {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('fullname, phone, title, content', 'required'),
            array('create_time, status, phone', 'numerical', 'integerOnly' => true),
            array('uid', 'length', 'max' => 10),
            array('fullname, address, title', 'length', 'max' => 225),
            array('phone', 'length', 'max' => 15),
            array('email', 'length', 'max' => 126),
            array('email', 'email'),
            array('id, uid, fullname, phone, email, address, title, content, create_time, status', 'safe', 'on' => 'search'),
        );
    }

    public function beforeValidate() {
        if ($this->isNewRecord) {
            $this->create_time = time();
            $this->ip = $_SERVER['REMOTE_ADDR'];
        }
        return true;
    }

    public function attributeLabels() {
        return array(
            'id' => UTranslate::t('ID', array(), UTranslate::CATEGORY_MODEL),
            'uid' => UTranslate::t('Uid', array(), UTranslate::CATEGORY_MODEL),
            'fullname' => UTranslate::t('Fullname', array(), UTranslate::CATEGORY_MODEL),
            'phone' => UTranslate::t('Phone', array(), UTranslate::CATEGORY_MODEL),
            'email' => UTranslate::t('Email', array(), UTranslate::CATEGORY_MODEL),
            'address' => UTranslate::t('Address', array(), UTranslate::CATEGORY_MODEL),
            'title' => UTranslate::t('Title', array(), UTranslate::CATEGORY_MODEL),
            'content' => UTranslate::t('Content', array(), UTranslate::CATEGORY_MODEL),
            'create_time' => UTranslate::t('Create Time', array(), UTranslate::CATEGORY_MODEL),
            'status' => UTranslate::t('Status', array(), UTranslate::CATEGORY_MODEL),
        );
    }

}

?>
