<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
?>
<div class="col-lg-10">
	<form action="index.php?action=formUpdateBlogPost" id="formUpdateBlogPost" method="POST">
	    <p>
		    <label class="d-none">ID</label> <textarea class="formLoginInput d-none" type="text"name="idBlogPost"><?= $updateId ?></textarea>
		    </br>
		    <label>Titre</label> <textarea style=" resize:none;" class="formLoginInput" type="text" name="title" rows="1" maxlength="10"><?= $updateTitle ?></textarea>
		    </br>
		    <label>Châpo</label> <textarea class="formLoginInput" style=" resize:none;" type="text" name="chapo"><?= $updateChapo ?></textarea>
		    </br>
		    <label>Contenu</label> <textarea class="formLoginInput" style=" resize:none;" type="text" name="content"><?= $updateContent ?> </textarea>
		    </br>
		    <input type="submit" name="valide">
		</p>
	</form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>