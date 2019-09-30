<?php
function chargerClasse($class)
{
  require $class . '.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

require "Config.php";

/*$admin = new Administrator([
'email' => 'Meeeee',
'name' => 'nfeznjfe',
'firstName' => 'fbebfezyefzby',
'password' => 'dzuiuheifuz'
]);*/

$manager = new BlogPostManager($db);

$blogp = $manager->get(1);

echo $blogp->idBlogPost();
//$manager->add($admin);