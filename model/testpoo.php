<?php
function chargerClasse($class)
{
  require $class . '.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

/*$com = new Comment([
'pseudo' => 'yehhhh',
'content' => 'fhuzeihezuezhhufezui'
]);*/

$id = new Administrator([
'id' => 2
]);

$db = new PDO('mysql:host=localhost;dbname=poo;charset=utf8', 'root', 'root');

$manager = new AdministratorManager($db);

$manager->get($id);

