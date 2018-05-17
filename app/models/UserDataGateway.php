<?php

namespace Auth\Models;


class UserDataGateway
{
    private $pdo;

    public function __construct(DataInterface $data)
    {
        $this->pdo = $data->connection();
    }

    public function inserNewUser($username, $userEmail, $password, $salt){
        $stmt = $this->pdo->prepare("INSERT INTO user(username, userEmail, password, salt) VALUES(?, ?, ?, ?)");
        $stmt->execute([$username, $userEmail, $password, $salt]);
    }

    public function checkUserEmail($userEmail)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user WHERE userEmail = :userEmail");
        $stmt->execute(["userEmail" => $userEmail]);
        $count = intval($stmt->fetch()["COUNT(*)"]);
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUsername($username){
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user WHERE username = :username");
        $stmt->execute(["username" => $username]);
        $count = intval($stmt->fetch()["COUNT(*)"]);

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function returnUserValue($userEmail)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE userEmail = :userEmail");
        $stmt->execute(["userEmail" => $userEmail]);
        return $stmt->fetch();

    }

    public function changeUserName($userEmail, $username){
        $stmt = $this->pdo->prepare("UPDATE user SET username=:username WHERE userEmail=:userEmail");
        $stmt->execute(["userEmail"=>$userEmail,"username"=> $username]);
    }


}