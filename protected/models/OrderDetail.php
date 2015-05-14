<?php

/**
 * This is the model class for table "{{order_detail}}".
 *
 * The followings are the available columns in table '{{order_detail}}':
 * @property integer $order_detail_id
 * @property integer $order_id
 * @property integer $product_id
 * @property double $price
 * @property integer $quantity
 * @property double $discount
 * @property double $line_total
 * @property string $note
 */
class OrderDetail extends OrderDetailBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order_detail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, product_id, price, quantity, line_total', 'required'),
			array('order_id, product_id, quantity', 'numerical', 'integerOnly'=>true),
			array('price, discount, line_total', 'numerical'),
			array('note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order_detail_id, order_id, product_id, price, quantity, discount, line_total, note', 'safe', 'on'=>'search'),
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
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_detail_id' => 'Order Detail',
			'order_id' => 'Order',
			'product_id' => 'Product',
			'price' => 'Price',
			'quantity' => 'Quantity',
			'discount' => 'Discount',
			'line_total' => 'Line Total',
			'note' => 'Note',
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

		$criteria->compare('order_detail_id',$this->order_detail_id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('line_total',$this->line_total);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
