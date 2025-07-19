<?php
/**
 * Plugin Name: OFZ Maintenance Mode Redirect
 * Description: Redirects visitors to a custom maintenance page if they're not logged in or don't have admin access.
 * Version: 1.0
 * Author: One From Zero
 * Author URI: https://onefromzero.media
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * 
 * 
 * This plugin checks if the user is logged in or has the capability to edit themes.
 * If not, it redirects them to a custom maintenance page.
 * You can customize the maintenance page URL in the code below.
 * Make sure to create a page with the slug 'maintenance-mode' in your WordPress site.  
 * 
 * Usage:
 * 1. Install and activate the plugin.
 * 2. Create a page with the slug 'maintenance-mode' to display your maintenance message.       
 *  * Note: This plugin does not provide a settings page; it simply redirects users based on their login status and capabilities.
 */

// Hook into template_redirect to enforce maintenance mode
function custom_maintenance_mode_redirect() {
    if (
        !current_user_can('edit_themes') &&
        !is_user_logged_in() &&
        !is_page('maintenance-mode')
    ) {
        wp_redirect(home_url('/maintenance-mode/'));
        exit;
    }
}
add_action('template_redirect', 'custom_maintenance_mode_redirect');
