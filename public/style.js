document.getElementsByClassName = function(className, elmt)
{
   var selection = new Array();
   var regex = new RegExp("\\b" + className + "\\b");

   // le second argument, facultatif
   if(!elmt)
      elmt = document;
   else if(typeof elmt == "string")
      elmt = document.getElementById(elmt);
   
   // on sélectionne les éléments ayant la bonne classe
   var elmts = elmt.getElementsByTagName("*");
   for(var i=0; i<elmts.length; i++)
      if(regex.test(elmts[i].className))
         selection.push(elmts[i]);

   return selection;
}

function errorLogin(){
	var errorLogin = document.createElement('a');
	var errorLoginText = document.createTextNode('* Veuillez entrer un pseudo valide');

	errorLogin.appendChild(errorLoginText);

	document.getElementById('formLogin').appendChild(errorLogin);

	errorLogin.style.color = "red" ;
}

function errorLoginPass(){
	var errorLogin = document.createElement('a');
	var errorLoginText = document.createTextNode('* Veuillez entrer un mot de passe valide');

	errorLogin.appendChild(errorLoginText);

	document.getElementById('formLogin').appendChild(errorLogin);

	errorLogin.style.color = "red" ;
}

function formRegistrationJS() {

	var interrogationPointElt = document.getElementById('interrogationPoint');

	var firstSecurityElt = document.getElementById("firstSecurity");
	var sdSecurityElt = document.getElementById("sdSecurity");
	var tdSecurityElt = document.getElementById("tdSecurity");

	var securityPasswordElt = document.getElementById("securityPassword");

	var submitFormRegistrationElt = document.getElementById("submitFormRegistration");

	function mouseOver(){
		var submitSecurity = document.createElement('submitSecu');
		var submitSecurityText = document.createTextNode('*La Sécurité de votre mot de passe doit être moyenne');

		submitSecurity.appendChild(submitSecurityText);

		interrogationPointElt.appendChild(submitSecurity);
	}

	function mouseOut(){
		var submitSecurityOut = document.querySelector('submitSecu');

		submitSecurityOut.parentNode.removeChild(submitSecurityOut);
	}

	interrogationPointElt.onmouseover = function() {mouseOver()};
	interrogationPointElt.onmouseout = function() {mouseOut()};
	
	document.getElementById("pass").addEventListener("input", function (e) {

	var pass = e.target.value;

	if(pass.length <1){

		securityPasswordElt.innerHTML = "";

		firstSecurityElt.style.backgroundColor="gray";
		sdSecurityElt.style.backgroundColor="gray";
		tdSecurityElt.style.backgroundColor="gray";

		submitFormRegistrationElt.disabled=true;

		interrogationPointElt.style.display="contents";

		}else if (pass.length >=1){

			securityPasswordElt.innerHTML = 'Sécurité Faible';

			firstSecurityElt.style.backgroundColor="red";
			sdSecurityElt.style.backgroundColor="gray";
			tdSecurityElt.style.backgroundColor="gray";

			submitFormRegistrationElt.disabled=true;

			interrogationPointElt.style.display="contents";

			if(pass.length >= 5 && (pass.match(/[0-9]/) || pass.match(/[A-Z]/))){

				securityPasswordElt.innerHTML = 'Sécurité Moyenne';

				firstSecurityElt.style.backgroundColor="orange";
				sdSecurityElt.style.backgroundColor="orange";
				tdSecurityElt.style.backgroundColor="gray";

				submitFormRegistrationElt.disabled=false;

				interrogationPointElt.style.display="none";

				if(pass.length >= 5 && pass.match(/[0-9]/) && pass.match(/[A-Z]/)){

					securityPasswordElt.innerHTML = 'Sécurité Forte';

					firstSecurityElt.style.backgroundColor="green";
					sdSecurityElt.style.backgroundColor="green";
					tdSecurityElt.style.backgroundColor="green";

					submitFormRegistrationElt.disabled=false;

					interrogationPointElt.style.display="none";

				}
			}
		} 
	});
}

function errorPassConfirm(){
	var errorPassConfirm = document.createElement('PassConfirm');
	var errorPassConfirmText = document.createTextNode('* Les mots de passe sont différents');

	errorPassConfirm.appendChild(errorPassConfirmText);

	document.getElementById('formRegistration').appendChild(errorPassConfirm);

	errorPassConfirm.style.color = "red" ;
}
