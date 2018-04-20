<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="wodrow-avatar-index">
    <div class="row">
        <div class="col-lg-12">
            <img id="cropper-image" src="\images\404.png" alt="">
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
    // Get the Cropper.js instance after initialized
    var cropper = $image.data('cropper');
</script>
<?php common\components\widgets\JsBlock::end(); ?>