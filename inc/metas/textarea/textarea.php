<?php

/**
 * Created by PhpStorm.
 * User: Duynv
 * Date: 12/7/18
 * Time: 20:31
 */
namespace dMetas\metas\textarea;

use dMetas\metas\metaAbstract;

class textarea extends metaAbstract
{
    public function save($post_id)
    {
        //get data from form
        $val = $_POST[$this->meta_key];
        //save data to database
        $this->post_id = $post_id;
        $this->meta_value = $val;
        $this->set();
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
            <textarea type="text" class="dMetas_field"
                      name="<?php echo $this->meta_key ?>" rows="3"><?php echo esc_attr($value); ?></textarea>
        </div>
        <?php
    }
}