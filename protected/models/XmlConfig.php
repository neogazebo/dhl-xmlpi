<?php

/**
 * This is the model class for table "xmlConfig".
 *
 * The followings are the available columns in table 'xmlConfig':
 * @property integer $id
 * @property string $siteID
 * @property string $password
 * @property string $shipperAccountNumber
 * @property string $shippingPaymentType
 * @property string $billingAccountNumber
 * @property string $dutyPaymentType
 */
class XmlConfig extends CActiveRecord
{
	const USED_CONF = 1;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return XmlConfig the static model class
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
		return 'xmlConfig';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('siteID, password, shipperAccountNumber, shippingPaymentType, billingAccountNumber, dutyPaymentType', 'required'),
			array('siteID, password', 'length', 'max'=>20),
			array('shipperAccountNumber, billingAccountNumber', 'length', 'max'=>15),
			array('shippingPaymentType, dutyPaymentType', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, siteID, password, shipperAccountNumber, shippingPaymentType, billingAccountNumber, dutyPaymentType', 'safe', 'on'=>'search'),
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
			'siteID' => 'SiteID',
			'password' => 'Password',
			'shipperAccountNumber' => 'Shipper Account Number',
			'shippingPaymentType' => 'Shipping Payment Type',
			'billingAccountNumber' => 'Billing Account Number',
			'dutyPaymentType' => 'Duty Payment Type',
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
		$criteria->compare('siteID',$this->siteID,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('shipperAccountNumber',$this->shipperAccountNumber,true);
		$criteria->compare('shippingPaymentType',$this->shippingPaymentType,true);
		$criteria->compare('billingAccountNumber',$this->billingAccountNumber,true);
		$criteria->compare('dutyPaymentType',$this->dutyPaymentType,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function mref()
	{
		$data = array();
		for ($i = 0; $i < 31; $i++)
		{
			$data[$i] = rand(1, 9);
		}
		$mref = implode('', $data);
		return $mref;
	}
}