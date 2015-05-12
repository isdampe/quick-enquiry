if ( typeof $ === "undefined" ) {
	$ = jQuery;
}
if ( typeof jQuery === "undefined" ) {
	jQuery = $;
}

WebFontConfig = {
    google: { families: [ 'Open+Sans:700italic,400,600:latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s)
	});
		
jQuery(document).ready(function(){
	
	jQuery("#qe-form").css("min-height", jQuery("#qe-form").height() + "px");
	
	jQuery("#side-label").on("click", function(e){
		e.preventDefault();
		
		if ( jQuery("#quick-enquiry").hasClass("qeSlideIn") ) {
			//Fade out.
			jQuery("#quick-enquiry").addClass("qeSlideOut");
			window.setTimeout(function(){
				jQuery("#quick-enquiry").removeClass("qeSlideIn");
				jQuery("#quick-enquiry").removeClass("qeSlideOut");
			}, 501);
		} else {
			//Fade in
			jQuery("#quick-enquiry").addClass("qeSlideIn");
			window.setTimeout(function(){
				jQuery("#qe-full-name").focus();
			}, 501);
		}
		
	})
	
	jQuery("#qe-form").on("submit", function(e){
		e.preventDefault();
		
		var data;
		
		var passed = true;
		jQuery("#qe-form [data-required=true]").each(function(){
			if (! jQuery(this).val() ) {
				passed = false;
			}
		});
		
		if ( passed === false ){
			//Handle missing fields.
			jQuery("#qe-message").html( 'You need to fill in all required fields to send your enquiry.' );
			jQuery("#qe-message").addClass("asterisk");
			return;
		}
		
		data = jQuery("#qe-form").serialize();
		jQuery("#qe-form").fadeTo(250,0.5);
		jQuery("#qe-form input").prop("disabled", "disabled");
		
		jQuery.ajax({
			method: "POST",
			url: window.location.href,
			data: data
		})
		.done(function( msg ) {
			console.log(msg);
			if ( msg == "1" ) {
				jQuery("#qe-form").html('<p>Thanks, your message was sent.</p>');
				jQuery("#qe-form").fadeTo(250,1);
			} else {
				jQuery("#qe-form").html('<p>Sorry, there was an error processing your enquiry.</p>');
				jQuery("#qe-form").fadeTo(250,1);
			}
		})
		.error(function(){
			jQuery("#qe-form").html('<p>Sorry, there was an error processing your enquiry.</p>');
				jQuery("#qe-form").fadeTo(250,1);
		});

		
		
	});
	
});