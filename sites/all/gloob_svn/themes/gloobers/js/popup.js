(function($) {
  Drupal.behaviors.login_popup_example = {
    attach: function(context, settings) {
      $(document).click(function(e) {
		alert("hre");
        var $target = $(e.target);
        if ($target.is('div') && ($target.attr('class') == "dr-heart")) {
          listing_popup_forms_data( 'listing_user_login', function(form_state) {
            alert(Drupal.t('Hello, @username!', {
              '@username': form_state.values.name
            }));
            window.location.reload();
          });
          e.preventDefault();
          e.stopPropagation();
          return false;
        }
      });
    }
  }
})(jQuery);