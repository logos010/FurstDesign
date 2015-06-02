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

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{promotion}}';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }    

}
