<?php
	use kartik\file\FileInput;
	use yii\helpers\Url;
	use app\models\Files;
	use app\models\Users;

	$this->title = 'Upload Files';
	require 'start.php';
	require 'dropbox_auth.php';
	$AccountInfo = $client->getAccountInfo();
	echo "<p style='color: green'>Xin chào <b><u>".$AccountInfo['display_name']."</u></b> vui lòng chọn file(s) để upload.</p> <br />";
	echo '<a href="#" class="btn btn-warning" onclick="logout();">Logout</a><br /><br />';

	echo FileInput::widget([
		'name' => 'file[]',
		'options' => [
			'multiple' => true
		],
		'pluginOptions' => [
			'uploadUrl' => '/basic/web/index.php?r=site/upload',
			'uploadExtraData' => [
				'filename' => 'Tailieu'
			],
		]
	]);
?>

<!-- <h1 class="text-center">List file(s)</h1>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Size</th>
            <th>Time create</th>
            <th>Storage</th>
            <th>User Upload</th>
        </tr>
    </thead>
    <tbody>
		<?php 
			$results = Files::find()
					    ->where(['user_id' => $_SESSION['user_id']])
					    ->all();
			$stt=0;
			foreach($results as $result) {
				$stt++;
				$user_id = $result['user_id'];
				$results_user = Users::find()
						    ->where(['id' => $user_id])
						    ->all();
				foreach($results_user as $result_user){
					echo "
						<tr>
				            <td>".$stt."</td>
				            <td>".$result['file_name']."</td>
				            <td>".$result['size']."</td>
				            <td>".$result['time_create']."</td>
				            <td>".$result['storage']."</td>
				            <td>".$result_user['username']."</td>
				        </tr>
					";
				}
				
				
			}
		 ?>
    </tbody>
</table> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
	function logout() {
		$.ajax({
            type:"POST",
            url:"/basic/web/index.php?r=site/logoutdropbox",
            success:function(x){
                alert("Logout Successfully");
                window.location.href = "/basic/web/index.php?r=site/index";
            }
        });
	}
</script>
