<?php

/**
 * WebUser
 *
 * @author HEO
 */
class WebUser extends CWebUser {

    private $_data;

    /**
     * Use this function to access the AR model of logged in user, for example
     * echo Yii::app()->user->data()->profile->firstname;
     * @return User 
     */
    public function data() {
        if ($this->_data instanceof User) {
            return $this->_data;
        } else if ($this->id && $this->_data = User::model()->cache(500)->findByPk($this->id)) {
            return $this->_data;
        } else {
            return new User();
        }
    }

    public function isSuperUser() {
        return $this->data()->super_user;
    }

}
