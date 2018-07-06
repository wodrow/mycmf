<?php
\common\assets\LightGalleryAsset::register($this);
?>

<?php
echo \common\widgets\LightGalleryWidget::widget([
    'items' => [
        [
            'thumb' => '/storage/images/404.png',
            'src' => '/storage/images/404.png',
        ],
        [
            'thumb' => '/storage/images/404.png',
            'src' => '/storage/images/404.png',
        ],
        [
            'thumb' => '/storage/images/404.png',
            'src' => '/storage/images/404.png',
        ],
        [
            'thumb' => '/storage/images/404.png',
            'src' => '/storage/images/404.png',
        ],
        [
            'thumb' => '/storage/images/404.png',
            'src' => '/storage/images/404.png',
        ],
        [
            'thumb' => '/storage/images/404.png',
            'src' => '/storage/images/404.png',
        ],
        [
            'thumb' => '/storage/images/404.png',
            'src' => '/storage/images/404.png',
        ],
    ],
    // more options http://sachinchoolur.github.io/lightGallery/docs/api.html
    'options' => [
        'mode' => 'lg-zoom-in-big',
        'download' => false,
        'zoom' => false,
        'share' => false
    ]
]);
?>
