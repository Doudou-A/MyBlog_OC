<?php 

spl_autoload_register(function ($class_name) {
    include 'model/' . $class_name . '.php';
});

class AdministratorController
{
	public function administratorAddForm()
	{
		$manager = new AdministratorManager();

		$postEmail = $_POST['email'];

		$emailExist = $manager->emailExist($postEmail);

		if ($emailExist != 0) //Vérification si le pseudo existe
		{
			header("Location: Ajouter-un-Utilisateur-Error-1.html");
			exit;
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

			header("Location: Gérer-les-Utilisateurs.html");
			exit;
		}
		else
		{
			header("Location: Ajouter-un-Utilisateur-Error-2.html");
			exit;
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

			$id = $_GET['id'];

			$admin = $manager->get($id);

			$manager->delete($admin);

			header("Location: index.php?action=administratorGetView");
			exit;
		}
		else
		{
			header("Location: Gérer-les-Utilisateurs-Protection-1.html");
			exit;
		}
	}

	public function administratorGetView()
	{

		$manager = new AdministratorManager();

		$administrators = $manager->getAdministrators();
		
		require('view/administratorGetView.php');
	}

	//Tratier le formulaire de modification
	public function administratorUpdateForm()
	{	
		
		$manager = new AdministratorManager();
		$id = $_GET['id'];
		$administrator = $manager->get($id);

		if ($administrator->email() != $_POST['email']) {

			$postEmail = $_POST['email'];

			$emailExist = $manager->emailExist($postEmail);

			if ($emailExist != 0) //Vérification si le mail existe
			{
				header("Location: Modifier-Utilisateur-".$id."-Error-1.html");
				exit;
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

				header("Location: Gérer-les-Utilisateurs-Alert-1.html");
				exit;
			}
			else
			{
				header("Location: Modifier-Utilisateur-".$id."-Error-2.html");
				exit;
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

			header("Location: Gérer-les-Utilisateurs-Alert-2.html");
			exit;

		}
	}

	//Afficher les formulaires de modification d'un Utilisateur
	public function administratorUpdateView()
	{

		if (!empty($_GET['id'])) 
		{
			$manager = new AdministratorManager();
			$id = $GET_['id'];

			$admin = $manager->get($id);

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
}