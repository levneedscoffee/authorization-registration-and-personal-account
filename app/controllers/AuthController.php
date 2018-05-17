<?php
namespace Auth\Controllers;
use Auth\Cookie\Cookie;
use Auth\Models\DatabaseMySQL;
use Auth\Models\UserDataGateway;
use Auth\Security\Security;
use Auth\Validation\UserValidation;



class AuthController extends Controller
{
    public function auth(){

        if(isset($_GET['status']) && $_GET['status'] === 'logout'){
            $cookie = new Cookie();
            $cookie->deleteCookie();
        }


        $security = new Security();
        $token = $security->createUniqueTokenXSRF();

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $userEmail = isset($_POST['userEmail']) ? trim($_POST['userEmail']) : false;
            $password = isset($_POST['password']) ? trim($_POST['password']) : false;

            $errors = $this->checkData($userEmail, $password);

            if(!empty($errors)){
                echo json_encode(['errors'=>true, 'errorsArray' => $errors]);
                exit;
            }

            $cookie = new Cookie();
            $cookie->setUserCookie($userEmail);

            echo  json_encode(['errors'=> false, 'redirect' => 'edit']);
            exit;
        }

        $this->twigRender('auth/auth.html.twig', ['token'=> $token]);
    }

    public function checkData($userEmail, $password){
        $db = new UserDataGateway(new DatabaseMySQL());
        $userValue = $db->returnUserValue($userEmail);

        $passwordFromDb = $userValue['password'];
        $passwordFromClient = md5($userValue['salt'].$password);

        $validation = new UserValidation();
        $validation->validateFieldEmail($userEmail);
        $validation->validateFieldPassword1($password);
        $validation->validateIsPasswordTheSame($passwordFromDb,$passwordFromClient);
        $validation->checkXSRF();

        return $validation->getErrors();
    }

}