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
			header("Location : Ajouter-un-Utilisateur-Error-1.html");
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

			header("Location : Gérer-les-Utilisateurs.html");
			die();
		}
		else
		{
			header("Location : Ajouter-un-Utilisateur-Error-2.html");
			die();
		}
	}

	public function administratorAddView()
	{
		require('view/AdministratorAddView.php');
	}

	public function administratorDelete()
	{

		session_start();
		if (!empty($_GET['id']) && !empty($_GET['jeton']) && !empty($_SESSION['jeton']) && ($_GET['jeton'] == $_SESSION['jeton'])) 
		{
			$manager = new AdministratorManager();

			$admin = $manager->get($_GET['id']);

			$manager->delete($admin);

			header("Location : index.php?action=administratorGetView");
			die();
		}
		else
		{
			header("Location : Gérer-les-Utilisateurs-Protection-1.html");
			die();
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
				header("Location : Modifier-Utilisateur-".$_GET['id']."-Error-1.html");
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

				header("Location : Gérer-les-Utilisateurs-Alert-1.html");
				die();
			}
			else
			{
				header("Location : Modifier-Utilisateur-".$_GET['id']."-Error-2.html");
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

			header("Location : Gérer-les-Utilisateurs-Alert-2.html");
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

		header("Location : Gérer-les-Articles.html");
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
		session_start();

		if (!empty($_GET['id']) && !empty($_GET['jeton']) && !empty($_SESSION['jeton']) && ($_GET['jeton'] == $_SESSION['jeton'])) 
		{
			$manager = new BlogPostManager();

			$blogp = $manager->get($_GET['id']);

			$manager->delete($blogp);

			header("Location : Gérer-les-Articles.html");
			die();
		}
		else
		{
			header("Location : Gérer-les-Articles-Protection-1.html");
			die();
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
		'content' =>  $_POST['content'],
		'idAdministrator' => $_POST['Administrator']
		]);

		$manager->update($blogp);
		
		header("Location : Gérer-les-Articles.html");
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

			header("Location : Tous-Les-Articles-Alert-1.html");
			die();

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

			header("Location : Gérer-les-Commentaires.html");
			die();
		}
		else
		{
			header("Location : Gérer-les-Commentaires-Protection-1.html");
			die();
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

			header("Location : Gérer-les-Commentaires.html");
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

	public function sendMail(){
		$dest = "adeldoudou1996@gmail.com";
		$sujet = "formulaire";
		$message = $_POST['message'];

		mail($dest, $sujet, $message);

		header("Location : index.php?action=index&alert=1");
		die();

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
			header("Location : Connexion-Error-1.html");
		}
		else
		{

			$administrator = $login->connect($_POST['email']);

			$isPasswordCorrect = password_verify($_POST['Password'], $administrator->password());

			if ($isPasswordCorrect) {
				unset($_SESSION['jeton']);
				session_start();
				$_SESSION['name'] = htmlspecialchars($administrator->name());
				$_SESSION['firstName'] = htmlspecialchars($administrator->firstName());	
				$_SESSION['id'] = $administrator->idAdministrator();
   				$_SESSION['jeton'] = bin2hex(openssl_random_pseudo_bytes(6));

				$controller = new Controller;
				$controller->adminView();

				return $administrator;
				return $isPasswordCorrect;
			}
			else 
			{
				header("Location : Connexion-Error-2.html");
			}
		}
	}

	public function loginView()
	{
		require('view/loginView.php');
	}
}