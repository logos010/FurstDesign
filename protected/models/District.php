<?php

/**
 * This is the model class for table "{{district}}".
 *
 * The followings are the available columns in table '{{district}}':
 * @property string $district_id
 * @property string $name
 * @property string $type
 * @property string $location
 * @property string $province_id
 */
class District extends DistrictBase {

    public $district_name;

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'district_id' => 'District',
            'name' => 'Name',
            'type' => 'Type',
            'location' => 'Location',
            'province_id' => 'Province',
        );
    }
    
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('district_id', $this->district_id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('location', $this->location, true);
        $criteria->compare('province_id', $this->province_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
   
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
