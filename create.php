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
            <br>
            <br>
            <br>
            <br>
            <!-- <div class="header_content">
                <h1 style="text-align: left;max-width: 500px;margin: auto; line-height: 50px;"><img src="./assets/siteImages/logo.svg" style="height: 25px;transform: translateY(6px);" alt="">  
                    is a platform to create, use and share virtual pinboards.
                    We use web based Augmented Reality to enable the creation of and
                    interaction with Virtual Pinboards. This project runs on any android that supports
                    ARcore and the webGL standard.
                </h1>
                <div class="graphic">
                    <img src="./assets/siteImages/Android_robot.svg" alt="android_logo" style="height: 60px;">
                </div>-->
                <!-- <a class="cta" href="./demo.html">Try Now</a> -->

    </section>
    
    

    <section class="signup-now">
            <h2>Scratch Pad</h2></span>
        <canvas id="drawing-canvas" height="128" width="128" style="border: 1px solid; background:white; ;margin: 0 auto;cursor:crosshair;"></canvas>
        <p>Input Here</p>
        <!-- <canvas id="canvas" style="border: 1px solid; margin: 0 auto;" height="200" width="800"></canvas> -->
        <br/>
        <!-- <p>Press the left mouse button and drag anywhere inside the black box above</p> -->
        <!-- <canvas id="drawing-canvas" height="128" width="128"></canvas> -->
        <input type="button" onClick="saveImage();" value="Save">
        <button class="btn" id="resetButton">Reset</button>
        <div id="result"></div>
    </section>

    <?php include("footer.html")?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="./js/savecanvas.js" type="module"></script>

</body>
</html>