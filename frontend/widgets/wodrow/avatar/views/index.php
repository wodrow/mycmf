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
            <div id="crop-avatar">
                <!-- Current avatar -->
                <div class="avatar-view" title="Change the avatar">
                    <img src="\images\404.png" alt="Avatar">
                </div>
                <!-- Cropping modal -->
                <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label"
                     role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form class="avatar-form" action="<?=\yii\helpers\Url::to('/test/test/crop') ?>" enctype="multipart/form-data" method="post">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" id="avatar-modal-label">修改图片</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="avatar-body">
                                        <!-- Upload image and data -->
                                        <div class="avatar-upload">
                                            <input class="avatar-src" name="avatar_src">
                                            <input class="avatar-data" name="avatar_data">
                                            <label for="avatarInput">本地上传</label>
                                            <input type="file" class="avatar-input" id="avatarInput"
                                                   name="avatar_file">
                                        </div>
                                        <!-- Crop and preview -->
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="avatar-wrapper"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="avatar-preview preview-lg"></div>
                                                <div class="preview-md" id="preview-md">

                                                    <canvas id="preview-canvas" width="200" height="100"></canvas>
                                                </div>
                                                <div class="avatar-preview preview-sm"></div>
                                            </div>
                                        </div>
                                        <div class="row avatar-btns">
                                            <div class="col-md-9">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary"
                                                            data-method="rotate" data-option="-90"
                                                            title="Rotate -90 degrees">向左转
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            data-method="rotate" data-option="-15">-15度
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            data-method="rotate" data-option="-30">-30度
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            data-method="rotate" data-option="-45">-45度
                                                    </button>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary"
                                                            data-method="rotate" data-option="90"
                                                            title="Rotate 90 degrees">向右转
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            data-method="rotate" data-option="15">15度
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            data-method="rotate" data-option="30">30度
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            data-method="rotate" data-option="45">45度
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-primary btn-block avatar-save">
                                                    完 成
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal -->

                <!-- Loading state -->
                <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
            </div>
        </div>
    </div>
</div>