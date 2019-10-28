<?php $title = 'MyBlog'; ?>

<?php 
ob_start();
session_start();?>
<div class="contrainer-fluid min-h-100 aqua-gradient">
	<div class="h-25 d-flex p-3">
		<img src="src/MyBlog.png" class="border rounded-circle shadow animated zoomIn" alt="MyBLog" height="200" width="auto">
		<div class="text-center w-100 h3 p-5 text-index animated slideInDown faster">
			Doudou Adel, le développeur passioné &#128513;
		</div>
	</div>
	<div class="mt-5 p-3 d-flex justify-content-around flex-wrap">
		<div class="white p-3 m-3 border rounded col-lg-3 text-index animated fadeIn">
			Formulaire de Contact :
			<form action="index.php?action=sendMail" method="POST" class="mt-3">
		  		<div class="row col-12 p-0 m-0">
					<div class="row p-0 m-0 col-12">
				   		<input class="col-lg-12 p-2" type="text" name="email" required="required" placeholder="Email" />
				    </div>
				    <div class="row p-0 m-0 col-12">
				    	<input class="col-lg-12 p-2" type="text" name="name" rows="1" maxlength="10" required="required" placeholder="Nom" />
				    </div>
				    <div class="row p-0 m-0 col-12">
				    	<input class="col-lg-12 p-2" type="text" name="firstName" required="required" placeholder="Prenom" />
				    </div>
				    <div class="row p-0 m-0 col-12">
				    	<textarea class="col-lg-12 p-2" type="text" name="message" placeholder="Message" rows="5"></textarea>
				    </div>
				    <input class="btn border-secondary col-6 offset-3 mt-4 rounded text-white" type="submit" name="valide" value="Valider">
				</div>
			</form>
		</div>
		<div class="white border p-3 m-3 rounded col-lg-3 text-index animated fadeIn delay-1s">
			Mon CV au format PDF :
			<embed src=src/CV.pdf class="col-12 h-75 mt-3 border" type='application/pdf'/>
		</div>
		<div class="p-3 m-3 col-lg-3 text-index animated fadeIn delay-2s">
			Retrouver moi sur : </br>
			<a href="https://www.facebook.com/adeldoudou1996" class="offset-2"><img src="public/upload/fb_icon_325x325.png" class="col-4 p-3"></a>
			<a href="https://www.linkedin.com/in/adel-doudou-363580182/" class="offset-1"><img src="public/upload/linkedin-logo-e1407144392549.png" class="col-4 p-3"></a>
		</div>
	</div>
</div>

<?php if(isset($_GET['alert']) && $_GET['alert'] == 1) : ?>
	<script type="text/javascript">
		alert("Le mail a été envoyé avec succès !");
	</script>
<?php endif ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>