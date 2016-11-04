<?php
	require 'start.php';

	list($accessToken, $dropboxPath) = $webAuth->finish($_GET);
	$client = new Dropbox\Client($accessToken, $appName, 'UTF-8');

	$store = $db->prepare("
		UPDATE users
		SET dropbox_token = :dropbox_token
		WHERE id = :user_id
	");

	$store->execute([
		'dropbox_token' => $accessToken,
		'user_id' => $_SESSION['user_id']
	]);

	header("Location: /basic/web/index.php?r=site/connectdropbox");
	exit();
	
	// // Upload files
	// $file = fopen('index.php', 'rb');
	// $file_size = filesize('index.php');
	// $tuchido = $client->uploadFile('/index.php', Dropbox\WriteMode::add(), $file, $file_size);
?>