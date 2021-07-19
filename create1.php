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
            <h1 class="createhead">To-do List</h1>
        </header>
    </section>
    
    <section class="canvas-section">
        <div class="canv-cont">
            <div class="canvas-input">
                <p>Input Here</p>
                <div class="flex-inp">
                    <div style="margin-top:30px; display: flex; flex-direction:column;">    
                        <input type="text" id="item-heading" name="message" onkeyup="check();" rows="1" cols="30"placeholder="Heading"></input>
                        <textarea id="item" name="message" onkeyup="check();" rows="10" cols="30"placeholder="Enter your items"></textarea>
                    </div>
                </div>
                <div>

                </div>
            </div>
            <div class="canvas-settings">
                <p>Preview</p>
                <canvas id="drawing-canvas" width="300" height="200" style="margin: 0 auto;cursor:crosshair;"></canvas>
                <div class="save_progress">
                    <img src="./assets/siteImages/832.gif" class="loader" alt="">
                    <img src="./assets/siteImages/saved.svg" class="saved" alt="">
                    <img src="./assets/siteImages/location.svg" class="location" alt="">
                </div>

                <input type="button" class="cta" style="background: linear-gradient(150deg,#330867,#31a7bb);" onclick="saveImage()" value="Save">
                <input type="button" class="cta" style="background: #f54242;" id="resetButton" value="Reset">
                <input type="button" class="cta" style="background: #f67898;" id = "find-me" value="Pin To My Location">
            </div>
        </div>
        <a class="cta-white" id="view" style="box-shadow: 0 0 10px rgb(0 0 0 / 0.6);" href="./view.php?">View in AR</a>
        
    </section>

    <div class="hide"style="display:none;">
        <div id="result">blank</div>
        <p id = "lati">999</p>
        <p id = "longi">999</p>
        <p id = "loc_status"></p>

    </div>

    <?php include("footer.html")?>
    
    <script src="./js/geoloc.js"></script>
    <script type="text/javascript" src="./js/share.js"></script>
    <script >
        var txt_array=[] ;
        var canvas = document.getElementById('drawing-canvas'),
        ctx = canvas.getContext('2d');
        document.getElementById("resetButton").onclick = Reset;
        changeCanvas();
        function defaultCanvas(){
            canvas.width=300;
            canvas.height=200;
            ctx.fillStyle = '#31a7bb';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = 'white';
            ctx.fillRect(10, 10, canvas.width - 20, canvas.height - 20);
        }
        function changeCanvas() {
            defaultCanvas();
            ctx.textAlign = "start";
            ctx.font = '20pt Arial';
            ctx.fillStyle = 'Green';
            var heading = document.getElementById('item-heading').value;
            ctx.fillText(heading, 10, 30);

            ctx.font = '10pt Arial';
            ctx.fillStyle = 'black';
            var text = document.getElementById('item').value;
            txt_array= text.split(/\n/);
            for ( let i = 0; i < txt_array.length; i ++ ) {	
                ctx.fillText( (i+1)+". "+txt_array[ i ], 10, 50+15 * i );
            }
        }
        function check() {
            changeCanvas();
        };
        //this function clears the canvas
        function Reset() {
            // document.getElementById("lati").innerHTML="...";
            document.querySelector(".saved").style.display="none";
            document.querySelector(".location").style.display="none";
            document.getElementById("lati").innerHTML=999;
            document.getElementById("longi").innerHTML=999;

            // result.style.display="none";
            ctx.clearRect(0,0,canvas.width,canvas.height);
            canvas.width=canvas.height;
            defaultCanvas();
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- <script src="./js/savecanvas.js" type="module"></script> -->
    <script>
        
        function saveImage(){
            // document.getElementById("result").style.display="block";
            // Asynchronus POST 
            try{
                var canvas = document.getElementById("drawing-canvas");
                var pid=document.getElementById("result").innerHTML;
                var data = canvas.toDataURL("image/png");
                var uid=<?php echo '"'.$_SESSION['uid'].'"';?>;

                var lati=document.getElementById("lati").innerHTML;
                var longi=document.getElementById("longi").innerHTML;
                $.ajax({
                    url: "includes/savecanvas.inc.php",
                    data:{
                        data:data,
                        uid:uid,
                        pid:pid,
                        lati:lati,
                        longi:longi},
                    type:"POST",
                    success:function(r){
                        // $pid=r;
                        // console.log($pid);
                        $("#result").html(r);
                        document.getElementById("view").href="./view.php?pid="+r;
                        // document.getElementById("saved").innerHTML="Saved";
                        document.querySelector(".saved").style.display="block";
                    }
            
                });
            }catch(e){
                alert(e.message);
            }

            // To Hide and show loading animation when save button is clicked
            $(document).on({
                ajaxStart: function(){
                    document.querySelector(".loader").style.display="block";
                    // $(".canvas-section").style.background="black";
                    // document.getElementById("saved").innerHTML=" ";
                },
                ajaxStop: function(){ 
                    document.querySelector(".loader").style.display="none";
                    // $(".canvas-section").style.background="black";
                }    
            });
        }
    </script>

</body>
</html>