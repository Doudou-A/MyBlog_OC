<?php
function chargerClasse($class)
{
  require $class . '.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

$db = new dbConnect();

$admin = new Administrator([
'email' => 'Meeeee',
'name' => 'nfeznjfe',
'firstName' => 'fbebfezyefzby',
'password' => 'dzuiuheifuz'
]);

$manager = new AdministratorManager($db);

//$admin = $manager->getList();

//var_dump($admin);
$manager->add($admin);