<?php

spl_autoload_register(function ($class_name) {
    include 'model/' . $class_name . '.php';
});

class BlogPostController extends SecurityController
{

	public function blogPostAddForm()
	{

		$content_dir = 'public/upload/';

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

		header("Location: Gérer-les-Articles.html");
		exit;

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
		session_start();

		if (!empty($_GET['id']) && !empty($_GET['jeton']) && !empty($_SESSION['jeton']) && ($_GET['jeton'] == $_SESSION['jeton'])) 
		{
			$manager = new BlogPostManager();

			$id = $_GET['id'];

			$blogp = $manager->get($id);

			$manager->delete($blogp);

			header("Location: Gérer-les-Articles.html");
			exit;
		}
		else
		{
			header("Location: Gérer-les-Articles-Protection-1.html");
			exit;
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

			$blogp = $manager->getFull($_GET['idBlogPost']);

			$commentsBlogPost = $managerC->getCommentsBlogPost($blogp->idBlogPost());

			require('view/blogPostFullView.php');
		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}

	//Afficher tous les articles dans l'espace administrateur
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
		'content' =>  $_POST['content'],
		'idAdministrator' => $_POST['Administrator']
		]);

		$manager->update($blogp);
		
		header("Location: Gérer-les-Articles.html");
		exit;
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

			$managerA = new AdministratorManager();

			$admin = $managerA->get($blogp->idAdministrator());

			$administrators = $managerA->getAdministrators();

			require('view/blogPostUpdateView.php');

		}
		else
		{
			throw new Exeption("Error Processing Request");
		}
	}
}