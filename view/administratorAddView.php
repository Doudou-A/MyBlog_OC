<?php $title = 'Inscription'; ?>

<?php ob_start(); 
session_start();
require('adminAccess.php');?>
<div class="col-10 m-auto h-100 p-5 d-flex flex-column  animated fadeIn">
	<h2>Ajouter un utilisateur</h1>
	<form action="index.php?action=administratorAddForm" id="formRegistration" method="POST">
		<div class="row col-12 p-0 m-0">
			<div class="row p-0 m-0 col-12">
			<label class="col-lg-12 mt-4 animated fadeInRight">Email</label> <input class="col-lg-12 p-2 animated fadeInLeft border" type="email" name="email" required="required" />
			</div>
			<div  style="display: none;" class="text-danger" id="errorEmail">
				* L'adresse Mail existe déja !
			</div>
			<div class="row p-0 m-0 col-12">
			<label class="col-lg-12 mt-4 animated fadeInRight">Nom : </label> <input class="col-lg-12 p-2 animated fadeInLeft border" type="text" name="name" required="required" />
			</div>
			<div class="row p-0 m-0 col-12">
			<label class="col-lg-12 mt-4 animated fadeInRight">Prénom : </label> <input class="col-lg-12 p-2 animated fadeInLeft border" type="text" name="firstName" required="required" />
			</div>
			<div class="row p-0 m-0 col-12">
			<label class="col-lg-12 mt-4 animated fadeInRight">Mot de Passe : </label> <input class="col-lg-12 p-2 animated fadeInLeft border" id="pass" type="password" name="password" required="required" />
			</div>	
			<div class="row p-0 m-0 col-12">
			<label class="col-lg-12 mt-4 animated fadeInRight">Confirmer le Mot de Passe : </label> <input class="col-lg-12 p-2 animated fadeInLeft border" id="pass" type="password" name="passwordConfirm" required="required" />
			</div>	
			<div style="display: none;" class="text-danger" id="errorPassword">
				* Les mots de passe sont différents !
			</div>
			<input id="submitFormRegistration" type="submit" name="valide" value="Valider" class="btn border-secondary col-6 offset-3 mt-4 animated fadeInRight rounded text-white" />
		</div>
	</form>
</div>
<?php if($_GET['error'] == 1) : ?>
	<script type="text/javascript">
		var errorEmail = document.getElementById('errorEmail');
		errorEmail.style.display = "block";
	</script>
<?php elseif($_GET['error'] == 2) :?>
	<script type="text/javascript">
		var errorPassword = document.getElementById('errorPassword');
		errorPassword.style.display = "block";
	</script>
<?php endif ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>