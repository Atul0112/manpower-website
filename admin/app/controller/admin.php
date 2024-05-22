<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Ipai\Money\Mailer;
use Ipai\Money\Acl;
use Rakit\Validation\Validator;

class AdminController extends Controller
{
    public $mailer;
    public $acl;
    public function __construct()
    {
        parent::__construct();
        $this->mailer = new Mailer();
        $this->acl = new Acl();
    }
    public function login()

    {
        $login_model = $this->load_model('login');
        $data = [];

        if (isset($_POST['submit'])) {

            $validator = new Validator;
            $validation = $validator->make($_POST, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $validation->validate();

            if ($validation->fails()) {
                $error = $validation->errors();
                $errors = $error->firstOfAll();
                $data['errors'] = $errors;
                $data['formdata'] = $_POST;
            }

            if (!isset($data['errors'])) {
                $email = $_POST['email'];
                $password = md5($_POST['password']);
                $is_valid = $login_model->login($email, $password);
                if (count($is_valid) > 0) {
                    $_SESSION['user']['id'] = $is_valid['id'];
                    $_SESSION['user']['email'] = $is_valid['email'];
                    $_SESSION['user']['status'] = $is_valid['status'];
                    $this->acl->set_user($is_valid);
                    header('location:/admin/index.php?path=home&method=index');
                }
            }
        }

        $this->load_view('login', false, $data);
    }

    public function logout()
    {
        session_unset();
        $this->acl->logout();
        header('/index.php');
    }
}
