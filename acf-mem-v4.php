<?php

class acf_field_mem extends acf_field {

    public $name = 'markdown';

    public $label = 'Markdown';

    public $category = 'Basic';

    public $settings = [];

    public $defaults = [];

    public $l10n = [];

    /*
    *  __construct
    *
    *  Set name / label needed for actions / filters
    *
    *  @since   3.6
    *  @date    23/01/13
    */

    public function __construct() {
        // do not delete!
        parent::__construct();
        // settings
        $this->settings = array(
            'path' => apply_filters('acf/helpers/get_path', __FILE__),
            'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
            'version' => '1.1.4'
        );
    }


    /*
    *  create_options()
    *
    *  Create extra options for your field. This is rendered when editing a field.
    *  The value of $field['name'] can be used (like below) to save extra data to the $field
    *
    *  @type    action
    *  @since   3.6
    *  @date    23/01/13
    *
    *  @param   $field  - an array holding all the field's data
    */

    public function create_options($field) {
        // defaults?
        $field = array_merge($this->defaults, $field);
        // key is needed in the field names to correctly save the data
        $key = $field['name'];
        // Include the options template file
        include(__DIR__.'/views/options.v4.php');
    }


    /*
    *  create_field()
    *
    *  Create the HTML interface for your field
    *
    *  @param   $field - an array holding all the field's data
    *
    *  @type    action
    *  @since   3.6
    *  @date    23/01/13
    */

    public function create_field( $field ) {
        // defaults?
        $field = array_merge($this->defaults, $field);
        // Retrieve the plugin directory
        $dir = plugin_dir_url( __FILE__ );
        // Include the field template file
        include(__DIR__.'/views/field.v4.php');
    }


    /*
    *  input_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
    *  Use this action to add CSS + JavaScript to assist your create_field() action.
    *
    *  $info    http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
    *  @type    action
    *  @since   3.6
    *  @date    23/01/13
    */

    public function input_admin_enqueue_scripts() {
        // Retrieve the plugin directory URL
        $url = plugin_dir_url( __FILE__ );
        // Register vendor scripts
        wp_enqueue_script( 'medium-editor', $url.'vendors/medium-editor/js/medium-editor.min.js', []);
        wp_enqueue_script( 'mem-standalone', $url.'vendors/medium-editor-markdown/me-markdown.standalone.js', ['medium-editor']);
        // Register vendor styles
        wp_enqueue_style( 'medium-editor-min' , $url."vendors/medium-editor/css/medium-editor.min.css", array());
        // Register field scripts
        wp_enqueue_style( 'acf-field-mem' , $url."css/input.css", array());
        // Register field styles
        wp_enqueue_script( 'acf-field-mem', $url.'js/input.js', ['mem-standalone']);
    }

}


// create field
new acf_field_mem();
