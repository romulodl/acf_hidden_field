<?php

class acf_field_hidden extends acf_field
{
    // vars
    public $settings; // will hold info such as dir / path
    public $defaults; // will hold default field options

    public function __construct()
    {
        // vars
        $this->name = 'hidden';
        $this->label = __('Hidden');
        $this->category = __("Basic",'acf'); // Basic, Content, Choice, etc
        $this->defaults = array(
            'prepend' => '',
            'append'  => ''
        );

        // do not delete!
        parent::__construct();

        // settings
        $this->settings = array(
            'path' => apply_filters('acf/helpers/get_path', __FILE__),
            'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
            'version' => '1.0.0'
        );
    }

    /*
     *  create_options()
     *
     *  Create extra options for your field. This is rendered when editing a field.
     *  The value of $field['name'] can be used (like bellow) to save extra data to the $field
     *
     *  @type    action
     *  @since   3.6
     *  @date    23/01/13
     *
     *  @param   $field  - an array holding all the field's data
     */
    public function create_options($field)
    {
        // key is needed in the field names to correctly save the data
        $key = $field['name'];
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
    public function create_field($field)
    {
        $o = array('id', 'class', 'name');
        $e = '';

        // prepend
        if ($field['prepend'] !== "") {
            $field['class'] .= ' acf-is-prepended';
            $e .= '<div class="acf-input-prepend">' . $field['prepend'] . '</div>';
        }

        // append
        if ($field['append'] !== "") {
            $field['class'] .= ' acf-is-appended';
            $e .= '<div class="acf-input-append">' . $field['append'] . '</div>';
        }

        $e .= '<div class="acf-input-wrap">';
        $e .= '<input type="hidden"';

        foreach ($o as $k) {
            $e .= ' ' . $k . '="' . esc_attr( $field[ $k ] ) . '"'; 
        }

        $e .= ' />';
        $e .= '</div>';

        echo $e;
    }
}

new acf_field_hidden();
