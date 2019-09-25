<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
?>
<div class="col-lg-10">
	<h1>Gérer les Articles</h1>
	<div class="col-lg-12 d-flex blue-grey lighten-3">
		<div class="col-lg-1 border border-dark text-center font-weight-bold">Article N°</div>
		<div class="col-lg-2 border border-dark text-center font-weight-bold">Titre Article</div>
		<div class="col-lg-2 border border-dark text-center font-weight-bold">Résumé</div>
		<div class="col-lg-5 border border-dark text-center font-weight-bold">Contenu</div>
		<div class="col-lg-2 border border-dark text-center font-weight-bold">Action</div>
	</div>
	<?php
			while($getBlogPost = $blogp->fetch())
			{
	?>		
			<div class="col-lg-12 d-flex">
				<div class="col-lg-1 border border-dark text-center">
					<?=$getBlogPost['idBlogPost']?>		
				</div>
				<div class="col-lg-2 border border-dark text-center">
					<?=$getBlogPost['titleBlogPost']?>
				</div>
				<div class="col-lg-2 border border-dark text-truncate pl-2">
					<?=$getBlogPost['chapo']?>
				</div>
				<div class="col-lg-5 border border-dark text-truncate pl-2">
					<?=$getBlogPost['content']?>
				</div>
				<div class="col-lg-1 border border-dark text-center">
					<a href="index.php?action=blogPostUpdateView&amp;id=<?=$getBlogPost['idBlogPost']?>" >Modifier</a>
				</div>
				<div class="col-lg-1 border border-dark text-center">
					<a href="index.php?action=blogPostDelete&amp;id=<?=$getBlogPost['idBlogPost']?>" >Supprimer</a>
				</div>
			</div>
	<?php
			}
	?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>