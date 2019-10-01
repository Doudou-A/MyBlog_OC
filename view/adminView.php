<?php $title = 'Administration'; ?>

<?php 
ob_start();
session_start();
$_SESSION['firstName'];
$_SESSION['name'];
 ?>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>