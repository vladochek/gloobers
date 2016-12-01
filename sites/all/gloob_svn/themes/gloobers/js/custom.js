jQuery(document).ready(function()
{

	jQuery(".account").click(function()
	{
	var X=jQuery(this).attr('id');
	if(X==1)
	{
	jQuery(".submenu").hide();
	jQuery(this).attr('id', '0');
	}
	else
	{
	jQuery(".submenu").show();
	jQuery(this).attr('id', '1');
	}

	});

	//Mouse click on sub menu
	jQuery(".submenu").mouseup(function()
	{
	return false
	});

	//Mouse click on my account link
	jQuery(".account").mouseup(function()
	{
	return false
	});


	//Document Click
	jQuery(document).mouseup(function()
	{
	jQuery(".submenu").hide();
	jQuery(".account").attr('id', '');
	});
	
	
	jQuery(".login-wrapper #user-login-form #edit-name").before('<span class="input-group-addon"><i class="fa fa-user"></i> </span>');
	jQuery(".login-wrapper #user-login-form #edit-pass").before('<span class="input-group-addon"><i class="fa fa-key"></i> </span>');
	
	jQuery(".login-wrapper #user-register-form #edit-name").before('<span class="input-group-addon"><i class="fa fa-user"></i> </span>');
	jQuery(".login-wrapper #user-register-form #edit-mail").before('<span class="input-group-addon"><i class="fa fa-envelope"></i> </span>');
	jQuery(".login-wrapper #user-register-form #edit-pass-pass1").before('<span class="input-group-addon"><i class="fa fa-key"></i> </span>');
	jQuery(".login-wrapper #user-register-form #edit-pass-pass2").before('<span class="input-group-addon"><i class="fa fa-key"></i> </span>');
	
	jQuery(".janrain-provider-icon-facebook").hide();

	$ = jQuery;
	
/*     var showChar = 100;
    var ellipsestext = "...";
    var moretext = "+ More";
    var lesstext = "- Less";
    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar-1, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    }); */
	
    $('.ancher-block').each(function() {
		var content = $(this).prev("p").text();
		if(content.length > 650){
			$(this).prev("p").css("height","130px").css('overflow', 'hidden'); 
			$(this).addClass('more');
			$(this).children("a").show();
		}
		else{
			$(this).children("a").hide();
		}
    });	
	$('.more a').live('click',function(){
		$(this).parent().prev("p").css("height","auto").css('overflow', 'visible'); 
		$(this).parent().removeClass("more");
		$(this).parent().addClass("less");
		$(this).text("+ Less");
	});
	$('.less a').live('click',function(){
		$(this).parent().prev("p").css("height","130px").css('overflow', 'hidden'); 
		$(this).parent().removeClass("less");
		$(this).parent().addClass("more");
		$(this).text("+ More");
	});
	
    $('.description-detail').each(function() {
		var content = $(this).prev("p").text();
		if(content.length > 150){
			$(this).prev("p").css("height","90px").css('overflow', 'hidden'); 
			$(this).addClass('rev-more');
			$(this).children("a").show();
		}
		else{
			$(this).children("a").hide();
		}
    });	
	$('.rev-more a').live('click',function(){
		$(this).parent().prev("p").css("height","auto").css('overflow', 'visible'); 
		$(this).parent().removeClass("rev-more");
		$(this).parent().addClass("rev-less");
		$(this).text("+ Less");
	});
	$('.rev-less a').live('click',function(){
		$(this).parent().prev("p").css("height","90px").css('overflow', 'hidden'); 
		$(this).parent().removeClass("rev-less");
		$(this).parent().addClass("rev-more");
		$(this).text("+ More");
	});
	
	$(".group1").colorbox({rel:'group1'});
	
});