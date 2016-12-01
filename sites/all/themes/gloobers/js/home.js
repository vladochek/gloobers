	jQuery( "#user-manual" ).click(function() {
		jQuery( ".user-manual" ).toggle( "slow", function() {
		 
		});
	});
	jQuery( ".share" ).click(function() {
		jQuery(this).parent().find(".quick-share").toggle( "slow", function() {
		 
		 
		});
		
	});
	
	jQuery(".select").selectBoxIt({
		showFirstOption: false,


	});
	jQuery(window).load(function() {
	jQuery('.flexslider').flexslider({slideshow: false});
		});
	jQuery("#ex2").slider({
	tooltip: 'always'
	});

	// Without JQuery
	//var slider = new Slider('#ex2', {});
	//tooltip: 'always'
 // Semicolon (;) to ensure closing of earlier scripting
    // Encapsulation
    // $ is assigned to jQuery
    ;(function($) {

         // DOM Ready
        $(function() {

            // Binding a click event
            // From jQuery v.1.7.0 use .on() instead of .bind()
            $('div.plus').bind('click', function(e) {

                // Prevents the default action to be triggered. 
                e.preventDefault();

                // Triggering bPopup when click event is fired
                $('.more-social-options').bPopup({
				 
				 	 zIndex: 101
                    , modalClose: false,
					 speed: 650,
            		transition: 'slideIn',
	    			transitionClose: 'slideBack',
					 modalColor: '#000',
					 
				
			});

            });

        });

    })(jQuery);	
	jQuery(document).ready(function () {
        jQuery('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true,   // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function(event) { // Callback function if tab is switched
                var $tab = jQuery(this);
                var $info = jQuery('#tabInfo');
                var $name = jQuery('span', $info);

                $name.text($tab.text());

                $info.show();
            }
        });

         
    });
	
	function submitExpereince()
   {
 document.getElementById("experience-listing-form").submit();
  }
  var jq=jQuery.noConflict();
	jq("#modal_trigger").leanModal({top : 200, overlay : 0.6, closeButton: ".modal_close" });
    // You can also use "$(window).load(function() {"
    jq(function () {
		
      // Slideshow 2
/*       jq("#slider2").responsiveSlides({
        auto: false,
        pager: true,
        speed: 300,
        width:100,
      }); */

		// Calling Login Form
		jq("#login_form").click(function(){
			jq(".social_login").hide();
			jq(".user_login").show();
			return false;
		});

		// Calling Register Form
		jq("#register_form").click(function(){
			jq(".social_login").hide();
			jq(".user_register").show();
			jq(".header_title").text('Register');
			return false;
		});

		// Going back to Social Forms
		jq(".back_btn").click(function(){
			jq(".user_login").hide();
			jq(".user_register").hide();
			jq(".social_login").show();
			jq(".header_title").text('Login');
			return false;
		});
		
    });
	var jq=jQuery.noConflict();
	
	jq(function () {
	 jq('#home-exp-datepicker').datepicker({minDate: 0});
	/*  jq("#home-exp-type").width('auto'); */

      jq("#slider5").responsiveSlides({
        maxwidth: 1920,
        speed: 800,
		auto: false,
        pager: true,
		 
		 
      });
	  
	  jq(".homepagevideo").colorbox({iframe:true, innerWidth:740, innerHeight:490});
	});
	function validateSearch(){
	var participants = jQuery("#exp-prtcpnt").val();
	var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
	if(participants.length>0){
		if(!numericReg.test(participants)) {
			jQuery("#exp-prtcpnt").css('border','solid 1px red');
			//$("#exp-prtcpnt").before('<span class="error error-keyup-1">Numeric characters only.</span>');
			return false;
		}
		else{
			jQuery("#exp-search-form").submit();
		}
	}
	jQuery("#exp-search-form").submit();
}
	jQuery(document).ready(function () {
	jQuery('.dr-nav').meanmenu();
		/***********************Experience Listing Search***********************************/
	jq('#select-exeperience-type').on('change', function() {
	jq('#select-exeperience-type').val(this.value).attr("selected", "selected");
	
	jq.ajax({
				type: "GET",
				url: $baseURL+"/product/ajax/getExperienceCategory",
				//dataType: "json",
				data: "typeId=" + encodeURI(this.value),
				success: function(msg){				
					jq('#select-experience-category').html('');
					jq('#exp-cat-outer .options').html('');
					 if(msg)
					{
						jq.each(msg,function(index,val){
						jq('#select-experience-category').append("<option value='"+index+"'>"+val+"</option>");
						//jq('#exp-cat-outer .options').append("<li data-val='"+index+"'><label>"+val+"</label></li>");
						jq('#exp-cat-outer .options').append("<li class='' data-val='"+index+"'><span><i></i></span><label>"+val+"</label></li>");
			
						});
						jq('#exp-cat-outer .options li').on('click',function(){
						var hiddenResult=jq('#select_result').val();
						   var dataVal=jq(this).attr("data-val");
							var elementClass = jq(this).attr("class");							
							var selectedText=jq(this).find("label").text();
							if(elementClass == ""){
							
							jq('#select-experience-category').val(dataVal).attr("selected", "selected");
							//jq('#select_result').val(dataVal+",");
								 jq(this).addClass("selected");				  
								 var placeholderClass=jq("#exp-cat-outer .SlectBox span").attr("class");
									 if (placeholderClass=="placeholder")
									 {
									 jq("#exp-cat-outer .SlectBox span").removeClass("placeholder");
									 jq("#exp-cat-outer .SlectBox span").text('');
									 }								
								  
								  if(jq("#exp-cat-outer .SlectBox span").text()!="")
								  {
								  jq("#exp-cat-outer .SlectBox span").append(","+selectedText);
								  }
								  else
								  {
								  jq("#exp-cat-outer .SlectBox span").append(selectedText);
								  }
								  
								  /****************************************************************/
								  if(hiddenResult !="" && hiddenResult.indexOf(dataVal)<0)
								  {
								  jq('#select_result').val(hiddenResult+","+dataVal);
								  }
								  else
								  {
								  jq('#select_result').val(dataVal);
								  }
								  /****************************************************************/
							}
							else{
						 	
							  var spanText=jq("#exp-cat-outer .SlectBox span").text();							
                               var splitData=spanText.split(",");
							   var finalSplitData=[];
                               if(splitData.length>1)
                                {
									for(var i=0;i<splitData.length;i++)
									{
								
										if(splitData[i]==selectedText)
										{
										continue;									 
										}
										else{
											finalSplitData.push(splitData[i]);
										}
									}
									
									 finaltext = finalSplitData.join(",");
								jq("#exp-cat-outer .SlectBox span").text(finaltext);
								
								
								
                                }
                                 else
                                {
							    /* var RemoveValue=hiddenResult.replace(dataVal,"");
							    var RemoveValues=hiddenResult.replace(dataVal+",",""); */
								
								jq("#exp-cat-outer .SlectBox span").text('Select Experience Category');
							    jq("#exp-cat-outer .SlectBox span").addClass("placeholder");
                                }	                           
								jq(this).removeClass("selected");
								/***************************************************************/
								  var hiddenData=hiddenResult.split(",");
								  var finalHiddenSplitData=[];
								  if(hiddenData.length>1)
                                  {
									for(var i=0;i<hiddenData.length;i++)
									{
								
										if(hiddenData[i]==dataVal)
										{
										continue;									 
										}
										else{
											finalHiddenSplitData.push(hiddenData[i]);
										}
									}
									
									 finalhiddentext = finalHiddenSplitData.join(",");
								    jq('#select_result').val(finalhiddentext);									
                                 }
								 else
								 {
								 jq('#select_result').val("");
								 }
								
								/***************************************************************/
							}
						}); 
					}
					else
					{
					
					jq('#select-experience-category').html('');
					jq('#exp-cat-outer .options').html('');
					jq('#select-experience-category').append('<option value="0">No Category Found</option>');
					}
					
				}
			});
			
	});
	/***********************************************************/

});
function updateViewsCount(listingID){
	jQuery.ajax({
		type: 'POST',
		async:false,
		url : $baseURL+"/experience/updateViewsCount",
		data : {'listingID':listingID},
		success: function(data){
			location.href=$baseURL+'/experience/view/'+listingID;
		},
		error: function(data){
			alert("ajax error occured…"+data);
		}
	})
}
function preloader(){
	jQuery(".loading").hide();
	jQuery(".flexslider").show();
	//document.getElementsByClassName("slider-block").style.display = "block";
}
window.onload = preloader;	
	