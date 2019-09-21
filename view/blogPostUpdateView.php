<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
?>

<h1>Modifier un Blog Post</h1>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>