<?php

spl_autoload_register(function ($class_name) {
    include 'model/' . $class_name . '.php';
});

require('PHPMailer-master/src/PHPMailer.php');
require("PHPMailer-master/src/SMTP.php");
require("PHPMailer-master/src/Exception.php");

class SecurityController
{	
	//Déconnexion
	public function destroy()
	{
		session_start();
		session_destroy();
		header("Location: index.php");
		exit;
	}

	//Page d'Accueil
	public function index()
	{
		require('view/indexView.php');
	}

	//Connexion
	public function login()
	{

		$login = new AdministratorManager();

		$getEmail = $login->getEmail($_POST['email']);

		if (!$getEmail) 
		{
			header("Location: Connexion-Error-1.html");
			exit;
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
				//Faille CRSF
   				$_SESSION['jeton'] = bin2hex(openssl_random_pseudo_bytes(6));

				require('view/adminView.php');

				return $administrator;
				return $isPasswordCorrect;
			}
			else 
			{
				header("Location: Connexion-Error-2.html");
				exit;
			}
		}
	}

	public function loginView()
	{
		require('view/loginView.php');
	}

	//Email
	public function sendMail(){

		$mail = new PHPMailer\PHPMailer\PHPMailer();

		$mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
		$mail->CharSet="UTF-8";
	    $mail->Host = "smtp.gmail.com";
	    $mail->SMTPDebug = 1; 
	    $mail->Port = 465 ; //465 or 587

	    $mail->SMTPSecure = 'ssl';  
	    $mail->SMTPAuth = true; 
	    $mail->IsHTML(true);

	    //Authentication
	    $mail->Username = "myblog.oc@gmail.com";
	    $mail->Password = "Password1.";

	    //Set Params
	    $mail->SetFrom("foo@gmail.com");
	    $mail->AddAddress("adeldoudou1996@gmail.com");
	    $mail->Subject = "MyBlogMail";
	    $mail->Body ="
	    HI :) </br> </br>
	    mail : ".$_POST['email']." </br> </br>
	    Name: ".$_POST['name']." </br> </br>
	    Firstname: ".$_POST['firstName']." </br> </br>
	    message : ".$_POST['message']."
	    ";

		if(!$mail->send()) {
		   echo 'Erreur, message non envoyé.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		   header("Location: MyBlog-Email-1.html");
		   exit;
		}
	}

}