
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pinboARds</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/basic.css">
</head>
<body>
    <?php 
    include("header.php");

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
        }

        ?>

    <section class="header_section">
        <header>
            <h1 class="profile-head">Profile</h1>
            <article class="profile">
                
                <div class="profile-card">
                    <!-- <img class="profile_pic" src="https://m.media-amazon.com/images/S/aplus-media/vc/cab6b08a-dd8f-4534-b845-e33489e91240._CR75,0,300,300_PT0_SX300__.jpg" alt=""> -->
                    <div class="profile_pic" style="background-image: url('https://m.media-amazon.com/images/S/aplus-media/vc/cab6b08a-dd8f-4534-b845-e33489e91240._CR75,0,300,300_PT0_SX300__.jpg');"></div>
                    <!-- <div class="profile_pic" style="background-image: url('./assets/siteImages/profile_pics/<?php// echo $backpic;?>');"></div> -->
                    <!-- <img class="globe_link" src="./assets/siteImages/profile_pics/<?php //echo $profilepic;?>"> -->
                    <div class="profile_info">
                        <div class="uid"><?php echo $uid;?></div>
                        <h2 class="name"><?php echo $name;?></h2>
                        <div class="desc"><?php echo $about;?></div>
                        <div class="actions">
                            <a href="editprofile.php"><img src="./assets/siteImages/edit.svg" alt=""></a>
                            <!-- <button><img src="./assets/siteImages/images/friends.svg" alt=""></button> -->
                            <!-- <button><img src="./assets/siteImages/images/paper-plane.svg" alt=""></button> -->
                        </div>
                    </div>
                </div>
                <div class="info-card">
                    <!-- <div class="badge" >
                        <img class="badge_pic" src="./assets/siteImages/badges/fledgling.jpg" alt="">
                        <canvas class="badge_pic" id="c"></canvs>
                    </div>
                    <div class="card_info">
                        
                        <div class="actions">
                            <a><img src="./assets/siteImages/images/paper-plane.svg" alt=""></a>
                        </div>
                    </div> -->
                </div>
            </article>
        </header>
    </section>
    
    

    <section class="pinboards-section">
        <h2>My Pinboards</h2>
        <div class="democards">
            <a href="./demo/d1.html" class="card">
              <img src="./assets/siteImages/temp1.jpg" alt="" class="card-img">
              <h3>Shopping List</h3>
              <p>Create a shopping list and view it in AR</p>
            </a>
            <a href="./demo/d2.html" class="card">
              <img src="./assets/siteImages/temp2.jpg" alt="" class="card-img">
              <h3>Notice Board</h3>
              <p>Explore the contents of a sample notice board</p>
            </a>
            <a href="./demo/d3.html" class="card">
              <img src="./assets/siteImages/temp3.jpg" alt="" class="card-img">
              <h3>Scribble Board</h3>
              <p>Make a pinboard with hand written/drawn content </p>
            </a> 
            <a href="./demo/d2.html" class="card">
              <img src="./assets/siteImages/temp2.jpg" alt="" class="card-img">
              <h3>Notice Board</h3>
              <p>Explore the contents of a sample notice board</p>
            </a> 
          <div>
    </section>

        <?php include("footer.html")?>


</body>
</html>