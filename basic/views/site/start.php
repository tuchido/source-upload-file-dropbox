<?php 
	session_start();
	$_SESSION['user_id'] = 1;
	require __DIR__ . '/../../vendor/autoload.php';

	$dropboxKey = 'ejqlhc9t0om539s';
	$dropboxSecret = 'fahpiouwae4cgsz';
	$appName = 'codecourse/1.0';

	$appInfo = new Dropbox\AppInfo($dropboxKey, $dropboxSecret);

	// Store CSRF token
	$csrfTokenStore = new Dropbox\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');

	// Define auth details
	$webAuth = new Dropbox\WebAuth($appInfo, $appName, 'http://localhost/basic/web/index.php?r=site/finish', $csrfTokenStore);

	$db = new PDO('mysql:host=localhost;dbname=users_token_dropbox', 'root', 'root');

	// User details
	$user = $db->prepare("SELECT * FROM users WHERE id = :user_id");
	$user->execute(['user_id' => $_SESSION['user_id']]);
	$user = $user->fetchObject();

 ?>