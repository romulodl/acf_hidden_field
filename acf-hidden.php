<?php
/*
Plugin Name: Advanced Custom Fields: Hidden Field
Plugin URI: http://github.com/romulodl/acf_hidden_field
Description: an hidden field for ACF
Version: 1.0.0
Author: Romulo De Lazzari
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

class acf_field_hidden_plugin
{
    /*
    *  Construct
    *
    *  @description:
    *  @since: 3.6
    *  @created: 1/04/13
    */
    public function __construct()
    {
        // version 4+
        add_action('acf/register_fields', array($this, 'register_fields'));

        // version 3-
        add_action('init', array($this, 'init'), 5);
    }

    /*
    *  Init
    *
    *  @description:
    *  @since: 3.6
    *  @created: 1/04/13
    */
    public function init()
    {
        if (function_exists('register_field')) {
            register_field('acf_field_hidden', dirname(__File__) . '/hidden-v3.php');
        }
    }

    /*
    *  register_fields
    *
    *  @description:
    *  @since: 3.6
    *  @created: 1/04/13
    */
    public function register_fields()
    {
        include_once('hidden-v4.php');
    }
}

new acf_field_hidden_plugin();
