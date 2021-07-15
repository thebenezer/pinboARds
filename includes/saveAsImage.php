<?php
if(isset($_POST['data'])){
$img = $_POST['data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);
//saving
$fileName = date('Ymdhisa').'.png';
$filePath = '../assets/saved_pins/'.$fileName;
file_put_contents($filePath, $fileData);
	echo('<hr>Created Image is: <br><img src=/pinboARds/assets/saved_pins/'.$fileName.'>');
}
?>
