<?php
global $base_url;
$userDetails=user_load($OverviewData['uid']);
//echo "<pre>";Print_r($bookingData);exit;


		if(!empty($rulesDetail['cancellation_policies_type'])){
				switch ($rulesDetail['cancellation_policies_type']) {
					case "Relaxed":
						$decriptionofpolicy=t('Guests will receive a full refund if they cancel at least two weeks before the start of their reservation.');
						break;
					case "Flexible":
						$decriptionofpolicy=t('Guests will receive their full refundable deposit :').'<p>'.t('A 50% refund of their paid rental costs if they cancel at least four weeks before the start of their reservation. OR').'</p><p>'.t('A 25% refund of their paid rental costs if they cancel up to two weeks before the start of their reservation.').'</p>';
						break;
					case "Moderate":
						$decriptionofpolicy=t('Guests will receive their full refundable deposit.<p> A 50% refund of their paid rental costs, if they cancel at least four weeks before the start of their reservation.').'</p>';
						break;
					case "Strict":
						$decriptionofpolicy=tt('Guests will receive their full refundable deposit :').'<p>'.t('A 50% refund of their paid rental costs if they cancel at least eight weeks before the start of their reservation OR').'</p><p>'.t('A 25% refund of their paid rental costs if they cancel up to four weeks before the start of their reservation.').'</p>';
						break;
					case "Super-Strict":
						$decriptionofpolicy=t('If the guest cancels, any money they have paid cannot be refunded.');
						break;
					case "Custom":
						$decriptionofpolicy=t('Guests will receive their full refundable deposit:').'<p>'.t($rulesDetail['amount_week'].'% refund of their paid rental costs if they cancel at least '.$rulesDetail['amount_week_rental']." ".$rulesDetail['amount_week_select']. ' prior to reservation. OR').'</p><p>'.t($rulesDetail['amount_day'].'% refund of their paid rental costs if they cancel at least '.$rulesDetail['amount_day_rental']." ".$rulesDetail['amount_day_select'].'  prior to reservation').'</p>';
					default:
					$decriptionofpolicy= t('No Cancellation policy.');
					}
		}
		else
		{
				$decriptionofpolicy=t('No Cancellation policy.');
		}
?>
<script type="text/javascript">
/* @license 
 * jQuery.print, version 1.3.0
 *  (c) Sathvik Ponangi, Doers' Guild
 * Licence: CC-By (http://creativecommons.org/licenses/by/3.0/)
 *--------------------------------------------------------------------------*/
(function ($) {
    "use strict";
    // A nice closure for our definitions
    function getjQueryObject(string){
        // Make string a vaild jQuery thing
        var jqObj = $("");
        try{
            jqObj = $(string)
                .clone();
        }catch(e){
            jqObj = $("<span />")
                .html(string);
        }
        return jqObj;
    }

    function printFrame(frameWindow){
        // Print the selected window/iframe
        var def = $.Deferred();
        try {
            setTimeout(function () {
                // Fix for IE : Allow it to render the iframe
                frameWindow.focus();
                try {
                    // Fix for IE11 - printng the whole page instead of the iframe content
                    if (!frameWindow.document.execCommand('print', false, null)) {
                        // document.execCommand returns false if it failed -http://stackoverflow.com/a/21336448/937891
                        frameWindow.print();
                    }
                } catch (e) {
                    frameWindow.print();
                }
                frameWindow.close();
                deferred.resolve();
            }, 250);
        } catch (err) {
            def.reject(err);
        }
        return def;
    }

    function printContentInNewWindow(content){
        // Open a new window and print selected content
        var w = window.open();
        w.document.write(content);
        w.document.close();
        return printFrame(w);
    }

    function isNode(o){
        /* http://stackoverflow.com/a/384380/937891 */
        return !!(typeof Node === "object" ? o instanceof Node : o && typeof o === "object" && typeof o.nodeType === "number" && typeof o.nodeName === "string");
    }
    $.print = $.fn.print = function () {
        // Print a given set of elements
        var options, $this, self = this;
        // console.log("Printing", this, arguments);
        if (self instanceof $) {
            // Get the node if it is a jQuery object
            self = self.get(0);
        }
        if (isNode(self)) {
            // If `this` is a HTML element, i.e. for
            // $(selector).print()
            $this = $(self);
            if (arguments.length > 0) {
                options = arguments[0];
            }
        } else {
            if (arguments.length > 0) {
                // $.print(selector,options)
                $this = $(arguments[0]);
                if (isNode($this[0])) {
                    if (arguments.length > 1) {
                        options = arguments[1];
                    }
                } else {
                    // $.print(options)
                    options = arguments[0];
                    $this = $("html");
                }
            } else {
                // $.print()
                $this = $("html");
            }
        }
        // Default options
        var defaults = {
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".no-print",
            iframe: true,
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred()
        };
        // Merge with user-options
        options = $.extend({}, defaults, (options || {}));
        var $styles = $("");
        if (options.globalStyles) {
            // Apply the stlyes from the current sheet to the printed page
            $styles = $("style, link, meta, title");
        } else if (options.mediaPrint) {
            // Apply the media-print stylesheet
            $styles = $("link[media=print]");
        }
        if (options.stylesheet) {
            // Add a custom stylesheet if given
            $styles = $.merge($styles, $('<link rel="stylesheet" href="' + options.stylesheet + '">'));
        }
        // Create a copy of the element to print
        var copy = $this.clone();
        // Wrap it in a span to get the HTML markup string
        copy = $("<span/>")
            .append(copy);
        // Remove unwanted elements
        copy.find(options.noPrintSelector)
            .remove();
        // Add in the styles
        copy.append($styles.clone());
        // Appedned content
        copy.append(getjQueryObject(options.append));
        // Prepended content
        copy.prepend(getjQueryObject(options.prepend));
        if (options.manuallyCopyFormValues) {
            // Manually copy form values into the HTML for printing user-modified input fields
            // http://stackoverflow.com/a/26707753
            copy.find("input, select, textarea")
                .each(function () {
                    var $field = $(this);
                    if ($field.is("[type='radio']") || $field.is("[type='checkbox']")) {
                        if ($field.prop("checked")) {
                            $field.attr("checked", "checked");
                        }
                    } else if ($field.is("select")) {
                        $field.find(":selected")
                            .attr("selected", "selected");
                    } else {
                        $field.attr("value", $field.val());
                    }
                });
        }
        // Get the HTML markup string
        var content = copy.html();
        // Notify with generated markup & cloned elements - useful for logging, etc
        try {
            options.deferred.notify('generated_markup', content, copy);
        } catch (err) {
            console.warn('Error notifying deferred', err);
        }
        // Destroy the copy
        copy.remove();
        if (options.iframe) {
            // Use an iframe for printing
            try {
                var $iframe = $(options.iframe + "");
                var iframeCount = $iframe.length;
                if (iframeCount === 0){
                    // Create a new iFrame if none is given
                    $iframe = $('<iframe height="0" width="0" border="0" wmode="Opaque"/>')
                        .prependTo('body')
                        .css({
                            "position": "absolute",
                            "top": -999,
                            "left": -999
                        });
                }
                var w, wdoc;
                w = $iframe.get(0);
                w = w.contentWindow || w.contentDocument || w;
                wdoc = w.document || w.contentDocument || w;
                wdoc.open();
                wdoc.write(content);
                wdoc.close();
                printFrame(w)
                    .done(function () {
                        // Success
                        setTimeout(function () {
                            // Wait for IE
                            if (iframeCount === 0) {
                                // Destroy the iframe if created here
                                $iframe.remove();
                            }
                        }, 100);
                    })
                    .fail(function () {
                        // Use the pop-up method if iframe fails for some reason
                        console.error("Failed to print from iframe", e.stack, e.message);
                        printContentInNewWindow(content);
                    })
                    .always(function () {
                        try {
                            options.deferred.resolve();
                        } catch (err) {
                            console.warn('Error notifying deferred', err);
                        }
                    });
            } catch (e) {
                // Use the pop-up method if iframe fails for some reason
                console.error("Failed to print from iframe", e.stack, e.message);
                printContentInNewWindow(content)
                    .always(function () {
                        try {
                            options.deferred.resolve();
                        } catch (err) {
                            console.warn('Error notifying deferred', err);
                        }
                    });
            }
        } else {
            // Use a new window for printing
            printContentInNewWindow(content)
                .always(function () {
                    try {
                        options.deferred.resolve();
                    } catch (err) {
                        console.warn('Error notifying deferred', err);
                    }
                });
        }
        return this;
    };
})(jQuery);
</script>
<style type="text/css">
@media print{
.printdiv min-wrapper{ width:80%; margin:auto;}
.printdiv{ width:100% !important; float:left !important; margin:80px 0 0 0 !important;  padding:30px 0 !important;}
.printdiv  h1{ font-size:43px !important; text-align:center !important;}
.printdiv .reserv{ float:left !important; width:100% !important;}
.printdiv .reserv p{ color:#424242 !important; text-align:center !important; font-size:29px !important;}
.printdiv a{ color:#51b8d7 !important; text-decoration:none !important;}
.printdiv .info{ text-align:center !important; color:#51b8d7 !important; font-size:29px !important; padding:10px 0 !important;}
.printdiv .confirmimg{ float:left; width:100%;}
.printdiv .confirmimg img{ width:100%; float:left !important;}
.printdiv .tourinfo{ float:left; width:100% !important;}
.printdiv .tourinfo .statusbar{ float:left !important; width:100% !important; border:1px solid #7e8075 !important; min-height:85px; padding:25px 0 !important;}
.printdiv .tourinfo .statusbar p{ font-size:22px !important; color:#424242 !important; text-align:center !important;}
.printdiv .tourinfo .statusbar p.leftalign{ text-align:left !important;}
.printdiv .tourinfo .statusbar p span{ font-weight:bold !important;}
.printdiv .tourinfo .statusbar p.title{ color:#51b8d7 !important;}
.printdiv .tourinfo.bgcolor{ background:#ebebeb !important;}
}
</style>
<div class="min-wrapper">
  <section class="confirm-sec">
    <div class="col-lg-12">
      <h1>Reservation Confirmation</h1>
      <div class="reserv">
        <p><?php echo $bookingData['booking_id']; ?></p>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 info">
		<a class="print-link no-print" href="#" onclick="jQuery('#ele1').print();">Print This Confirmation</a>
	  </div>
      <div class="col-xs-12 col-sm-6 col-md-6 info"><a href="<?php echo $base_url; ?>/booking/mailsendtoprovider">Send Via Email</a></div>
    </div>
	<?php
		$photo 	= unserialize($photos[0]["value1"]);
		$file 	= file_load($photo["fid"]);
		$imgpath = $file->uri;
		$style='summary_img_style';
	?>
	<div id="ele1" class="printdiv">
	<div class="col-lg-12 confirmimg"> <img src="<?php print image_style_url($style,$imgpath);?>" alt=" "> </div>
    <div class="col-lg-12 tourinfo">
      <div class="col-lg-12 statusbar">
        <div class="col-md-12">
          <p><span><?php echo  $bookingData['title']; ?></span></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar bgcolor">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Date</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p><?php echo  $bookingData['arrive_at_date'].' '.$bookingData['arrive_at_time'];?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar">
		<div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Travellers</span></p>
        </div>
        <div class="col-md-12  col-sm-6 col-md-6">
          <p><?php echo $bookingData['quantity']; ?> x <i class="fa fa-user"></i> (2 Adults, 2 Children)</p>
        </div>
      </div>
      <div class="col-lg-12 statusbar bgcolor">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Location</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p class="title"><?php echo $bookingData['city'].', '.$bookingData['country']; ?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Additionnal Services</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p><?php echo $bookingData['additional_services'];  ?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar bgcolor">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Operator</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p>Alex ZUBOLOV +9177225237 - alex@westbikers.com</p>
        </div>
      </div>
      <div class="col-lg-12 statusbar">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Cancellation Policy</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p><?php  echo ($rulesDetail['cancellation_policies_type'])?$rulesDetail['cancellation_policies_type'].':':''; echo $decriptionofpolicy?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar bgcolor">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Deposit</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p>$<?php  echo $bookingData['security']; ?></p>
        </div>
      </div>
      <div class="col-lg-12 statusbar">
        <div class="col-xs-12 col-sm-3 col-md-3">
          <p class="leftalign"><span>Total Amount</span></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <p><span>$<?php  echo $bookingData['total_cost']; ?></span></p>
        </div>
      </div>
    </div>
	</div>
  </section>
</div>
<div class="modal fade" id="recommend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-right:0px !important;">
  <div class="modal-dialog recommend">
    <div class="recommend2">
      <div class="modal-content loginpop">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">New message</h4>
          <p>You Are About To Recommend This Listing To A friend. You Will Be Notified As Soon As Your Friend Follows Your
            Recommendation And Rewarded After He Reviewed His Trip.</p>
        </div>
        <div class="modal-body">
          <div class="tabbable">
            <ul class="nav nav-tabs">
              <li><a href="#tab1" data-toggle="tab">Share A Link</a></li>
              <li class="active"><a href="#tab2" data-toggle="tab">Add To</a></li>
              <li><a href="#tab3" data-toggle="tab">Embed</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab1">
                <form>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">A Travel Guide</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Add Your Comment</label>
                    <textarea class="form-control" id="message-text">Why do you recommend this listing?</textarea>
                  </div>
                </form>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-default btncncl" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary btnsend">Send</button>
                </div>
              </div>
              <div class="tab-pane active" id="tab2">
                <form>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">A Travel Guide</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                </form>
              </div>
              <div class="tab-pane active" id="tab3">
                <form>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Add Your Comment</label>
                    <textarea class="form-control" id="message-text">Why do you recommend this listing?</textarea>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$('.first.circle').circleProgress({
    value: 0.98,
    //animation: false,
    fill: { color: '#00aeef' }
});
$('.second.circle').circleProgress({
    startAngle: -Math.PI / 4 * 3,
    value: 0.73,
    fill: { color: '#00aeef' }
});

$('.third.circle').circleProgress({
    startAngle: -Math.PI / 4 * 3,
    value: 0.73,
    fill: { color: '#00aeef' }
});

$('.forth.circle').circleProgress({
    startAngle: -Math.PI / 4 * 3,
    value: 0.67,
    fill: { color: '#00aeef' }
});
</script> 

<script>

jQuery(document).ready(function () {
jQuery('nav').meanmenu();
});
var jq=jQuery.noConflict();

//Start of Script for Sticky header
 jq(window).scroll(function() {
if (jq(this).scrollTop() > 1){  
jq('header').addClass("sticky");
}
else{
jq('header').removeClass("sticky");
}
});


jq(document).ready(function(){	

/************** for filter toggle **************/		

jq(".filterbutton").click(function(){
jq(".formsec").slideToggle("slow");
});	


jq(".notifi").click(function(){
jq(".ndropmenu").slideToggle("slow");
});	

jq(".admin-sec").click(function(){
jq(".nadminmenu").slideToggle("slow");
});	


/************** for filter toggle **************/		

jq(".clickarrow").click(function(){
jq(".checksec").slideToggle("slow");
});	


/************** for options toggle **************/

jq(".listicon").click(function(event){
 event.preventDefault();
 jq(this).parent().parent().find(".listview").slideToggle("slow");
 
});


jq('#recommend').on('show.bs.modal', function (event) {
  var button = jq(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = jq(this)
  modal.find('.modal-title').text('Recommend << Big Five Safari >> To A Friend' + recipient)
  //modal.find('.modal-body input').val(recipient)
})

jq(function () {
				jq('#datetimepicker1').datetimepicker({
					pickTime: false
				});
			});

/**************************For experience detail page *********Price div*************/
width = jq( window ).width();
if(width>1025)
{
	jq(window).scroll(function() {
    var scroll = jq(window).scrollTop();

    if (scroll >= 300 && scroll < 500) {
        jq(".booking-sec").addClass("darkHeader");
    }
	else if (scroll >= 500 || scroll < 300) {
		
        jq(".booking-sec").removeClass("darkHeader");
    }
	
});
}
});
</script>