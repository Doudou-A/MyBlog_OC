<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
?>
<h1>Valider un Commentaire</h1>
<?php
		while($getCom = $comToValid->fetch())
		{
?>		
		<div class="col-lg-12 d-flex">
			<div class="col-lg-2">
				<?=$getCom['idComment']?>		
			</div>
			<div class="col-lg-2">
				<?=$getCom['pseudo']?>
			</div>
			<div class="col-lg-2">
				<?=$getCom['content']?>
			</div>
			<div class="col-lg-1">
				<a href="index.php?action=commentUpdate&amp;id=<?=$getCom['idComment']?>" >Valider ce Commentaire</a>
			</div>
			<div class="col-lg-2">
				<a href="index.php?action=commentDelete&amp;id=<?=$getCom['idComment']?>" >Supprimer ce Commentaire</a>
			</div>
		</div>
</br>
<?php
		}
		while($getCom = $comValid->fetch())
		{
?>		
		<div class="col-lg-12 d-flex">
			<div class="col-lg-2">
				<?=$getCom['idComment']?>		
			</div>
			<div class="col-lg-2">
				<?=$getCom['pseudo']?>
			</div>
			<div class="col-lg-2">
				<?=$getCom['content']?>
			</div>
			<div class="col-lg-2">
				<a href="index.php?action=commentDelete&amp;id=<?=$getCom['idComment']?>" >Supprimer ce Commentaire</a>
			</div>
		</div>
</br>
<?php
		}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>