<?php
/**
 * @package TechGnosis-confetti
 */
/*
Plugin Name: TechGnosis-confetti
Plugin URI: https://webtechgnosis.com/
Description: Provides a simple shortcode for the Confetti-js library.
Version: 1.0.0
Author: Techgnosis
Author URI: https://webtechgnosis.com/
License: GPLv2 or later
Text Domain: techgnosis-confetti
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'TECHGBLOCKS_VERSION', '4.1.2' );
define( 'TECHGBLOCKS__MINIMUM_WP_VERSION', '4.0' );
define( 'TECHGBLOCKS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'TECHGBLOCKS__PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once( TECHGBLOCKS__PLUGIN_DIR . 'class.tech-blocks.php' );

add_action( 'init', array( 'TechGBlocks', 'init' ) );
