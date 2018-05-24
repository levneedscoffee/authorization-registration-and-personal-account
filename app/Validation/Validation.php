<?php
namespace Auth\Validation;
use Auth\Models\UserDataGateway;
use Auth\Models\DatabaseMySQL;

class Validation
{
    public function validateEmail($email)
    {
        if (!preg_match('#^([\w]+\.?)+(?<!\.)@(?!\.)[a-zа-я0-9ё\.-]+\.?[a-zа-яё]{2,80}$#ui', $email)) {
            return "Email должен быть в формате name@example.com и не длиннее 80 символов.";
        }
        return true;
    }

    public function validateNickname($nickname)
    {
        if(!preg_match('/^[0-9a-zA-Zа-яёА-ЯЁ]{1,35}$/u', $nickname)){
            return "Никнейм дожен состоять только из букв или цифр и быть не больше 35 символов ";
        }
        return true;
    }

    public function isEmailExist($userEmail)
    {
        $db = new UserDataGateway(new DatabaseMySQL());
        $isEmailExist = $db->checkUserEmail($userEmail);

        if(!$isEmailExist){
            return 'Неверный email';
        }
        return true;
    }

    public function isEmailNotExist($userEmail)
    {
        $db = new UserDataGateway(new DatabaseMySQL());
        $isEmailExist = $db->checkUserEmail($userEmail);

        if($isEmailExist){
            return 'К сожалению пользователь с таким email уже зарегестрирован';
        }
        return true;
    }

    public function isFieldEmpty($values)
    {
        if(!$values){
            $answer =['Поле пустое', 'Вы не заполнили поле выше', 'Пожалуйста, заполните поле'];
            $randomNum = mt_rand(0,count($answer)-1);
            return $answer[$randomNum];
        }
        return true;
    }

    public function isPasswordTheSame($password1, $password2){
        if($password1 !== $password2){
            return  "Неверный пароль";
        }
        return true;
    }

    public function isUsernameExist($username){
        $db = new UserDataGateway(new DatabaseMySQL());
        $isUsernameExist= $db->checkUsername($username);

        if($isUsernameExist){
            return 'Пользователь с таким ником уже существует';
        }
        return true;
    }


}