<?php

spl_autoload_register(function ($class_name) {
    include 'model/' . $class_name . '.php';
});

class CommentController extends SecurityController
{
	public function commentAddForm()
	{
		if (!empty($_GET['id'])) 
		{
			$manager = new CommentManager();

			$com = new Comment([
			'idBlogPost' =>  $_GET['id'],
			'pseudo' => $_POST['pseudo'],
			'content' =>  $_POST['content'],
			]);

			$manager->add($com);

			header("Location: Tous-Les-Articles-Alert-1.html");
			exit;

		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function commentDelete()
	{
		session_start();

		if (!empty($_GET['id']) && !empty($_GET['jeton']) && !empty($_SESSION['jeton']) && ($_GET['jeton'] == $_SESSION['jeton'])) 
		{
			$manager = new CommentManager();

			$com = $manager->get($_GET['id']);

			$manager->delete($com);

			header("Location: Gérer-les-Commentaires.html");
			exit;
		}
		else
		{
			header("Location: Gérer-les-Commentaires-Protection-1.html");
			exit;
		}
	}

	public function commentFullToValid()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new CommentManager();

			$com = $manager->get($_GET['id']);

			$comId = $com->idComment();
			$comPseudo = $com->pseudo();
			$comContent = $com->content();

			require('view/commentToValidFullView.php');
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function commentFullValid()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new CommentManager();

			$com = $manager->get($_GET['id']);

			$comId = $com->idComment();
			$comPseudo = $com->pseudo();
			$comContent = $com->content();

			require('view/commentValidFullView.php');
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function commentGetView()
	{

		$manager = new CommentManager();

		$commentsToValid = $manager->getComToValid();

		$commentsValid = $manager->getComValid();
		
		require('view/commentGetView.php');
	}

	public function commentValid()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new CommentManager();

			$com = $manager->get($_GET['id']);
			$manager->update($com);

			header("Location: Gérer-les-Commentaires.html");
			exit;
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

}