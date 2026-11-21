<?php

class AuthController extends Controller
{
    public function login()
    {
        if ($this->isLoggedIn()) {
            $this->redirect('index.php');
        }

        $error = "";
        $username = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->getByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $this->redirect('index.php');
            } else {
                $error = "Wrong username or password";
            }
        }

        $this->view('login', ['error' => $error, 'username' => $username]);
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('index.php');
    }
}
