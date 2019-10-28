<?php

require_once('Config.php');
require('BlogPost.php');
//use App\Entity\BlogPost;

class BlogPostManager
{
	private $_db;

	 public function __construct()
  	{
    	$this->setDb(DbConfig::dbConnect());
 	}

	public function add(BlogPost $blogp)
	{
		$q = $this->_db->prepare('INSERT INTO BlogPost(title, chapo, content, dateCreated, image, idAdministrator) VALUES (:title, :chapo, :content, NOW(), :image, :idAdministrator)');

		$q->bindValue(':title', $blogp->title(), PDO::PARAM_STR);
		$q->bindValue(':chapo', $blogp->chapo(), PDO::PARAM_STR);
		$q->bindValue(':content', $blogp->content(), PDO::PARAM_STR);
		$q->bindValue(':image', $blogp->image(), PDO::PARAM_STR);
		$q->bindValue(':idAdministrator', $blogp->idAdministrator(), PDO::PARAM_STR);

		$q->execute();

	}

	//Supprimer un article
	public function delete(BlogPost $blogp)
	{
		$this->_db->exec('DELETE FROM BlogPost WHERE idBlogPost = '.$blogp->idBlogPost());
	}


	//Récupérer un article selon l'id
	public function get($id)
	{
		$id = (int) $id;
		$q = $this->_db->query('SELECT * FROM BlogPost WHERE idBlogPost='.$id);
		$data = $q->fetch(PDO::FETCH_ASSOC);

		return new BlogPost($data);
	}

	public function getFull($id)
	{
		$Administrator = new AdministratorManager();

		$id = (int) $id;
		$q = $this->_db->query('SELECT * FROM BlogPost WHERE idBlogPost='.$id);
		$data = $q->fetch(PDO::FETCH_ASSOC);

		$blogp = new BlogPost($data);

		$blogp->setIdAdministrator($Administrator->get($data["idAdministrator"]));

		return $blogp;

	}

	public function getBlogPosts()
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

	/*public function getList()
	{
		$blogp = [];

		$q = $this->_db->query('SELECT * FROM BlogPost');

		return $q;
	}*/

	public function update(BlogPost $blogp)
	{
		$q = $this->_db->prepare('UPDATE BlogPost SET title = :title, chapo = :chapo, content = :content, dateLastUpdate = NOW(), idAdministrator = :idAdministrator WHERE idBlogPost = :idBlogPost');

		$q->bindValue(':idBlogPost', $blogp->idBlogPost(), PDO::PARAM_INT);
		$q->bindValue(':title', $blogp->title(), PDO::PARAM_STR);
		$q->bindValue(':chapo', $blogp->chapo(), PDO::PARAM_STR);
		$q->bindValue(':content', $blogp->content(), PDO::PARAM_STR);
		$q->bindValue(':idAdministrator', $blogp->idAdministrator(), PDO::PARAM_INT);

		$q->execute();
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}