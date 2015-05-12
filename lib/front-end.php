<?php if ( !defined( 'ABSPATH' ) ) { die("<h1>Forbidden</h1>"); } ?>

<div id="quick-enquiry" class="quick-enquiry">
	<div class="quick-wrapper">
		<aside id="side-label" class="side-label">
			<div>Quick enquiry</div>
		</aside>
		<p id="qe-message">Fill in your details below and we'll be in contact with you shortly.</p>
		<p class="small"><span class="asterisk">*</span> indicates a required field.</p>
		<form method="post" id="qe-form">
			<input type="hidden" name="qe-process-form" value="true" />
			<input type="text" name="qe-cap" value="" class="hid" />
			
			<label for="qe-full-name">Full name <span class="asterisk">*</span></label>
			<input data-required="true" type="text" name="qe-full-name" id="qe-full-name" />
			
			<label for="qe-phone">Phone number <span class="asterisk">*</span></label>
			<input data-required="true" type="text" name="qe-phone" id="qe-phone" />
			
			<label for="qe-email">Email address <span class="asterisk">*</span></label>
			<input data-required="true" type="text" name="qe-email" id="qe-email" />
			
			<label for="qe-postcode">Post code</label>
			<input type="text" name="qe-postcode" id="qe-postcode" />
			
			<label for="qe-message">Message <span class="asterisk">*</span></label>
			<textarea data-required="true" name="qe-message" id="qe-message"></textarea>
			
			<input type="submit" class="submit" value="Send enquiry" />
		</form>
	</div>
</div>