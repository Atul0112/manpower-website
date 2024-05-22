<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use Ipai\Money\Mailer;
use Rakit\Validation\Validator;
class FooterController extends Controller{
    public $mailer;
    public function __construct(){
        parent::__construct();
        $this->mailer = new Mailer();
        
       
    }

    public function index(){

        // $this->load_view('include/footer');
        $this->load_view('include/js');
       
    }
  }