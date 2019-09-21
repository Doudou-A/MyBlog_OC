<?php $title = 'Administration'; ?>

<?php 
ob_start();
session_start();
 ?>

<p>Gérer les Blogs Posts</p>
<a href="index.php?action=blogPostAddView">Ajouter un Blog Post</a>
<a href="index.php?action=blogPostUpdateView">Modifier un Blog Post</a>
<a href="index.php?action=blogPostDeleteView">Supprimer un Blog Post</a>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>