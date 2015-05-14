<?php

/**
 * This is the model class for table "{{order}}".
 *
 * The followings are the available columns in table '{{order}}':
 * @property integer $order_id
 * @property string $purchase_id
 * @property integer $customer_id
 * @property string $create_time
 * @property integer $status
 * @property double $invoice_total
 * @property double $shipping_fee
 * @property double $grand_total
 * @property integer $is_paid
 * @property string $command
 */
class OrderBase extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, create_time, status, invoice_total, grand_total', 'required'),
			array('customer_id, status, is_paid', 'numerical', 'integerOnly'=>true),
			array('invoice_total, shipping_fee, grand_total', 'numerical'),
			array('purchase_id', 'length', 'max'=>30),
			array('command', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order_id, purchase_id, customer_id, create_time, status, invoice_total, shipping_fee, grand_total, is_paid, command', 'safe', 'on'=>'search'),
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
			'order_id' => 'Order',
			'purchase_id' => 'Purchase',
			'customer_id' => 'Customer',
			'create_time' => 'Create Time',
			'status' => 'Status',
			'invoice_total' => 'Invoice Total',
			'shipping_fee' => 'Shipping Fee',
			'grand_total' => 'Grand Total',
			'is_paid' => 'Is Paid',
			'command' => 'Command',
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

		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('purchase_id',$this->purchase_id,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('invoice_total',$this->invoice_total);
		$criteria->compare('shipping_fee',$this->shipping_fee);
		$criteria->compare('grand_total',$this->grand_total);
		$criteria->compare('is_paid',$this->is_paid);
		$criteria->compare('command',$this->command,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
