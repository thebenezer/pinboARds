<?php
if(isset($_POST['data']) && isset($_POST['uid'])){
	$img = $_POST['data'];
	$uid = $_POST['uid'];
	$pid=1;
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	//saving
	// $fileName = date('Ymdhisa').'.png';
	$fileName = $uid.'.png';
	$filePath = '../assets/saved_pins/'.$fileName;
	if(file_put_contents($filePath, $fileData)){
		// echo('<img src=/pinboARds/assets/saved_pins/'.$fileName.'><br>'.$uid);
		echo('Saved'.$uid.$pid);
	}
	else{ 
		echo "Error Occured";
		exit();
	}
}
else{
	header("Location: ../index.php");
  	exit();
}
?>
