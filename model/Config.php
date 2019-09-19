<?php

Class DbConfig{
	public static function dbConnect()
	{
		return new PDO('mysql:host=localhost;dbname=MyBlog;charset=utf8', 'root', 'root');
	}
}
