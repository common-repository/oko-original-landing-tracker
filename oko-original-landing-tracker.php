<?php
/**
 * Plugin Name: OKO OLT
 * Description: OKO Original Landing Tracker. A snippet of analytics code to track new visitors original landing pages. Config page for this is under Settings
 * Version: 1.0
 * Author: OKO Digital
 * Author URI: http://oko.co.uk
 */

// This function gets the snippet into a function to be inserted via hook ( add_action('wp_footer', 'add_snippet'); )
function add_snippet() { ?>
<!-- OKO Landing Page Analytics snippet -->
	<script type='text/javascript'>
		if(document.cookie.indexOf("_utma")<0) _gaq.push(['_setCustomVar', <?php echo get_option('oko_variable_slot'); ?>,'Original Landing Page',document.URL,1]);
	</script>
<?php
}

// Let's include all the functions and hooks we need
include( plugin_dir_path( __FILE__ ) . 'config.php');
