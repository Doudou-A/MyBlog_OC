<?php

require_once('Config.php');
require('Administrator.php');

class AdministratorManager
{
	private $_db;

	public function __construct()
  	{
    	$this->setDb(DbConfig::dbConnect());
 	}

 	//Ajouter un Utilisateur
	public function add(Administrator $admin)
	{
		$query = $this->_db->prepare('INSERT INTO Administrator(email, name, firstName, password) VALUES(:email, :name, :firstName, :password)');

		$pass_hash = password_hash($admin->password(), PASSWORD_DEFAULT);

		$query->bindValue(':email', $admin->email(), PDO::PARAM_STR);
		$query->bindValue(':name', $admin->name(), PDO::PARAM_STR);
		$query->bindValue(':firstName', $admin->firstName(), PDO::PARAM_STR);
		$query->bindValue(':password', $pass_hash);

		$query->execute();
	}

	//Connecter un Utilisateur
	public function connect($email)
	{
		$email = (string) $email;

		$query = $this->_db->prepare('SELECT * FROM Administrator WHERE email = :email');
		$query->execute(array(':email' => $email));
		$data = $query->fetch();

		return new Administrator($data);

	}

	public function delete(Administrator $admin)
	{
		$query = $this->_db->prepare('DELETE FROM Administrator WHERE idAdministrator = :idAdministrator');
		$query->bindvalue(':idAdministrator', $admin->idAdministrator(), PDO::PARAM_INT);
		$query->execute();
	}

	//Vérifier l'existance d'un email
	public function emailExist($email)
	{
		$email = (string) $email;

		$query = $this->_db->prepare('SELECT idAdministrator FROM Administrator WHERE email = :email');
		$query->execute(array(':email' => $email));
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return $data;
	}

	public function getEmail($email)
	{
		$email = (string) $email;

		$query = $this->_db->prepare('SELECT * FROM Administrator WHERE email = :email');
		$query->execute(array(':email' => $email));
		$data = $query->fetch();

		return $data;

	}

	public function get($id)
	{
		$id = (int) $id;

		$query = $this->_db->prepare('SELECT * FROM Administrator WHERE idAdministrator = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return new Administrator($data);
	}

	public function getAdministrators()
	{
		$adminspublish=[];

		$query = $this->_db->query('SELECT * FROM Administrator');
		$data = $query->fetchAll(\PDO::FETCH_ASSOC);

		for ($i=0; $i< count($data); $i++) 
		{ 
			$adminpublish = new Administrator($data[$i]);
			array_push($adminspublish, $adminpublish); 
		} 

		return $adminspublish;
	}

	//Modifier un utilisateur avec un mot de passe différent
	public function update(Administrator $admin)
	{
		$query = $this->_db->prepare('UPDATE Administrator SET email = :email, name = :name, firstName = :firstName, password = :password WHERE idAdministrator = :idAdministrator');

		$pass_hash = password_hash($admin->password(), PASSWORD_DEFAULT);

		$query->bindValue(':idAdministrator', $admin->idAdministrator(), PDO::PARAM_STR);
		$query->bindValue(':email', $admin->email(), PDO::PARAM_STR);
		$query->bindValue(':name', $admin->name(), PDO::PARAM_STR);
		$query->bindValue(':firstName', $admin->firstName(), PDO::PARAM_STR);
		$query->bindValue(':password', $pass_hash, PDO::PARAM_STR);

		$query->execute();
	}


	//Modifier un utilisateur avec le même mot de passe
	public function updateNoPassword(Administrator $admin)
	{
		$query = $this->_db->prepare('UPDATE Administrator SET email = :email, name = :name, firstName = :firstName WHERE idAdministrator = :idAdministrator');

		$query->bindValue(':idAdministrator', $admin->idAdministrator(), PDO::PARAM_STR);
		$query->bindValue(':email', $admin->email(), PDO::PARAM_STR);
		$query->bindValue(':name', $admin->name(), PDO::PARAM_STR);
		$query->bindValue(':firstName', $admin->firstName(), PDO::PARAM_STR);

		$query->execute();
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}