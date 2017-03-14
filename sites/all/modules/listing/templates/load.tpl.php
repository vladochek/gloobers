<script>

    jQuery(document).ready(function () {

        jQuery("body").on("click", "#test", function () {
            jQuery.ajax({
                url: '/search-hotel/ajax',
                type: 'GET',
                data: {'recipientid': 1, 'isAjax': 1},
                success: function (result) {
                    console.log(result);
                }

            });
        });
    });</script>