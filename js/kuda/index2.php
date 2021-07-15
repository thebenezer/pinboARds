<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="main.css" />
<title>Store HTML5 Canvas on Server</title>

</head>

<body>
	<div id="wrapper">
		<h1>Scratch Pad</h1>
		<h2>Please scratch below</h2></span>

		<canvas id="canvas" style="border: 1px solid; margin: 0 auto;" height="200" width="800"></canvas>
		<br/>
		<p>Press the left mouse button and drag anywhere inside the black box above</p>
		<input type="button" onClick="saveImage();" value="Save as Image">
		<button class="btn" id="resetButton">Reset</button>
	<div id="result"></div>

	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="./js/savecanvas.js"></script>
</body>
</html>
