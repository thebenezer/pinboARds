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
    <?php include("header.php")?>
    <section class="header_section">
        <header>
            <div class="header_content">
                <h1>A platform to create, use and share virtual pinboards</h1>
                <div class="graphic">
                    <img src="./assets/siteImages/p0.svg" alt="" srcset="">
                </div><br><br><br><br>
                <a class="cta" href="./demo.php">Try Now</a>
            </div>
        </header>
    </section>
    
    <section class="intro_section">
        <h2>Features</h2>
        <h3>Virtual Pinboards</h3>
        <p class="summary">Use the power of Augmented Reality to create and view virtual pinboards whenever and wherever you want to.</p>
        <div class="intro">
            <div class="intro-info">
                <h3>No Set-up Required</h3>
                <p>All you need is a smartphone and web browser! All you have to do is visit a URL.</p>
            </div>
            <div class="info-graphic">
                <img src="./assets/siteImages/p1.svg" alt="">
            </div>
        </div>
        <div class="intro alt">
            <div class="intro-info">
                <h3>Create, Modify, Share</h3>
                <p>Once a PinboARd is created, you can view it using AR. Share any pinboard by making it public.</p>
            </div>
            <div class="info-graphic">
                <img src="./assets/siteImages/p2.svg" alt="">
            </div>
        </div>
        <div class="intro">
            <div class="intro-info">
                <h3>Collaborating made easy</h3>
                <p>Want to collaborate on a single pinboard? Just create a pinboard and provide edit access to anyone you would like to collaborate with!</p>
            </div>
            <div class="info-graphic">
                <img src="./assets/siteImages/p3.svg" alt="">
            </div>
        </div>
    </section>

    <section class="how-section">
        <article>
            <h2>Want to Get Started?</h2>
            <div class="content"></div>
            <div class="graphic"></div>
            <a class="cta" onclick="openSignupForm()">Signup Now</a>
        </article>

    </section>

    <section class="signup-now">
        <h2>Built With</h2>
        
        <div class="tools" style="margin-bottom: 200px;">
            <img src="./assets/siteImages/three.svg" alt="">
            <img src="./assets/siteImages/Ar_core.svg" alt="">
            <img src="./assets/siteImages/WebGL_Logo.svg" alt="">
        </div>
        <!-- <h2>Runs On</h2>
        <div class="tools" style="margin-bottom: 200px;">
            <img src="./assets/siteImages/Google_Chrome.svg" alt="">
            <img src="./assets/siteImages/1920px-Brave_icon_app.png" alt="">
            <img src="./assets/siteImages/Firefox_logo,_2019.svg" alt="">
        </div> -->

    </section>

    <?php include("footer.html")?>
    

</body>
</html>