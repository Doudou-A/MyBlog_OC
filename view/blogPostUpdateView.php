<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
$_SESSION['firstName'];
$_SESSION['name'];
?>
<div class="col-10 m-auto h-100 p-5 d-flex flex-column">
	<h2>Modifier un Article</h1>
	<form action="index.php?action=blogPostUpdateForm" id="formUpdateBlogPost" method="POST">
	  <div class="row col-12 p-0 m-0">
			<div class="row p-0 m-0 col-12">
		   		<label class="d-none">ID</label> <textarea class="formLoginInput d-none" type="text"name="idBlogPost"><?= $updateId ?></textarea>
		    </div>
		    <div class="row p-0 m-0 col-12">
		    	<label class="col-lg-12 mt-4">Titre</label> <input style=" resize:none;" class="col-lg-12 p-2" type="text" name="title" rows="1" maxlength="10" value="<?= $updateTitle ?>"/>
		    </div>
		    <div class="row p-0 m-0 col-12">
		    	<label class="col-lg-12 mt-4">Châpo</label> <input class="col-lg-12 p-2" style=" resize:none;" type="text" name="chapo" value="<?= $updateChapo ?>"/>
		    </div>
		    <div class="row p-0 m-0 col-12">
		    	<label class="col-lg-12 mt-4">Contenu</label> <textarea class="col-lg-12 p-2 text-justify" style=" resize:none;" type="text" name="content" rows="10"><?= $updateContent ?></textarea>
		    </div>
		    <input class="btn border-secondary col-6 offset-3 mt-4 rounded text-white" type="submit" name="valide" value="Valider">
		</p>
	</form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>