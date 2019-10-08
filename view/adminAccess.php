<?php
if (!isset($_SESSION['firstName'])) {
	header("Location: index.php?action=loginView");
}