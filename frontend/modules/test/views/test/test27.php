<?php
\common\assets\Ckplayer::register($this);
?>

<object classid="clsid:02bf25d5-8c17-4b23-bc80-d3488abddc6b" width="320"height="180"
        codebase="http://www.apple.com/qtactivex/qtplugin.cab">
    <param name="src" value="videofilename.mov">
    <param name="autoplay" value="false">
    <param name="controller" value="true">
    <embed src="/storage/videos/test.wmv" width="320" height="180" autoplay="false" controller="true" pluginspage="http://www.apple.com/quicktime/download/">
    </embed>
</object>

<div id="video" style="width:600px;height:400px;"></div>

<?php \common\components\widgets\JsBlock::begin(); ?>
<script type="text/javascript">
    var videoObject = {
        container: '#video',//“#”代表容器的ID，“.”或“”代表容器的class
        variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
        video:'/storage/videos/test.wmv'//视频地址
    };
    var player=new ckplayer(videoObject);
</script>
<?php \common\components\widgets\JsBlock::end(); ?>


