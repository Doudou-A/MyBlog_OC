<?php
class AdministratorManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(Administrator $admin)
	{
		$q = $this->_db->prepare('INSERT INTO administrator(email, name, firstName, password) VALUE(:email, :name, :firstName, :password)');

		$q->bindValue(':email', $admin->email());
		$q->bindValue(':name', $admin->name());
		$q->bindValue(':firstName', $admin->firstName());
		$q->bindValue(':password', $admin->password());

		$q->execute();
	}

	public function delete(Administrator $admin)
	{
		$this->_db->exec('DELETE FROM administrator WHERE id = '.$admin->id());
	}

	public function get($id)
	{
		$id = (int) $id;

		$q = $this->_db->query('SELECT id, email, name, firstName, password FROM administrator WHERE id = '.$id);
		$data = $q->fetch(PDO::FETCH_ASSOC);

		return new Administrator($data);
	}

	public function getList()
	{
		$admin = [];

		$q = $this->_db->query('SELECT id, email, name, firstName From administrator Order BY name');

		while ($data = $q->fetch(PDO::FETCH_ASSOC))
		{
			$admin[] = new Administrator($data);
		}

		return $admin;
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}