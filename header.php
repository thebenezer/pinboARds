<?php
  session_start();
if(isset($_GET['error'])){
    $error=$_GET['error'];
    if($error=='wrongpwd'){
        echo "<script>alert('Incorrect Password');</script>";
        $uid=$_GET['uid'];
    }
    else if($error=='mismatchedpwd'){
        echo "<script>alert('Passwords do not match.');</script>";
        $uid=$_GET['uid'];
        $mail=$_GET['mail'];
    }
    else if($error=='uidtaken'){
        echo "<script>alert('Username already exists');</script>";
        $mail=$_GET['mail'];
    }
    else if($error=='nouser'){
        echo "<script>alert('Username does not exist');</script>";
    }
    else if($error=='sqlerror_1'){
        echo "<script>alert('Unknown error. Please try again later.');</script>";
    }
    else if($error=='sqlerror_2'){
        echo "<script>alert('Unknown error. Please try again later.');</script>";
    }
    else if($error=='sqlerror_3'){
        echo "<script>alert('Unknown error. Please try again later.');</script>";
    }
    else if($error=='unknownerror'){
        echo "<script>alert('Unknown error. Please try again later.');</script>";
    }
}

?>

<div class="navbar"> 
    <a class="logo" href="index.php"><img src="./assets/siteImages/logo.svg" alt="logo"></a>
    <div class="hamburger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
    </div>
    <nav class="nav">
        <ul class="nav-links">
            <li><a href="./about.php">About</a></li>
            <li><a href="./demo.php">Demo</a></li>
            <?php if (isset($_SESSION['uid'])) { ?>
                <li><a href="./includes/logout.inc.php">Logout</a></li>
                <li><a class="cta" href="profile.php">Profile</a></li>
            <?php } 

            else { ?>
                <li><a href="#" onclick="openLoginForm()">Login</a></li>
                <li><a href="#" class="cta" onclick="openSignupForm()">Signup</a></li>
            <?php }?>
            <!-- <li><a href="#" onclick="openLoginForm()">Login</a></li>
            <li><a href="#" class="cta" onclick="openSignupForm()">Signup</a></li> -->
        </ul>
    </nav>
    
</div>


<!-- ****************** LOGIN FORM ******************* -->

<div class="loginwindow">
    <form method="POST" action="./includes/login.inc.php" class="ls-form">
        <div class="close-form" onclick="closeForm()">
            <span class="close-l1"></span>
            <span class="close-l2"></span>
        </div>
        <h1>Login</h1><br>
       

        <label class="ls-label">
            <input type="text" name="uid" required />
            <div class="ls-label-text">Username/Email</div>
        </label>
        <label class="ls-label">
            <input type="password" name="pwd" required />
            <div class="ls-label-text">Password</div>
        </label>

        <button type="submit" class="btn" name="login-submit">Login</button>
        <p>New to pinboARds? <a style="color:blue;cursor:pointer;" onclick="openSignupForm()">Sign-up</a></p>
        
    </form>
    </div>
</div>

<!-- ****************** SIGNUP FORM ******************* -->

<div class="signupwindow">
    <form method="POST" action="includes/signup.inc.php" class="ls-form">
        <div class="close-form" onclick="closeForm()">
            <span class="close-l1"></span>
            <span class="close-l2"></span>
        </div>
        <h1>Signup</h1><br>
       

        <label class="ls-label">
            <input type="text" name="uid"required />
            <div class="ls-label-text">Username</div>
        </label>
        <label class="ls-label">
            <input type="email" name="email" required />
            <div class="ls-label-text">E-mail</div>
        </label>
        <label class="ls-label">
            <input type="password" name="pwd" required />
            <div class="ls-label-text">Password</div>
        </label>
        <label class="ls-label">
            <input type="password" name="conf_pwd" required />
            <div class="ls-label-text">Confirm Password</div>
        </label>

        <button type="submit" class="btn" name="signup-submit">Sign-up</button>    
        <p>Have an account already? <a style="color:blue;cursor:pointer;" onclick="openLoginForm()">Login</a></p>
        
    </form>
    </div>
</div>