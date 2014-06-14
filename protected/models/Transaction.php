<?php

/**
 * This is the model class for table "transaction".
 *
 * The followings are the available columns in table 'transaction':
 * @property integer $id
 * @property integer $shipmentId
 * @property integer $company_id
 * @property integer $invoiceId
 * @property integer $charges
 * @property integer $created
 *
 * The followings are the available model relations:
 * @property Invoice $invoice
 * @property Companies $company
 * @property Shipments $shipment
 */
class Transaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Transaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shipmentId, company_id, charges', 'required'),
			array('invoiceId', 'required','on' => 'invoice'),
			array('shipmentId, company_id, invoiceId, charges, created', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shipmentId, company_id, invoiceId, charges, created', 'safe', 'on'=>'search'),
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
			'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoiceId'),
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'shipment' => array(self::BELONGS_TO, 'Shipment', 'shipmentId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'shipmentId' => 'Shipment',
			'company_id' => 'Company',
			'invoiceId' => 'Invoice',
			'charges' => 'Charges',
			'created' => 'Created',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('shipmentId',$this->shipmentId);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('invoiceId',$this->invoiceId);
		$criteria->compare('charges',$this->charges);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}