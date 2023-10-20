<?php

class Router
{
    public function routeReq()
    {
        if (!isset($_SESSION['user'])) {

            if (isset($_GET['login'])) {
                $currentPage = 'Connexion';
                include('./views/login.phtml');
            } elseif (isset($_GET['register'])) {
                $currentPage = 'Inscription';
                include('./views/register.phtml');
            } else {
                $currentPage = 'Connexion';
                include('./views/login.phtml');
            }
        } else {

            if (isset($_GET['home'])) {
                $currentPage = 'Chat';
                include('./views/home.phtml');
            } elseif (isset($_GET['logout'])) {
                session_destroy();
                header('Location: index.php?login');
            } else {
                $currentPage = 'Chat';
                include('./views/home.phtml');
            }
        }
    }
}
