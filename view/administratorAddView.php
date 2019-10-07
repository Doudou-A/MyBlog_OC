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

			<!--<div>
				<p id="securityPassword"></p>
				<div style="display: flex; ">
					<div id="firstSecurity" style="width: 100px; height: 15px; background-color: grey;"></div>
					<div id="sdSecurity" style="width: 100px; height: 15px; background-color: grey;"></div>
					<div id="tdSecurity" style="width: 100px; height: 15px; background-color: grey;"></div>
				</div>
			</div>
			<ul>
				<li style="list-style: none;">Pour votre sécurité, utilisez un mot de passe contenant :</li>
				<li style="list-style: none;">• Minimum 5 carcatères</li>
				<li style="list-style: none;">• Au moins une lettre en majuscule</li>
				<li style="list-style: none;">• Un chiffre</li>
			</ul>
			<label class="passConfirm">Confirmer Mot de Passe</label> <input type="password" name="passwordconfirm" id="formPassRegistration" />
			</br>-->
			<input id="submitFormRegistration" type="submit" name="valide" value="Valider" class="btn border-secondary col-6 offset-3 mt-4 animated fadeInRight rounded text-white" />
			<!--<div id="interrogationPoint">
				<p>?</p>
			</div>-->
		</div>
	</form>

	<!--<script type="text/javascript"> 
		formRegistrationJS(); 
	</script>-->
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