<?php

/**
 * Description of GenericService
 *
 * @author HAO
 */
class GenericService extends CComponent {

    /**
     * Service result object
     * @var ServiceResult
     */
    protected $result;
    protected $criteria;

    public function __construct() {
        $this->result = new ServiceResult();
        $this->criteria = new CDbCriteria();
    }

    public function init($module) {
        Yii::import("$module.models.*");
    }

    public function getPage($itemCount) {
        $this->result->page = new CPagination($itemCount);
        $this->result->page->setPageSize(($this->criteria->limit > 0) ? $this->criteria->limit : UConfig::get('page', 'client'));
        $this->result->page->applyLimit($this->criteria);

        $this->criteria->offset = $this->result->page->getOffset();
        $this->criteria->limit = $this->result->page->getLimit();
    }

    public function getResult($rs) {
//        if (empty($rs) || $rs === null) {
//            throw new CHttpException(404, UTranslate::t('Error 404. Not found url'));
//        }
        $this->result->data = $rs;
        return $this->result;
    }

}
