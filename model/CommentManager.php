<?php

require_once('Config.php');

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
		$this->_db->exec('DELETE FROM Comment WHERE idComment = '.$com->idComment());
	}

	
	public function deleteIdBlogPost(Comment $com)
	{
		$this->_db->exec('DELETE FROM Comment WHERE idBlogPost = '.$com);
	}

	public function get($id)
	{
		$id = (int) $id;
		$q = $this->_db->query('SELECT idComment, pseudo, content, valid FROM Comment WHERE idComment ='.$id);
		$data = $q->fetch(PDO::FETCH_ASSOC);

		return new Comment($data);
	}

	public function getCommentsBlogPost($id)
	{
		$valid = true;

		$commentspublish=[];

		$q = $this->_db->query('SELECT * FROM Comment WHERE valid ='.((int) $valid).' AND idBlogPost = '.$id);
		$data = $q->fetchAll(\PDO::FETCH_ASSOC);

		for ($i=0; $i< count($data); $i++) 
		{ 
			$commentpublish = new Comment($data[$i]);
			array_push($commentspublish, $commentpublish); 
		} 

		return $commentspublish;
	}

	/*public function getInvalid($id)
	{
		$id = (int) $id;

		$q = $this->_db->query('SELECT idComment, pseudo, content, valid FROM Comment WHERE idComment ='.$id);
		$data = $q->fetch(PDO::FETCH_ASSOC);

		return new Comment($data);
	}*/


	public function getComValid()
	{
		$comspublish=[];
		$idBlogPost= new BlogPostManager;

		$q = $this->_db->query('SELECT * FROM Comment WHERE valid = 1');
		$data = $q->fetchAll(\PDO::FETCH_ASSOC);

		for ($i=0; $i< count($data); $i++) 
		{ 
			$compublish = new Comment($data[$i]);
			$compublish->idBlogPost($idBlogPost->get($data[$i]["idBlogPost"]));
			var_dump($idBlogPost);
			array_push($comspublish, $compublish); 
		} 

		return $comspublish;
	}

	public function getComToValid()
	{
		$comspublish=[];
		$idBlogPost= new BlogPostManager;

		$q = $this->_db->query('SELECT idComment, pseudo, content, valid FROM Comment WHERE valid = 0');
		$data = $q->fetchAll(\PDO::FETCH_ASSOC);

		for ($i=0; $i< count($data); $i++) 
		{ 
			$compublish = new Comment($data[$i]);
			$compublish->idBlogPost($idBlogPost->get($data[$i]["idBlogPost"]));
			var_dump($compublish);
			array_push($comspublish, $compublish); 
		} 

		return $comspublish;
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
		$this->_db->exec('UPDATE Comment SET valid = 1 WHERE idComment ='.$com->idComment());
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

}