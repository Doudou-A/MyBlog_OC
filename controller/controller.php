<?php

class Controller
{
	public function index()
	{
		require('view/indexView.php');
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