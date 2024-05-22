<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Ipai\Money\Mailer;
use Rakit\Validation\Validator;
use Ipai\Money\Acl;

class Add_pageController extends Controller
{
    public $mailer;
    public $acl;
    public function __construct()
    {
        parent::__construct();
        $this->mailer = new Mailer();
    }

    public function index()
    {

        $EditorModel = $this->load_model('add_page');
        if (isset($_POST['submit'])) {
            $validator = new Validator;
            $validation = $validator->make($_POST, [
                'title' => 'required',
                'description' => 'required',

            ]);
            $validation->validate();
            if ($validation->fails()) {
                $error = $validation->errors();
                $errors = $error->firstOfAll();
                $data['errors'] = $errors;
                $data['formdata'] = $_POST;
            }

            if (!isset($data['errors'])) {
                $userdetail = array(
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                );

                $EditorModel->editor($userdetail);
            }
        }

        $this->load_controller('common/preloader');
        $this->load_controller('common/header');
        $this->load_controller('common/sidebar');
        $this->load_view('pages/add_page');
        $this->load_controller('common/footer');
    }
}
