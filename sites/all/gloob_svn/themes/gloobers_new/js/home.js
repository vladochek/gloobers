var jq = jQuery.noConflict();
jq(document).ready(function(){
//Start of Script for Sticky header
  jq(window).scroll(function() {
    if (jq(this).scrollTop() > 1){  
        jq('header').addClass("sticky");
    }
    else{
        jq('header').removeClass("sticky");
    }
 });
 /*************************************/
 jq('nav').meanmenu();
 /****************************************/
 jq('#login').on('show.bs.modal', function (event) {
  var button = jq(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = jq(this)
  modal.find('.modal-title').text('Log in with your email' + recipient)
  //modal.find('.modal-body input').val(recipient)
})

jq('#signup').on('show.bs.modal', function (event) {
  var button = jq(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = jq(this)
  modal.find('.modal-title').text('Sign up with your email' + recipient)
  //modal.find('.modal-body input').val(recipient)
})
/***************************Login Popup*****************************************/
jQuery("#edit-name").attr('placeholder','Enter Your Username');
jQuery("#edit-pass").attr('placeholder','Enter Your Password');
jQuery(document).on('click','#login #user-login-form input[type="submit"]',function(e) {
	e.preventDefault();
	var username=jQuery("#login #user-login-form #edit-name").val();
	var pass=jQuery("#login #user-login-form #edit-pass").val();
	jQuery.ajax({
				type: 'POST',
				async:false,
				url : $baseURL+"/ajax/login",
				data : {'user':username,'pass':pass},
					success: function(data){						
						var obj = jQuery.parseJSON(data);
						if(obj.failure)
						{
							jQuery(".modal-body .alert-message").html("");
							jQuery(".modal-body .alert-message").show();
							jQuery(".modal-body .alert-message").addClass("alert-danger");							
							jQuery(".modal-body .alert-message").append('<strong>Invalid Username or Password </strong>');
						}
						else 
						{
							window.location.reload();
							
						} 
					},
				error: function(data){
					console.log("ajax error occured…"+data);
				}		
           });
});
/************************************************************************************/
jQuery(document).on('click','#signup #user-register-form input[type="submit"]',function(e) {
	e.preventDefault();
	//var email=jQuery("#signup #user-register-form #edit-mail").val();
	//var pass=jQuery("#signup #user-register-form #edit-pass-pass1").val();
	//var Conpass=jQuery("#signup #user-register-form #edit-pass-pass2").val();
	//var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	//var valid = emailReg.test(email);
	/*if((!valid)){
		//alert('Invalid email address.');
		jQuery('#divErr').html('Invalid email address.');		
	}else if(pass==''){
		jQuery('#divErr').html('Password should not be blank.');
		//alert('Password should not be blank.');	
	}else if (pass!=Conpass){
		jQuery('#divErr').html('Password and confirm password should be same.');
		//alert('Password and confirm password should be same.');
	}else{*/
		jQuery('#divErr').html('');
		//jQuery('#signup #user-register-form input[type="submit"]').attr('disabled','disabled');
		jQuery.ajax({
				type: 'POST',
				async:false,
				url : $baseURL+"/ajax/register",
				data : {'email':encodeURI(email),'pass':encodeURI(pass)},
					success: function(data){
						var obj = jQuery.parseJSON(data);
						if(obj.failure)
						{
							//jQuery('#signup #user-register-form input[type="submit"]').removeAttr('disabled');
							jQuery(".modal-body .alert-message").html("");
							jQuery(".modal-body .alert-message").show();
							jQuery(".modal-body .alert-message").addClass("alert-danger");							
							jQuery(".modal-body .alert-message").append('<strong>Email already registered</strong>');
						}
						else 
						{
							window.location.reload();
							
						} 
					},
				error: function(data){
					console.log("ajax error occured…"+data);
				}		
           });
	//}
});
/************************Signup popup********************************************/
jQuery("#edit-mail").attr('placeholder','Enter Your Email');
jQuery("#edit-pass-pass1").attr('placeholder','Enter Your Password');
jQuery("#edit-pass-pass2").attr('placeholder','Repeat Your Password');
});