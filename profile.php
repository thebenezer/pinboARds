
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

            // ************************GET PINBOARDS*********************
            $sql = "SELECT pid from pinboards where uid= ?;";
            $stmt= mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                echo "An unforseen error has occured. Please try again later.";
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $uid);
                if(!mysqli_stmt_execute($stmt)){
                    echo "An unforseen error has occured. Please try again later.";
                }
                $result = $stmt->get_result();
                $num_boards = 0;
                $pinboards=[];
                if($result->num_rows != 0){
                    while($row = $result->fetch_assoc()){
                        $pinboards[]=$row;
                        // array_push($pinboards,$row['pid']);
                        $num_boards+=1;
                    }
                }
                mysqli_stmt_close($stmt);
            }
        }

        ?>
        <div class="create-pinboard">
            <ul class="create_list">
                <a href="./create.php?val=text">Text Board</a>
                <a href="./create.php?val=scribble">Scribble Pad</a>
                <a href="./create.php?val=image">Image Board</a>
            </ul>
            <div class="plus-cont" onclick="openCreateLinks()">
                <div class="plus"></div>
            </div>
            
        </div>
    
    <section class="header_section">
        <header>
            <h1 class="profile-head">Profile</h1>
            <article class="profile">
            
                <div class="profile-card">
                    <!-- <img class="profile_pic" src="https://m.media-amazon.com/images/S/aplus-media/vc/cab6b08a-dd8f-4534-b845-e33489e91240._CR75,0,300,300_PT0_SX300__.jpg" alt=""> -->
                    <!-- <div class="profile_pic" style="background-image: url('https://m.media-amazon.com/images/S/aplus-media/vc/cab6b08a-dd8f-4534-b845-e33489e91240._CR75,0,300,300_PT0_SX300__.jpg');"></div> -->
                    <div class="back_pic" style="background-image: url('./assets/profile_pics/<?php echo $backpic;?>') no-repeat fixed center;"></div>
                    <img class="profile_pic" src="./assets/profile_pics/<?php echo $profilepic;?>">
                    <div class="profile_info">
                        <div class="uid"><?php echo $uid;?></div>
                        <h2 class="name"><?php echo $name;?></h2>
                        <div class="desc"><?php echo $about;?></div>
                        <div class="actions">
                            <a href="./editprofile.php"><img src="./assets/siteImages/edit.svg" alt=""></a>
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
                    <!-- <div class="create-pinboard2" onclick="openLoginForm()">
                        <div class="plus"></div>
                    </div> -->
                </div>
            </article>
        </header>
    </section>
    
    

    <section class="pinboards-section">
        <h2>My Pinboards</h2>
        <div class="democards">
            <?php
            foreach($pinboards as $pinboard){
                $sql = "SELECT * from pinboard_details where pid=?;";
                $stmt= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "An unforseen error has occured. Please try again later.";
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $pinboard['pid']);
                    if(!mysqli_stmt_execute($stmt)){
                        echo "An unforseen error has occured. Please try again later.";
                    }
                    else{
                        $result = $stmt->get_result();
                        if($result->num_rows == 0){
                            echo "<p>You have no pinboARds saved. Click on the create button to create new pinboards.</p>";
                        }
                        else{
                            $row = $result->fetch_assoc();
                            echo ' <div class="card">
                                        <div class="card-img" style="background-image: url("./assets/saved_pins/'.htmlspecialchars($pinboard['pid']).'.png")" ></div>
                                        <img src="./assets/saved_pins/'.$pinboard['pid'].'.png" alt="">
                                        <h3>'.$row['pid'].'</h3>
                                        <p>Scribble Board</p>
                                        <a href="./view.php?pid='.$pinboard['pid'].'"><img class="icon" src="./assets/siteImages/view.png" alt=""></a>
                                        <img src="./assets/siteImages/share.svg" alt="" class="icon" onclick=\'sharelink("./view.php?pid='.$pinboard['pid'].'")\'>
                                    </div>';
                        }
                    }
                    
                    mysqli_stmt_close($stmt);
                }
            }
            ?>
            <!-- <a href="./demo/d1.html" class="card">
              <img src="./assets/siteImages/temp1.jpg" alt="" class="card-img">
              <h3>pid</h3>
              <p>Scribble Board</p>
            </a> -->
            <!-- <div class="card">
                <div class="card-img" style="background-image: url("./assets/saved_pins/'.htmlspecialchars($pinboard['pid']).'.png")" ></div>
                <img src="./assets/saved_pins/'.$pinboard['pid'].'.png" alt="">
                <h3>'.$row['pid'].'</h3>
                <p>Scribble Board</p>
                <a href="./view.php?pid='.$pinboard['pid'].'"><img src="./assets/siteImages/view.png" alt=""></a>
                <button class="share-button"onclick=\'sharelink("./view.php?pid='.$pinboard['pid'].'")\'>Share</button>
            </div> -->
          <div>
    </section>

        <?php include("footer.html")?>
        <script type="text/javascript" src="./js/share.js">

</body>
</html>