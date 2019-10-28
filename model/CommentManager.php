<?php


require_once('Config.php');
require('Comment.php');
//use App\Entity\Comment;

class CommentManager
{
	private $_db;

	public function __construct()
	{
		$this->setDb(DbConfig::dbConnect());
	}

	public function add(Comment $com)
	{
		$valid = false;

		$q = $this->_db->prepare('INSERT INTO Comment(pseudo, dateCreated, content, valid, idBlogPost) VALUES (:pseudo, NOW(), :content, '.((int) $valid).' , :idBlogPost)');
		
		$q->bindValue(':pseudo', $com->pseudo(), PDO::PARAM_STR);
		$q->bindValue(':content', $com->content(), PDO::PARAM_STR);
		$q->bindValue(':idBlogPost', $com->idBlogPost(), PDO::PARAM_INT);

		$q->execute();
	}

	public function delete(Comment $com)
	{
		$q = $this->_db->prepare('DELETE FROM Comment WHERE idComment = :idComment');

		$q->bindValue(':idComment', $com->idComment(), PDO::PARAM_INT);

		$q->execute();

	}

	
	/*public function deleteIdBlogPost(Comment $com)
	{
		$this->_db->exec('DELETE FROM Comment WHERE idBlogPost = '.$com);
	}*/

	public function get($id)
	{
		$id = (int) $id;
		$q = $this->_db->prepare('SELECT idComment, pseudo, content, valid FROM Comment WHERE idComment = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();

		$data = $q->fetch(PDO::FETCH_ASSOC);

		return new Comment($data);
	}

	//Récupérer les commentaires d'un article
	public function getCommentsBlogPost($id)
	{
		$valid = true;

		$commentspublish=[];

		$q = $this->_db->prepare('SELECT * FROM Comment WHERE valid ='.((int) $valid).' AND idBlogPost = :id ');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$data = $q->fetchAll(\PDO::FETCH_ASSOC);

		for ($i=0; $i< count($data); $i++) 
		{ 
			$commentpublish = new Comment($data[$i]);
			array_push($commentspublish, $commentpublish); 
		} 

		return $commentspublish;
	}

	//Récupérer les commentaires valides
	public function getComValid()
	{
		$comspublish=[];
		$BlogPost = new BlogPostManager;

		$q = $this->_db->query('SELECT * FROM Comment WHERE valid = 1');
		$data = $q->fetchAll(\PDO::FETCH_ASSOC);

		for ($i=0; $i< count($data); $i++) 
		{ 
			$compublish = new Comment($data[$i]);	
			$compublish->setIdBlogPost($BlogPost->get($data[$i]["idBlogPost"]));
			array_push($comspublish, $compublish); 

		} 

		return $comspublish;
	}

	//Récupérer les commentaires à valider
	public function getComToValid()
	{
		$comspublish = [];
		$BlogPost = new BlogPostManager;

		$q = $this->_db->query('SELECT * FROM Comment WHERE valid = 0');
		$data = $q->fetchAll(\PDO::FETCH_ASSOC);

		for ($i=0; $i< count($data); $i++) 
		{ 
			$compublish = new Comment($data[$i]);
			$compublish->setIdBlogPost($BlogPost->get($data[$i]["idBlogPost"]));
			array_push($comspublish, $compublish); 
		} 

		return $comspublish;
	}
	
	/*public function getList()
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
		$this->_db->exec('UPDATE Comment SET valid = 1 WHERE idComment ='.$com->idComment());
	}*/

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

}