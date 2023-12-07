<?php
/**
 * Plugin Name: Mail Now
 * Plugin URI: https://kavavdigital.com
 * Description: 
 * Version: 6.7.0
 * Author: Octavio Martinez
 * Author URI: https://github.com/zenx5 
 * 
 */

 require "./classes/class-core-external-url.php";

register_activation_hook( __FILE__, ["FormExternalUrl", "activation"]);
register_deactivation_hook( __FILE__, ["FormExternalUrl", "deactivation"]);

add_action( 'init', ["FormExternalUrl", "init"]);

