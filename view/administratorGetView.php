<?php $title = 'Gérer les Administrateurs'; ?>

<?php 
ob_start(); 
session_start();
require('adminAccess.php');?>
<div class="container-fluid h-100 p-5 grey lighten-3">
	<h2 class="border-bottom  animated slideInDown faster">Gérer les Administrateurs</h2>
	<div class="col-lg-12 d-flex green text-white mt-3 animated slideInUp faster">
		<div class="col-lg-1 border border-white text-center font-weight-bold">Administrateur N°</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold">Email</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold">Nom</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold">Prénom</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold">Action</div>
	</div>
	<?php foreach ($administrators as $key => $administrator) :?>
			<div class="col-lg-12 d-flex">
				<div class="col-lg-1 border border-white text-center animated slideInUp faster">
					<?=$administrator->idAdministrator();?>	
				</div>
				<div class="col-lg-3 border border-white text-center animated slideInUp faster">
					<?=$administrator->email();?>
				</div>
				<div class="col-lg-3 border border-white text-truncate pl-2 animated slideInUp faster">
					<?=$administrator->name();?>
				</div>
				<div class="col-lg-3 border border-white text-truncate pl-2 animated slideInUp faster">
					<?=$administrator->firstName();?>
				</div>
				<?php if($_SESSION['id'] == $administrator->idAdministrator()) : ?>
				<div class="col-lg-1 border border-white text-center animated zoomIn">
					<a href="Modifier-Utilisateur-<?=$administrator->idAdministrator();?>.html" >Modifier</a>
				</div>
				<div class="col-lg-1 border border-white text-center animated zoomIn">
					<a class="text-danger" href="index.php?action=administratorDelete&amp;id=<?=$administrator->idAdministrator();?>&amp;jeton=<?=$_SESSION['jeton']?>" >Supprimer</a>
				</div>
				<?php else : ?>
				<div class="col-lg-2 border border-white text-center animated zoomIn">
					<a class="text-danger" href="index.php?action=administratorDelete&amp;id=<?=$administrator->idAdministrator();?>&amp;jeton=<?=$_SESSION['jeton']?>&amp;jeton=<?=$_SESSION['jeton']?>" >Supprimer</a>
				</div>
				<?php endif?>
			</div>
	<?php endforeach ?>
</div>
<?php if(isset($_GET['alert']) && $_GET['alert'] == 1) : ?>
	<script type="text/javascript">
		alert("Le mot de Passe a été modifié avec succès !");
	</script>
<?php elseif (isset($_GET['alert']) && $_GET['alert'] == 2) : ?>
	<script type="text/javascript">
		alert("L'Utilisateur a été modifié avec succès !");
	</script>
<?php elseif(isset($_GET['protection']) && $_GET['protection'] == 1) : ?>
	<script type="text/javascript">alert('Vous n\'êtes pas autorisé à supprimer un utilisateur');</script>
<?php endif ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>