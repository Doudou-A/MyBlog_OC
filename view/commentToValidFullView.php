<?php $title = 'Valider un Commentaire'; ?>

<?php 
ob_start(); 
session_start();
?>
<div class="col-10 m-auto h-100 p-5 d-flex flex-column">
	<h1>Commentaire</h1>
	<div class="d-flex flex-column">
		<div class="row col-12 p-0 m-0">
			<div class="row p-0 m-0 col-12">
				<div class="col-lg-12 mt-4">
					Pseudo :
				</div>
				<div class="col-lg-12 p-2 border mt-2">
					<?= $comPseudo ?>
				</div>
			</div>
			<div class="row p-0 m-0 col-12">
				<div class="col-lg-12 mt-4">
					Contenu :
				</div>
				<div class="col-lg-12 p-2 border mt-2 text-justify">
					<?= $comContent ?>
				</div>
			</div>
			<div class="col-md-4 offset-md-2 mt-4">
				<a class="text-success" href="index.php?action=commentValid&amp;id=<?=$comId?>" >&#x2705;   Valider</a>
			</div>
			<div class="col-md-4 offset-md-2 mt-4">
				<a class="text-danger" href="index.php?action=commentDelete&amp;id=<?=$comId?>" >&#x274C;  Supprimer</a>
			</div>
		</div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>