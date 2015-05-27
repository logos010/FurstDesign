<?php

class Menu extends MenuBase {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{menu}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type_id, alias, name', 'required'),
            array('parent_id, weight, status', 'numerical', 'integerOnly' => true),
            array('type_id', 'length', 'max' => 10),
            array('alias, name', 'length', 'max' => 64),
            array('url', 'length', 'max' => 128),
            array('level, visible_expression', 'length', 'max' => 155),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type_id, parent_id, alias, name, url, weight, level, status, create_time, update_time, visible_expression', 'safe', 'on' => 'search'),
        );
    }

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
            'id' => 'ID',
            'type_id' => 'Type',
            'parent_id' => 'Parent',
            'alias' => 'Alias',
            'name' => 'Name',
            'url' => 'Url',
            'weight' => 'Weight',
            'level' => 'Level',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'visible_expression' => 'Visible Expression',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('type_id', $this->type_id, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('weight', $this->weight);
        $criteria->compare('level', $this->level, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->compare('visible_expression', $this->visible_expression, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Menu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function hasChild($mid){
        $menuChild = Menu::model()->findAll(array(
            'condition' => 'type_id = 1 AND status = 1 AND parent_id = :mid',
            'params' => array(
                ':mid' => $mid
            )
        ));
        
        if (!is_null($menuChild))
            return $menuChild;
        else
            return null;
    }
    
    public function fetchSubMenu($m){
       
    }
}
