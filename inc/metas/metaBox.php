<?php
/**
 * Created by PhpStorm.
 * User: Duynv
 * Date: 12/7/18
 * Time: 22:38
 */

namespace dMetas\metas;


class metaBox
{
    /*
     * @var string $meta_id Unique id for meta box
     * */
    protected $meta_id;

    /*
     * @var string $meta_title Title of meta box
     * */
    public $meta_title;

    /*
     * @var string $post_type Post type for meta box
     * */
    protected $post_type;

    /*
     * @var string $meta_element_string User defined string for create meta box element
     * */
    protected $meta_element_string;

    /*
     * @var array $meta_element_object array of meta box element
     * */
    protected $meta_element_object;

    /*
     * Construct
     *
     * @param array $param
     * */
    public function __construct($param)
    {
        $this->post_type = $param['post_type'];
        $this->meta_element_string = $param['meta_elements'];
        $this->meta_id = uniqid('dMetas_');
        $this->meta_title = __('Custom meta');

        //process the meta element
        $this->process();
        //default hook
        add_action('add_meta_boxes', array($this, 'hook'), 10, 2);
        add_action('save_post', array($this, 'save'), 10, 2);
    }

    /*
     * Define meta element here
     * */
    protected function process()
    {
        foreach ($this->meta_element_string as $meta) {
            switch ($meta['meta_type']) {
                case 'text':
                    $this->meta_element_object[] = new \dMetas\metas\text\text($meta);
                    break;
                case 'textarea':
                    $this->meta_element_object[] = new \dMetas\metas\textarea\textarea($meta);
                    break;
                case 'image':
                    $this->meta_element_object[] = new \dMetas\metas\image\image($meta);
                    break;
                case 'gallery':
                    $this->meta_element_object[] = new \dMetas\metas\gallery\gallery($meta);
                    break;
            }
        }
    }

    /*
     * Hook the meta to admin
     * */
    public function hook()
    {
        add_meta_box(
            $this->meta_id,
            __($this->meta_title),
            array($this, 'render'),
            $this->post_type
        );
    }

    /*
     * Render meta box html in admin
     * */
    public function render($post)
    {
        //little hack style
        ?>
        <style>
            #
            <?php echo $this->meta_id?>
            .inside {
                padding: 0 !important;
            }
        </style>
        <?php
        foreach ($this->meta_element_object as $key => $meta_e) {
            $meta_e->render($post->ID);
        }

        // Add an nonce field so we can check for it later.
        wp_nonce_field('dMetas_', 'dMetas_nonce');
    }

    /*
     * Save meta box value
     * */
    public function save($post_id, $post)
    {
        //save data
        // Add nonce for security and authentication.
        $nonce_name = isset($_POST['dMetas_nonce']) ? $_POST['dMetas_nonce'] : '';
        $nonce_action = 'dMetas_';

        // Check if nonce is valid.
        if (!wp_verify_nonce($nonce_name, $nonce_action)) {
            return;
        }

        // Check if user has permissions to save data.
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Check if not an autosave.
        if (wp_is_post_autosave($post_id)) {
            return;
        }

        // Check if not a revision.
        if (wp_is_post_revision($post_id)) {
            return;
        }

        //save data for each meta element
        foreach ($this->meta_element_object as $meta_e) {
            $meta_e->save($post_id);
        }
    }

}