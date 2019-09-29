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

	public function connect()
	{
		$req = $this->_db->prepare('SELECT email, password FROM Administrator WHERE email = :email');
		$req->execute(array('email' => $_POST['email']));
		$result = $req->fetch();

		return $result;

	}

	public function delete(Administrator $admin)
	{
		$this->_db->exec('DELETE FROM Administrator WHERE idAdministrator = '.$admin->idAdministrator());
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

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}