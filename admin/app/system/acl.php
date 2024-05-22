<?php
namespace Ipai\Money;
class Acl{
    public $userType;
    public $userId;
    public $userName;
    public $userEmail;
    public $userRole;
    public $userImage;
    public $userStatus;
    public $userToken;

    function __construct(){
        if(isset($_SESSION['user']) && count($_SESSION['user']) > 0){
            $this->set_user($_SESSION['user']);
        }else{
            //$this->loginCheck();
        }
        
    }

    function set_user($user){
        // $this->userType = $user['type'];
        $this->userId = $user['id'];
        // $this->userName = $user['name'];
        $this->userEmail = $user['email'];
        // $this->userRole = $user['role'];
        // if(isset($user['image'])){
        //     $this->userImage = $user['image'];
        // }
        $this->userStatus = $user['status'];
        // $this->userToken = $user['token'];
    }

    function unset_user(){
        $this->userType = "";
        $this->userId = "";
        $this->userName = "";
        $this->userEmail = "";
        $this->userRole = "";
        $this->userImage = "";
        $this->userStatus = "";
        $this->userToken = "";
    }
    // getters
    public function get_userType(){
        return $this->userType;
    }
    public function get_userId(){
        return $this->userId;
    }
    public function get_userName(){
        return $this->userName;
    }
    public function get_userEmail(){
        return $this->userEmail;
    }
    public function get_userRole(){
        return $this->userRole;
    }

    public function get_userStatus(){
        return $this->userStatus;
    }
    
    public function get_userImage(){
        if($this->userImage == ""){

        }else{
            return $this->userImage; 
        }
        
    }

    public function get_userToken(){
        if($this->userToken == ""){

        }else{
            return $this->userToken; 
        }        
    }

    function is_login(){
        if(isset($_SESSION['user']['id'])){
            return true;
        }else{
            return false;
        }
    }

    function is_first_login(){
        if($_SESSION['user']['first_login'] == "1"){
            return true;
        }else{
            return false;
        }
    }

    function login($row){
        unset($row["password"]);
        unset($row["email_verified_at"]);
        unset($row["remember_token"]);
        unset($row["created_at"]);
        unset($row["updated_at"]);
        $_SESSION['user'] = $row;
        $this->set_user($row);
    }

    function logout(){
        $_SESSION['user'] = array();
        $this->unset_user();
        header('Location: /admin/index.php');
    }

    public function loginCheck(){
        if(!isset($_GET['path']) || $_GET['path'] == ""){
            $path = "home";
        }else{
            $path = $_GET['path'];
        }

        if(!isset($_GET['method']) || $_GET['method'] == ""){
            $method = "index";
        }else{
            $method = $_GET['method'];
        }
        $allowedPaths = array("admin","api");
        $allowedPages = array("login","forgotpassword");
        if(!in_array($path, $allowedPaths) && !in_array($method , $allowedPages)){
            if(!$this->is_login()){
                    header('Location: /admin/index.php?path=admin&method=login');
            }
            // }else{
            //     if($this->is_first_login()){
            //         header('Location: /index.php?path=user&method=newpassword');
            //     }
            // }
        }
    }
}