<?php
/**
 * Created by PhpStorm.
 * User: Duynv
 * Date: 12/7/18
 * Time: 18:44
 */

/*
  Plugin Name: dMetas
  Plugin URI: http://i-devso.com
  Description: Create custom meta box for Wordpress
  Author: Duy.nv
  Version: 1.1
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
require_once 'inc/metas/textarea/textarea.php';
require_once 'inc/metas/editor/editor.php';
require_once 'inc/metas/image/image.php';
require_once 'inc/metas/gallery/gallery.php';

require_once 'inc/dMetas.php';
require_once 'inc/dMetas_assets.php';

//defined function get_field();

if (function_exists('get_field')) {
    function get_field($key)
    {
        global $post;
        return get_post_meta($post->id, $key, TRUE);
    }
}
