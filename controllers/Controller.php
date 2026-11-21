<?php

class Controller
{
    protected function view($page, $data = [])
    {
        extract($data);
        include 'views/header.php';
        include 'views/' . $page . '.php';
     
    }

    protected function isLoggedIn()
    {
        return isset($_SESSION['admin_id']);
    }

    protected function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }
}
