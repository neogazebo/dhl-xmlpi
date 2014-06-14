<?php

/**
 * This is the model class extend from model user
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $created
 * @property integer $updated
 * @property integer $access
 * @property integer $isActive
 * @property string $firstName
 * @property string $lastName
 */
class Profile extends User
{
	
	public $confirmPassword;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profile the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('username, email', 'required',),
//			array('password', 'required', 'on' => 'insert'),
			array('confirmPassword,password,newPassword', 'length', 'max' => 100, 'min' => 4),
			array('confirmPassword','compare','compareAttribute'=>'newPassword'),
			array('firstName,lastName', 'length', 'max' => 50, 'min' => 3),
			array('email', 'email'),
			array('email', 'unique'),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => "Incorrect symbols (A-z0-9)."),
			array('updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email', 'safe', 'on' => 'search'),
		);
	}
}