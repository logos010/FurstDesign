<?php

class Ward extends WardBase {

    public $ward_name;

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
            'ward_id' => 'Ward',
            'name' => 'Name',
            'type' => 'Type',
            'location' => 'Location',
            'district_id' => 'District',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ward_id', $this->ward_id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('location', $this->location, true);
        $criteria->compare('district_id', $this->district_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ward the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
