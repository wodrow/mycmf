<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-27
 * Time: 上午8:34
 */
use common\components\widgets\JsBlock;

\frontend\widgets\wodrow\avatar\assets\Asset::register($this);
?>

<div class="frontend-test-test-test18" id="crop-avatar" data-old_avatar="<?=$avatar_url ?>">
    <div class="row">
        <div class="col-sm-9">
            <div class="avatar-wrap"></div>
        </div>
        <div class="col-sm-3">
            <div class="avatar-preview"></div>
        </div>
    </div>
</div>

<?php JsBlock::begin(); ?>
    <script>
        $(function () {
            var $crop = $("#crop-avatar");
            var old_avatar = $crop.data('old_avatar');

            function CropAvatar($element) {
                this.$crop = $crop;
                this.url = old_avatar;
                this.$wrap = this.$crop.find('.avatar-wrap');
                this.$img = $('<img class="avatar-image" src="'+this.url+'" alt="">');
                this.$previewOut = this.$crop.find('.avatar-preview');
//                this.$preview = $('<canvas class="crop-preview" width="200" height="200" style="border: 3px solid #ccc;"></canvas>');
                this.$preview = $('<div class="crop-preview" style="border: 2px solid #ccc;height: 200px;width: 200px;"></div>');
                this.init();
            }

            CropAvatar.prototype = {
                init: function () {
                    this.$img.cropper({
                        aspectRatio: 1,
                        preview: this.$preview,
                        viewMode: 1,
                        crop: function (e) {
                            console.log(e.detail.x);
                        }
                    });
                    this.$wrap.empty().html(this.$img);
                    this.$previewOut.empty().html(this.$preview);
                    var x = this.$img.cropper("getImageData");
                    console.log(x);
                }
            };

            var ca = new CropAvatar($crop);
        })
    </script>
<?php JsBlock::end(); ?>