<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
?>
<div class="col-lg-10 p-5 grey lighten-3">
	<h1 class="border-bottom">Gérer les Articles</h1>
	<div class="col-lg-12 d-flex green text-white mt-3">
		<div class="col-lg-1 border border-white text-center font-weight-bold">Article N°</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold">Titre Article</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold">Résumé</div>
		<div class="col-lg-5 border border-white text-center font-weight-bold">Contenu</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold">Action</div>
	</div>
	<?php
			foreach ($blogposts as $key => $blogpost) {
	?>		
			<div class="col-lg-12 d-flex">
				<div class="col-lg-1 border border-white text-center">
					<?=$blogpost->idBlogPost();?>	
				</div>
				<div class="col-lg-2 border border-white text-center">
					<?=$blogpost->title();?>
				</div>
				<div class="col-lg-2 border border-white text-truncate pl-2">
					<?=$blogpost->chapo();?>
				</div>
				<div class="col-lg-5 border border-white text-truncate pl-2">
					<?=$blogpost->content();?>
				</div>
				<div class="col-lg-1 border border-white text-center">
					<a href="index.php?action=blogPostUpdateView&amp;id=<?=$blogpost->idBlogPost();?>" >Modifier</a>
				</div>
				<div class="col-lg-1 border border-white text-center">
					<a class="text-danger" href="index.php?action=blogPostDelete&amp;id=<?=$blogpost->idBlogPost();?>" >Supprimer</a>
				</div>
			</div>
	<?php
			}
	?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>