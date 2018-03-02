<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       varietycube.com
 * @since      1.0.0
 *
 * @package    Cb_Reg
 * @subpackage Cb_Reg/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <form method="post" name="regestration_options" action="options.php">
        
		<fieldset>
			<legend class="screen-reader-text"><span>Registration active</span></legend>
			<label for="regestration_active">
				<input name="" type="checkbox" id="users_can_register" value="1" />
				<span><?php esc_attr_e( 'Regeneration active', 'WpAdminStyle' ); ?></span>
			</label>
		</fieldset>
		
        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>
	
	
	<h1 class="wp-heading-inline">Registered players</h1>
	<hr class="wp-header-end">
	
	<table class="widefat">
		<thead>
			<tr>
				<th class="row-title">Jersey Number</th>
				<th class="row-title">Full Name</th>
				<th class="row-title">Positions</th>
				<th class="row-title">Teams</th>
				<th class="row-title">Height</th>
				<th class="row-title">Age/Birth date</th>
				<th class="row-title">Interesting Note</th>
				<th class="row-title">Consent</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>00</td>
				<td>Zain Ashraf</td>
				<td>Center</td>
				<td>Kangaroos</td>
				<td>5'10"</td>
				<td>03/07/1996</td>
				<td>I'm Cool</td>
				<td>I agree</td>
			</tr>
			
		</tbody>
	</table>
	
	<h1 class="wp-heading-inline"><?php echo $GLOBALS['user_date']; ?></h1>
	
</div>
