


import * as THREE from '.././js/three/build/three.module.js';
import { ARButton } from '.././js/three/examples/jsm/webxr/ARButton.js';
let container;
let camera, scene, renderer,material;
let controller;

let reticle;

let hitTestSource = null;
let hitTestSourceRequested = false;

const drawStartPos = new THREE.Vector2();

init();
setupCanvasDrawing();
animate();


function setupCanvasDrawing() {

    // get canvas and context

    const drawingCanvas = document.getElementById( 'drawing-canvas' );
    const drawingContext = drawingCanvas.getContext( '2d' );

    // draw white background

    drawingContext.fillStyle = '#FFFFFF';
    drawingContext.fillRect( 0, 0, 128, 128 );

    // set canvas as material.map (this could be done to any map, bump, displacement etc.)

    material.map = new THREE.CanvasTexture( drawingCanvas );

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
    material.map.needsUpdate = true;

}

function init() {

    container = document.createElement( 'div' );
    document.body.appendChild( container );

    scene = new THREE.Scene();

    camera = new THREE.PerspectiveCamera( 70, window.innerWidth / window.innerHeight, 0.01, 20 );

    const light = new THREE.HemisphereLight( 0xffffff, 0xbbbbff, 1 );
    light.position.set( 0.5, 1, 0.25 );
    scene.add( light );

    //

    renderer = new THREE.WebGLRenderer( { antialias: true, alpha: true } );
    renderer.setPixelRatio( window.devicePixelRatio );
    renderer.setSize( window.innerWidth, window.innerHeight );
    renderer.xr.enabled = true;
    container.appendChild( renderer.domElement );

    //
    material = new THREE.MeshBasicMaterial();

    document.body.appendChild( ARButton.createButton( renderer, { requiredFeatures: [ 'hit-test' ] } ) );

    //

    // const geometry = new THREE.PlaneGeometry( 0.1, 0.1, 0.2, 32 ).translate( 0, 0.1, 0 );
    const geometry = new THREE.PlaneGeometry(0.75,0.5);
    // var loader=new THREE.TextureLoader();
    // var Texture = loader.load("../assets/siteImages/temp2.jpg"); 
    // const geometry = new THREE.PlaneGeometry( width = 0.75,height=0.5);

    function onSelect() {

        if ( reticle.visible ) {

            // const material = new THREE.MeshPhongMaterial( { color: 0xffffff * Math.random() } );
            // var material = new THREE.MeshBasicMaterial({map:Texture}); 
            const mesh = new THREE.Mesh( geometry, material );
            mesh.position.setFromMatrixPosition( reticle.matrix );
            // mesh.scale.y = Math.random() * 2 + 1;
            scene.add( mesh );

        }

    }

    controller = renderer.xr.getController( 0 );
    controller.addEventListener( 'select', onSelect );
    scene.add( controller );

    reticle = new THREE.Mesh(
        new THREE.RingGeometry( 0.15, 0.2, 32 ).rotateX( - Math.PI / 2 ),
        new THREE.MeshBasicMaterial()
    );
    reticle.matrixAutoUpdate = false;
    reticle.visible = false;
    scene.add( reticle );

    //

    window.addEventListener( 'resize', onWindowResize );

}

function onWindowResize() {

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();

    renderer.setSize( window.innerWidth, window.innerHeight );

}

//

function animate() {

    renderer.setAnimationLoop( render );

}

function render( timestamp, frame ) {

    if ( frame ) {

        const referenceSpace = renderer.xr.getReferenceSpace();
        const session = renderer.xr.getSession();

        if ( hitTestSourceRequested === false ) {

            session.requestReferenceSpace( 'viewer' ).then( function ( referenceSpace ) {

                session.requestHitTestSource( { space: referenceSpace } ).then( function ( source ) {

                    hitTestSource = source;

                } );

            } );

            session.addEventListener( 'end', function () {

                hitTestSourceRequested = false;
                hitTestSource = null;

            } );

            hitTestSourceRequested = true;

        }

        if ( hitTestSource ) {

            const hitTestResults = frame.getHitTestResults( hitTestSource );

            if ( hitTestResults.length ) {

                const hit = hitTestResults[ 0 ];

                reticle.visible = true;
                reticle.matrix.fromArray( hit.getPose( referenceSpace ).transform.matrix );

            } else {

                reticle.visible = false;

            }

        }

    }

    renderer.render( scene, camera );

}
