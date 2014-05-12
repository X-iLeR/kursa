<?php

/**
 * RegistrationForm class.
 */
class RegistrationForm extends CFormModel
{
	public $name;
	public $pwd1;
    public $pwd2;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, pwd1, pwd2, verifyCode', 'required'),
            array('name, pwd1, pwd2', 'length', 'max'=>24),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
            'name' => 'Имя персонажа',
            'pwd1' =>  'Пароль',
            'pwd2' => 'Повторите пароль',
            'verifyCode' => 'Captcha',
		);
	}

    public function validate() {
        if(parent::validate()) {
            if  ($this->pwd1 == $this->pwd2) {
                return true;
            } else {
                $this->addError('pwd2', 'Пароли должны совпадать');
                return false;
            }
        }
        return false;
    }

}