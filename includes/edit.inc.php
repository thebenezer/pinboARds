<?php

function uploadFile($p,$conn,$uid,$file)
{

    $filename = $file['name'];
    $filetmpname = $file['tmp_name'];
    $fileerror = $file['error'];
    $filetype = $file['type'];
    $filesize = $file['size'];
    //echo $filetmpname;

    $fileExt=explode(".",$filename);
    $fileExtReal=strtolower(end($fileExt));
    $allowed=array('jpg','jpeg','png');

    if (in_array($fileExtReal,$allowed)) {
        if ($fileerror===0) {
            if ($filesize<1000000) {
                if ($p==1) {
                    $fileNewName=$uid."_prof.".$fileExtReal;
                    $filedest='/opt/lampp/htdocs/pinboARds/assets/profile_pics/'.$uid."_prof.".$fileExtReal;
                    if(move_uploaded_file($filetmpname,$filedest)){
                        $sql = "update user_profile set profilepic = '$fileNewName' where uid='$uid';";
                        $result= mysqli_query($conn,$sql);
                    } 
                }else {
                    $fileNewName=$uid."_back.".$fileExtReal;
                    $filedest='/opt/lampp/htdocs/pinboARds/assets/profile_pics/'.$uid."_back.".$fileExtReal;
                    if(move_uploaded_file($filetmpname,$filedest)){
                        $sql = "update user_profile set backpic = '$fileNewName' where uid='$uid';";
                        $result= mysqli_query($conn,$sql);
                    }
                }
                // else{header("Location: ../profile.php?uploadfail");}
                echo "yessss";
                return TRUE;
            }
            else {
                echo "File size too big";
            }
        }
        else {
        echo "Error in uploading file...";
        }
    }
    else {
        echo "This type is not supported...";
    }
    return FALSE;
}


if (isset($_POST['edit-submit'])) {
    require 'dbh.inc.php';
    session_start();

    $uid = $_SESSION['uid'];
    $name =$_POST['name'];
    $phno =$_POST['phno'];
    $age =(int)$_POST['age'];
    $address =$_POST['address'];
    $about =$_POST['about'];

    $sql="UPDATE user_profile set name=?,phno=?,age=?,address=?,about=? where uid=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql))
    {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../editprofile.php?error=data_uploadfail");
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt, "ssisss",$name,$phno,$age,$address,$about,$uid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } 

    if (is_uploaded_file($_FILES['profile_pic']['tmp_name'])) {
        if(!uploadFile(1,$conn,$uid,$_FILES['profile_pic'])){
            mysqli_close($conn);
            header("Location: ../editprofile.php?profile_uploadfail");
        }
    }
    if (is_uploaded_file($_FILES['back_pic']['tmp_name'])) {
        if(!uploadFile(2,$conn,$uid,$_FILES['back_pic'])){
            mysqli_close($conn);
            header("Location: ../editprofile.php?back_uploadfail");
        }
    }
    header("Location: ../profile.php?success");
    mysqli_close($conn);

}
else {
  header("Location: ../index.php?error=illegal_access");
  exit();
}