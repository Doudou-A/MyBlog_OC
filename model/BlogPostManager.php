<?php

require_once('Config.php');
require('BlogPost.php');

class BlogPostManager
{
	private $_db;

	 public function __construct()
  	{
    	$this->setDb(DbConfig::dbConnect());
 	}

	public function add(BlogPost $blogp)
	{
		$query = $this->_db->prepare('INSERT INTO BlogPost(title, chapo, content, dateCreated, image, idAdministrator) VALUES (:title, :chapo, :content, NOW(), :image, :idAdministrator)');

		$query->bindValue(':title', $blogp->title(), PDO::PARAM_STR);
		$query->bindValue(':chapo', $blogp->chapo(), PDO::PARAM_STR);
		$query->bindValue(':content', $blogp->content(), PDO::PARAM_STR);
		$query->bindValue(':image', $blogp->image(), PDO::PARAM_STR);
		$query->bindValue(':idAdministrator', $blogp->idAdministrator(), PDO::PARAM_STR);

		$query->execute();

	}

	//Supprimer un article
	public function delete(BlogPost $blogp)
	{
		$query = $this->_db->prepare('DELETE FROM BlogPost WHERE idBlogPost = :idBlogPost');
		$query->bindValue(':idBlogPost' , $blogp->idBlogPost(), PDO::PARAM_INT);
		$query->execute();

	}


	//Récupérer un article selon l'id
	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare('SELECT * FROM BlogPost WHERE idBlogPost= :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return new BlogPost($data);
	}

	public function getFull($id)
	{
		$Administrator = new AdministratorManager();

		$id = (int) $id;
		$query = $this->_db->prepare('SELECT * FROM BlogPost WHERE idBlogPost= :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch(PDO::FETCH_ASSOC);

		$blogp = new BlogPost($data);

		$blogp->setIdAdministrator($Administrator->get($data["idAdministrator"]));

		return $blogp;

	}

	public function getBlogPosts()
	{
		$postspublish=[];

		$query = $this->_db->query('SELECT * FROM BlogPost');
		$data = $query->fetchAll(\PDO::FETCH_ASSOC);

		for ($i=0; $i< count($data); $i++) 
		{ 
			$postpublish = new BlogPost($data[$i]);
			array_push($postspublish, $postpublish); 
		} 

		return $postspublish;
	}

	/*public function getList()
	{
		$blogp = [];

		$query = $this->_db->query('SELECT * FROM BlogPost');

		return $query;
	}*/

	public function update(BlogPost $blogp)
	{
		$query = $this->_db->prepare('UPDATE BlogPost SET title = :title, chapo = :chapo, content = :content, dateLastUpdate = NOW(), idAdministrator = :idAdministrator WHERE idBlogPost = :idBlogPost');

		$query->bindValue(':idBlogPost', $blogp->idBlogPost(), PDO::PARAM_INT);
		$query->bindValue(':title', $blogp->title(), PDO::PARAM_STR);
		$query->bindValue(':chapo', $blogp->chapo(), PDO::PARAM_STR);
		$query->bindValue(':content', $blogp->content(), PDO::PARAM_STR);
		$query->bindValue(':idAdministrator', $blogp->idAdministrator(), PDO::PARAM_INT);

		$query->execute();
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}