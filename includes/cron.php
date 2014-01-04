<?php
/**
 * Delightful Downloads Cron
 *
 * @package     Delightful Downloads
 * @subpackage  Includes/Cron
 * @since       1.3
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Register Cron Events
 *
 * @since  1.3
 */
function dedo_cron_register() {
	// Weekly
	if ( !wp_next_scheduled( 'dedo_cron_weekly' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'weekly', 'dedo_cron_weekly' );
	}	
}
add_action( 'admin_init', 'dedo_cron_register' );

/**
 * Weekly Events
 *
 * @since  1.3
 */
function dedo_cron_weekly() {
	// Run folder protection
	dedo_folder_protection();
}
add_action( 'dedo_cron_weekly', 'dedo_cron_weekly' );

/**
 * Add Cron Schedules
 *
 * @since  1.3
 */
function dedo_cron_schedules( $schedules ) {
	// Adds once weekly to the existing schedules.
 	$schedules['weekly'] = array(
 		'interval' => 604800,
 		'display' => __( 'Once Weekly' )
 	);

 	return $schedules;
}
add_filter( 'cron_schedules', 'dedo_cron_schedules' );