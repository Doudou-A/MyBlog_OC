<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
?>

<h1>Modifier un Blog Post</h1>
<?php
		while($getBlogPost = $blogp->fetch())
		{
?>		
		<div class="col-lg-12 d-flex">
			<div class="col-lg-2">
				<?=$getBlogPost['idBlogPost']?>		
			</div>
			<div class="col-lg-2">
				<?=$getBlogPost['title']?>
			</div>
			<div class="col-lg-2">
				<?=$getBlogPost['chapo']?>
			</div>
			<div class="col-lg-2">
				<?=$getBlogPost['content']?>
			</div>
			<div class="col-lg-1">
				<a href="index.php?action=blogPostUpdateView&amp;id=<?=$getBlogPost['idBlogPost']?>" >Modifier ce Blog Post</a>
			</div>
			<div class="col-lg-2">
				<a href="index.php?action=blogPostDelete&amp;id=<?=$getBlogPost['idBlogPost']?>" >Supprimer ce Blog Post</a>
			</div>
		</div>
</br>
<?php
		}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>