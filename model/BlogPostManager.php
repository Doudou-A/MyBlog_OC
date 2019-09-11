<?php
class BlogPostManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDB($db);
	}

	public function add(BlogPost $blogp)
	{
		$q = $this->_db->prepare('INSERT INTO blogpost(title, chapo, content, dateCreated) VALUES (:title, :chapo, :content, NOW())');

		$q->bindValue(':title', $blogp->title(), PDO::PARAM_STR);
		$q->bindValue(':chapo', $blogp->chapo(), PDO::PARAM_STR);
		$q->bindValue(':content', $blogp->content(), PDO::PARAM_STR);

		$q->execute();

	}

	public function delete(BlogPost $blogp)
	{
		$this->_db->exec('DELETE FROM blogPost WHERE id = '.$blogp->id());
	}

	public function get($id)
	{
		$id = (int) $id;
		$q = $this->_db->query('SELECT id, title, chapo, content, dateLastUpdate, dateCreated FROM blogPost WHERE id='.$id);
		$data = $q->detch(PDO::FETCH_ASSOC);

		return new BlogPost($data);
	}

	public function getList()
	{
		$blogp = [];

		$q = $this->_db->query('SELECT id, title, chapo, content, dateLastUpdate, dateCreated FROM blogpost ORDER BY title');
		
		while ($data = $q->fetch(PDO::FETCH_ASSOC))
		{
			$blogp[] = new BlogPost($data);
		}

		return $blogp;
	}

	public function update(BlogPost $blogp)
	{
		$q = $this->_db->prepare('UPDATE blogp SET title = :title, chapo = :chapo, content = :content, dateLastUpdate = :dateLastUpdate WHERE id = :id');

		$q->bindValue(':title', $blogp->title(), PDO::PARAM_STR);
		$q->bindValue(':chapo', $blogp->chapo(), PDO::PARAM_STR);
		$q->bindValue(':content', $blogp->content(), PDO::PARAM_STR);
		$q->bindValue(':dateLastUpdate', $blogp->dateLastupdate());
		$q->bindValue(':id', $blogp->id(), PDO::PARAM_INT);

		$q->execute();
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}