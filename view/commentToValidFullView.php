<?php $title = 'MyBlog'; ?>

<?php 
ob_start(); 
session_start();
require('adminAccess.php');
?>
<div class="col-10 m-auto h-100 p-5 d-flex flex-column animated fadeIn">
	<h2>Détail du Commentaire</h2>
	<div class="d-flex flex-column">
		<div class="row col-12 p-0 m-0">
			<div class="row p-0 m-0 col-12">
				<div class="col-lg-12 mt-4 animated fadeInRight">
					Pseudo :
				</div>
				<div class="col-lg-12 p-2 border mt-2 animated fadeInLeft">
					<?= htmlspecialchars($comPseudo) ?>
				</div>
			</div>
			<div class="row p-0 m-0 col-12">
				<div class="col-lg-12 mt-4 animated fadeInRight">
					Contenu :
				</div>
				<div class="col-lg-12 p-2 border mt-2 animated fadeInLeft text-justify">
					<?= htmlspecialchars($comContent) ?>
				</div>
			</div>
			<div class="col-md-4 offset-md-2 mt-4">
				<a class="text-success animated fadeInLeft" href="index.php?action=commentValid&amp;id=<?=$comId?>" >&#x2705;   Valider</a>
			</div>
			<div class="col-md-4 offset-md-2 mt-4">
				<a class="text-danger animated fadeInRight" href="index.php?action=commentDelete&amp;id=<?=$comId?>&amp;jeton=<?=$_SESSION['jeton']?>" >&#x274C;  Supprimer</a>
			</div>
		</div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>