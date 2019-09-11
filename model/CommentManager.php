<?php
class CommentManagger
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(Comment $com)
	{
		$valid = false;

		$q = $this->_db->prepare('INSERT INTO comment(pseudo, date, content, valid) VALUES (:pseudo, NOW(), :content, '.((int) $valid).')');
		
		$q->bindValue(':pseudo', $com->pseudo(), PDO::PARAM_STR);
		$q->bindValue(':content', $com->content(), PDO::PARAM_STR);

		$q->execute();
	}

	public function delete(Comment $com)
	{
		$this->_db->exec('DELETE FROM comment WHERE id = '.$com->id());
	}

	public function get($id)
	{
		$id = (int) $id;

		$q = $this->_db->query('SELECT id, pseudo, date, content, valid FROM comment WHERE id ='.$id);
		$data = $q->fetch(PDO::FETCH_ASSOC);

		return new Comment($data);
	}

	public function getList()
	{
		$com = [];

		$q = $this->_db->query('SELECT id, pseudo, date, content, valid FROM comment ORDER BY pseudo');

		while ($data = $q->fetch(PDO::FETCH_ASSOC))
		{
			$com[] = new Comment($data);
		}

		return $com;
	}

	public function update(Comment $com)
	{
		$q = $this->_db->prepare('UPDATE comment SET valid = :valid WHERE id = :id');

		$q->bindValue(':valid', $com->valid());

		$q->execute();
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

}