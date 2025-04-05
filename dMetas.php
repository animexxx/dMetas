<?php
/*
  Plugin Name: dMetas2025
  Plugin URI: http://facebook.com/duynv2
  Description: Create custom meta box for Wordpress
  Author: Duy.nv
  Version: 1.2
  Author URI: http://facebook.com/duynv2
 */

/*
 * Define common variables
 * */
define('dMetas__PLUGIN_DIR', plugin_dir_path(__FILE__));
define('dMetas__PLUGIN_URL', plugin_dir_url(__FILE__));

//Remove bellow comment and edit path if include this plugin to theme
//define('dMetas__PLUGIN_DIR', TEMPLATEPATH . '/inc/dMetas/');
//define('dMetas__PLUGIN_URL', get_bloginfo('template_url') . '/inc/dMetas/');

/*
 * Include file
 * */

require_once 'inc/metas/metaAbstract.php';
require_once 'inc/metas/metaBox.php';
require_once 'inc/metas/text/text.php';
require_once 'inc/metas/number/number.php';
require_once 'inc/metas/checkbox/checkbox.php';
require_once 'inc/metas/textarea/textarea.php';
require_once 'inc/metas/editor/editor.php';
require_once 'inc/metas/image/image.php';
require_once 'inc/metas/gallery/gallery.php';

require_once 'inc/dMetas.php';
require_once 'inc/dMetas_assets.php';

//defined function get_field();

if (!function_exists('field')) {
    function field($key, $pid = 0)
    {
        global $post;
        if (!$pid)
            return get_post_meta($post->ID, $key, TRUE);
        else
            return get_post_meta($pid, $key, TRUE);
    }
}


// function myguten_register_post_meta()
// {
//     register_post_meta('post', 'myguten_meta_block_field', array(
//         'show_in_rest' => true,
//         'single' => true,
//         'type' => 'string',
//     ));
// }
// add_action('init', 'myguten_register_post_meta');
// wp_register_script('dMetas-m2', dMetas__PLUGIN_URL . 'assets/js/test.js', array('jquery'));
// wp_enqueue_script('dMetas-m2');
