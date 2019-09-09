<?php
class AdministratorsManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(Administrator $admin)
	{
		//prépa requête insertion
		//assignation valeur name...
		//Exécutions de la requête
	}

	public function delete(Administrator $admin)
	{
		//Exécute une requête de type DELETE.
	}

	public function get($id)
	{
		//Exécute une requête de type SELECT avec un clause WHERE, et retourne un objet Administrator.
	}

	public function getList()
	{
		//Retourne la liste de tous les admins.
	}

	public function update(Administrator $admin)
	{
		//Prépare une requête de type UPDATE.
		//Assignation des valeurs à la requête.
		//Exécution de la requête.
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}