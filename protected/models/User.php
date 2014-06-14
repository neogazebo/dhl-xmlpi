<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property integer $company_id
 * @property string $roles
 * @property string $username
 * @property string $password
 * @property string $newPassword
 * @property string $email
 * @property integer $created
 * @property integer $updated
 * @property integer $access
 * @property integer $isActive
 * @property string $firstName
 * @property string $lastName
 * @property string $phoneNumber
 * @property string $phoneExt
 * @property string $fax
 * @property string $telex
 * 
 * The followings are the available model relations:
 * @property Company[] $company
 */
class User extends CActiveRecord
{
	const STAT_ACTIVE = 1;
	const STAT_NOACTIVE = 0;
	const ROLE_ROOT = 'root';
	const ROLE_ADMIN = 'admin';
	const ROLE_USER = 'user';

	public $newPassword;
	private $_listRootsId = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, roles', 'required', 'on' => 'insert,update'),
			array('company_id, created, updated, access', 'numerical', 'integerOnly' => true),
			array('password', 'required', 'on' => 'insert'),
			array('roles', 'length', 'max' => 10),
			array('username', 'length', 'max' => 20, 'min' => 3),
			array('password,newPassword', 'length', 'max' => 100, 'min' => 4),
			array('firstName,lastName', 'length', 'max' => 50, 'min' => 3),
			array('phoneNumber, fax, telex', 'length', 'max' => 30),
			array('phoneExt', 'length', 'max' => 6),
			array('email', 'email'),
			array('username', 'unique'),
			array('email', 'unique'),
			array('isActive', 'in', 'range' => array(self::STAT_NOACTIVE, self::STAT_ACTIVE)),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => "Incorrect symbols (A-z0-9)."),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email, phoneNumber, isActive', 'safe', 'on' => 'search'),
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
			'roles' => 'Roles',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'created' => 'Created',
			'updated' => 'Updated',
			'access' => 'Access',
			'isActive' => 'Is Active',
			'firstName' => 'First Name',
			'lastName' => 'Last Name',
			'phoneNumber' => 'Phone Number',
			'phoneExt' => 'Phone Ext',
			'fax' => 'Fax',
			'telex' => 'Telex',
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
		$criteria->compare('username', $this->username, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('phoneNumber', $this->phoneNumber, true);
		$criteria->compare('isActive',$this->isActive);

		if(!Yii::app()->user->checkAccess('root'))
			$criteria->addNotInCondition('id', self::model()->getAllRootUserId());
		
		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	public static function userStatusList()
	{
		return array(self::STAT_ACTIVE => 'Active', self::STAT_NOACTIVE => 'Not Active');
	}
	
	public static function userRolesList()
	{
		if(Yii::app()->user->checkAccess('root'))
			return array(self::ROLE_USER => 'User' ,self::ROLE_ADMIN => 'Admin',self::ROLE_ROOT => 'Root');
		else
			return array(self::ROLE_USER => 'User',self::ROLE_ADMIN => 'Admin');
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
//		return Yii::app()->hasher->checkPassword($password, $this->password);
		return true;
	}

	public function beforeSave()
	{
		if ($this->isNewRecord)
		{
			$this->created = time();
			$this->password = Yii::app()->hasher->hashPassword($this->password);
		}
		else
		{
			if ($this->validate('newPassword') && strlen($this->newPassword) != 0)
			{
				$this->password = Yii::app()->hasher->hashPassword($this->newPassword);
			}
		}
		return parent::beforeSave();
	}
	
	public function getAllRootUserId()
	{
		$users = self::model()->findAllByAttributes(array('roles'=>'root'));
		
		foreach ($users as $user)
		{
			$this->_listRootsId[] = $user->id;
		}
		
		return $this->_listRootsId;
	}
}