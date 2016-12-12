var jQuery = jQuery.noConflict();

var $baseUrl="http://localhost/complete-gloobers";
jQuery(window).load(function () {

   jQuery(".load-screen_details").hide();
   jQuery(".load-screen_details_loginSignup").hide();
});
 jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 1){  
        jQuery('header').addClass("sticky");
    }
    else{
        jQuery('header').removeClass("sticky");
    }
 });
jQuery(document).ready(function(){
    /**
     * remove popup
     */
    jQuery(".ui-dialog-titlebar").parent().remove();
//    jQuery(".mask").remove();

//Start of Script for Sticky header
 
 /*************************************/
 /****************************************/
 jQuery('#login').on('show.bs.modal', function (event) {
  var button = jQuery(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = jQuery(this)
  modal.find('.modal-title').text('Log in with your email' + recipient)
  //modal.find('.modal-body input').val(recipient)
})

jQuery('#signup').on('show.bs.modal', function (event) {
  var button = jQuery(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = jQuery(this)
  modal.find('.modal-title').text('Sign up with your email' + recipient)
  //modal.find('.modal-body input').val(recipient)
})
/***************************Login Popup*****************************************/
jQuery("#edit-name").attr('placeholder','Enter Your Email-id');
jQuery("#edit-pass").attr('placeholder','Enter Your Password');
jQuery(document).on('click','#basic #user-login-form input[type="submit"]',function(e) {
//alert($baseURL);exit;
	e.preventDefault();
	
	var username=jQuery("#basic #user-login-form #edit-name").val();
	var pass=jQuery("#basic #user-login-form #edit-pass").val();
	if(username == ''){
		jQuery('#divErr').html('Please enter the email-id.');
	}else if(pass == ''){
		jQuery('#divErr').html('Please enter the password.');
	}else {
		jQuery('#divErr').html('');
		jQuery(".load-screen_details_loginSignup").show();
		jQuery.ajax({
				/* beforeSend: function () {
                	preLoading('show', 'load-screen');
           		 },  */
				type: 'POST',
				async:false,
				
				url : $baseURL+"/ajax/login",
				async: false,
				data : {'user':username,'pass':pass},
				
					success: function(data){	
					jQuery(".load-screen_details_loginSignup").hide();		
						var obj = jQuery.parseJSON(data);
						
						if(obj.failure)
						{
						jQuery(".load-screen_details_loginSignup").hide();		
							jQuery('#divErr').html('<strong>Please enter valid email-id or password</strong>');
							// jQuery(".modal-body .alert-message").html("");
							// jQuery(".modal-body .alert-message").show();
							// jQuery(".modal-body .alert-message").addClass("alert-danger");							
							// jQuery(".modal-body .alert-message").append('<strong>Invalid Username or Password </strong>');
						}
						else 
						{
							if(obj.success=='2'){
								window.location.href=$baseURL+'/user/confirm'
							}else{
								window.location.reload();
							}
							//window.location.reload();
							
						} 
					},
				error: function(data){
					console.log("ajax error occured…"+data);
				}		
           });
		}
});
/************************************************************************************/
jQuery(document).on('click','#slide #user-register-form input[type="submit"]',function(e) {
	e.preventDefault();

	 jQuery(".load-screen_details_loginSignup").show();
	var email=jQuery("#slide #user-register-form #edit-mail").val();
	var pass=jQuery("#slide #user-register-form #edit-pass-pass1").val();
	
	var firstname=jQuery("#slide #user-register-form #edit-field-first-name-und-0-value").val();
	var lastname=jQuery("#slide #user-register-form #edit-field-last-name-und-0-value").val();
	var Conpass=jQuery("#slide #user-register-form #edit-pass-pass2").val();
	var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	var valid = emailReg.test(email);
	var refer_id= getParameterByName('refer');
	var refered_uid= getParameterByName('ruid');
	var url      = window.location.href;  
	
	if((refer_id !='') && (refered_uid !='')){
		var refer=refer_id;
		var uid=refered_uid;
	
	}else{
		var refer=0;
		var uid=0;
	
	}
	jQuery('#divErrReg').removeClass('error_password');
	if(firstname == ''){
		jQuery('#divErrReg').html('Please fill the first name.');
		jQuery(".load-screen_details_loginSignup").hide();
	}else if(lastname == ''){
		jQuery('#divErrReg').html('Please fill the last name.');
	jQuery(".load-screen_details_loginSignup").hide();
	}else if(email == ''){
		jQuery('#divErrReg').html('Please fill the email.');
	jQuery(".load-screen_details_loginSignup").hide();
	}else if((!valid)){
		
		jQuery('#divErrReg').html('Invalid email address.');		
		jQuery(".load-screen_details_loginSignup").hide();
	}else if(pass==''){
		jQuery('#divErrReg').html('Password should not be blank.');
		jQuery(".load-screen_details_loginSignup").hide();		
	}else if (pass != Conpass){
		jQuery('#divErrReg').html('Password and confirm password should be same.');
		jQuery(".load-screen_details_loginSignup").hide();
	}else if(jQuery('#terms_and_conditions').hasClass('checked')){
		jQuery('#divErrReg').html('Please, agree on Gloobers terms & Conditions.');
		jQuery(".load-screen_details_loginSignup").hide();
	}else{
		jQuery('#divErrReg').html('');
		
		jQuery.ajax({
				
				type: 'POST',
				async:false,
				url : $baseURL+"/ajax/register",
				data : {'email':encodeURI(email),'pass':encodeURI(pass),'firstname':encodeURI(firstname),'lastname':encodeURI(lastname),'refer':encodeURI(refer),'uid':encodeURI(uid)},
				 
					success: function(data){
					console.log('1');
						jQuery(".load-screen_details_loginSignup").hide();
						var obj = jQuery.parseJSON(data);
						if(obj.failure)
						{
							//jQuery('#signup #user-register-form input[type="submit"]').removeAttr('disabled');
							jQuery('#divErrReg').html('<strong>Email already registered</strong>');
							/* jQuery("#new_signup").html("");
							jQuery("#new_signup").show();
							jQuery("#new_signup").addClass("alert-danger");							
							jQuery("#new_signup").append('<strong>Email already registered</strong>');
				 */		}else if(obj.failure_pass){
							var objMsg=obj.failure_pass;
							var err_pass=objMsg.split('.');
							//var res = objMsg.replace(".", "<br/>"); 
						//	alert(err_pass);
							
							jQuery('#divErrReg').addClass('error_password');
							jQuery('.error_password').animate({'right':'100%','bottom':'0'},1000);
							jQuery('.loin_form').css({'margin-top':'10px'});
							//jQuery('.error_password').slideDown();
							
							jQuery.each(err_pass, function( index, value ) {
								if(err_pass[index] !=''){
								  jQuery('#divErrReg').append('<span>'+value+'</span>');
								}
							});
							
				 
						}else{
							window.location.href=$baseURL+"/user/confirm";
							//window.location.reload();
							
						} 
					},
				error: function(data){
				console.log('12');
				jQuery(".load-screen_details_loginSignup").hide();		
					console.log("ajax error occured…"+data);
				}		
           });
	}
});

/* Signup Process From Page */
jQuery(document).on('click','#user-register-form--3 input[type="submit"]',function(e) {
	e.preventDefault();

	 jQuery(".load-screen_details_loginSignup").show();
	var email=jQuery("#user-register-form--3 #edit-mail--3").val();
	var pass=jQuery("#user-register-form--3 #edit-pass-pass1--3").val();
	
	var firstname=jQuery("#user-register-form--3 #edit-field-first-name-und-0-value--3").val();
	var lastname=jQuery("#user-register-form--3 #edit-field-last-name-und-0-value--3").val();
	var Conpass=jQuery("#user-register-form--3 #edit-pass-pass2--3").val();
	var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	var valid = emailReg.test(email);
	var refer_id= getParameterByName('refer');
	var refered_uid= getParameterByName('ruid');
	var url      = window.location.href;  
	
	if((refer_id !='') && (refered_uid !='')){
		var refer=refer_id;
		var uid=refered_uid;
	
	}else{
		var refer=0;
		var uid=0;
	
	}
	jQuery('#divErrReg').removeClass('error_password');
	console.log(pass);
	console.log(Conpass);
	if(firstname == ''){
		jQuery('#divErrReg').html('Please fill the first name.');
		jQuery(".load-screen_details_loginSignup").hide();
	}else if(lastname == ''){
		jQuery('#divErrReg').html('Please fill the last name.');
	jQuery(".load-screen_details_loginSignup").hide();
	}else if(email == ''){
		jQuery('#divErrReg').html('Please fill the email.');
	jQuery(".load-screen_details_loginSignup").hide();
	}else if((!valid)){
		
		jQuery('#divErrReg').html('Invalid email address.');		
		jQuery(".load-screen_details_loginSignup").hide();
	}else if(pass==''){
		jQuery('#divErrReg').html('Password should not be blank.');
		jQuery(".load-screen_details_loginSignup").hide();		
	}else if (pass != Conpass){
		jQuery('#divErrReg').html('Password and confirm password should be same.');
		jQuery(".load-screen_details_loginSignup").hide();
	}else if(jQuery('#terms_and_conditions').hasClass('checked')){
		jQuery('#divErrReg').html('Please, agree on Gloobers terms & Conditions.');
		jQuery(".load-screen_details_loginSignup").hide();
	}else{
		jQuery('#divErrReg').html('');
		
		jQuery.ajax({
				
				type: 'POST',
				async:false,
				url : $baseURL+"/ajax/register",
				data : {'email':encodeURI(email),'pass':encodeURI(pass),'firstname':encodeURI(firstname),'lastname':encodeURI(lastname),'refer':encodeURI(refer),'uid':encodeURI(uid)},
				 
					success: function(data){
						jQuery(".load-screen_details_loginSignup").hide();
						var obj = jQuery.parseJSON(data);
						if(obj.failure)
						{
							//jQuery('#signup #user-register-form input[type="submit"]').removeAttr('disabled');
							jQuery('#divErrReg').html('<strong>Email already registered</strong>');
							/* jQuery("#new_signup").html("");
							jQuery("#new_signup").show();
							jQuery("#new_signup").addClass("alert-danger");							
							jQuery("#new_signup").append('<strong>Email already registered</strong>');
				 */		}else if(obj.failure_pass){
							var objMsg=obj.failure_pass;
							var err_pass=objMsg.split('.');
							//var res = objMsg.replace(".", "<br/>"); 
						//	alert(err_pass);
							
							jQuery('#divErrReg').addClass('error_password');
							jQuery('.error_password').animate({'right':'100%','bottom':'0'},1000);
							jQuery('.loin_form').css({'margin-top':'10px'});
							//jQuery('.error_password').slideDown();
							
							jQuery.each(err_pass, function( index, value ) {
								if(err_pass[index] !=''){
								  jQuery('#divErrReg').append('<span>'+value+'</span>');
								}
							});
							
				 
						}else{
							window.location.href=$baseURL+"/user/confirm";
							//window.location.reload();
							
						} 
					},
				error: function(data){
				jQuery(".load-screen_details_loginSignup").hide();		
					console.log("ajax error occured…"+data);
				}		
           });
	}
	
});

/************************Signup popup********************************************/
jQuery("#edit-mail").attr('placeholder','Enter Your Email');
jQuery("#edit-pass-pass1").attr('placeholder','Enter Your Password');
jQuery("#edit-pass-pass2").attr('placeholder','Repeat Your Password');

/**************slideToggel*******************/
jQuery(".admin-sec").click(function(){	
jQuery(".nadminmenu").slideToggle("slow");
});

});


//loading while rendering images
    var preLoading = function(type,el){
		switch(type){
            case 'show':
                //jQuery('#load-screen,#load-screen_details').fadeIn();
				jQuery('#'+el).fadeIn();
                break;
            case 'hide':
                //jQuery('#load-screen,#load-screen_details').fadeOut();
				jQuery('#'+el).fadeOut();
                jQuery('.listing_container_head').fadeIn();
                break;
            default:
                break;
            }
    }

	
	//on change of gloobers search box
    jQuery(document).on('keypress','#edit-keys',function(event){
    	if ( event.which == 13 ) {
            var search = (jQuery('#edit-keys').val()).trim();
            if(search.length<=0){
                return false;
            }
            setTimeout(function(){
                var href = $baseUrl+'/search-destination/'+search;
                window.location.href = href;
            });
        }
        
    });
		
	//on change of gloobers search box
    jQuery(document).on('click','.my-custom-search',function(){
        var search = (jQuery('#edit-keys').val()).trim();
        if(search.length<=0){
            return false;
        }
        
        /*setTimeout(function(){
            var value = jQuery('#edit-keys').val();
            value = value.replace(/,/g, "%2C");
            history.pushState(null, "A new title!", value);
            var cObj = {
                min : <?php echo $minMaxPrice['minbaseprice'] ?>,
                max : <?php echo $minMaxPrice['maxbaseprice'] ?>,
                expType : jQuery('#select_experience_type').val(),
                when : jQuery('#datetimepicker2').val(),
                person : this.value,
                place: jQuery('#edit-keys').val(),
                action : 'search'
            }
            setFilter(cObj);
        },200);*/
        
    setTimeout(function(){
            var href = $baseUrl+'/search-destination/'+search;
            window.location.href = href;
        });
		
    });
	
	jQuery(window).load(function(){
		//Loading search button while form search submit
		jQuery('#search-listings-form').on('submit',function(){
		  var $btn = jQuery(this).find('input[type=submit]').button('loading')
		});
	});

	// 8 july 2015
	
	/* jQuery(document).on('click','#slide #user-register-form input[type="submit"]',function(e) {
			terms :"required",
			keys: {  required: true, },
     });  */
	function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
	
	