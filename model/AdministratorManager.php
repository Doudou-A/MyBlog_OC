<?php

require_once('Config.php');

class AdministratorManager
{
	private $_db;

	public function __construct()
  	{
    	$this->setDb(DbConfig::dbConnect());
 	}

	public function add(Administrator $admin)
	{
		$q = $this->_db->prepare('INSERT INTO Administrator(email, name, firstName, password) VALUES(:email, :name, :firstName, :password)');

		$pass_hash = password_hash($admin->password(), PASSWORD_DEFAULT);

		$q->bindValue(':email', $admin->email(), PDO::PARAM_STR);
		$q->bindValue(':name', $admin->name(), PDO::PARAM_STR);
		$q->bindValue(':firstName', $admin->firstName(), PDO::PARAM_STR);
		$q->bindValue(':password', $pass_hash);

		$q->execute();
	}

	public function connect($email)
	{
		$email = (string) $email;

		$q = $this->_db->prepare('SELECT * FROM Administrator WHERE email = :email');
		$q->execute(array(':email' => $email));
		$data = $q->fetch();

		return new Administrator($data);

	}

	public function delete(Administrator $admin)
	{
		$this->_db->exec('DELETE FROM Administrator WHERE idAdministrator = '.$admin->idAdministrator());
	}

	public function emailExist($email)
	{
		$email = (string) $email;

		$q = $this->_db->prepare('SELECT idAdministrator FROM Administrator WHERE email = :email');
		$q->execute(array(':email' => $email));
		$data = $q->fetch(PDO::FETCH_ASSOC);

		return $data;
	}

	public function getEmail($email)
	{
		$email = (string) $email;

		$q = $this->_db->prepare('SELECT * FROM Administrator WHERE email = :email');
		$q->execute(array(':email' => $email));
		$data = $q->fetch();

		return $data;

	}

	public function get($id)
	{
		$id = (int) $id;

		$q = $this->_db->query('SELECT idAdministrator, email, name, firstName, password FROM Administrator WHERE idAdministrator = '.$id);
		$data = $q->fetch(PDO::FETCH_ASSOC);

		return new Administrator($data);
	}

	public function getAdministrators()
	{
		$adminspublish=[];

		$q = $this->_db->query('SELECT * FROM Administrator');
		$data = $q->fetchAll(\PDO::FETCH_ASSOC);

		for ($i=0; $i< count($data); $i++) 
		{ 
			$adminpublish = new Administrator($data[$i]);
			array_push($adminspublish, $adminpublish); 
		} 

		return $adminspublish;
	}

	public function update(Administrator $admin)
	{
		$q = $this->_db->prepare('UPDATE Administrator SET email = :email, name = :name, firstName = :firstName, password = :password WHERE idAdministrator = :idAdministrator');

		$pass_hash = password_hash($admin->password(), PASSWORD_DEFAULT);

		$q->bindValue(':idAdministrator', $admin->idAdministrator(), PDO::PARAM_STR);
		$q->bindValue(':email', $admin->email(), PDO::PARAM_STR);
		$q->bindValue(':name', $admin->name(), PDO::PARAM_STR);
		$q->bindValue(':firstName', $admin->firstName(), PDO::PARAM_STR);
		$q->bindValue(':password', $pass_hash, PDO::PARAM_STR);

		$q->execute();
	}

	public function updateNoPassword(Administrator $admin)
	{
		$q = $this->_db->prepare('UPDATE Administrator SET email = :email, name = :name, firstName = :firstName WHERE idAdministrator = :idAdministrator');

		$q->bindValue(':idAdministrator', $admin->idAdministrator(), PDO::PARAM_STR);
		$q->bindValue(':email', $admin->email(), PDO::PARAM_STR);
		$q->bindValue(':name', $admin->name(), PDO::PARAM_STR);
		$q->bindValue(':firstName', $admin->firstName(), PDO::PARAM_STR);

		$q->execute();
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}