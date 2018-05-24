<?php
namespace Auth\Validation;

use Auth\Security\Security;

class UserValidation extends Validation
{
    private $errors;


    public function getErrors()
    {
        foreach($this->errors as $key=>$error){
            if($error === true){
                unset($this->errors[$key]);
            }
        }

        return $this->errors;
    }


    public function validateFieldUsername($username)
    {

        $this->errors["usernameNotValid"] = $this->validateNickname($username);
        $this->errors["usernameEmpty"] = $this->isFieldEmpty($username);

        if($this->errors["usernameNotValid"] === true){
            $this->errors["usernameExistInDb"] = $this->isUsernameExist($username);
        }
    }

    public function validateFieldEmail($userEmail, $register=false)
    {
        $this->errors["emailEmpty"] = $this->isFieldEmpty($userEmail);
        $this->errors["emailNotValid"] = $this->validateEmail($userEmail);

        if($register){
            $this->errors["emailExistInDb"] = $this->isEmailNotExist($userEmail);
        }else{
            $this->errors["emailNotExistInDb"] = $this->isEmailExist($userEmail);
        }
    }

    public function validateFieldPassword2($password)
    {
        $this->errors["password1Empty"] = $this->isFieldEmpty($password);
    }

    public function validateFieldPassword1($password)
    {
        $this->errors["password2Empty"] = $this->isFieldEmpty($password);
    }

    public function validateIsPasswordTheSame($password1, $password2)
    {
        $this->errors["passwordsNotTheSame"] = $this->isPasswordTheSame($password1, $password2);
    }

    public function checkXSRF(){
        $security = new Security();
        $this->errors['XSRF'] = $security->checkTokenXSRF();
    }



}
