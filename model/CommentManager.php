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

		$query = $this->_db->prepare('INSERT INTO Comment(pseudo, dateCreated, content, valid, idBlogPost) VALUES (:pseudo, NOW(), :content, '.((int) $valid).' , :idBlogPost)');
		
		$query->bindValue(':pseudo', $com->pseudo(), PDO::PARAM_STR);
		$query->bindValue(':content', $com->content(), PDO::PARAM_STR);
		$query->bindValue(':idBlogPost', $com->idBlogPost(), PDO::PARAM_INT);

		$query->execute();
	}

	public function delete(Comment $com)
	{
		$query = $this->_db->prepare('DELETE FROM Comment WHERE idComment = :idComment');

		$query->bindValue(':idComment', $com->idComment(), PDO::PARAM_INT);

		$query->execute();

	}

	
	/*public function deleteIdBlogPost(Comment $com)
	{
		$this->_db->exec('DELETE FROM Comment WHERE idBlogPost = '.$com);
	}*/

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare('SELECT idComment, pseudo, content, valid FROM Comment WHERE idComment = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();

		$data = $query->fetch(PDO::FETCH_ASSOC);

		return new Comment($data);
	}

	//Récupérer les commentaires d'un article
	public function getCommentsBlogPost($id)
	{
		$valid = true;

		$commentspublish=[];

		$query = $this->_db->prepare('SELECT * FROM Comment WHERE valid ='.((int) $valid).' AND idBlogPost = :id ');
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetchAll(\PDO::FETCH_ASSOC);

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

		$query = $this->_db->query('SELECT * FROM Comment WHERE valid = 1');
		$data = $query->fetchAll(\PDO::FETCH_ASSOC);

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

		$query = $this->_db->query('SELECT * FROM Comment WHERE valid = 0');
		$data = $query->fetchAll(\PDO::FETCH_ASSOC);

		for ($i=0; $i< count($data); $i++) 
		{ 
			$compublish = new Comment($data[$i]);
			$compublish->setIdBlogPost($BlogPost->get($data[$i]["idBlogPost"]));
			array_push($comspublish, $compublish); 
		} 

		return $comspublish;
	}

	public function update(Comment $com)
	{
		$this->_db->exec('UPDATE Comment SET valid = 1 WHERE idComment ='.$com->idComment());
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

}