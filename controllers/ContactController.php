<?php

class ContactController extends Controller
{
    private $contactModel;

    public function __construct()
    {
        $this->contactModel = new Contact();
    }

    public function index()
    {
        $contacts = $this->contactModel->getAll();
        $this->view('list', ['contacts' => $contacts]);
    }

    public function add()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('index.php?action=login');
        }

        $errors = [];
        $name = "";
        $email = "";
        $phone = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            checkToken();

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);

            $errors = $this->validate($name, $email, $phone);

            if (empty($errors)) {
                $this->contactModel->add($name, $email, $phone);
                $_SESSION['msg'] = "Contact added";
                $this->redirect('index.php');
            }
        }

        $this->view('form', [
            'title' => 'Add Contact',
            'action' => 'add',
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'errors' => $errors
        ]);
    }

    public function edit()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('index.php?action=login');
        }

        $id = $_GET['id'];
        $contact = $this->contactModel->getById($id);

        if (!$contact) {
            http_response_code(404);
            $this->view('404');
            return;
        }

        $errors = [];
        $name = $contact['name'];
        $email = $contact['email'];
        $phone = $contact['phone'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            checkToken();

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);

            $errors = $this->validate($name, $email, $phone);

            if (empty($errors)) {
                $this->contactModel->update($contact['id'], $name, $email, $phone);
                $_SESSION['msg'] = "Contact updated";
                $this->redirect('index.php');
            }
        }

        $this->view('form', [
            'title' => 'Edit Contact',
            'action' => 'edit&id=' . $contact['id'],
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'errors' => $errors
        ]);
    }

    public function delete()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('index.php?action=login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            checkToken();
            $this->contactModel->delete($_GET['id']);
            $_SESSION['msg'] = "Contact deleted";
        }

        $this->redirect('index.php');
    }

    private function validate($name, $email, $phone)
    {
        $errors = [];

        if ($name == "") {
            $errors['name'] = "Name is required";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter a valid email";
        }

        // saudi mobile number, 10 digits starting with 05
        if (!preg_match('/^05[0-9]{8}$/', $phone)) {
            $errors['phone'] = "Phone must be 10 digits and start with 05";
        }

        return $errors;
    }
}
