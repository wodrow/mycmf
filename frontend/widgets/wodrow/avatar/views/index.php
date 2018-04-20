<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use kartik\helpers\Html;

?>

<div class="wodrow-avatar-index">
    <div class="row">
        <div class="col-lg-12">
            <img id="cropper-image" src="\images\404.png" alt="">
        </div>
        <div class="col-lg-12">
            <?=Html::button('crop', ['id' => "image-crop-button", 'class' => "btn btn-primary"]) ?>
        </div>
    </div>
</div>

<?php common\components\widgets\JsBlock::begin(); ?>
<script>
    var $image = $('#cropper-image');
    $image.cropper({
        aspectRatio: 1 / 1,
        crop: function(event) {
            console.log(event.detail.x);
            console.log(event.detail.y);
            console.log(event.detail.width);
            console.log(event.detail.height);
            console.log(event.detail.rotate);
            console.log(event.detail.scaleX);
            console.log(event.detail.scaleY);
        }
    });
    var cropper = $image.data('cropper');
    $('#image-crop-button').click(function () {
        $().cropper('move', 111, 0)
        var x = $().cropper('getData');
        $().cropper('getCropperCanvas', {
            'width': '20', // the destination width of the output canvas.
            'height': '20', // the destination height of the output canvas.
            'minWidth': 0, // the minimum destination width of the output canvas, the default value is 0.
            'minHeight': 0, // the minimum destination height of the output canvas, the default value is 0.
            'maxWidth': 'Infinity', // the maximum destination width of the output canvas, the default value is Infinity.
            'maxHeight': 'Infinity', // the maximum destination height of the output canvas, the default value is Infinity.
            'fillColor': 'transparent', // a color to fill any alpha values in the output canvas, the default value is transparent.
            'imageSmoothingEnabled': true, // set to change if images are smoothed (true, default) or not (false).
            'imageSmoothingQuality': 'low' // one of "low" (default), "medium", or "high".
        });
        console.log(x);
    })
</script>
<?php common\components\widgets\JsBlock::end(); ?>