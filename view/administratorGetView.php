<?php $title = 'Gérer les Administrateurs'; ?>

<?php 
ob_start(); 
session_start();
require('adminAccess.php');?>
<div class="container-fluid h-100 p-5 grey lighten-3">
	<h2 class="border-bottom  animated slideInDown">Gérer les Administrateurs</h2>
	<div class="col-lg-12 d-flex green text-white mt-3 animated slideInUp">
		<div class="col-lg-1 border border-white text-center font-weight-bold">Administrateur N°</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold">Email</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold">Nom</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold">Prénom</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold">Action</div>
	</div>
	<?php foreach ($administrators as $key => $administrator) :?>
			<div class="col-lg-12 d-flex">
				<div class="col-lg-1 border border-white text-center animated slideInUp">
					<?=$administrator->idAdministrator();?>	
				</div>
				<div class="col-lg-3 border border-white text-center animated slideInUp">
					<?=$administrator->email();?>
				</div>
				<div class="col-lg-3 border border-white text-truncate pl-2 animated slideInUp">
					<?=$administrator->name();?>
				</div>
				<div class="col-lg-3 border border-white text-truncate pl-2 animated slideInUp">
					<?=$administrator->firstName();?>
				</div>
				<?php if($_SESSION['id'] == $administrator->idAdministrator()) : ?>
				<div class="col-lg-1 border border-white text-center animated zoomIn delay-1s">
					<a href="index.php?action=administratorUpdateView&amp;id=<?=$administrator->idAdministrator();?>" >Modifier</a>
				</div>
				<div class="col-lg-1 border border-white text-center animated zoomIn delay-1s">
					<a class="text-danger" href="index.php?action=administratorDelete&amp;id=<?=$administrator->idAdministrator();?>" >Supprimer</a>
				</div>
				<?php else : ?>
				<div class="col-lg-2 border border-white text-center animated zoomIn delay-1s">
					<a class="text-danger" href="index.php?action=administratorDelete&amp;id=<?=$administrator->idAdministrator();?>" >Supprimer</a>
				</div>
				<?php endif?>
			</div>
	<?php endforeach ?>
</div>
<?php if(isset($_GET['alert']) && $_GET['alert'] == 1) : ?>
<script type="text/javascript">
	alert("Le mot de Passe a été modifié avec succès !");
</script>
<?php else : ?>
<?php if (isset($_GET['alert']) && $_GET['alert'] == 2) : ?>
<script type="text/javascript">
	alert("L'Utilisateur a été modifié avec succès !");
</script>
<?php endif ?>
<?php endif ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>