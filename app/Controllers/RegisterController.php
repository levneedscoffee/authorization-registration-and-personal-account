<?php

namespace Auth\Controllers;

use Auth\Cookie\Cookie;
use Auth\Security\Security;
use Auth\Validation\UserValidation;
use Auth\Models\UserDataGateway;
use Auth\Models\DatabaseMySQL;

/**
 * Class RegisterController
 * @package Auth\Controllers
 */
class RegisterController extends Controller
{
    /**
     *
     */
    public function register()
    {
        $security = new Security();
        $token = $security->createUniqueTokenXSRF();


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = isset($_POST['username']) ? trim($_POST['username']) : false;
            $userEmail = isset($_POST['userEmail']) ? trim($_POST['userEmail']) : false;
            $password1 = isset($_POST['password1']) ? trim($_POST['password1']) : false;
            $password2 = isset($_POST['password2']) ? trim($_POST['password2']) : false;

            $errors = $this->checkData($username, $userEmail, $password1, $password2);

            if (!empty($errors)) {
                echo json_encode(['errors' => true, 'errorsArray' => $errors,
                    'username' => $username,
                    'userEmail' => $userEmail]);
                exit;
            } else {
                $salt = $this->generateSalt();
                $password = md5($salt . $password1);

                $db = new UserDataGateway(new DatabaseMySQL());
                $db->inserNewUser($username, $userEmail, $password, $salt);

                $cookie = new Cookie();
                $cookie->setUserCookie($userEmail);

                echo json_encode(['error' => false, 'redirect' => 'edit']);
                exit;
            }
        }

        $this->twigRender('register/register.html.twig', ['token' => $token]);
    }


    /**
     * @param $username
     * @param $userEmail
     * @param $password1
     * @param $password2
     * @return mixed
     */
    private function checkData($username, $userEmail, $password1, $password2)
    {
        $validation = new UserValidation();
        $validation->validateFieldEmail($userEmail, true);
        $validation->validateFieldUsername($username);
        $validation->validateFieldPassword1($password1);
        $validation->validateFieldPassword2($password2);
        $validation->validateIsPasswordTheSame($password1, $password2);
        $validation->checkXSRF();

        return $validation->getErrors();
    }

    /**
     * @return string
     */
    private function generateSalt()
    {
        $security = new Security();
        $salt = $security->generateRandomHash();
        return $salt;
    }
}