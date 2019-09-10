<?php
function chargerClasse($class)
{
  require $class . '.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

$db = new PDO('mysql:host=localhost;dbname=poo;charset=utf8', 'root', 'root');

$manager = new AdministratorManager($db);

$id = 2;

$manager->get($id);

echo data();