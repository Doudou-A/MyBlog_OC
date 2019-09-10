<?php
function chargerClasse($class)
{
  require $class . '.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

$administrator = new Administrator([
	'email' => 'phil@gmail.com',
	'name' => 'phil',
	'firstName' => 'Me',
	'password' => 'yoyoyoyo'
]);

$db = new PDO('mysql:host=localhost;dbname=POO;charset=utf8', 'root', 'root');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$manager = new AdministratorManager($db);

$manager->add($administrator);
