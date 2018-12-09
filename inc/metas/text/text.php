<?php

/**
 * Created by PhpStorm.
 * User: Duynv
 * Date: 12/7/18
 * Time: 20:31
 */
namespace dMetas\metas\text;

use dMetas\metas\metaAbstract;

class text extends metaAbstract
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
            <input type="text" class="dMetas_field" name="<?php echo $this->meta_key ?>"
                   value="<?php echo esc_attr($value); ?>"/>
        </div>
        <?php
    }
}