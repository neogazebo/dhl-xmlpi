<?php

/**
 * This is the model class for table "invoice".
 *
 * The followings are the available columns in table 'invoice':
 * @property integer $id
 * @property integer $created
 * @property integer $company_id
 * @property integer $paymentDate
 * @property integer $dueDate
 * @property string $charges
 *
 * The followings are the available model relations:
 * @property Transaction[] $transactions
 */
class Invoice extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invoice the static model class
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
		return 'invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('created, paymentDate, dueDate, charges, company_id', 'required'),
			array('created, paymentDate, dueDate, company_id', 'numerical', 'integerOnly' => true),
			array('charges', 'length', 'max' => 12),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created, paymentDate, dueDate, charges', 'safe', 'on' => 'search'),
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
			'transactions' => array(self::HAS_MANY, 'Transaction', 'invoiceId'),
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created' => 'Created',
			'paymentDate' => 'Payment Date',
			'dueDate' => 'Due Date',
			'charges' => 'Charges',
			'company_id' => 'Company'
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
		$criteria->compare('created', $this->created);
		$criteria->compare('company_id', $this->company_id);
		$criteria->compare('paymentDate', $this->paymentDate);
		$criteria->compare('dueDate', $this->dueDate);
		$criteria->compare('charges', $this->charges, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	public function beforeSave()
	{
		if ($this->isNewRecord)
		{
			$this->created = time();
		}
		return parent::beforeSave();
	}

	public function beforeDelete()
	{
		try
		{
			$trans = Yii::app()->db->beginTransaction();
			if (count($this->transactions) == 0)
			{
				throw new NoInvoiceException(400, 'Invalid request. Please do not repeat this request again.');
			}
			foreach ($this->transactions as $transaction)
			{
				if (!($transaction instanceof Transaction))
					throw new NoInvoiceException(400, 'Invalid request. Please do not repeat this request again.');

				$transaction->invoiceId = 0;
				if (!$transaction->save(false))
					throw new NoInvoiceException(400, 'Invalid request. Please do not repeat this request again.');
			}
			$trans->commit();
		}
		catch (NoInvoiceException $e)
		{
			$trans->rollback();
			throw new CException;
		}
		return parent::beforeDelete();
	}
}

class NoInvoiceException extends CException
{
	
}