<?php

if (isset($_POST['login-submit'])) {
  require 'dbh.inc.php';

  $mailuid = $_POST['uid'];
  $password = $_POST['pwd'];


    $sql = "SELECT * from users where uid=? OR email=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location: ../index.php?error=sqlerror_1");
      exit();
    }
    else
    {
       mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);
       if($result->num_rows === 0){
        header("Location: ../index.php?error=nouser");
        exit();
       }
       if ($row = mysqli_fetch_assoc($result))
       {
         $pwdcheck= password_verify($password,$row['pwd']);
         if ($pwdcheck==false)
         {
           header("Location: ../index.php?error=wrongpwd&uid=".$mailuid);
           exit();
         }
         elseif($pwdcheck==true)
         {
           session_start();
           $_SESSION['uid'] =$row['uid'];
           header("Location: ../profile.php?login=success");
           exit();
         }
         else
         {
             header("Location: ../index.php?error=unknownerror");
             exit();
         }
       }
       else
       {
           header("Location: ../index.php?error=nouser");
           exit();
       }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
  header("Location: ../index.php");
  exit();
}