<?php

class acf_field_mem extends acf_field {

    public $name = 'markdown';

    public $label = 'Markdown';

    public $category = 'basic';

    public $defaults = [];

    public $l10n = [];

    /*
    *  render_field_settings()
    *
    *  Create extra settings for your field. These are visible when editing a field
    *
    *  @type    action
    *  @since   3.6
    *  @date    23/01/13
    *
    *  @param   $field (array) the $field being edited
    *  @return  n/a
    */

    function render_field_settings($field) { }

    /*
    *  render_field()
    *
    *  Create the HTML interface for your field
    *
    *  @param   $field (array) the $field being rendered
    *
    *  @type    action
    *  @since   3.6
    *  @date    23/01/13
    *
    *  @param   $field (array) the $field being edited
    *  @return  n/a
    */

    function render_field( $field ) {

        $id = 'editor_' . uniqid();

        $textareaId = $id . '_textarea';

        acf_hidden_input(array(
            'type'  => 'hidden',
            'name'  => $field['name'],
            'id'    => $textareaId,
            'value' => $field['value']
        ));
        // Include the field template file
        include(__DIR__.'/views/field.v5.php');
    }


    /*
    *  input_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
    *  Use this action to add CSS + JavaScript to assist your render_field() action.
    *
    *  @type    action (admin_enqueue_scripts)
    *  @since   3.6
    *  @date    23/01/13
    *
    *  @param   n/a
    *  @return  n/a
    */

    function input_admin_enqueue_scripts() {
        // Retrieve the plugin directory URL
        $url = plugin_dir_url( __FILE__ );
        // Register vendor scripts
        wp_enqueue_script( 'medium-editor', $url.'vendors/medium-editor/js/medium-editor.min.js', []);
        wp_enqueue_script( 'mem-standalone', $url.'vendors/medium-editor-markdown/me-markdown.standalone.js', ['medium-editor']);
        // Register vendor styles
        wp_enqueue_style( 'medium-editor-min' , $url."vendors/medium-editor/css/medium-editor.min.css", array());
        wp_enqueue_style( 'medium-editor-default' , $url."vendors/medium-editor/css/themes/default.css", array());
        // Register field scripts
        wp_enqueue_style( 'acf-field-mem' , $url."css/input.css", array());
        // Register field styles
        wp_enqueue_script( 'acf-field-mem', $url.'js/input.js', ['mem-standalone']);
    }

}


// create field
new acf_field_mem();
