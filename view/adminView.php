<?php $title = 'Administration'; ?>

<?php 
ob_start();
session_start();
 ?>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>