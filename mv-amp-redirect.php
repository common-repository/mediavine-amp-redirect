<?php
/*
Plugin Name: Mediavine AMP Redirect
Plugin URI: http://mediavine.com/
Description: Redirect AMP urls to their non-amp counterparts
Version: 1.0.0
Author: mediavine
Author URI: http://mediavine.com
License: GPL2
*/

if (!class_exists('MVAMPRedirect')) {
    class MVAMPRedirect
    {
        public function __construct()
        {
            $this->init_plugin_filters();
        }

        public static function activate()
        {
        }

        public static function deactivate()
        {
        }

        public function init_plugin_filters()
        {
            add_filter( 'template_redirect', array( $this, 'redirect_amp_traffic' ), 10, 2 );
        }

        public function redirect_amp_traffic()
        {
            $url = $_SERVER['REQUEST_URI'];
            $regex = '/^(.*)\/amp\/?$/';
            preg_match($regex, $url, $matches);
            if ( $matches ) {
                wp_redirect( $matches[1] );
                exit();
            }
        }
    }
}

if (class_exists('MVAMPRedirect')) {
    // Installation and uninstallation hooks
    register_activation_hook( __FILE__, array( 'MVAMPRedirect', 'activate' ) );
    register_deactivation_hook( __FILE__, array( 'MVAMPRedirect', 'deactivate' ) );

    // instantiate the plugin class
    $MVAMPRedirect = new MVAMPRedirect();
}
