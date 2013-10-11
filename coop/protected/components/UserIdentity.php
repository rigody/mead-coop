<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;
	 
	public function authenticate()
	{
		$user = User::model()->find('username = :username', array(
			':username' => $this->username,
		));
		
		if ($user == NULL)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if ($user->password != $this->password)
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id = $user->id;
			$this->username = $user->username;
			$this->setState('userModel', $user);
			
			$this->errorCode = self::ERROR_NONE;
		}
		
		return $this->errorCode == self::ERROR_NONE;
	}
	
	/*
	 * Ensure that Yii::app()->user->id returns the id of the user instead of the username
	 */
	public function getId()
	{
		return $this->_id;
	}
}
