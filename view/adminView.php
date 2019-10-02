<?php $title = 'Administration'; ?>

<?php 
ob_start();
session_start();
$Name = htmlspecialchars($_SESSION['Name']);
$firstName = htmlspecialchars($_SESSION['firstName']);
 ?>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>