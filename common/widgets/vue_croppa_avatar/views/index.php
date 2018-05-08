<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-8
 * Time: 上午9:52
 */

use common\components\widgets\JsBlock;
?>

<div class="vue-croppa-avatar-index">
    123456
    <div class="row">
        <div class="col-lg-12">
            <croppa v-model="myCroppa"></croppa>
        </div>
    </div>
</div>

<?php JsBlock::begin(); ?>
    <script>
        Vue.use(Croppa);
    </script>
<?php JsBlock::end(); ?>