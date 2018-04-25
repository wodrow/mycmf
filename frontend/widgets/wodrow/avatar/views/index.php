<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use kartik\helpers\Html;
use kartik\form\ActiveForm;
use common\components\widgets\JsBlock;
use yii\bootstrap\Modal;

?>

<div class="wodrow-avatar-index" id="crop-avatar" data-old_avatar="<?=$avatar_url ?>">
    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="avatar-view">
                    <img src="<?=$avatar_url ?>" alt="">
                </div>
            </div>
            <div class="modal fade" id="modal-avatar" tabindex="-1" role="dialog" aria-labelledby="change-avatar" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">×
                            </button>
                            <h4 class="modal-title" id="change-avatar">
                                修改头像
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="avatar-wrap">

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="avatar-preview">
                                        123
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">关闭
                            </button>
                            <button type="button" class="btn btn-primary">
                                提交更改
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
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
                this.$view = this.$crop.find('.avatar-view');
                this.$modal = this.$crop.find('#modal-avatar');
                this.url = old_avatar;
                this.$wrap = this.$crop.find('.avatar-wrap');
                this.$img = $('<img class="avatar-image" src="'+this.url+'" alt="">');
                this.$previewOut = this.$crop.find('.avatar-preview');
//                this.$preview = $('<canvas class="crop-preview" width="200" height="200" style="border: 3px solid #fff;"></canvas>');
                this.$preview = $('<div class="crop-preview" style="border: 2px solid #ccc;height: 150px;width: 150px;"></div>');
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
            ca.$view.click(function () {
                ca.$modal.modal('show');
            })
        })
    </script>
<?php JsBlock::end(); ?>