# dMetas

Create custom meta by define array.

Can include to theme for theme developer.
```
$metas = array(
    [
        'post_type' => 'post',
        'meta_elements' => array(
            [
                'name' => 'txt1',
                'label' => 'Text box 1',
                'meta_type' => 'text',
            ],
            [
                'name' => 'txt2',
                'label' => 'Textarea 1',
                'meta_type' => 'textarea',
            ],
            [
                'name' => 'txt3',
                'label' => 'Editor',
                'meta_type' => 'editor',
            ],
            [
                'name' => 'img1',
                'label' => 'Image upload',
                'meta_type' => 'image',
            ],
            [
                'name' => 'gallery1',
                'label' => 'Gallery',
                'meta_type' => 'gallery',
            ]
        )
    ]
);
dMetas_setMeta($metas);
```
