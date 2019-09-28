<?php

require_once('Config.php');

class BlogPostManager
{
	private $_db;

	 public function __construct()
  	{
    	$this->setDb(DbConfig::dbConnect());
 	}

	public function add(BlogPost $blogp)
	{
		$q = $this->_db->prepare('INSERT INTO BlogPost(title, chapo, content, dateCreated) VALUES (:title, :chapo, :content, NOW())');

		$q->bindValue(':title', $blogp->title(), PDO::PARAM_STR);
		$q->bindValue(':chapo', $blogp->chapo(), PDO::PARAM_STR);
		$q->bindValue(':content', $blogp->content(), PDO::PARAM_STR);

		$q->execute();

	}

	public function delete(BlogPost $blogp)
	{
		$this->_db->exec('DELETE FROM BlogPost WHERE idBlogPost = '.$blogp->idBlogPost());
	}

	public function get($id)
	{
		$id = (int) $id;
		$q = $this->_db->query('SELECT idBlogPost, title, content, chapo FROM BlogPost WHERE idBlogPost='.$id);
		$data = $q->fetch(PDO::FETCH_ASSOC);

		return new BlogPost($data);
	}

	public function getBlogPost()
	{
		$postspublish=[];

		$q = $this->_db->query('SELECT * FROM BlogPost');
		$data = $q->fetchAll(\PDO::FETCH_ASSOC);

		for ($i=0; $i< count($data); $i++) 
		{ 
			$postpublish = new BlogPost($data[$i]);
			array_push($postspublish, $postpublish); 
		} 

		return $postspublish;
	}

	public function getList()
	{
		$blogp = [];

		$q = $this->_db->query('SELECT * FROM BlogPost');

		return $q;
	}

	public function update(BlogPost $blogp)
	{
		$q = $this->_db->prepare('UPDATE BlogPost SET title = :title, chapo = :chapo, content = :content, dateLastUpdate = NOW() WHERE idBlogPost = :idBlogPost');

		$q->bindValue(':title', $blogp->title(), PDO::PARAM_STR);
		$q->bindValue(':chapo', $blogp->chapo(), PDO::PARAM_STR);
		$q->bindValue(':content', $blogp->content(), PDO::PARAM_STR);
		$q->bindValue(':idBlogPost', $blogp->idBlogPost(), PDO::PARAM_INT);

		$q->execute();
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}