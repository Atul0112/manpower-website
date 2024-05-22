<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
require "config.php";
require 'vendor/autoload.php';

// $path = (isset($_GET['path']) && $_GET['path'] != "") ? $_GET['path'] : CONFIG['this']['home_controller'];
$path = (isset($_GET['path']) && $_GET['path'] != "") ? $_GET['path'] : CONFIG['this']['home_controller'];
if (strpos($path, '/') !== false){
    $path_array = explode("/",$path);
    $path_array = array_filter($path_array);
    $path_name = end($path_array);
}else{
    $path_name = $path;
}


$config['this']['home_controller'] = $path_name;

$method = (isset($_GET['method']) && $_GET['method'] != "") ? $_GET['method'] : "index";
$config['this']['method'] = $method;
$coreControllerClass = ucfirst($config['this']['home_controller']."Controller");
$load = new $coreControllerClass();
$load->$method();
?>