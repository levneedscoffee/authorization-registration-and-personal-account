<?php

namespace Auth\Models;


/**
 * Class UserDataGateway
 * @package Auth\Models
 */
class UserDataGateway
{
    /**
     * @var
     */
    private $pdo;

    /**
     * UserDataGateway constructor.
     * @param DataInterface $data
     */
    public function __construct(DataInterface $data)
    {
        $this->pdo = $data->connection();
    }

    /**
     * @param $username
     * @param $userEmail
     * @param $password
     * @param $salt
     */
    public function inserNewUser($username, $userEmail, $password, $salt)
    {
        $stmt = $this->pdo->prepare("INSERT INTO user(username, userEmail, password, salt) VALUES(?, ?, ?, ?)");
        $stmt->execute([$username, $userEmail, $password, $salt]);
    }

    /**
     * @param $userEmail
     * @return bool
     */
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

    /**
     * @param $username
     * @return bool
     */
    public function checkUsername($username)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user WHERE username = :username");
        $stmt->execute(["username" => $username]);
        $count = intval($stmt->fetch()["COUNT(*)"]);

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param $userEmail
     * @return mixed
     */
    public function returnUserValue($userEmail)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE userEmail = :userEmail");
        $stmt->execute(["userEmail" => $userEmail]);
        return $stmt->fetch();

    }

    /**
     * @param $userEmail
     * @param $username
     */
    public function changeUserName($userEmail, $username)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET username=:username WHERE userEmail=:userEmail");
        $stmt->execute(["userEmail" => $userEmail, "username" => $username]);
    }


}