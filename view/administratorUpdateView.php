<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
if($_SESSION['id'] != $_GET['id'])
{
	header("Location : index.php?action=administratorGetView");
}
require('adminAccess.php');
?>
<div class="h-100 m-auto h-100 p-5 d-flex flex-column animated fadeIn">
	<h2>Modifier un Utilisateur</h1>
	<form action="index.php?action=administratorUpdateForm&amp;id=<?= $updateId ?>" id="formUpdateBlogPost" method="POST">
  		<div class="row col-12 p-0 m-0">
			<div class="row p-0 m-0 col-12">
		   		<label class="col-lg-12 mt-4 animated fadeInRight">Email : </label> <input class="col-lg-12 p-2 animated fadeInLeft border" type="text" name="email" value="<?= $updateEmail ?>"/>
		    </div>
		    <div  style="display: none;" class="text-danger" id="errorEmail">
				* L'adresse Mail existe déja !
			</div>
		    <div class="row p-0 m-0 col-12">
		    	<label class="col-lg-12 mt-4 animated fadeInRight">Nom : </label> <input class="col-lg-12 p-2 animated fadeInLeft border" type="text" name="name" rows="1" maxlength="10" value="<?= $updateName ?>"/>
		    </div>
		    <div class="row p-0 m-0 col-12">
		    	<label class="col-lg-12 mt-4 animated fadeInRight">Prénom : </label> <input class="col-lg-12 p-2 animated fadeInLeft border" type="text" name="firstName" value="<?= $updateFirstName ?>"/>
		    </div>
		    <div class="row p-0 m-0 col-12">
		    	<label class="col-lg-12 mt-4 animated fadeInRight">Nouveau Mot de Passe : </label><input class="col-lg-12 p-2 animated fadeInLeft border" type="password" name="password"/>
		    </div>
		    <div class="row p-0 m-0 col-12">
		    	<label class="col-lg-12 mt-4 animated fadeInRight">Confirmer le Nouveau Mot de Passe : </label><input class="col-lg-12 p-2 animated fadeInLeft border" type="password" name="passwordConfirm"/>
		    </div>
		    <div style="display: none;" class="text-danger" id="errorPassword">
				* Les mots de passe sont différents !
			</div>
		    <input class="btn border-secondary col-6 offset-3 mt-4 animated fadeInRight rounded text-white" type="submit" name="valide" value="Valider">
	</form>
</div>

<?php if(isset($_GET['error']) && $_GET['error'] == 1) : ?>
	<script type="text/javascript">
		var errorEmail = document.getElementById('errorEmail');
		errorEmail.style.display = "block";
	</script>
<?php elseif(isset($_GET['error']) && $_GET['error'] == 2) : ?>
	<script type="text/javascript">
		var errorPassword = document.getElementById('errorPassword');
		errorPassword.style.display = "block";
	</script>
<?php endif ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>