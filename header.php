
<div class="navbar"> 
    <a class="logo" href="index.html"><img src="./assets/logo.svg" alt="logo"></a>
    <div class="hamburger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
    </div>
    <nav class="nav">
        <ul class="nav-links">
            <li><a href="./about.html">About</a></li>
            <li><a href="./demo.html">Demo</a></li>
            <li><a href="#" onclick="openLoginForm()">Login</a></li>
            <li><a href="#" class="cta" onclick="openSignupForm()">Signup</a></li>
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
        <h1>Login</h1>
       

        <label class="ls-label">
            <input type="text" name="uid" required />
            <div class="ls-label-text">Username/Email</div>
        </label>
        <label class="ls-label">
            <input type="password" name="pwd" required />
            <div class="ls-label-text">Password</div>
        </label>

        <button type="submit" class="btn" name="login-submit">Login</button>
        <p>New to SURF?</p>
        <div type="button" class="secondbtn" onclick="openSignupForm()">Sign-up</div>
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
        <h1>Signup</h1>
       

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
        <p>Have an account already?</p>
        <div type="submit" class="secondbtn" onclick="openLoginForm()">Login</div>
    </form>
    </div>
</div>