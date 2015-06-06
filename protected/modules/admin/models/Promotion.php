<?php

/**
 * This is the model class for table "{{promotion}}".
 *
 * The followings are the available columns in table '{{promotion}}':
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $image
 * @property string $url
 * @property integer $position
 * @property integer $status
 * @property string $create_time
 */
class Promotion extends PromotionBase {

    public $cate;

    public function tableName() {
        return '{{promotion}}';
    }

    public function relations() {
        parent::relations();
        return array(
            'pTerm' => array(self::MANY_MANY, 'Term', 'tbl_promotion_term(pid,tid)', 'together' => true, 'joinType' => 'INNER JOIN'),
        );
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, image, cate, url, create_time', 'required'),
            array('position, status', 'numerical', 'integerOnly' => true),
            array('name, image, url', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, image, url, position, status, create_time', 'safe', 'on' => 'search'),
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'CAdvancedArBehavior' => array(
                'class' => 'ext.behaviors.CAdvancedArBehavior'
        ));
    }

    public function beforeSave() {
        $this->pTerm = $this->cate;
        return true;
    }

}
