
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pinboARds</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/basic.css">
    <style>
        /* CARD DESIGN */
.profile{
    width: 80%;
    display: flex;
    margin: auto;
}
.profile-card {
    background: #fff;
    border-radius: 4px;
    box-shadow: 0px 10px 40px rgba(34, 35, 58, 0.5);
    display: flex;
    flex-direction: row;
    flex: 1;
    border-radius: 25px;
    position: relative;
    width: 100%;
    min-height: 300px;
}

.profile_pic {
    flex: 1;
    /* width: 100%; */
    /* height: 100%; */
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
    /* background-position: bottom center; */
    background-size: cover;
}

.card_info {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    text-align: left;
    /* grid-template-columns: 1fr 2fr; */
}

.uid {
    padding: 1rem;
    text-align: right;
    color: green;
    font-weight: bold;
    font-size: 16px;
}
.name{
    color: black;
    padding: 0.5rem 1rem 0 1rem;
    text-align: left;
    margin-top: 10px;
}
.desc {
    padding: 0 1rem;
    font-size: 12px;
    /* margin: 0; */
}
   
.actions {
    /* text-align: left; */
    width: 100%;
    display: flex;
    justify-content: flex-end;
    padding-right: 20px;
}
.actions a img {
    margin: 0 20px;
    width: 30px;
    border: none;
}

.actions a {
    border: none;
    background: none;
    font-size: 24px;
    cursor: pointer;
    transition:.2s;
}
.actions a:hover{
    opacity: 0.6;
}
    </style>
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
            <article class="profile">
                <div class="profile-card">
                    <img class="profile_pic" src="https://m.media-amazon.com/images/S/aplus-media/vc/cab6b08a-dd8f-4534-b845-e33489e91240._CR75,0,300,300_PT0_SX300__.jpg" alt="">
                    <div class="profile_pic" style="background-image: url('./assets/profile_pics/<?php echo $backpic;?>');"></div>
                    <img class="globe_link" src="./assets/profile_pics/<?php echo $profilepic;?>">
                    <div class="card_info">
                        <div class="uid"><?php echo $uid;?></div>
                        <h2 class="name"><?php echo $name;?></h2>
                        <div class="desc"><?php echo $about;?></div>
                        <div class="actions">
                            <a href="editprofile.php"><img src="./assets/images/edit.svg" alt=""></a>
                        </div>
                    </div>
                </div>
            </article>
        </header>
    </section>
    
    

    <section class="signup-now">
        <h2>Built With</h2>
        
        <div class="tools" style="margin-bottom: 50px;">
            <img src="./assets/three.svg" alt="">
            <img src="./assets/Ar_core.svg" alt="">
            <img src="./assets/WebGL_Logo.svg" alt="">
        </div>
        <h2>Runs On</h2>
        <div class="tools" style="margin-bottom: 200px;">
            <img src="./assets/Google_Chrome.svg" alt="">
            <img src="./assets/1920px-Brave_icon_app.png" alt="">
            <img src="./assets/Firefox_logo,_2019.svg" alt="">
        </div>
    </section>

        <?php include("footer.html")?>


</body>
</html>