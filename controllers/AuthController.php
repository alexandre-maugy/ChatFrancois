<?php
require_once('../models/UserModel.php');

class AuthController
{

    public $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function handleReq()
    {
        session_start();

        if (isset($_POST['type'])) {
            $type = $_POST['type'];

            switch ($type) {

                case 'login':
                    // Get data from form
                    $username = $_POST['username'];

                    // Check data validity
                    if (!empty($username)) {
                        // Check if user exists
                        $user = $this->UserModel->getUserByUsername($username);
                        if ($user) {
                            // Start session & redirect to home page
                            $_SESSION['user'] = $username;
                            header('Location: ../index.php?home');
                            exit();
                        } else {
                            $this->UserModel->createUser($username);
                            $_SESSION['user'] = $username;
                            header('Location: ../index.php?home');
                            exit();
                        }
                    } else {
                        header('Location: ../index.php?login&error=empty_fields');
                        exit();
                    }

                case 'logout':
                    session_destroy();
                    header('Location: ../index.php?login');
                    break;
                default:
                    break;
            }
        }
    }
}

$authController = new AuthController();
$authController->handleReq();
