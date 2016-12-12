jq = jQuery.noConflict();
jq(document).ready(function () {
    //Start the autocomplte js event for trip search here
    initialize_trip();

    jQuery('#start_date').datetimepicker({
        pickTime: false,
        format: 'YYYY/MM/DD'
    });
    jQuery('#end_date').datetimepicker({
        pickTime: false,
        format: 'YYYY/MM/DD'
    });

   /*  jq('.fa-chevron-down,.fa-calendar-o').on('click', function () {
        if (jq(this).hasClass('drop-menu-show')) {
            jq(this).closest('.trip-filter').find('.dropdown-menu').hide();
            jq(this).removeClass('drop-menu-show');
        } else {
            jq(this).closest('.trip-filter').find('.dropdown-menu').show();
            jq(this).addClass('drop-menu-show');
        }
    }); */

    //return curor to search box area
    jq(document).on('click', '#_search_advisor_anchor', function () {
        jq('html, body').animate({
            scrollTop: jq('#_finder_form_container').outerHeight()
        }, 800);
    });

    jq('#_filter_search_advisor').on('click', function () {

        var locationTitle = jQuery.trim(jQuery("#_trip_loction").val());
        jQuery("#_trip_loction").css('border', '1px solid #A9A9A9');
        var message = '';
        var flag = false;

        if (locationTitle.length <= 0 || locationTitle == 'Destination') {
            jQuery("#_trip_loction").css('border', '1px solid #DC3400');
            message = message + 'Please Enter Destination\n\n';
            var flag = true;
        }
        if (jQuery('[name= trip_type]:radio:checked').length <= 0) {
            message = message + 'Please Select TYPE OF TRIP\n\n';
            flag = true;
        }
        if (jQuery.trim(jQuery("#start_date").val()).length <= 0 && jQuery.trim(jQuery("#end_date").val()).length <= 0) {
            message = message + 'Please Choose Start and End Date\n\n';
            flag = true;
        }
        if (flag) {
            alert(message);
            return false;
        }

        jq.ajax({
            url: $baseUrl + '/finder/advisors_list',
            type: 'post',
            data: jq('#_advisor_form_el').serialize(),
            beforeSend: function () {
                preLoading('show', 'load-screen');
            },
            success: function (data) {
                var res = jQuery.parseJSON(data);
                if (res.status = 'success') {
                    dataHtml = data
                    jQuery('#_advisorListingBoard').html(res.html);
                }
            }, complete: function () {
                preLoading('hide', 'load-screen');
                jQuery('#_advisorListingBoard').on('load', function () {
                    alert('images loaded')
                });
                jq('html, body').animate({
                    scrollTop: (jq('#_advisorListingBoard').outerHeight())
                }, 600);
            }
        });
    });

    jq(document).bind('click', function (e) {
        if (!jq(e.target).is('.fa-sub-menu-popup') && (jq(e.target).closest('.dropdown-menu').length) <= 0) {
            jq('.fa-sub-menu-popup').closest('.trip-filter').find('.dropdown-menu').hide();
        }
    });

    function initialize_trip() {
        var home_autocomplete = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */
                        (document.getElementById('_trip_loction')),
						{types: []});
        google.maps.event.addListener(home_autocomplete, 'place_changed', function () {
        });
    }

    /*
     * 
     * @param {form} SENDING REQUEST TO ADVISOR/DECLINE REQUEST BY ADVISOR
     * @param {type} advisor/postRequest
     * @returns {json}
     */
      jQuery("#advisor_request_form").submit(function () {
      
       //$btn = (jQuery(this).find('input[type=submit]'));
        var requester_id =  jQuery('#requester_id').val();
		var request_Link =  jQuery('#dynamic').val();
        var destination= getParameterByName('dest');
        var triptype  = getParameterByName('triptype');
        var traveler = getParameterByName('traveler');
        var start_date = getParameterByName('start_date');
        var end_date = getParameterByName('end_date');
		var budget = getParameterByName('overall_budget');
        var data = "&destination="+destination +'&triptype='+triptype+'&traveler='+traveler+'&start_date='+start_date+"&end_date="+end_date+"&requester_id="+requester_id+"&budget="+budget;
        
        var url = '';
        if (jQuery('#requestID').length > 0) {
            url = $baseUrl + '/advice/ajax/decline_request';
        } else if (jQuery('#advisor_uid').length > 0) {
            url = $baseUrl + '/advice/ajax/post_request';
            
        } else {
            alert('Wrong input method');
            return false;
        }

        jQuery.ajax({
            url: url,
            type: 'post',
            data: jQuery(this).serialize()+'&filter_advisor_input='+data+'&requestLink='+request_Link,
            beforeSend: function () {
                preLoading('show', 'load-screen');
               
            },
            success: function (data) {
                console.log(data);
                var res = jQuery.parseJSON(data);
                if (res.status == 'success') {
                    preLoading('hide', 'load-screen');
                    jQuery.notify(res.message, {globalPosition: 'top center', className: 'success'});
                    if (jQuery('#requestID').length > 0) {
                        var elId = res.elt;
                       
                        jQuery('#element_' + elId).find('.green').html(res.label);
                        jQuery('#element_' + elId).find('.green').addClass('red').removeClass('green');
                        jQuery('#element_' + elId).find('.req_decline>a').remove();
                        jQuery('#element_'+elId+' .edit_recommendation_table td').not(':first').remove();
                        jQuery('#modal_advisor_request').modal('hide');
                        jQuery('#message-text').val('');
                    }
                } else {
                    preLoading('hide', 'load-screen');
                    jQuery.notify(res.message, {globalPosition: 'top center', className: 'error'});
                }
                //$btn.button('reset');

                 jQuery('#modal_advisor_request').modal('hide');
            }
        });
        return false;
    });

    jQuery('.req_massage p').on('click', function () {
        jQuery(this).css('white-space', 'normal');
    });
    
    jQuery(".listicon").click(function(event){
        event.preventDefault();
        jQuery(this).parent().parent().find(".listview").slideToggle("slow");	 
    });
    //add to wish list
    addToWishList();
});

jQuery(window).load(function(){
    //1 minute interval for notification
  /*  setInterval(function() { 
        getNotifications();
    },60000);*/
    
    if(jQuery('.flexslider').length>0){
        jQuery('.flexslider').flexslider({slideshow: false});
    }
});

//12april2016

/*getNotifications =  function(){   
    jq.ajax({
        url: $baseUrl + '/advice/notification/',
        type: 'post',
        data: {notification:1},
        beforeSend: function () {
           
        },
        success: function (data) {
            // var res = jQuery.parseJSON(data);
            // var notificationCount = (res.count>0)? res.count : '';
            // jQuery('#_my_notifications_badge').html(notificationCount);
            var res = jQuery.parseJSON(data);
            var notificationCount = (res.count>0)? res.count : '';
            var html = '<span class="count" id="_my_notifications_badge">'+notificationCount+'</span>';
            if(res.count>0)
            {
            //jQuery('.notification_block').html(html);
            jQuery('.notification_block').text(notificationCount);
            jQuery(".nav-dropdown-heading").text('Notifications('+notificationCount+')');
            }

            jQuery('#_my_notifications_badge2').text(notificationCount);
            jQuery('#noti_ajax_data').html(res.html);
        }
    });
}*/

ErrorOnImage = function (el, url) {
    jQuery(el).attr('src', url);
}

forward_request = function (uid, name) {
    jQuery('#recipient-name').val(name);
    jQuery('#advisor_uid').val(uid);
    jQuery('#modal_advisor_request').modal();
    jQuery('#filter_advisor_input').val(jQuery('#_advisor_form_el').serialize());
}

decline_request = function (rid, name) {
    jQuery('#recipient-name').val(name);
    jQuery('#requestID').val(rid);
    jQuery('#modal_advisor_request').modal();
}

editTrevelGuide = function (tgid) {
    jq.ajax({
        url: $baseUrl + '/advice/ajax/getGuideByID',
        type: 'post',
        data: {tgid : tgid,returnType:'json'},
        beforeSend: function () {
            preLoading('show', 'load-screen');
        },
        success: function (data) {
            var res = jQuery.parseJSON(data);
            jQuery('#_guideTitle').val(res.title);
            jQuery('#_guideIsPublic').val(res.is_public);
            jQuery('#_guideDescription').val(res.description);
            //jQuery('#_guideRecommendation').val(res.recommend_for_uid);
            jQuery('#_guideRecommendation').val(res.name);
            jQuery('#_guideID').val(res.tgid);
            preLoading('hide', 'load-screen');
            jq('html, body').animate({
                scrollTop: (jq('#trevelGuideForm').outerHeight())
            }, 600);
            jQuery('#headingGuideHelp').html('Update Trevel Guide');
            jQuery('#_button_submit').val('Update Guide');
        }
    });
}

addToWishList = function() {
        jQuery('.add_to_wishlist').click(function () {
            var listId = jQuery(this).attr('data-attr');
            listId = listId.split(',');
            var dom = jQuery(this);

            jq.ajax({
                type: 'POST',
                //async:false,
                url: $baseURL+"/add/wishlist",
                data: {listingId: listId[1], status: listId[0]},
                success: function (data) {
                    jQuery(dom).attr('data-attr', data.replace('-', ','));
                    var res = data.split('-');
                    if (res[0] == 1) {
                        jQuery(dom).find('i').css({'color': '#E14776', 'border': '1px solid #E14776'});
                    } else {
                        jQuery(dom).find('i').css({'color': '#FFF', 'border': '1px solid #FFF'});
                    }
                },
                error: function (data) {
                    alert("ajax error occured?" + data);
                }
            });
        });
}	