

jQuery(document).ready(function(){	
		
    /************** for filter toggle **************/		
		
    jQuery(".filterbutton").click(function(){
        jQuery(".formsec").slideToggle("slow");
    });	
	
	
    /************** for filter toggle **************/		
		
    jQuery(".clickarrow").click(function(){
        jQuery(".checksec").slideToggle("slow");
    });	
	
	
    /************** for options toggle **************/
    listingClick();
	
});

jQuery(function () {
    jQuery('#datetimepicker2').datetimepicker({
        pickTime: false
    });
});

function listingClick(){
    jQuery(".listicon").click(function(event){
        event.preventDefault();
        jQuery(this).parent().parent().find(".listview").slideToggle("slow");
		 
    });
}
