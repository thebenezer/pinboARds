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
        <header class="createheading">
            <h1 class="createhead">Scribble Board</h1>
        </header>
    </section>
    
    

    <section class="canvas-section">
        <div class="canv-cont">
            <div>
                <p>Input Here</p>
                <canvas id="drawing-canvas" height="200" width="128" style="border: 1px solid;margin: 0 auto;cursor:crosshair;"></canvas>
                <p>Press the left mouse button and drag anywhere inside the black box above</p>
            </div>
            <div>
                <p>Preview</p>
                <div id="result"></div>
                <input type="button" class="cta" style="background: linear-gradient(150deg,#330867,#31a7bb);;" onclick="saveImage()" value="Save">
                <input type="button" class="cta" style="background: #f54242;" id="resetButton" value="Reset">
            </div>
        </div>
        
    </section>

    <?php include("footer.html")?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="./js/savecanvas.js" type="module"></script>
    <script>
        function saveImage(){
            try{
                var canvas = document.getElementById("drawing-canvas");
                var data = canvas.toDataURL("image/png");
                $.ajax({
                    url: "includes/saveAsImage.php",
                    data:{data:data},
                    type:"POST",
                    success:function(r){
                        $("#result").html(r);
                    }
            
                });
            }catch(e){
                alert(e.message);
            }
        }
    </script>

</body>
</html>