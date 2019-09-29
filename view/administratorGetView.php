<?php $title = 'Gérer les Administrateurs'; ?>

<?php 
ob_start(); 
session_start();
?>
<div class="col-lg-10 p-5 grey lighten-3">
	<h2 class="border-bottom">Gérer les Administrateurs</h2>
	<div class="col-lg-12 d-flex green text-white mt-3">
		<div class="col-lg-1 border border-white text-center font-weight-bold">Administrateur N°</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold">Email</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold">Nom</div>
		<div class="col-lg-3 border border-white text-center font-weight-bold">Prénom</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold">Action</div>
	</div>
	<?php
			foreach ($administrators as $key => $administrator) {
	?>		
			<div class="col-lg-12 d-flex">
				<div class="col-lg-1 border border-white text-center">
					<?=$administrator->idAdministrator();?>	
				</div>
				<div class="col-lg-3 border border-white text-center">
					<?=$administrator->email();?>
				</div>
				<div class="col-lg-3 border border-white text-truncate pl-2">
					<?=$administrator->name();?>
				</div>
				<div class="col-lg-3 border border-white text-truncate pl-2">
					<?=$administrator->firstName();?>
				</div>
				<div class="col-lg-2 border border-white text-center">
					<a class="text-danger" href="index.php?action=administratorDelete&amp;id=<?=$administrator->idAdministrator();?>" >Supprimer</a>
				</div>
			</div>
	<?php
			}
	?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>