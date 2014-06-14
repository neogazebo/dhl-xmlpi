<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $isActive
 * @property integer $handlingFee
 */
class Product extends CActiveRecord
{
	const STAT_ACTIVE = 1;
	const STAT_NOACTIVE = 0;
	private $_listProductsId = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
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
		return 'products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('isActive,handlingFee', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			array('code', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, code, isActive, handlingFee', 'safe', 'on'=>'search'),
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
			'code' => 'Code',
			'isActive' => 'Is Active',
			'handlingFee' => 'Handling Fee',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('handlingFee',$this->handlingFee);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getAllProductId()
	{
		$products = self::model()->findAll();
		foreach($products as $product)
		{
			$this->_listProductsId[] = $product->id;
		}
		
		return $this->_listProductsId;
	}
	
	public static function listAllProducts($val='id',$label = 'name')
	{
		return CHtml::listData(self::model()->findAll(), $val, $label);
	}
	
	public static function productStatusList()
	{
		return array(self::STAT_ACTIVE => 'Active', self::STAT_NOACTIVE => 'Not Active');
	}
}