<?php
require('model/Administrator.php');
require('model/AdministratorManager.php');
require('model/BlogPostManager.php');
require('model/BlogPost.php');
require('model/CommentManager.php');
require('model/Comment.php');

class Controller
{	
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

	public function blogPostAddView()
	{
		require('view/blogPostAddView.php');
	}

	public function blogPostGetView()
	{
		require('model/Config.php');

		$manager = new BlogPostManager($db);

		$allBlogPost = $manager->getAll();

		$i = 1;
		$j = 1;

		while($data = $allBlogPost->fetch())
		{
			$blogp[$j] = $manager->get($i);
			$i++;
			$j++;
		}
		
		require('view/blogPostGetView.php');
	}

	public function blogPostUpdateView()
	{
		require('model/Config.php');

		if (!empty($_GET['actions'])) 
		{
			$k = $_GET['actions'];

			$manager = new BlogPostManager($db);

			$blogp = $manager->get($k);

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
		require('model/Config.php');

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
		require('model/Config.php');

		if (!empty($_GET['actions'])) 
		{
			
			$k = $_GET['actions'];

			$manager = new BlogPostManager($db);

			$blogp = $manager->get($k);

			$manager->delete($blogp);

			echo "ok";
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function formAddBlogPost()
	{

		require('model/Config.php');

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
		require('model/Config.php');

		$manager = new CommentManager($db);

		$comToValid = $manager->getComToValid();
		
		require('view/commentGetView.php');
	}


	public function commentUpdate()
	{
		require('model/Config.php');

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

	public function formRegistration()
	{
		require('model/Config.php');

		$manager = new AdministratorManager($db);

		$admin = new Administrator([
		'email' => $_POST['email'],
		'name' =>  $_POST['name'],
		'firstName' =>  $_POST['firstName'],
		'password' =>  $_POST['password'],
		]);

		$manager->add($admin);
	}

	public function login()
	{
		require('model/Config.php');

		$login = new AdministratorManager($db);

		$result = $login->connect();

		$isPasswordCorrect = password_verify($_POST['Password'], $result['password']);

		if (!$result['email']) 
		{
			throw new Exception("Error Processing Request");
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
				throw new Exception("Error Processing Request");
			}
		}
	}
}