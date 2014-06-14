<?php

/**
 * This is the model class for table "addressBook".
 *
 * The followings are the available columns in table 'addressBook':
 * @property integer $id
 * @property integer $userId
 * @property integer $company_id
 * @property string $companyName
 * @property string $address
 * @property string $city
 * @property string $postalCode
 * @property string $countryCode
 * @property string $countryName
 * @property string $personName
 * @property string $phoneNumber
 * @property string $phoneExt
 * @property string $fax
 * @property string $telex
 * @property string $email
 */
class AddressBook extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AddressBook the static model class
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
		return 'addressBook';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, company_id', 'required'),
			array('userId, company_id', 'numerical', 'integerOnly'=>true),
			array('companyName, city', 'length', 'max'=>45),
			array('postalCode, countryName', 'length', 'max'=>10),
			array('countryCode', 'length', 'max'=>5),
			array('personName', 'length', 'max'=>40),
			array('phoneNumber, fax, telex', 'length', 'max'=>30),
			array('phoneExt', 'length', 'max'=>7),
			array('email', 'email'),
			array('address', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, company_id, companyName, address, city, postalCode, countryCode, countryName, personName, phoneNumber, phoneExt, fax, telex, email', 'safe', 'on'=>'search'),
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
			'userId' => 'User',
			'company_id' => 'Company',
			'companyName' => 'Company Name',
			'address' => 'Address',
			'city' => 'City',
			'postalCode' => 'Postal Code',
			'countryCode' => 'Country Code',
			'countryName' => 'Country Name',
			'personName' => 'Person Name',
			'phoneNumber' => 'Phone Number',
			'phoneExt' => 'Phone Ext',
			'fax' => 'Fax',
			'telex' => 'Telex',
			'email' => 'Email',
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
		$criteria->compare('userId',$this->userId);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('companyName',$this->companyName,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('postalCode',$this->postalCode,true);
		$criteria->compare('countryCode',$this->countryCode,true);
		$criteria->compare('countryName',$this->countryName,true);
		$criteria->compare('personName',$this->personName,true);
		$criteria->compare('phoneNumber',$this->phoneNumber,true);
		$criteria->compare('phoneExt',$this->phoneExt,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('telex',$this->telex,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}