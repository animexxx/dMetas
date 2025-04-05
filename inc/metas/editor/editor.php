<?php

/**
 * Created by PhpStorm.
 * User: Duynv
 * Date: 12/7/18
 * Time: 20:31
 */

namespace dMetas\metas\editor;

use dMetas\metas\metaAbstract;

class editor extends metaAbstract
{
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

    public function render($post_id)
    {
        //get exist value from database
        $this->post_id = $post_id;
        $content = $this->get();
        $editor_id = $this->meta_key;
        // Display the form, using the current value.
?>
        <div class="dMetas_box">
            <label>
                <?php _e($this->label); ?>
            </label>
        </div>
<?php
        wp_editor($content, $editor_id, array('textarea_rows' => 5));
    }
}
