<?php
/**
 * Plugin Name: External Url for WP Forms
 * Plugin URI: https://zenx5.pro
 * Description: 
 * Version: 1.0.0
 * Author: Octavio Martinez
 * Author URI: https://zenx5.pro
 *
 */

 require  __DIR__."/classes/class-core-external-url.php";

register_activation_hook( __FILE__, ["FormExternalUrl", "activation"]);
register_deactivation_hook( __FILE__, ["FormExternalUrl", "deactivation"]);

add_action( 'init', ["FormExternalUrl", "init"]);

