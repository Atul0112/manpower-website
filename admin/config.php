<?php
date_default_timezone_set('Asia/Kolkata');
ini_set('session.gc_maxlifetime', 86400);
session_set_cookie_params(86400);
session_start();
define('MAIN_DOMAIN',"hoogmatic.in");
define('CONFIG', [
  'site_url' => siteUrl(),
  'site_name' => 'IPai Admin',
  'doc_cdn' => "https://ipai.local/",
  'uploads' => "D:/wamp64/sites/ipai.in",
  // 'uploads'=>'/var/www/sites/963/uploads/',
  'path' => [
      'controller' => 'app/controller/',
      'model' => 'app/model/',
      'view' => 'app/view/',
      'system' => 'system/'
  ],
  'default_connection' => 'database',
  'mail_setting' => 'mail',
  'database' => [
      'server' => 'localhost',
      'name' => 'manpower',
      'user' => 'root',
      'password' => ''
  ],
  'mail' => [
      'host' => '',
      'port' => '',
      'username' => '',
      'password' => '',
      'from' => '',
      'SMTPSecure' => '',
      'to_email_dev' => '' // All emails send to this email id in development
  ],
  'this' => [
      'home_controller' => 'home' // do not change
  ],
  // for production environment use 'production' => true
  // for development environment use 'production' => false
  'production' => false
]);

function siteUrl(){
  return sprintf(
      "%s://%s/",
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      $_SERVER['SERVER_NAME']
  );
}