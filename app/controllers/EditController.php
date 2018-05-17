<?php
namespace Auth\Controllers;
use Auth\Models\UserDataGateway;
use Auth\Models\DatabaseMySQL;
use Auth\Validation\UserValidation;
use Auth\Security\Security;

class EditController extends Controller
{
    public function edit(){
        $security = new Security();
        $token = $security->createUniqueTokenXSRF();

        if(!isset($_COOKIE["userEmail"])){
            header("Location: auth");
        }

        $userEmail = $_COOKIE["userEmail"];


        $db = new UserDataGateway(new DatabaseMySQL());
        $userValue = $db->returnUserValue($userEmail);
        $username = $userValue["username"];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $postUsername= trim($_POST["newUsername"]);

            $errors = $this->checkData($postUsername);

            if(!empty($errors)){
                if($username !== $postUsername){
                    echo json_encode(['errors'=>true, 'errorsArray'=> $errors,
                        'message' =>'Ник '.$postUsername." к сожалению занят", "username"=>$username]);
                    exit;
                }else{
                    echo json_encode(['errors'=>true, 'errorsArray'=> $errors, "username"=>$username]);
                    exit;
                }

            }else{
                $db->changeUserName($userEmail, $postUsername);

                echo json_encode(['errors'=>false, 'username'=>$username, 'message'=>'Вы изменили свой никнейм']);
                exit;
            }
        }

        $this->twigRender('edit/edit.html.twig',['username'=> $username, 'token'=>$token]);
    }

    public function checkData($newUsername){

        $validation = new UserValidation();
        $validation->validateFieldUsername($newUsername);
        $validation->checkXSRF();

        return $validation->getErrors();

    }
}