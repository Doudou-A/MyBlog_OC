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

			$controller = new Controller;
			$controller->administratorGetView();
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

		$blogp = new BlogPost([
		'title' => $_POST['title'],
		'chapo' =>  $_POST['chapo'],
		'content' =>  $_POST['content'],
		'image' =>  $name_file
		]);

		$manager->add($blogp);

		$controller = new Controller();
		$controller->blogPostGetView();
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

			$controller = new Controller;
			$controller->blogPostGetView();
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	public function blogPostFullView()
	{
		if (!empty($_GET['id'])) 
		{
			$manager = new BlogPostManager();
			$managerC = new CommentManager();

			$blogp = $manager->get($_GET['id']);

			$commentsBlogPost = $managerC->getCommentsBlogPost();

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
		
		$controller = new Controller;
		$controller->blogPostGetView();
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
			'pseudo' => $_POST['pseudo'],
			'content' =>  $_POST['content']
			]);

			$manager->add($com);
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}

		$controller = new Controller();
		$controller->blogPostAllView();
	}

	public function commentDelete()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new CommentManager();

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

			$controller = new Controller;
			$controller->commentGetView();
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
		$controller = new Controller;
		$controller->index();
		exit;
	}

	public function index()
	{
		require('view/indexView.php');
	}

	public function login()
	{

		$login = new AdministratorManager();

		$result = $login->connect();

		$isPasswordCorrect = password_verify($_POST['Password'], $result->password());

		if (!$result->email()) 
		{
			$error = true;
			$errorEmail = true;
			require('view/loginView.php');
		}
		else
		{
			if ($isPasswordCorrect) {
				session_start();
				$_SESSION['name'] = $result->name();
				$_SESSION['firstName'] = $result->firstName();

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

	public function loginView()
	{
		require('view/loginView.php');
	}
}