<?php

private $db;

function dbConnect()
{
	$db = new PDO('mysql:host=localhost;dbname=poo;charset=utf8', 'root', 'root');
	return $db;
}