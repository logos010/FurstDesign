<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property string $thumb
 * @property string $teaser
 * @property string $content
 * @property integer $promote
 * @property integer $type
 * @property string $uri
 * @property integer $stream
 * @property string $create_time
 * @property string $publish_time
 * @property string $update_time
 * @property integer $countview
 * @property integer $status
 * @property integer $create_by
 * @property integer $update_by
 * @property string $quote
 */
class NewsBase extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{news}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, alias, teaser, content, uri, countview, create_by, update_by, quote', 'required'),
			array('promote, type, stream, countview, status, create_by, update_by', 'numerical', 'integerOnly'=>true),
			array('title, alias, thumb, uri, quote', 'length', 'max'=>255),
			array('teaser', 'length', 'max'=>1000),
			array('create_time, publish_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, alias, thumb, teaser, content, promote, type, uri, stream, create_time, publish_time, update_time, countview, status, create_by, update_by, quote', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'alias' => 'Alias',
			'thumb' => 'Thumb',
			'teaser' => 'Teaser',
			'content' => 'Content',
			'promote' => 'Promote',
			'type' => 'Type',
			'uri' => 'Uri',
			'stream' => 'Stream',
			'create_time' => 'Create Time',
			'publish_time' => 'Publish Time',
			'update_time' => 'Update Time',
			'countview' => 'Countview',
			'status' => 'Status',
			'create_by' => 'Create By',
			'update_by' => 'Update By',
			'quote' => 'Quote',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('thumb',$this->thumb,true);
		$criteria->compare('teaser',$this->teaser,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('promote',$this->promote);
		$criteria->compare('type',$this->type);
		$criteria->compare('uri',$this->uri,true);
		$criteria->compare('stream',$this->stream);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('publish_time',$this->publish_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('countview',$this->countview);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_by',$this->create_by);
		$criteria->compare('update_by',$this->update_by);
		$criteria->compare('quote',$this->quote,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NewsBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
