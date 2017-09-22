<?php
/**
 * @var \yii\web\View $this
 */
$this->title = "My first Three.js app";
?>

<div class="td-default-index">
    <div class="row">
        <div class="col-lg-12">
            <div id="c1" style="background: #ccc;"></div>
        </div>
    </div>
</div>

<?php \common\components\widgets\JsBlock::begin(); ?>
    <script>
        console.log($("#c2"));
        var scene = new THREE.Scene();
        var camera = new THREE.PerspectiveCamera( 75, 1140/800, 0.1, 1000 );
        var renderer = new THREE.WebGLRenderer();
        renderer.setSize( 1140, 800 );
        c1.appendChild( renderer.domElement );
        var geometry = new THREE.BoxGeometry( 1, 1, 1 );
        var material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
        var cube = new THREE.Mesh( geometry, material );
        scene.add( cube );
        camera.position.z = 5;
        var render = function () {
            requestAnimationFrame(render);
            cube.rotation.x += 0.01;
            cube.rotation.y += 0.1;
            renderer.render(scene, camera);
        };
        render();
    </script>
<?php \common\components\widgets\JsBlock::end(); ?>