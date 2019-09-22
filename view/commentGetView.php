<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
?>
<h1>Valider un Commentaire</h1>
<?php
		$k = 1;
		while($data<=$NumberInvalid->fetch())
		{
?>		
		<div class="col-lg-12 d-flex">
			<div class="col-lg-2">
				<?=$com[$k]->idComment();?>		
			</div>
			<div class="col-lg-2">
				<?=$com[$k]->pseudo();?>
			</div>
			<div class="col-lg-2">
				<?=$com[$k]->content();?>
			</div>
		</div>
<?php
			$k++;
?>
</br>
<?php
		}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>