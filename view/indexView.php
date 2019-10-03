<?php $title = 'My Blog'; ?>

<?php 
ob_start();
session_start(); ?>
<h1>MyBlog</h1>
<p>Doudou Adel</p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>