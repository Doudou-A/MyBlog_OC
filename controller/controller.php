<?php

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

		$login->connect();
	}
}
/*
function index()
{
	require('view/indexView.php');
}

function formLogin()
{
	$formLogin = getForm();

}

require('model/registrationModel.php');

function formRegistration()
{
	$formRegistration = registration();
}

function registrationView()
{
	require('view/registrationView.php');
}*/