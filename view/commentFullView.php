<?php $title = 'Valider un Commentaire'; ?>

<?php 
ob_start(); 
session_start();
?>
<div class="col-lg-10">
	<h1>Commentaire</h1>
	<div class="d-flex flex-column">
		<div class="h-100">
			<div>
				<div class="col-md-2 offset-md-2 border-bottom">Id</div>
				<div class="col-md-2 offset-md-2 mb-3"><?= $comId ?></div>
			</div>
			<div>
				<div class="col-md-2 offset-md-2 border-bottom">Pseudo</div>
				<div class="col-md-2 offset-md-2 mb-3"><?= $comPseudo ?></div>
			</div>
			<div class="h-50">
				<div class="col-md-8 offset-md-2 border-bottom">Contenu</div>
				<div class="col-md-8 offset-md-2 d-inline-block"><?= $comContent ?> </div>
			</div>
			<div class="col-md-8 offset-md-2">
				<a href="index.php?action=commentUpdate&amp;id=<?=$comId?>" >Valider</a>
			</div>
			<div class="col-md-8 offset-md-2">
				<a href="index.php?action=commentDelete&amp;id=<?=$comId?>" >Supprimer</a>
			</div>
		</div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>