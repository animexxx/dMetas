<?php
/**
 * Created by PhpStorm.
 * User: Duynv
 * Date: 12/7/18
 * Time: 23:41
 */

//hook admin assets
add_action('admin_enqueue_scripts', 'dMetas_add_assets');

function dMetas_add_assets()
{
    /*//js file
    wp_register_script(
        'dForm-js', dForms__PLUGIN_URL . '/js/dForm.js', array('jquery')
    );
    wp_localize_script('dForm-js', 'myAjax', array('ajaxurl' => get_bloginfo('url')));
    wp_enqueue_script('dForm-js');

    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('jquery-ui-draggable');
    wp_enqueue_script('jquery-ui-droppable');*/

    //css file
    wp_register_style('dMetas-style', dMetas__PLUGIN_URL . 'assets/css/style.css');
    wp_enqueue_style('dMetas-style');
}