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
			<div class="col-lg-2">
				<?=$blogp[$k]->idBlogPost();?>		
			</div>
			<div class="col-lg-2">
				<?=$blogp[$k]->title();?>
			</div>
			<div class="col-lg-2">
				<?=$blogp[$k]->chapo();?>
			</div>
			<div class="col-lg-2"> 
				<?=$blogp[$k]->content();?>	
			</div>
			<div class="col-lg-1">
				<a href="index.php?action=blogPostUpdateView&amp;actions=<?=$blogp[$k]->idBlogPost();?>" >Modifier ce Blog Post</a>
			</div>
			<div class="col-lg-2">
				<a href="index.php?action=blogPostDelete&amp;actions=<?=$blogp[$k]->idBlogPost();?>" >Supprimer ce Blog Post</a>
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