<?php



namespace Controller;

use Model\User;
use Exception;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // Registro do usuário
    public function registerUser($user_fullname, $email, $password)
    {
        try {
            if (empty($user_fullname) or empty($email) or empty($password)) {
                return false;
            }

            // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            return $this->userModel->registerUser($user_fullname, $email, $password);

        } catch (Exception $error) {
            echo "Erro ao cadastrar usuário: " . $error->getMessage();
            return false;
        }
    }


    // Email já cadastrado
    public function checkuserbyEmail($email){
        return $this->userModel->getUserByEmail($email);
    }


    // Login do usuário
    public function login($email, $password)
    {
        $user = $this->userModel->getUserByEmail($email);
        
        
        /**
         * $user = [
         *    "id"=> 1,
         * 
         *  ]
         * 
         * 
         * 
        */ 
        if($user && password_verify($password,$user['password'])){
                $_SESSION['id'] = $user ['id'];
                $_SESSION['user_fullname'] = $user['user_fullname'];
                $_SESSION['email'] = $email['email'];
                
                return true;
        }

        return false;
    }

    // usuário logado
    public function isLoggedIn()
    {
        return isset($_SESSION['id']);
    }

    
    
    // Resgatar dados do usuário
    public function getUserData($id,$user_fullname,$email){
        $id = $_SESSION['id'];

        return $this->userModel->getUserInfo($id, $user_fullname, $email);
    }
}

?>