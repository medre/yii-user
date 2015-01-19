<?php

/**
 * UserRecoveryForm class.
 * UserRecoveryForm is the data structure for keeping
 * user recovery form data. It is used by the 'recovery' action of 'UserController'.
 */
class UserRecoveryForm extends CFormModel {
	public $login_or_email, $user_id;
	
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('login_or_email', 'required'),
			//array('login_or_email', 'match', 'pattern' => '/^[A-Za-z0-9@.-\s,]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
            array('login_or_email','check'),
			// password needs to be authenticated
			array('login_or_email', 'checkExists'),
		);
	}
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'login_or_email'=>UserModule::t("username or email"),
		);
	}

    public function check($attribute,$params){

        if (strpos($this->login_or_email,"@")) {

            if (filter_var($this->login_or_email, FILTER_VALIDATE_EMAIL))
                return true;
            return false;
        }else{
            return true;
        }

    }
	
	public function checkExists($attribute,$params) {
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			if (strpos($this->login_or_email,"@")) {
				$user=User::model()->findByAttributes(array('email'=>$this->login_or_email));
				if ($user)
					$this->user_id=$user->id;
			} else {
				$user=User::model()->findByAttributes(array('username'=>$this->login_or_email));
				if ($user)
					$this->user_id=$user->id;
			}
			
			if($user===null)
				if (strpos($this->login_or_email,"@")) {
					$this->addError("login_or_email",UserModule::t("Email is incorrect."));
				} else {
					$this->addError("login_or_email",UserModule::t("Username is incorrect."));
				}
		}
	}
	
}