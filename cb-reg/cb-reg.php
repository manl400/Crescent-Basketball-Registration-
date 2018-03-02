<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              varietycube.com
 * @since             1.0.0
 * @package           Cb_Reg
 *
 * @wordpress-plugin
 * Plugin Name:       Crescent Basketball Registration 
 * Plugin URI:        https://github.com/manl400/Crescent-Basketball-Registration-
 * Description:       Registration system for Crescent Basketball.
 * Version:           1.0.0
 * Author:            Zain Ashraf
 * Author URI:        varietycube.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cb-reg
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cb-reg-activator.php
 */
function activate_cb_reg() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cb-reg-activator.php';
	Cb_Reg_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cb-reg-deactivator.php
 */
function deactivate_cb_reg() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cb-reg-deactivator.php';
	Cb_Reg_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cb_reg' );
register_deactivation_hook( __FILE__, 'deactivate_cb_reg' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cb-reg.php';

/**
 * Sportspress API Call
 *
 */
 
global $test_name;
$test_name = "John";
 
function get_team_names () {
	$response = wp_remote_get('http://crescent-basktball.local/wp-json/sportspress/v2/teams');
	
	if( is_wp_error( $response ) ) {
		return;
	}
	
	$teams = json_decode( wp_remote_retrieve_body( $response ) );

	return $teams;
}

function complete_registration() {
	global $jersey_number, $full_name, $positions, $team, $height, $age, $interesting, $consent;
	global $user_date;
	
	$jersey_number = $_POST['jersey_number'] ;
	$full_name = $_POST['full_name'];
	$positions = $_POST['positions[]'];
	$team = $_POST['teams'];
	$height = $_POST['height'];
	$age = $_POST['age'];
	$interesting = $_POST['interesting_note'];
	$consent = $_POST['consent_release[]' ];
	
	$user_date = array($jersey_number, $full_name, $positions, $team, $height, $age, $interesting, $consent );
}



/**
 * Short Codes
 *
 */
 
 add_shortcode('cbregistration', 'cb_player_regestration_form');
 
 function cb_player_regestration_form() {
	 
	$teams = get_team_names();
	
	foreach( $teams as $team ) {
		$team_options .= '<option value=' . $team->title->rendered . ' id="' . $team->title->rendered . '">' . $team->title->rendered . '</option>';
	}
	
	$content = ' <form action="' . $_SERVER['REQUEST_URI'] . '" method= "post" id="rendered-form" wtx-context="0800CE3A-07BA-46E5-864B-6E1757397A19" >
	<div class="rendered-form">
		<div class="fb-number form-group field-jersey_number"><label for="jersey_number" class="fb-number-label">Jersey Number<span class="fb-required">*</span><span class="tooltip-element" tooltip="What is your jersey number?">?</span></label><input type="number" placeholder="00" class="form-control" name="jersey_number" min="00" max="99" id="jersey_number" title="What is your jersey number?" required="required" aria-required="true" wtx-context="62673014-D7E0-4C4B-8D6F-862ED73E3F14"></div>
		<div class="fb-text form-group field-full_name"><label for="full_name" class="fb-text-label">Full Name<span class="fb-required">*</span><span class="tooltip-element" tooltip="Write your full name.">?</span></label><input type="text" class="form-control" name="full_name" id="full_name" title="Write your full name." required="required" aria-required="true" wtx-context="49F2803F-74F4-4C9B-8979-CDCD44BC74DC"></div>
		<div class="fb-checkbox-group form-group field-positions">
			<label for="positions" class="fb-checkbox-group-label">Positions<span class="fb-required">*</span><span class="tooltip-element" tooltip="Select all positions, up too 2. ">?</span></label>
			<div class="checkbox-group">
				<div class="checkbox-inline"><input name="positions[]" id="positions-0" aria-required="true" value="Center" type="checkbox" wtx-context="0A3422E9-D6D0-4CC5-A6B4-07B209676474"><label for="positions-0">Center</label></div>
				<div class="checkbox-inline"><input name="positions[]" id="positions-1" aria-required="true" value="Forward" type="checkbox" wtx-context="E29771C7-C9AD-437C-8FEE-03D3667850EB"><label for="positions-1">Forward</label></div>
				<div class="checkbox-inline"><input name="positions[]" id="positions-2" aria-required="true" value="Forward-Center" type="checkbox" wtx-context="4A9AAD62-AF5C-44A1-BAD9-F4D9CB5D64CE"><label for="positions-2">Forward-Center</label></div>
				<div class="checkbox-inline"><input name="positions[]" id="positions-3" aria-required="true" value="Forward-Guard" type="checkbox" wtx-context="AF3E6C89-908E-4C99-8E11-18F96FB60C4C"><label for="positions-3">Forward-Guard</label></div>
				<div class="checkbox-inline"><input name="positions[]" id="positions-4" aria-required="true" value="Guard" type="checkbox" wtx-context="99236137-59B2-4725-9F79-34E2ADE1FF6E"><label for="positions-4">Guard</label></div>
				<div class="checkbox-inline"><input name="positions[]" id="positions-5" aria-required="true" value="Point-Guard" type="checkbox" wtx-context="9A482E5F-29F9-4215-9549-B109649F1003"><label for="positions-5">Point-Guard</label></div>
				<div class="checkbox-inline"><input name="positions[]" id="positions-6" aria-required="true" value="Power-Forward" type="checkbox" wtx-context="B82E473A-23A2-4A9D-8B19-CD6011905C4D"><label for="positions-6">Power-Forward</label></div>
				<div class="checkbox-inline"><input name="positions[]" id="positions-7" aria-required="true" value="Shooting-Forward" type="checkbox" wtx-context="5F544717-392A-4134-B70D-58066A655CF1"><label for="positions-7">Shooting-Forward</label></div>
				<div class="checkbox-inline"><input name="positions[]" id="positions-8" aria-required="true" value="Shooting-Guard" type="checkbox" wtx-context="86EA1877-91F5-4282-8F5A-9D7CCFE79C17"><label for="positions-8">Shooting-Guard</label></div>
				<div class="checkbox-inline"><input name="positions[]" id="positions-9" aria-required="true" value="Small-Forward" type="checkbox" wtx-context="E20AD60E-7AF8-4FDB-8AAD-0EA215EB3EE7"><label for="positions-9">Small-Forward</label></div>
			</div>
		</div>
		<div class="fb-select form-group field-teams">
			<label for="teams" class="fb-select-label">Teams<span class="fb-required">*</span><span class="tooltip-element" tooltip="Select your team">?</span></label>
			<select class="form-control" name="teams" id="teams" required="required" aria-required="true" wtx-context="CCDB4258-FC4F-4649-8541-7D3496FBA249">' . $team_options
			. '</select>
		</div>
		<div class="fb-text form-group field-height"><label for="height" class="fb-text-label">Height<span class="fb-required">*</span><span class="tooltip-element" tooltip="Enter height.">?</span></label><input type="text" placeholder="5&apos;10&quot;" class="form-control" name="height" maxlength="7" id="height" title="Enter height." required="required" aria-required="true" wtx-context="B2F15634-84D5-4057-8085-3AA6535BA0E8"></div>
		<div class="fb-date form-group field-age"><label for="age" class="fb-date-label">Age<span class="fb-required">*</span><span class="tooltip-element" tooltip="Enter birthdate">?</span></label><input type="date" class="form-control" name="age" id="age" title="Enter birthdate" required="required" aria-required="true" wtx-context="21BA5843-5261-4931-BBBF-87A5778C183D"></div>
		<div class="fb-textarea form-group field-interesting_note"><label for="interesting_note" class="fb-textarea-label">Tell us something funny/interesting about yourself?<span class="fb-required">*</span></label><textarea type="textarea" class="form-control" name="interesting_note" rows="2" id="interesting_note" required="required" aria-required="true"></textarea></div>
		<div class="">
			<h1 id="control-3975722">Consent and Release</h1>
		</div>
		<div class="">
			<h3 id="control-4107131">By virtue of registering onto the Crescent Basketball League (CBL) website to play, I hereby release all organizers, and participants (players or otherwise) of CBL and Robert F Kennedy High School (RFK), Queens HS of Teaching (QHST), PAL Facility in New Hyde Park (PAL), Junior High School 217 Robert A Van Wyck (JHS217), from any and all liability resulting from injuries or damages incurred while the registered player is participating in any gaming activities, sponsored by CBL. I accept any and all risks, and this is a formal consent that I understand all associated risks and liabilities. Additionally, my captain, as well as league organizers have spoken to each player including myself on my team concerning all associated risks and liabilities. Lastly, CBL isn’t responsible for the actions of captains and players outside of their games at RFK. QHST, and the PAL gym.&nbsp;&nbsp;</h3>
		</div>
		<div class="fb-checkbox-group form-group field-consent_release">
			<label for="consent_release" class="fb-checkbox-group-label">Consent and Release<span class="fb-required">*</span><span class="tooltip-element" tooltip="Read and accept to the consent and release.">?</span></label>
			<div class="checkbox-group">
				<div class="checkbox"><input name="consent_release[]" id="consent_release-0" required="required" aria-required="true" value="agreed" type="checkbox" wtx-context="7332C807-B222-4951-8DE4-528C9EA7D380"><label for="consent_release-0">I agree</label></div>
			</div>
		</div>
		<div class="fb-button form-group field-submit"><button type="submit" class="btn btn-primary" name="submit" style="primary" id="submit">Submit</button></div>
		<h1 class="wp-heading-inline">' .  $GLOBALS['user_date'] . '</h1>
	</div>
</form>
	 ';
	complete_registration();
	
	echo $GLOBALS['user_date'];
	
	return $content;
 }

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cb_reg() {

	$plugin = new Cb_Reg();
	$plugin->run();

}
run_cb_reg();
