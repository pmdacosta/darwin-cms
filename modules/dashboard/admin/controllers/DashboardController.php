<?php

class DashboardController extends Controller
{
    public function runBeforeAction()
    {
        if ($_SESSION['is_admin'] ?? false) {
            return true;
        }

        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';

        if ($action != 'login') {
            header('Location: /admin/index.php?module=dashboard&action=login');
            die();
        } else {
            return true;
        }
    }

    public function defaultAction()
    {
        echo "Welcome to the administration";
    }

    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $auth = new Auth;
            if ($auth->checkLogin($username, $password)) {
                $_SESSION['is_admin'] = 1;
                Header('Location: /admin/');
                die();
            }
        }

        include VIEW_PATH . 'admin/login.html';
    }
}