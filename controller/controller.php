<?php
require('model/Administrator.php');
require('model/AdministratorManager.php');
require('model/BlogPostManager.php');
require('model/BlogPost.php');
require('model/CommentManager.php');
require('model/Comment.php');


class Controller
{	
	public function administratorAddForm()
	{
		$manager = new AdministratorManager();

		$emailExist = $manager->emailExist($_POST['email']);

		if ($emailExist != 0) //Vérification si le pseudo existe
		{
			header("Location : index.php?action=administratorAddView&error=1");
			die();
		}
		elseif($_POST['password'] == $_POST['passwordConfirm'])
		{

			$admin = new Administrator([
			'email' => $_POST['email'],
			'name' =>  $_POST['name'],
			'firstName' =>  $_POST['firstName'],
			'password' =>  $_POST['password'],
			]);

			$manager->add($admin);

			$controller = new Controller;
			$controller->administratorGetView();
		}
		else
		{
			header("Location : index.php?action=administratorAddView&error=2");
			die();
		}
	}

	public function administratorAddView()
	{
		require('view/AdministratorAddView.php');
	}

	public function administratorDelete()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new AdministratorManager();

			$admin = $manager->get($_GET['id']);

			$manager->delete($admin);

			header("Location : index.php?action=administratorGetView");
			die();
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function administratorGetView()
	{

		$manager = new AdministratorManager();

		$administrators = $manager->getAdministrators();
		
		require('view/administratorGetView.php');
	}

	public function administratorUpdateForm()
	{	
		
		$manager = new AdministratorManager();
		$administrator = $manager->get($_GET['id']);

		if ($administrator->email() != $_POST['email']) {

			$emailExist = $manager->emailExist($_POST['email']);

			if ($emailExist != 0) //Vérification si le mail existe
			{
				header("Location : index.php?action=administratorUpdateView&id=".$_GET['id']."&error=1");
				die();
			}
		}
		if(!empty($_POST['password']))
		{

			if($_POST['password'] == $_POST['passwordConfirm'])
			{

				$admin = new Administrator([
				'idAdministrator' => $_GET['id'],
				'email' => $_POST['email'],
				'name' =>  $_POST['name'],
				'firstName' =>  $_POST['firstName'],
				'password' =>  $_POST['password'],
				]);

				$manager->update($admin);

				header("Location : index.php?action=administratorGetView&alert=1");
				die();
			}
			else
			{
				header("Location : index.php?action=administratorUpdateView&id=".$_GET['id']."&error=2");
				die();
			}
		}
		else
		{
			$admin = new Administrator([
			'idAdministrator' => $_GET['id'],
			'email' => $_POST['email'],
			'name' =>  $_POST['name'],
			'firstName' =>  $_POST['firstName'],
			]);

			$manager->updateNoPassword($admin);

			header("Location : index.php?action=administratorGetView&alert=2");
			die();

		}
	}

	public function administratorUpdateView()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new AdministratorManager();

			$admin = $manager->get($_GET['id']);

			$updateId = $admin->idAdministrator();
			$updateEmail = $admin->email();
			$updateName = $admin->name();
			$updateFirstName = $admin->firstName();

			require('view/AdministratorUpdateView.php');

		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function adminView()
	{
		require('view/adminView.php');
	}

	public function blogPostAddForm()
	{

		$content_dir = 'upload/';

	    $tmp_file = $_FILES['image']['tmp_name'];

	    if( !is_uploaded_file($tmp_file) )
	    {
	    	throw new Exception("Le image est introuvable", 1);
	    }

	    // on copie le image dans le dossier de destination
	    $name_file = $_FILES['image']['name'];

	    if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) )
		{
			throw new Exception("Nom de image non valide", 1);
		}
		else if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
		{
			throw new Exception("Impossible de copier le image dans $content_dir", 1);
		}

		$manager = new BlogPostManager();
		$idAdministrator = $_GET['id'];

		$blogp = new BlogPost([
		'title' => $_POST['title'],
		'chapo' =>  $_POST['chapo'],
		'content' =>  $_POST['content'],
		'image' =>  $name_file,
		'idAdministrator' => $idAdministrator
		]);

		$manager->add($blogp);

		header("Location : index.php?action=blogPostGetView");
		die();

	}
	
	public function blogPostAddView()
	{
		require('view/blogPostAddView.php');
	}

	public function blogPostAllView()
	{
		$manager = new BlogPostManager();

		$blogposts = $manager->getBlogPosts();

		require('view/blogPostAllView.php');
	}

	public function blogPostDelete()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new BlogPostManager();

			$blogp = $manager->get($_GET['id']);

			$manager->delete($blogp);

			header("Location : index.php?action=blogPostGetView");
			die();
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function blogPostFullView()
	{
		if (!empty($_GET['idBlogPost'])) 
		{

			if (!empty($_GET['idSession']))
			{
				$managerA = new AdministratorManager();

				$commentAdmin = $managerA->get($_GET['idSession']);
				
			}
			$manager = new BlogPostManager();
			$managerC = new CommentManager();

			$blogp = $manager->get($_GET['idBlogPost']);

			$commentsBlogPost = $managerC->getCommentsBlogPost($blogp->idBlogPost());

			require('view/blogPostFullView.php');
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function blogPostGetView()
	{

		$manager = new BlogPostManager();

		$blogposts = $manager->getBlogPosts();

		require('view/blogPostGetView.php');
	}

	public function blogPostUpdateForm()
	{

		$manager = new BlogPostManager();

		$blogp = new BlogPost([
		'idBlogPost' => $_POST['idBlogPost'],
		'title' => $_POST['title'],
		'chapo' =>  $_POST['chapo'],
		'content' =>  $_POST['content']
		]);

		$manager->update($blogp);
		
		header("Location : index.php?action=blogPostGetView");
		die();
	}

	public function blogPostUpdateView()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new BlogPostManager();

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

	public function commentAddForm()
	{
		if (!empty($_GET['id'])) 
		{
			$manager = new CommentManager();

			$com = new Comment([
			'idBlogPost' =>  $_GET['id'],
			'pseudo' => $_POST['pseudo'],
			'content' =>  $_POST['content']
			]);

			$manager->add($com);

			header("Location : index.php?action=blogPostAllView&alert=1");
			die();

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
			$manager = new CommentManager();

			$com = $manager->get($_GET['id']);

			$manager->delete($com);

			header("Location : index.php?action=commentGetView");
			die();
		}
		else
		{
			throw new Exeption("Error Processing Request");
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

			header("Location : index.php?action=commentGetView");
			die();
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function destroy()
	{
		session_start();
		session_destroy();
		header("Location : index.php");
		exit;
	}

	public function index()
	{
		require('view/indexView.php');
	}

	public function login()
	{

		$login = new AdministratorManager();

		$getEmail = $login->getEmail($_POST['email']);

		if (!$getEmail) 
		{
			header("Location : index.php?action=loginView&error=1");
		}
		else
		{

			$administrator = $login->connect($_POST['email']);

			$isPasswordCorrect = password_verify($_POST['Password'], $administrator->password());

			if ($isPasswordCorrect) {
				session_start();
				$_SESSION['name'] = $administrator->name();
				$_SESSION['firstName'] = $administrator->firstName();	
				$_SESSION['id'] = $administrator->idAdministrator();

				$controller = new Controller;
				$controller->adminView();

				return $administrator;
				return $isPasswordCorrect;
			}
			else 
			{
				header("Location : index.php?action=loginView&error=2");
			}
		}
	}

	public function loginView()
	{
		require('view/loginView.php');
	}
}