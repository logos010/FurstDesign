<?php

/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class UserChangePassword extends CFormModel {

    public $old_password;
    public $password;
    public $verifyPassword;

    public function rules() {
        return array(
            array('password, verifyPassword', 'required'),
            array('old_password', 'required', 'on' => 'UserChangePassword'),
            array('password', 'length', 'max' => 128, 'min' => 4, 'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
            array('verifyPassword', 'compare', 'compareAttribute' => 'password', 'message' => UserModule::t("Retype Password is incorrect.")),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'old_password' => UserModule::t("Old Password"),
            'password' => UserModule::t("New Password"),
            'verifyPassword' => UserModule::t("Retype Password"),
        );
    }

}

