<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Ipai\Money\Mailer;
use Rakit\Validation\Validator;
use Ipai\Money\Acl;

class View_pagesController extends Controller
{
    public $mailer;
    public $acl;
    public function __construct()
    {
        parent::__construct();
        $this->mailer = new Mailer();
        // $this->acl = new Acl();
        // $this->acl->logincheck();
    }

  
  public function index()
  {

    $pages_model = $this->load_model('view_pages');
    $data = [];

    $data['list'] = $pages_model->page_list();

    $this->load_controller('common/preloader');
    $this->load_controller('common/header');
    $this->load_controller('common/sidebar');
    $this->load_view('pages/view_pages', false, $data);
    $this->load_controller('common/footer');

  }

}
