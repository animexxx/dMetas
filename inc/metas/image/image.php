<?php

/**
 * Created by PhpStorm.
 * User: Duynv
 * Date: 12/7/18
 * Time: 20:31
 */

namespace dMetas\metas\image;

use dMetas\metas\metaAbstract;

class image extends metaAbstract
{
    public function __construct($var)
    {
        parent::__construct($var);
        add_action('admin_enqueue_scripts', array($this, 'add_assets'));
    }

    public function save($post_id)
    {
        if (!isset($_POST[$this->meta_key])) return;
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
        wp_register_script('dMetas-image-upload', dMetas__PLUGIN_URL . 'inc/metas/image/image.js', array('jquery'));
        wp_enqueue_script('dMetas-image-upload');
        //need to call it when code plugin page
        wp_enqueue_media();
    }

    public function render($post_id)
    {
        //get exist value from database
        $this->post_id = $post_id;
        $value = $this->get();

        // Display the form, using the current value.
?>
        <div class="dMetas_box">
            <label>
                <?php _e($this->label); ?>
            </label>
            <input type="hidden" class="upload_image" name="<?php echo $this->meta_key ?>">
            <?php if ($value): ?>
                <img class="upload_image_img" src="<?php echo $value ?>" width="200">
            <?php endif ?>
            <img class="upload_image_img" src="" width="200">
            <input class="upload_image_button" type="button" value="Upload Image" />
            <?php if ($value): ?>
                <input class="remove_image_button" type="button" value="Remove Image" />
            <?php endif ?>
        </div>
<?php
    }
}
