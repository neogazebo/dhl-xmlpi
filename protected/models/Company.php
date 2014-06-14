<?php

/**
 * This is the model class for table "companies".
 *
 * The followings are the available columns in table 'companies':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $postalCode
 * @property string $countryCode
 * @property string $countryName
 * @property integer $created
 * @property integer $updated
 *
 * The followings are the available model relations:
 * @property Users[] $users
 */
class Company extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'companies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created, updated', 'numerical', 'integerOnly' => true),
			array('name', 'length', 'max' => 80),
			array('city', 'length', 'max' => 45),
			array('postalCode', 'length', 'max' => 10),
			array('countryCode', 'length', 'max' => 2),
			array('countryName', 'length', 'max' => 20),
			array('address', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, address, city, postalCode, countryCode, countryName, created, updated', 'safe', 'on' => 'search'),
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
			'users' => array(self::HAS_MANY, 'User', 'company_id'),
			'companies' => array(self::HAS_MANY, 'Company', 'company_id'),
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
			'address' => 'Address',
			'city' => 'City',
			'postalCode' => 'Postal Code',
			'countryCode' => 'Country',
			'countryName' => 'Country Name',
			'created' => 'Created',
			'updated' => 'Updated',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('city', $this->city, true);
		$criteria->compare('postalCode', $this->postalCode, true);
		$criteria->compare('countryCode', $this->countryCode, true);
		$criteria->compare('countryName', $this->countryName, true);
		$criteria->compare('created', $this->created);
		$criteria->compare('updated', $this->updated);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	protected function beforeSave()
	{
		if ($this->isNewRecord)
		{
			$this->created = time();
		}
		else
		{
			$this->updated = time();
		}
		return parent::beforeSave();
	}

	public static function listAllCompanies()
	{
		return CHtml::listData(self::model()->findAll(), 'id', 'name');
	}
}