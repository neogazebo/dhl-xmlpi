<?php

/**
 * This is the model class for table "customerRates".
 *
 * The followings are the available columns in table 'customerRates':
 * @property integer $id
 * @property integer $company_id
 * @property integer $productId
 * @property integer $upTo
 * @property integer $fixPrice
 * @property integer $isActive
 *
 * The followings are the available model relations:
 * @property Companies $company
 * @property Products $product
 */
class CustomerRate extends CActiveRecord
{
	const STAT_ACTIVE = 1;
	const STAT_NOACTIVE = 0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerRate the static model class
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
		return 'customerRates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, productId, upTo, isActive', 'required'),
			array('company_id+productId', 'application.extensions.uniqueMultiColumnValidator'),
			array('fixPrice','numerical'),
			array('company_id, productId, upTo, isActive', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, productId, upTo, fixPrice, isActive', 'safe', 'on' => 'search'),
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
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'productId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company_id' => 'Company',
			'productId' => 'Product',
			'upTo' => 'Up To',
			'fixPrice' => 'Fix Price',
			'isActive' => 'Is Active',
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
		$criteria->compare('company_id', $this->company_id);
		$criteria->compare('productId', $this->productId);
		$criteria->compare('upTo', $this->upTo);
		$criteria->compare('fixPrice', $this->fixPrice);
		$criteria->compare('isActive', $this->isActive);
		$criteria->order = 'company_id';

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	public function rateInit($company_id)
	{
		$success = 0;
		$productsId = Product::model()->getAllProductId();
		if (count($productsId) == 0)
			return false;

		foreach ($productsId as $productId)
		{
			$rate = new self;
			$rate->company_id = $company_id;
			$rate->productId = $productId;
			$rate->upTo = 10;
			$rate->fixPrice = 0;
			if ($rate->save())
				$success++;
		}

		return count($productsId) == $success;
	}
	
	public static function rateStatusList()
	{
		return array(self::STAT_ACTIVE => 'Active', self::STAT_NOACTIVE => 'Not Active');
	}
	
	public static function calculateRate($company_id,$product_code,$charge)
	{
		$product = Product::model()->findByAttributes(array('code'=>$product_code));
		$rate = self::model()->findByAttributes(array('company_id' =>$company_id,'productId'=>$product->id));
		$upRate = ($rate instanceof CustomerRate) ? $rate->upTo : 0;
		
		return $charge + ($charge * $upRate/100) + ($charge * $product->handlingFee/100);
	}
}