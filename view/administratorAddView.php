<?php $title = 'Inscription'; ?>

<?php ob_start(); 
session_start();
$_SESSION['firstName'];
$_SESSION['name'];?>
<div class="col-10 m-auto h-100 p-5 d-flex flex-column">
	<h2>Ajouter un utilisateur</h1>
	<form action="index.php?action=administratorAddForm" id="formRegistration" method="POST">
		<div class="row col-12 p-0 m-0">
			<div class="row p-0 m-0 col-12">
			<label class="col-lg-12 mt-4">Email</label> <input class="col-lg-12 p-2" type="text" name="email" />
			</div>
			<div class="row p-0 m-0 col-12">
			<label class="col-lg-12 mt-4">Name</label> <input class="col-lg-12 p-2" type="text" name="name" />
			</div>
			<div class="row p-0 m-0 col-12">
			<label class="col-lg-12 mt-4">FirstName</label> <input class="col-lg-12 p-2" type="text" name="firstName" />
			</div>
			<div class="row p-0 m-0 col-12">
			<label class="col-lg-12 mt-4">Mot de Passe</label> <input class="col-lg-12 p-2" id="pass" type="password" name="password"/>
			</div>	
			<div class="row p-0 m-0 col-12">
			<label class="col-lg-12 mt-4">Confirmer le Mot de Passe</label> <input class="col-lg-12 p-2" id="pass" type="password" name="passwordconfirm"/>
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
			<input id="submitFormRegistration" type="submit" name="valide" value="Valider" class="btn border-secondary col-6 offset-3 mt-4 rounded text-white" />
			<!--<div id="interrogationPoint">
				<p>?</p>
			</div>-->
		</div>
	</form>

	<!--<script type="text/javascript"> 
		formRegistrationJS(); 
	</script>-->
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>