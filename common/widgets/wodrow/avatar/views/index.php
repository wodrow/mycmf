<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-8
 * Time: 下午3:20
 */

use common\components\widgets\JsBlock;
?>

<img id="element_id" src="/storage/images/404.png" alt="">

<?php JsBlock::begin(); ?>
<script>
    $('#element_id').Jcrop();
</script>
<?php JsBlock::end(); ?>
