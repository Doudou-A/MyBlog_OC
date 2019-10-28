<?php

//Autoloader
spl_autoload_register(function ($class_name) {
    include 'controller/' . $class_name . '.php';
});

//Routeur
try {
    $controllerFirst = new SecurityController;
    $controllerSecond = new AdministratorController;
    $controllerThird = new BlogPostController;
    $controllerFourth = new CommentController;
    if (!empty($_GET['action'])) {
        $action = $_GET['action'];
        if (method_exists($controllerFirst, $action)) {
            $controllerFirst->$action();
        } elseif (method_exists($controllerSecond, $action)) {
            $controllerSecond->$action();
        } elseif (method_exists($controllerThird, $action)) {
            $controllerThird->$action();
        } elseif (method_exists($controllerFourth, $action)) {
            $controllerFourth->$action();
        }
    } else {
        $controllerFirst->index();
    }
} catch (Exeption $e) {
    die('Erreur : '.$e->getMessage());
}