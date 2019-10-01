function commentsBlogPost(){
	var comments = document.getElementById('comments');
		var commentsview = document.getElementById('commentsview');
		commentsview.onclick = function(){
			if (comments.style.display === "none"){
				comments.style.display = "block";
				commentsview.innerHTML = "Cacher les Commentaires";
				} else {
				comments.style.display = "none";
				commentsview.innerHTML = "Afficher les Commentaires";
				}
		}
}