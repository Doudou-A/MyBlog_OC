<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
?>
<div class="d-flex flex-column">
	<h1>Ajouter un Blog Post</h1>
	<form action="index.php?action=formAddBlogPost" id="formAddBlogPost" method="POST">
	    <p>
		    <label>Titre</label> <input class="formLoginInput" type="text" name="title"/>
		    </br>
		    <label>Châpo</label> <input class="formLoginInput" type="text" name="chapo"/>
		    </br>
		    <label>Contenu</label> <input class="formLoginInput" type="text" name="content"/>
		    </br>
		    <input type="submit" name="valide">
		</p>
	</form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>