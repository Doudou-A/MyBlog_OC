<?php $title = 'Inscription'; ?>

<?php ob_start(); ?>
<div class="col-lg-10">
	<h1>Ajouter un utilisateur</h1>
	<form action="index.php?action=formRegistration" id="formRegistration" method="POST">
		<p>
			<label>Email</label> <input type="text" name="email" />
			</br>
			<label>Name</label> <input type="text" name="name" />
			</br>
			<label>FirstName</label> <input type="text" name="firstName" />
			</br>
			<label>Mot de Passe</label> <input id="pass" type="password" name="password" />
			</br>	
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
			<input id="submitFormRegistration" type="submit" name="valide" />
			<!--<div id="interrogationPoint">
				<p>?</p>
			</div>-->
		</p>
	</form>

	<!--<script type="text/javascript"> 
		formRegistrationJS(); 
	</script>-->
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>