<?php
//defined custom meta array

//txt
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
                'name' => 'txt1',
                'label' => 'Labels',
                'meta_type' => 'text',
            ],
            [
                'name' => 'txt2',
                'label' => 'Labels 2',
                'meta_type' => 'editor',
            ],
            [
                'name' => 'txt2',
                'label' => 'Labels',
                'meta_type' => 'textarea',
            ],
            [
                'name' => 'img1',
                'label' => 'Labels',
                'meta_type' => 'image',
            ],
            [
                'name' => 'gallery1',
                'label' => 'Labels',
                'meta_type' => 'gallery',
            ],
            [
                'name' => 'repeat1',
                'label' => 'Labels',
                'meta_type' => 'repeater',
                'construcre' => [
                    [
                        'name' => 'txt1',
                        'label' => 'Labels',
                        'meta_type' => 'text',
                    ],
                    [
                        'name' => 'txt1',
                        'label' => 'Labels',
                        'meta_type' => 'text',
                    ]
                ]
            ]
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

dMetas_setMeta($metas);