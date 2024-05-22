<?php
use Ipai\Money\Acl;
use Ipai\Money\Db;

class Controller{
    public $acl;
    public $leadType;
    public $db;
    public $config;
    public function __construct(){
        $this->acl = new Acl();
        //$this->acl->loginCheck();
		$this->db = new Db();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach($_POST as $__k => $__v){
                $_POST[$__k] = str_replace("'","&apos;",$__v);
            }
        }
        $settings_model = $this->load_model("home");
        // $this->config = $settings_model->getSettings();
    }

    public function load_controller($controller,$method = "index"){
        require_once CONFIG['path']['controller'].$controller.".php";
        if (strpos($controller, '/') !== false){
            $controller = explode("/",$controller);
            $controller_name = end($controller);
        }else{
            $controller_name = $controller;
        }
        $controller_name = ucfirst($controller_name."Controller");
        $controller_obj = new $controller_name();
        return $controller_obj->$method();
    }

    public function load_model($model){
        //$model = ucfirst($model);
        require_once  CONFIG['path']['model'] . $model . ".php";
        if (strpos($model, '/') !== false){
            $model = explode("/",$model);
            $model_name = end($model);
        }else{
            $model_name = $model;
        }
        $model_name = ucfirst($model_name."Model");
        return new $model_name();
    }

    public function load_view($view, $output = false, $data = array()){
        $this->db->close();
            if($output == false){
                return include CONFIG['path']['view'].$view.".php";
            }else{
                return file_get_contents(CONFIG['path']['view'].$view.".php");
            }
    }

    public function load_mailerHtml($view,$data = array()){
        include CONFIG['path']['view'].$view.".php";
        return $html;
    }

    public function load_style($path){
        return '<link rel="stylesheet" href="'.$path.'">';
    }

    public function load_script($path){
        $sql = "SELECT `value` FROM `config_settings` WHERE `title` = 'cache'";
        $ver = $this->db->query($sql)->fetchArray();
        return '<script src="'.$path.'?v='.$ver['value'].'"></script>';
    }

    /* public function addLog($txt){
        if($this->acl->is_login()){
            //$ip = getip();
            $longip = ip2long($ip);
            // Insert In database
            $sql = sprintf("INSERT INTO server_logs SET created_at = '".date("Y-m-d H:i:s")."', user_ip = '%s', path = '".$_GET['path']."', method = '".$_GET['method']."', path_id = '".$_GET['id']."', user_name = '".$this->acl->userName."', user_id = '".$this->acl->userId."', action = '".$txt."'", $longip);
            $this->db->query($sql);
            //Write Logfile
            $text = date("Y-m-d H:i:s") ." - ". $_SERVER['REMOTE_ADDR']." -> ". $this->acl->userName . "(".$this->acl->userId.")\n";
            $text .= "Action: ". $txt;    

            $myfile = fopen(date("Ym")."log.txt", "a");
            fwrite($myfile, $text);
            fclose($myfile);
        }
    } */

    public function setApplicantLink($leadId,$leadType){
        $now = DateTime::createFromFormat('U.u', microtime(true));
        $u = $now->format("Y-m-d H:i:s.u");
        $code = hash("sha256",md5($u));
        $query = "path=".$leadType."&method=view&id=".$leadId;
        $sql = "INSERT INTO `applicant_links` SET `code`='" . $code . "',`query`='" . $query . "',`lead_id`='" . $leadId."',`lead_type`='".$leadType."',`created_at`='".date("Y-m-d H:i:s")."'";
        $this->db->query($sql);
    }
}