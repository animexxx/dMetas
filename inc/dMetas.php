<?php
//defined custom meta array

//text
//textarea
//image
//editor
//gallery -> array
//repeater -> array
$metas = array(
    [
        'post_type' => 'post',
        'meta_elements' => array(
            [
                'name' => 'cc',
                'label' => 'Custom product label',
                'meta_type' => 'text',
            ],
            [
                'name' => 'ck2',
                'label' => 'Custom product photo',
                'meta_type' => 'image',
            ],
            [
                'name' => 'ck4',
                'label' => 'Custom gallery',
                'meta_type' => 'gallery',
            ],
        )
    ]


);

/*
 * Create meta box by calling class
 * */
function dMetas_setMeta($metas)
{
    foreach ($metas as $meta) {
        //Defined new meta box for each post type
        new \dMetas\metas\metaBox($meta);
    }
}

//dMetas_setMeta($metas);