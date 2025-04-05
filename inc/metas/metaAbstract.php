<?php

/**
 * Created by PhpStorm.
 * User: Duynv
 * Date: 12/7/18
 * Time: 20:19
 */

namespace dMetas\metas;

abstract class metaAbstract
{
    protected $prefix = '';
    protected $name;
    protected $label;
    protected $meta_type;
    protected $post_id;
    protected $meta_key;
    protected $meta_value;

    public function __construct($var)
    {
        $this->name = $var['name'];
        $this->label = $var['label'];
        $this->meta_type = $var['meta_type'];
        $this->meta_key = $this->prefix . $this->name;
    }


    /*
     * Get value of meta
     * */
    protected function get()
    {
        return get_post_meta($this->post_id, $this->meta_key, TRUE);
    }

    /*
     * Set value of meta
     * */
    protected function set()
    {
        if ($this->get() !== $this->meta_value) {
            $check = update_post_meta($this->post_id, $this->meta_key, $this->meta_value);
            if (!$check) {
                throw new \Exception("Can't update meta value");
            }
        }
    }

    abstract public function render($post_id);

    abstract public function save($post_id);
}
