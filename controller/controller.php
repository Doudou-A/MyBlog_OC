<?php
require('model/Administrator.php');
require('model/AdministratorManager.php');
require('model/BlogPostManager.php');
require('model/BlogPost.php');
require('model/CommentManager.php');
require('model/Comment.php');


class Controller
{	
	private $db;
	
	public function index()
	{
		require('view/indexView.php');
	}

	public function registrationView()
	{
		require('view/registrationView.php');
	}

	public function loginView()
	{
		require('view/loginView.php');
	}

	public function login()
	{

		$login = new AdministratorManager($db);

		$result = $login->connect();

		$isPasswordCorrect = password_verify($_POST['Password'], $result['password']);

		if (!$result['email']) 
		{
			$error = true;
			$errorEmail = true;
			require('view/loginView.php');
		}
		else
		{
			if ($isPasswordCorrect) {
				session_start();
				$_SESSION['email'] = htmlspecialchars($_POST['email']);

				require('view/adminView.php');

				return $result;
				return $isPasswordCorrect;
			}
			else 
			{
				$error = true;
				$errorPassword = true;
				require('view/loginView.php');
			}
		}
	}

	public function blogPostAddView()
	{
		require('view/blogPostAddView.php');
	}

	public function blogPostGetView()
	{

		$manager = new BlogPostManager($db);

		$blogp = $manager->getBlogPost();
		
		require('view/blogPostGetView.php');
	}

	public function blogPostUpdateView()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new BlogPostManager($db);

			$blogp = $manager->get($_GET['id']);

			$updateId = $blogp->idBlogPost();
			$updateTitle = $blogp->title();
			$updateChapo = $blogp->chapo();
			$updateContent = $blogp->content();

			require('view/blogPostUpdateView.php');

		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function formUpdateBlogPost()
	{

		$manager = new BlogPostManager($db);

		$blogp = new BlogPost([
		'idBlogPost' => $_POST['idBlogPost'],
		'title' => $_POST['title'],
		'chapo' =>  $_POST['chapo'],
		'content' =>  $_POST['content']
		]);

		$manager->update($blogp);
		
		$controller = new Controller;
		$controller->blogPostGetView();
	}

	public function blogPostDelete()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new BlogPostManager($db);

			$blogp = $manager->get($_GET['id']);

			$manager->delete($blogp);

			$controller = new Controller;
			$controller->blogPostGetView();
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function formAddBlogPost()
	{

		$manager = new BlogPostManager($db);

		$blogp = new BlogPost([
		'title' => $_POST['title'],
		'chapo' =>  $_POST['chapo'],
		'content' =>  $_POST['content']
		]);

		$manager->add($blogp);

		echo "Ajout du BP effectué";
	}

	public function commentGetView()
	{

		$manager = new CommentManager($db);

		$comToValid = $manager->getComToValid();

		$comValid = $manager->getComValid();
		
		require('view/commentGetView.php');
	}

	public function commentFull()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new CommentManager($db);

			$com = $manager->get($_GET['id']);

			$comId = $com->idComment();
			$comPseudo = $com->pseudo();
			$comContent = $com->content();

			require('view/commentFullView.php');
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}


	public function commentUpdate()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new CommentManager($db);

			$com = $manager->get($_GET['id']);
			$manager->update($com);

			$controller = new Controller;
			$controller->commentGetView();
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function commentDelete()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new CommentManager($db);

			$com = $manager->get($_GET['id']);

			$manager->delete($com);

			$controller = new Controller;
			$controller->commentGetView();
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function formRegistration()
	{

		$manager = new AdministratorManager($db);

		$admin = new Administrator([
		'email' => $_POST['email'],
		'name' =>  $_POST['name'],
		'firstName' =>  $_POST['firstName'],
		'password' =>  $_POST['password'],
		]);

		$manager->add($admin);
	}
}