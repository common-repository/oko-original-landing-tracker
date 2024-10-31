<?php
/**
 * This file is used for setting up menu items, option pages, enable/disable functionality etc
 */

/*
 * Now let's sort all the functions
 * This one is for creating the menu item
 */
function oko_create_menu() {
	add_options_page('OKO Settings', 'OKO Settings', 'manage_options', 'oko_original_landing', 'oko_settings_options');
}

/*
 * Function for the settings page
 */
function oko_settings_options() {
	if (!current_user_can('manage_options')) {
		wp_die('You do not have sufficient permissions to access this page.');
	} ?>
	<div class="wrap">
	<?php screen_icon(); ?>
	<h2>OKO Settings</h2>
	<h3>Settings for OLT</h3>
	<form method="post" action="options.php">
	<?php settings_fields('oko_options_group'); 
	do_settings_sections('oko_options_group'); ?>
	<p>Variable Slot can only be between 1 to 5.</p>
	<table class="form-table">
		<tr valign="top">
		<th scope="row">Custom Variable Slot</th>
		<td>
			<input type="text" name="oko_variable_slot" value="<?php echo get_option('oko_variable_slot'); ?>" />
		</td>
		</tr>
	</table>
	<?php submit_button(); ?>
	</form>
	</div>
<?php
}

/*
 * Just a little validation function for the input of the settings form
 * Makes sure the number is between 1-5 and is actually a number
 */
function oko_validate($input) {
	$input = intval($input);
	if ($input > 5) {
		$input = 5;
	} elseif ($input < 1) {
		$input = 1;
	}
	return $input;
}

/*
 * Here we do the register and activation functions
 * These are called near the start and they sort out the settings fields
 * Activate function sets the default value of the field to be 1
 */
function oko_register_settings() {
	register_setting('oko_options_group', 'oko_variable_slot', 'oko_validate');
	
	// This bit adds the option value if it doesn't exist yet, should be in activate function but didn't work
	if (!get_option('oko_variable_slot')) {
		add_option('oko_variable_slot', 1);
	}
}

/*
 * For some reason this doesn't seem to work right now, leaving in for when I get around to figuring it out though
 */
function oko_activate() {
	if (!get_option('oko_variable_slot')) {
		add_option('oko_variable_slot', 1);
	}
}


/*
 * I don't know if this makes a difference but putting the hooks at the end of file makes more sense to me.
 * Sorting out all the actions and hooks etc
 */
add_action('wp_footer', 'add_snippet');
add_action('admin_menu', 'oko_create_menu');
add_action('admin_init', 'oko_register_settings');
register_activation_hook(__FILE__, 'oko_activate');
