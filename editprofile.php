<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pinboARds</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/basic.css">
    <link rel="stylesheet" href="./css/forms.css">
</head>
<body>
    <?php include("header.php");
    
    if (isset($_SESSION['uid'])) {
        require './includes/dbh.inc.php';
    
        $uid = $_SESSION['uid'];         
        
        // ************************GET USER DETAILS*********************
        $sql = "SELECT * from user_profile where uid= ?;";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./index.php?sql_error1");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $uid);
            mysqli_stmt_execute($stmt);
            $result = $stmt->get_result();
            if($result->num_rows == 0){
                header("Location: ./index.php?error=nouser");
                exit();
            }
            else{
                $row = $result->fetch_assoc();
                $name = $row['name'];
                $jdate = $row['join_date'];
                $address =$row['address'];
                $phno=$row['phno'];
                $age=$row['age'];
                $profilepic=$row['profilepic'];
                $backpic=$row['backpic'];
                $about=$row['about'];
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
    }
    else{
        header("Location: ./index.php?error=illegal_access");
        exit();
    }
    ?>

    <section class="header_section">
        <header class="demo">
          <h1>Edit Profile</h1>
        </header>
    </section>

    <section class="signup-now">
    <article class="profile">
                <form action="./includes/edit.inc.php" method="post" enctype="multipart/form-data" class="edit_profile">
                    <label>
                        <input type="text" name="name" placeholder="<?php echo $name;?>" value="<?php echo $name;?>"/>
                        <div class="label-text">Full Name</div>
                    </label>
                    <label>
                        <input type="text" name="phno"placeholder="<?php echo $phno;?>" value="<?php echo $phno;?>"/>
                        <div class="label-text">Pnone Number</div>
                    </label>
                    <label>
                        <input type="number" min="0" name="age" placeholder="<?php echo $age;?>" value="<?php echo $age;?>"/>
                        <div class="label-text">Age</div>
                    </label>
                    <label>
                        <input type="text" name="address" placeholder="<?php echo $address;?>" value="<?php echo $address;?>"/>
                        <div class="label-text">Location/Country</div>
                    </label>
                    <label>
                        <div class="about-text">About</div>
                        <textarea class="editabout" name="about"placeholder="<?php echo $about;?>"><?php echo $about;?></textarea>
                    </label>
                    <label for="profile_pic"><b>Upload Profile Picture</b></label>
                    <input type="file" name="profile_pic">
                    <label for="back_pic"><b>Upload Background Picture</b></label>
                    <input type="file" name="back_pic">
                    <br>
                    <!-- <br>
                    <label>
                        <input type="password"/>
                        <div class="label-text">Password</div>
                    </label> -->
                    <button type="submit" name="edit-submit">Confirm</button>
                </form>
            </article>

    </section>

        <?php include("footer.html")?>


</body>
</html>

