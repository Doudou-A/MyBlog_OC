<?php $title = 'MyBlog'; ?>

<?php 
ob_start(); 
session_start();
require('adminAccess.php');
?>
<div class="h-100 p-5 grey lighten-3">
	<h2 class="border-bottom animated slideInDown">Valider un Commentaire</h2>
	<h3 class="mt-5 font-weight-normal animated slideInLeft">Commentaire à Valider</h3>
	<div class="col-lg-12 d-flex green text-white mt-3 animated slideInRight faster">
		<div class="col-lg-1 border border-white text-center font-weight-bold">Article N°</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold">Titre Article</div>
		<div class="col-lg-1 border border-white text-center font-weight-bold">Pseudo</div>
		<div class="col-lg-5 border border-white text-center font-weight-bold">Contenu</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold">Action</div>
	</div>
<?php 
	foreach ($commentsToValid as $key => $commentToValid) :	?>		
	<div class="col-lg-12 d-flex">
		<div class="col-lg-1 border border-white text-center animated slideInRight faster">
			<?=$commentToValid->idBlogPost()->idBlogPost();?>	
		</div>
		<div class="col-lg-2 border border-white text-center animated slideInRight faster">
			<?=$commentToValid->idBlogPost()->title();?>		
		</div>
		<div class="col-lg-1 border border-white text-truncate pl-2 animated slideInRight faster">
			<?=htmlspecialchars($commentToValid->pseudo());?>	
		</div>
		<div class="col-lg-5 border border-white text-truncate pl-2 animated slideInRight faster">
			<?=htmlspecialchars($commentToValid->content());?>
		</div>
		<div class="col-lg-1 border border-white text-center animated zoomIn">
			<a href="Commentaire-Invalide-<?=$commentToValid->idComment();?>.html" >Afficher</a>
		</div>
		<div class="col-lg-1 border border-white text-center animated zoomIn">
			<a class="text-success" href="index.php?action=commentValid&amp;id=<?=$commentToValid->idComment();?>" >Valider</a>
		</div>
		<div class="col-lg-1 border border-white text-center animated zoomIn">
			<a class="text-danger" href="index.php?action=commentDelete&amp;id=<?=$commentToValid->idComment();?>&amp;jeton=<?=$_SESSION['jeton']?>" >Supprimer</a>
		</div>
	</div>
<?php endforeach ?>
	<h3 class="mt-5 font-weight-normal animated slideInLeft">Commentaire(s) Validé(s)</h3>
	<div class="col-lg-12 d-flex green text-white mt-3 animated slideInRight">
		<div class="col-lg-1 border border-white text-center font-weight-bold ">Article N°</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold ">Titre Article</div>
		<div class="col-lg-1 border border-white text-center font-weight-bold ">Pseudo</div>
		<div class="col-lg-5 border border-white text-center font-weight-bold ">Contenu</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold ">Action</div>
	</div>
<?php 
	$_SESSION['jeton'];
	foreach ($commentsValid as $key => $commentValid) : ?>		
	<div class="col-lg-12 d-flex lighten-5">
		<div class="col-lg-1 border border-white text-center animated slideInRight">
			<?=$commentValid->idBlogPost()->idBlogPost();?>	
		</div>
		<div class="col-lg-2 border border-white text-center animated slideInRight">
			<?=$commentValid->idBlogPost()->title();?>	
		</div>
		<div class="col-lg-1 border border-white text-truncate pl-2 animated slideInRight">
			<?=htmlspecialchars($commentValid->pseudo());?>
		</div>
		<div class="col-lg-5 border border-white text-truncate pl-2 animated slideInRight">
			<?=htmlspecialchars($commentValid->content());?>
		</div>
		<div class="col-lg-1-5 border border-white text-center animated zoomIn delay-1s">
			<a href="Commentaire-Valide-<?=$commentValid->idComment();?>.html" >Afficher</a>
		</div>
		<div class="col-lg-1-5 border border-white text-center animated zoomIn delay-1s">
			<a class="text-danger" href="index.php?action=commentDelete&amp;id=<?=$commentValid->idComment();?>&amp;jeton=<?=$_SESSION['jeton']?>" >Supprimer</a>
		</div>
	</div>
<?php endforeach ?>
</div>
<?php if($_GET['protection'] == 1) : ?>
<script type="text/javascript">alert('Vous n\'êtes pas autorisé à supprimer un commentaire');</script>
<?php endif ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>