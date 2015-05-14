<?php

/**
 * Description of Result
 *
 * @author HEO
 */
class ServiceResult {

    const STATUS_FAILURE = 0;
    const STATUS_SUCCESS = 1;

    public $status;
    public $target;
    public $data = array();
    public $page = array();
    public $errorMessages = array();

    public function __construct($status = self::STATUS_SUCCESS, $errorMessages = '') {
        $this->status = $status;
        if ($errorMessages != '')
            $this->errorMessages = array($errorMessages);
    }

    public function toText() {
        if (is_string($this->data))
            return $this->data;
        return serialize($this->data);
    }

    public function isFailed() {
        return $this->status != self::STATUS_SUCCESS;
    }
    
    public function success() {
        $this->status = self::STATUS_SUCCESS;
        $this->errorMessages = array();
    }
    
    public function fail($errorMessages = null) {
        $this->status = self::STATUS_FAILURE;
        
        if ($errorMessages == null) {
            $errorMessages = array();
            $errors = Yii::app()->errorHandler->error;
            foreach ($errors as $error) {
                $errorMessages[] = $error->getErrorMessage();
            }
        }
        
        $this->addErrorMessages($errorMessages);
    }

    public function addErrorMessages($errorMessages) {
        if (!is_string($errorMessages) && !is_array($errorMessages))
            return;
        if (is_array($errorMessages))
            $this->errorMessages = array_merge($this->errorMessages, $errorMessages);
        else
            $this->errorMessages = array_merge($this->errorMessages, array($errorMessages));
    }

}
