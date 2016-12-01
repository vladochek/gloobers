<?php
global $user, $base_url;
drupal_add_js(drupal_get_path('theme', 'gloobers2') . '/js/jquery.jqEasyCharCounter.min.js', array('scope' => 'footer'));
$hotel_id = arg(3);
$hotel_data = getHotelDetailById($hotel_id);

/**
 * for render overview page
 */
print drupal_render($hotelForm);
?> 
<script>
    /**
     * delete optinal services
     * 
     */
    jQuery(document).ready(function () {
        jQuery("body").on("click", ".delete_optional_service", function () {
            var me = jQuery(this);
            var service_id = me.attr("data-val");
            var r = confirm("Are you sure want to delete?");
            var dataString = "method=deleteoptinal_services&service_id=" + service_id;
            if (r == true) {
                jQuery.ajax({
                    url: '<?= $base_url; ?>/hotel/ajax/deleteServices',
                    type: "post",
                    data: dataString,
                    beforeSend: function (xhr) {

                    }, success: function (data) {
                        if (data == "success") {
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });</script>