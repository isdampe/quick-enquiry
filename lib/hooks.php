<?php if ( !defined( 'ABSPATH' ) ) { die("<h1>Forbidden</h1>"); }

function qe_enqueue_scripts() {
	
	//Register our CSS and script.
	wp_register_script("qe-verify", plugins_url() . "/quick-enquiry/assets/quick-enquiry.js");
	wp_register_style("qe-style",  plugins_url() . "/quick-enquiry/assets/quick-enquiry.css");
	
	//Enqueue them.
	wp_enqueue_script("jquery");
	wp_enqueue_script("qe-verify", false, array('jquery'), false, true);
	wp_enqueue_style("qe-style");
	
	
}
add_action("wp_enqueue_scripts", "qe_enqueue_scripts");

function qe_injecthtml() {
	
	//Include the form front end template.
	require_once 'front-end.php';
	
}
add_action("wp_footer", "qe_injecthtml");

function qe_processform() {
	
	//Process form data if there is valid POST data.
	if ( ! empty($_POST['qe-process-form']) ) {
		
		//Check antispam.
		if ( ! empty($_POST['qe-cap']) ) {
			die("-1");
		}
		
		$fields = array(
			array(
				'name' => 'qe-full-name',
				'label' => 'Full name',
				'required' => true,
				'data' => null
			),
			array(
				'name' => 'qe-phone',
				'label' => 'Phone number',
				'required' => true,
				'data' => null
			),
			array(
				'name' => 'qe-email',
				'label' => 'Email address',
				'required' => true,
				'data' => null
			),
			array(
				'name' => 'qe-postcode',
				'label' => 'Post code',
				'required' => false,
				'data' => null
			),
			array(
				'name' => 'qe-message',
				'label' => 'Message',
				'required' => true,
				'data' => null
			)
		);
		
		$new_data = array();
		
		foreach ( $fields as $field ) {
			if ( $field['required'] == true ) {
				if ( empty($_POST[$field['name']]) ) {
					die("-2");
				}
			}
			
			if ( ! empty( $_POST[$field['name']] ) ) {
				$field['data'] = stripslashes( $_POST[$field['name']] );
			}
			
			$new_data[] = $field;
			
		}
		
		$emailmsg = "A new quick enquiry has been submitted through the Quick-enquiry box on " . get_bloginfo("wpurl") . "\n\n";
		foreach( $new_data as $field ) {
			$emailmsg .= $field['label'] . ": " . $field['data'] . "\n";
		}
		
		//Send the mail.
		if ( wp_mail( get_bloginfo("admin_email"), "Quick enquiry", $emailmsg ) ) {
			die("1");
		} else {
			die("-3");
		}
		
	}
	
}
add_action("template_redirect", "qe_processform");