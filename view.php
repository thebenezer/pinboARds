<!DOCTYPE html>
<html lang="en">
	<head>
		<title>View AR</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link type="text/css" rel="stylesheet" href="./css/demo.css">
	</head>
	<body>
        <div id="info">
			<a href="./index.php" target="_blank" rel="noopener">PinboARds</a> Tap on the screen when in AR View to place pinboards<br/>(Chrome Android 81+)
		</div>

		<script type="module">

            import * as THREE from './js/three/build/three.module.js';
            import { ARButton } from './js/three/examples/jsm/webxr/ARButton.js';

			let container;
			let camera, scene, renderer;
			let controller;

			let reticle;

			let hitTestSource = null;
			let hitTestSourceRequested = false;

			init();
			animate();

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

				document.body.appendChild( ARButton.createButton( renderer, { requiredFeatures: [ 'hit-test' ] } ) );

				//

				const geometry = new THREE.PlaneGeometry(0.75,0.5);
				var loader=new THREE.TextureLoader();
    			var Texture = loader.load(<?php echo '"./assets/saved_pins/'.$_GET['pid'].'"';?>); 
				// const geometry = new THREE.PlaneGeometry( width = 0.75,height=0.5);

				function onSelect() {

					if ( reticle.visible ) {

						// const material = new THREE.MeshPhongMaterial( { color: 0xffffff * Math.random() } );
						var material = new THREE.MeshBasicMaterial({map:Texture}); 
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

		</script>
	</body>
</html>
