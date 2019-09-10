<?php

function autoload($class)
{
	require $class . '.php';
}

$admin = new Administrator([
	'email' => 'phil@gmail.com',
	'name' => 'phil',
	'firstName' => 'Me',
	'password' => 'yoyoyoyo'
]);

$db = new PDO('mysql:host=localhost;dbname=POO', 'root', '');
$manager = new AdministratorManager($db);

$manager->add($admin);