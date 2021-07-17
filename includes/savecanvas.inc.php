<?php
require 'dbh.inc.php';

function getPID($uid,$conn){
	$sql="SELECT * from pinboards where uid=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql))
    {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        // header("Location: ../create.php?error=error");
        // exit();
		return (-1);
    }
    else {
		mysqli_stmt_bind_param($stmt, "s", $uid);
		mysqli_stmt_execute($stmt);
		$result = $stmt->get_result();
		mysqli_stmt_close($stmt);
        // mysqli_close($conn);

		return $result->num_rows;
	}
}

function savePID($pid,$uid,$conn)
{
	$sql="INSERT INTO pinboards (pid,uid) values(?,?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql))
	{
		echo "Error Occured";
		exit();
	}
	else
	{
		mysqli_stmt_bind_param($stmt, "ss", $pid,$uid);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
}

if(isset($_POST['data']) && isset($_POST['uid'])){
	$img = $_POST['data'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	$fileName='';
	
	$uid = $_POST['uid'];
	$pid = $_POST['pid'];
	// if pinboard ID was already saved once, then skip database queries
	if($pid== 'blank'){
		$pid = getPID($uid,$conn)+1;
		if($pid == 0){
			echo "Error Occured";
			exit();
		}
		$fileName = $uid.$pid.'.png';
		savePID(''.$uid.$pid,$uid,$conn);
	}
	else{
		$fileName = $pid;
	}
	
	//saving
	$filePath = '../assets/saved_pins/'.$fileName;
	if(file_put_contents($filePath, $fileData)){
		// echo('<img src=/pinboARds/assets/saved_pins/'.$fileName.'><br>'.$uid);
		echo(''.$fileName);
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
