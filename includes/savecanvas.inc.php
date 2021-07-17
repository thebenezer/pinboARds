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

function save_to_database($pid,$uid,$lati,$longi,$conn)
{
	$sql="INSERT INTO pinboards (pid,uid) values(?,?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql))
	{
		echo "Error1 Occured";
		exit();
	}
	else
	{
		mysqli_stmt_bind_param($stmt, "ss", $pid,$uid);
		mysqli_stmt_execute($stmt);
		
		$sql="INSERT INTO pinboard_details (pid,latitude,longitude) values(?,?,?);";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql))
		{
			echo "Error2 Occured";
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt, "sdd", $pid,$lati,$longi);
			mysqli_stmt_execute($stmt);
		}
		mysqli_stmt_close($stmt);
	}
}

function update_to_database($pid,$lati,$longi,$conn)
{
	$sql="UPDATE pinboard_details SET latitude=?,longitude=? WHERE pid=?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql))
	{
		echo "ErrorU1 Occured";
		exit();
	}
	else
	{
		mysqli_stmt_bind_param($stmt, "dds",$lati,$longi, $pid);
		if(mysqli_stmt_execute($stmt));
		else{
			echo "ErrorU2 Occured";
			exit();
		}
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
	$lati = $_POST['lati'];
	$longi = $_POST['longi'];
	// if pinboard ID was already saved once, then skip insert database queries
	if($pid == 'blank'){
		$pid = getPID($uid,$conn)+1;
		if($pid == 0){
			echo "Error Occured";
			exit();
		}
		$fileName = $uid.$pid;
		save_to_database($fileName,$uid,$lati,$longi,$conn);
	}
	else{
		$fileName = $pid;
		update_to_database($pid,$lati,$longi,$conn);
	}
	
	//saving
	$filePath = '../assets/saved_pins/'.$fileName.'.png';
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
