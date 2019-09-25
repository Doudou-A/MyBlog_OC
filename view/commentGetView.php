<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
?>
<div class="col-lg-10">
	<h1>Valider un Commentaire</h1>
	<h2>Commentaire à Valider</h2>
	<div class="col-lg-12 d-flex blue-grey lighten-3">
		<div class="col-lg-1 border border-dark text-center font-weight-bold">Article N°</div>
		<div class="col-lg-2 border border-dark text-center font-weight-bold">Titre Article</div>
		<div class="col-lg-1 border border-dark text-center font-weight-bold">Pseudo</div>
		<div class="col-lg-5 border border-dark text-center font-weight-bold">Contenu</div>
		<div class="col-lg-3 border border-dark text-center font-weight-bold">Action</div>
	</div>
	<?php
	while($getCom = $comToValid->fetch())
	{
	?>		
	<div class="col-lg-12 d-flex blue-grey lighten-5">
		<div class="col-lg-1 border border-dark text-center">
			<?=$getCom['idBlogPost']?>		
		</div>
		<div class="col-lg-2 border border-dark text-center">
			<?=$getCom['titleBlogPost']?>		
		</div>
		<div class="col-lg-1 border border-dark text-truncate pl-2">
			<?=$getCom['pseudo']?>
		</div>
		<div class="col-lg-5 border border-dark text-truncate pl-2">
			<?=$getCom['content']?>
		</div>
		<div class="col-lg-1 border border-dark text-center">
			<a href="index.php?action=commentFull&amp;id=<?=$getCom['idComment']?>" >Afficher</a>
		</div>
		<div class="col-lg-1 border border-dark text-center">
			<a href="index.php?action=commentUpdate&amp;id=<?=$getCom['idComment']?>" >Valider</a>
		</div>
		<div class="col-lg-1 border border-dark text-center">
			<a href="index.php?action=commentDelete&amp;id=<?=$getCom['idComment']?>" >Supprimer</a>
		</div>
	</div>
	<?php
	}
	?>
	<h2>Commentaire Valider</h2>
	<div class="col-lg-12 d-flex blue-grey lighten-3">
		<div class="col-lg-1 border border-dark text-center font-weight-bold">Article N°</div>
		<div class="col-lg-2 border border-dark text-center font-weight-bold">Titre Article</div>
		<div class="col-lg-1 border border-dark text-center font-weight-bold">Pseudo</div>
		<div class="col-lg-5 border border-dark text-center font-weight-bold">Contenu</div>
		<div class="col-lg-3 border border-dark text-center font-weight-bold">Action</div>
	</div>
	<?php
	while($getCom = $comValid->fetch())
	{
	?>		
	<div class="col-lg-12 d-flex blue-grey lighten-5">
		<div class="col-lg-1 border border-dark text-center">
			<?=$getCom['idBlogPost']?>		
		</div>
		<div class="col-lg-2 border border-dark text-center">
			<?=$getCom['titleBlogPost']?>		
		</div>
		<div class="col-lg-1 border border-dark text-truncate pl-2">
			<?=$getCom['pseudo']?>
		</div>
		<div class="col-lg-5 border border-dark text-truncate pl-2">
			<?=$getCom['content']?>
		</div>
		<div class="col-lg-1-5 border border-dark text-center">
			<a href="index.php?action=commentFull&amp;id=<?=$getCom['idComment']?>" >Afficher</a>
		</div>
		<div class="col-lg-1-5 border border-dark text-center">
			<a href="index.php?action=commentDelete&amp;id=<?=$getCom['idComment']?>" >Supprimer</a>
		</div>
	</div>
	<?php
			}
	?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>