<?php
class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT)
            ];

            if ($this->userModel->register($data)) {
                redirect('login');
            } else {
                die('Error al registrar');
            }
        } else {
            view('auth/register');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $user = $this->userModel->login($email, $password);

            if ($user) {
                $this->createUserSession($user);
                redirect('songs');
            } else {
                view('auth/login', ['error' => 'Credenciales inválidas']);
            }
        } else {
            view('auth/login');
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        redirect('login');
    }

    private function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
    }
}