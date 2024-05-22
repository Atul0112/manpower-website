<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Ipai\Money\Mailer;
use Rakit\Validation\Validator;
use Ipai\Money\Acl;

class Edit_pageController extends Controller
{
    public $mailer;
    public $acl;
    public function __construct()
    {
        parent::__construct();
        $this->mailer = new Mailer();
        $this->acl = new Acl();
        $this->acl->logincheck();
    }

    public function edit()
    {
        $id = $_GET['id'];
        $pages_model = $this->load_model('view_pages');
        if (isset($_POST['submit'])) {
            $post = $_POST;
            $pages_model->update($id, $post);
            header("location:/admin/index.php?path=view_pages&method=index");
        }
        $data['editdata'] = $pages_model->get_data($id);
        $this->load_controller('common/preloader');
        $this->load_controller('common/header');
        $this->load_controller('common/sidebar');
        $this->load_view('pages/edit_page', false, $data);
        $this->load_controller('common/footer');
    }
  

}
