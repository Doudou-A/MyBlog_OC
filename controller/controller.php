<?php
require('model/Administrator.php');
require('model/AdministratorManager.php');
require('model/BlogPostManager.php');
require('model/BlogPost.php');

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

	public function blogPostUpdateView()
	{
		require('model/Config.php');

		$manager = new BlogPostManager($db);

		$NumberId = $manager->getNumberId();

		$i = 1;
		$j = 1;

		while($i<=$NumberId)
		{
			$blogp[$j] = $manager->get($i);
			$i++;
			$j++;
		}
		
		require('view/blogPostUpdateView.php');
	}

	public function test(1)
	{
		require('view/blogPostDeleteView.php');
	}

	public function blogPostDeleteView()
	{
		require('view/blogPostDeleteView.php');
	}

	function formAddBlogPost()
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

	function formRegistration()
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

	function login()
	{
		require('model/Config.php');

		$login = new AdministratorManager($db);

		$result = $login->connect();

		$isPasswordCorrect = password_verify($_POST['Password'], $result['password']);

		if (!$result['email']) 
		{
			 echo 'error1';
			die();
		}
		else
		{
			if ($isPasswordCorrect) {
				session_start();
				$_SESSION['id'] = $result['id'];
				$_SESSION['email'] = htmlspecialchars($_POST['email']);

				require('view/adminView.php');

				return $result;
				return $isPasswordCorrect;
			}
			else 
			{
				//require('view/indexView.php');
				echo 'error 2';
				die();
			}
		}
	}
}