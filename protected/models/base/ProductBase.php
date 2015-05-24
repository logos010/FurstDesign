<?php

/**
 * This is the model class for table "{{product}}".
 *
 * The followings are the available columns in table '{{product}}':
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $uri
 * @property string $image
 * @property string $sku
 * @property integer $quantity
 * @property double $price
 * @property double $wholesale_price
 * @property integer $bought
 * @property double $discount
 * @property double $sale_promotion
 * @property integer $like
 * @property integer $subscripbe
 * @property string $description
 * @property string $detail
 * @property integer $status
 * @property integer $promote
 * @property string $create_time
 * @property string $update_time
 */
class ProductBase extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, alias, uri, image, sku, price, description, detail, status, create_time', 'required'),
			array('quantity, bought, like, subscripbe, status, promote', 'numerical', 'integerOnly'=>true),
			array('price, wholesale_price, discount, sale_promotion', 'numerical'),
			array('name, alias', 'length', 'max'=>150),
			array('uri, image', 'length', 'max'=>255),
			array('sku', 'length', 'max'=>15),
			array('update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, alias, uri, image, sku, quantity, price, wholesale_price, bought, discount, sale_promotion, like, subscripbe, description, detail, status, promote, create_time, update_time', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'alias' => 'Alias',
			'uri' => 'Uri',
			'image' => 'Image',
			'sku' => 'Sku',
			'quantity' => 'Quantity',
			'price' => 'Price',
			'wholesale_price' => 'Wholesale Price',
			'bought' => 'Bought',
			'discount' => 'Discount',
			'sale_promotion' => 'Sale Promotion',
			'like' => 'Like',
			'subscripbe' => 'Subscripbe',
			'description' => 'Description',
			'detail' => 'Detail',
			'status' => 'Status',
			'promote' => 'Promote',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('uri',$this->uri,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('sku',$this->sku,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('price',$this->price);
		$criteria->compare('wholesale_price',$this->wholesale_price);
		$criteria->compare('bought',$this->bought);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('sale_promotion',$this->sale_promotion);
		$criteria->compare('like',$this->like);
		$criteria->compare('subscripbe',$this->subscripbe);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('promote',$this->promote);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
