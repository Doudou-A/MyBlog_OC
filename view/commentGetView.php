<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
?>
<div class="col-10 p-5 grey lighten-3">
	<h2 class="border-bottom">Valider un Commentaire</h2>
	<h3 class="mt-5 font-weight-normal">Commentaire à Valider</h3>
	<div class="col-lg-12 d-flex green text-white mt-3">
		<div class="col-lg-1 border border-white text-center font-weight-bold">Article N°</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold">Titre Article</div>
		<div class="col-lg-1 border border-white text-center font-weight-bold">Pseudo</div>
		<div class="col-lg-5 border border-white text-center font-weight-bold">Contenu</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold">Action</div>
	</div>
	<?php
	foreach ($commentsToValid as $key => $commentToValid) 
	{
	?>		
	<div class="col-lg-12 d-flex">
		<div class="col-lg-1 border border-white text-center">
			<?=$commentToValid->idComment();?>		
		</div>
		<div class="col-lg-2 border border-white text-center">

		</div>
		<div class="col-lg-1 border border-white text-truncate pl-2">
			<?=$commentToValid->pseudo();?>	
		</div>
		<div class="col-lg-5 border border-white text-truncate pl-2">
			<?=$commentToValid->content();?>
		</div>
		<div class="col-lg-1 border border-white text-center">
			<a href="index.php?action=commentFullToValid&amp;id=<?=$commentToValid->idComment();?>" >Afficher</a>
		</div>
		<div class="col-lg-1 border border-white text-center">
			<a class="text-success" href="index.php?action=commentValid&amp;id=<?=$commentToValid->idComment();?>" >Valider</a>
		</div>
		<div class="col-lg-1 border border-white text-center">
			<a class="text-danger" href="index.php?action=commentDelete&amp;id=<?=$commentToValid->idComment();?>" >Supprimer</a>
		</div>
	</div>
	<?php
	}
	?>
	<h3 class="mt-5 font-weight-normal">Commentaire Valider</h3>
	<div class="col-lg-12 d-flex green text-white mt-3">
		<div class="col-lg-1 border border-white text-center font-weight-bold">Article N°</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold">Titre Article</div>
		<div class="col-lg-1 border border-white text-center font-weight-bold">Pseudo</div>
		<div class="col-lg-5 border border-white text-center font-weight-bold">Contenu</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold">Action</div>
	</div>
	<?php
	foreach ($commentsValid as $key => $commentValid)
	{
	?>		
	<div class="col-lg-12 d-flex">
		<div class="col-lg-1 border border-white text-center">
			<?=$commentValid->idComment();?>	
		</div>
		<div class="col-lg-2 border border-white text-center">	

		</div>
		<div class="col-lg-1 border border-white text-truncate pl-2">
			<?=$commentValid->pseudo();?>
		</div>
		<div class="col-lg-5 border border-white text-truncate pl-2">
			<?=$commentValid->content();?>
		</div>
		<div class="col-lg-1-5 border border-white text-center">
			<a href="index.php?action=commentFullValid&amp;id=<?=$commentValid->idComment();?>" >Afficher</a>
		</div>
		<div class="col-lg-1-5 border border-white text-center">
			<a class="text-danger" href="index.php?action=commentDelete&amp;id=<?=$commentValid->idComment();?>" >Supprimer</a>
		</div>
	</div>
	<?php
			}
	?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>