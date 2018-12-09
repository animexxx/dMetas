<?php

/**
 * Created by PhpStorm.
 * User: Duynv
 * Date: 12/7/18
 * Time: 20:31
 */
namespace dMetas\metas\gallery;

use dMetas\metas\metaAbstract;

class gallery extends metaAbstract
{
    public function __construct($var)
    {
        parent::__construct($var);
        add_action('admin_enqueue_scripts', array($this, 'add_assets'));
    }

    public function save($post_id)
    {
        //get data from form
        $val = $_POST[$this->meta_key];
        //save data to database
        $this->post_id = $post_id;
        $this->meta_value = $val;
        $this->set();
    }

    public function add_assets()
    {
        //add js
        wp_register_script('dMetas-m-image-upload', dMetas__PLUGIN_URL . 'inc/metas/gallery/gallery.js', array('jquery'));
        wp_enqueue_script('dMetas-m-image-upload');
        //need to call it when code plugin page
        wp_enqueue_media();
        wp_enqueue_script('jquery-ui-sortable');
    }

    public function render($post_id)
    {
        //get exist value from database
        $this->post_id = $post_id;
        $value = $this->get();
        $img_arr = array();
        if ($value) {
            $arr_ids = explode(',', $value);
            foreach ($arr_ids as $id) {
                $img_arr[$id] = wp_get_attachment_image_src($id);
            }
        }

        // Display the form, using the current value.
        ?>
        <div class="dMetas_box">
            <label>
                <?php _e($this->label); ?>
            </label>
            <input type="hidden" class="upload_m_image" name="<?php echo $this->meta_key ?>"
                   value="<?php echo $value ?>">
            <div class="gallery_box">
                <?php if ($img_arr):
                    foreach ($img_arr as $id => $img):
                        if (!$img) continue;
                        ?>
                        <div class="gal_ele" data-id="<?php echo $id ?>"><img src="<?php echo $img[0] ?>" alt="">
                            <button class="del">X</button>
                        </div>
                        <?php
                    endforeach;
                endif; ?>
            </div>
            <input class="upload_m_image_button" type="button" value="Edit Gallery"/>
        </div>
        <?php
    }
}