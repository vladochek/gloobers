$(document).ready(function(e){
	/*Html Scroll*/
	$("html").niceScroll();
	/*SelectBox*/
	$("select").selectbox(); 
	$('.sbHolder').click(function(e){
		e.stopPropagation();
		}),
		$('body').click(function(e){
			$("select").selectbox('close'); 
			e.stopPropagation();
		}); //End

//Stick Header
$(window).scroll(function() {
	dHeight = $(".scroll_down").offset().top + $(".main_head").height();
	wHeight = $(window).scrollTop() + $(window).height();
	if (dHeight < wHeight) { 
		$('.loginheader').addClass('barfixed');
		}
		else{
			$('.loginheader').removeClass('barfixed');
		}
}); // End Sticky()


$('.navbar-header').click(function(e){
	$('.login_bar').toggleClass('displayblock', 10);
	e.stopPropagation();
	}),
		$('body').click(function(e){
				$('.login_bar').removeClass('displayblock');
			e.stopPropagation();
		}); //End

}); //End Document.Ready()


/*Smooth Scroll*/
$(function() {
  $('.morearrow').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});