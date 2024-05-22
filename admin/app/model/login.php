<?php
class LoginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

 public function login($email,$password){
    $sql = "SELECT * FROM `user` WHERE email = '".$email."' AND password = '".$password."' AND `status`='1'";
    return $this->db->query($sql)->fetchArray();
}
}
