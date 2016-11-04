<?php 
	session_start();
	$_SESSION['user_id'] = 1;
	require __DIR__ . '/../../vendor/autoload.php';
	$db = new PDO('mysql:host=localhost;dbname=users_token_dropbox', 'root', 'root');

	// User details
	$user = $db->prepare("UPDATE users SET dropbox_token = NULL WHERE id = :user_id");
	$user->execute(['user_id' => $_SESSION['user_id']]);
	$user = $user->fetchObject();
 ?>