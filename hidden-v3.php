<?php

class acf_field_hidden extends acf_Field
{

    // vars
    var $settings, // will hold info such as dir / path
        $defaults; // will hold default field options


    /*--------------------------------------------------------------------------------------
     *
     *   Constructor
     *   - This function is called when the field class is initalized on each page.
     *   - Here you can add filters / actions and setup any other functionality for your field
     *
     *   @author Elliot Condon
     *   @since 2.2.0
     *
     *-------------------------------------------------------------------------------------*/

    function __construct($parent)
    {

        // do not delete!
        parent::__construct($parent);

        // set name / title
        $this->name = 'hidden';
        $this->title = __('Hidden');
        $this->defaults = array();

        // settings
        $this->settings = array(
            'path' => $this->helpers_get_path(__FILE__),
            'dir' => $this->helpers_get_dir(__FILE__),
            'version' => '1.0.0'
        );
    }

    /*
     *  helpers_get_path
     *
     *  @description: calculates the path (works for plugin / theme folders)
     *  @since: 3.6
     *  @created: 30/01/13
     */

    function helpers_get_path($file)
    {
        return trailingslashit(dirname($file));
    }

    /*
     *  helpers_get_dir
     *
     *  @description: calculates the directory (works for plugin / theme folders)
     *  @since: 3.6
     *  @created: 30/01/13
     */

    function helpers_get_dir($file)
    {
        $dir = trailingslashit(dirname($file));
        $count = 0;


        // sanitize for Win32 installs
        $dir = str_replace('\\', '/', $dir);


        // if file is in plugins folder
        $wp_plugin_dir = str_replace('\\', '/', WP_PLUGIN_DIR);
        $dir = str_replace($wp_plugin_dir, WP_PLUGIN_URL, $dir, $count);


        if($count < 1)
        {
            // if file is in wp-content folder
            $wp_content_dir = str_replace('\\', '/', WP_CONTENT_DIR);
            $dir = str_replace($wp_content_dir, WP_CONTENT_URL, $dir, $count);
        }


        if($count < 1)
        {
            // if file is in ??? folder
            $wp_dir = str_replace('\\', '/', ABSPATH);
            $dir = str_replace($wp_dir, site_url('/'), $dir);
        }

        return $dir;
    }


    /*--------------------------------------------------------------------------------------
     *
     *   create_options
     *   - this function is called from core/field_meta_box.php to create extra options
     *   for your field
     *
     *   @params
     *   - $key (int) - the $_POST obejct key required to save the options to the field
     *   - $field (array) - the field object
     *
     *   @author Elliot Condon
     *   @since 2.2.0
     *
     *-------------------------------------------------------------------------------------*/

    function create_options($key, $field)
    {

    }

    /*--------------------------------------------------------------------------------------
     *
     *   create_field
     *   - this function is called on edit screens to produce the html for this field
     *
     *   @author Elliot Condon
     *   @since 2.2.0
     *
     *-------------------------------------------------------------------------------------*/

    function create_field($field)
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
