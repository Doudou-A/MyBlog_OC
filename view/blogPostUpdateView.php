<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
?>

<h1>Modifier un Blog Post</h1>
<?php
		$k = 1;
		while($k<=$NumberId)
		{
?>		
		<div class="col-lg-12 d-flex">
			<div class="col-lg-3">
<?php 
				echo $blogp[$k]->idBlogPost();
?>		
			</div>
			<div class="col-lg-3">
<?php 
				echo $blogp[$k]->title();
?>		
			</div>
			<div class="col-lg-3">
<?php 
				echo $blogp[$k]->chapo();
?>		
			</div>
			<div class="col-lg-3">
<?php 
				echo $blogp[$k]->content();
?>		
			</div>
			<div class="col-lg-3">
				<a href="">
			</div>
		</div>
<?php
			$k++;
?>
</br>
<?php
		}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>