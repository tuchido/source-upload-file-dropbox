<?php 
	require 'start.php';
	require 'dropbox_auth.php';
	require __DIR__ . '/../../vendor/autoload.php';
	// namespace app\models;

	use app\models\Files;

	if(empty($_FILES['file'])) 
    { 
        echo json_encode(['error' => 'No files found for upload']); 
        return; 
    } 

	$files = $_FILES['file']; 
	$file_url = $files['tmp_name'][0];
	$file_name = $files['name'][0];
	$filesize = $files['size'][0];
	$bytes = floatval($filesize);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
	$file = fopen($file_url, 'rb');
	for($i=0; $i < count($file_name); $i++) { 
        $results = $client->uploadFile('/'.$file_name, Dropbox\WriteMode::add(), $file, $filesize);
        $db = new PDO('mysql:host=localhost;dbname=users_token_dropbox', 'root', 'root');
		// User details
		$user_id = $_SESSION['user_id'];
		$storage = 'dropbox';
		$date = date("F j, Y, g:i a");

		$customer = new Files;
		$customer->file_name = $file_name;
		$customer->size = $result;
		$customer->time_create = $date;
		$customer->storage = $storage;
		$customer->user_id = $user_id;
		$customer->save();

    }
	if(isset($results)) { 
        echo "
        <script type='text/javascript'>
        	alert('Upload file(s) successfully');
        	window.location.href = '/basic/web/index.php?r=site/index';
        </script>"; 
    }

 ?>