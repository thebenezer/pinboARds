
const result = document.getElementById( 'result' );


import * as THREE from '.././js/three/build/three.module.js';

const drawStartPos = new THREE.Vector2();
const drawingCanvas = document.getElementById( 'drawing-canvas' );
    // get canvas and context
const drawingContext = drawingCanvas.getContext( '2d' );
drawingCanvas.addEventListener("touchstart",  function(event) {event.preventDefault()})
drawingCanvas.addEventListener("touchmove",   function(event) {event.preventDefault()})
drawingCanvas.addEventListener("touchend",    function(event) {event.preventDefault()})
drawingCanvas.addEventListener("touchcancel", function(event) {event.preventDefault()})
setupCanvasDrawing();

function defaultCanvas(){
    drawingCanvas.width=128;
    drawingCanvas.height=200;
    drawingContext.fillStyle = '#000000';
    drawingContext.fillRect( 0, 0,drawingCanvas.width,drawingCanvas.height);
    drawingContext.fillStyle = '#ffffff';
    drawingContext.fillRect( 5, 5,drawingCanvas.width-10,drawingCanvas.height-10);
}

function setupCanvasDrawing() {


  
    // draw white background
    defaultCanvas();
    document.getElementById("resetButton").onclick = Reset;

    

    // set the variable to keep track of when to draw

    let paint = false;

    // add canvas event listeners
    drawingCanvas.addEventListener( 'pointerdown', function ( e ) {

        paint = true;
        drawStartPos.set( e.offsetX, e.offsetY );

    } );

    drawingCanvas.addEventListener( 'pointermove', function ( e ) {

        if ( paint ) draw( drawingContext, e.offsetX, e.offsetY );

    } );

    drawingCanvas.addEventListener( 'pointerup', function () {

        paint = false;

    } );

    drawingCanvas.addEventListener( 'pointerleave', function () {

        paint = false;

    } );

}

function draw( drawContext, x, y ) {

    drawContext.moveTo( drawStartPos.x, drawStartPos.y );
    drawContext.strokeStyle = '#000000';
    drawContext.lineTo( x, y );
    drawContext.stroke();
    // reset drawing start position to current position.
    drawStartPos.set( x, y );
    // need to flag the map as needing updating.

}

//this function clears the canvas
function Reset() {
    result.style.display="none";
    drawingContext.clearRect(0,0,drawingCanvas.width,drawingCanvas.height);
    drawingCanvas.width=drawingCanvas.height;
    defaultCanvas();
}
