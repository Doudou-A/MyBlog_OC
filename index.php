<?php
require('controller/controller.php');

try 
	{
		function chargerClasse($class)
	{
	  require 'model/' . $class . '.php'; 
	}

	spl_autoload_register('chargerClasse'); 

	$controller = new Controller;

	if(!empty($_GET['action']))
	{
		$action = $_GET['action'];
		if (method_exists($controller, $action))
		{
			$controller->$action();
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}
	else
	{
		$controller->index();
	}
}

catch(Exeption $e)
{
	die('Erreur : '.$e->getMessage());
}