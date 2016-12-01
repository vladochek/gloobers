
var jq = jQuery.noConflict();
    jq(function () {
//alert($flashPath);
			//alert($silverlite);
/********************************************************************************************************************/
jq(".form-type-plupload").plupload({
			// General settings
			runtimes : 'html5,flash,silverlight,html4',
			url : $baseURL+"/product/add/images",
	 
			// Maximum file size
			max_file_size : '5mb',
	 
			/* chunk_size: '1mb', */
	 
	 
			// Specify what files to browse for
			/* filters : [
				{title : "Image files", extensions : "jpg,gif,png"},
				{title : "Zip files", extensions : "zip,avi"}
			], */
	           /*   max_img_resolution: 400, */
			    filters: {
					min_img_resolution: 20000,
					extensions : "jpg,gif,png"
			},
			// Rename files by clicking on their titles
			rename: true,
			 
			// Sort files
			sortable: true,
	 
			// Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
			dragdrop: true,
	 
			// Views to activate
			views: {
				list: true,
				thumbs: true, // Show thumbs
				active: 'thumbs'
			},
			multipart_params : {
				"customValue" : ""
			},
			// Flash settings
			
			flash_swf_url :$flashPath,
		 
			// Silverlight settings
			silverlight_xap_url : $silverlite
		}); 
/********************************************************************************************************************/
	
		jq(".plupload_file_action1").click(function(){
		/* return false; */
			var fileID = jq(this).find(".fileID").val();
			var listingID = jq(".listing_id").val();
			var menuchahidihaiid = jq(this).parent().attr("id");

			jConfirm("Are you sure you wish to delete this photo? It's a nice one! ", 'Delete Photo', function(r) {
				if (r == true)
				{
					jq.ajax({
						beforeSend: function(){
							jq("#"+menuchahidihaiid).parent().append('<span style="color:green;font-weight:bold;font-size:15px;" class="ajax-running">Deleting...</span>');
						},
						complete: function(){
							jq("#"+menuchahidihaiid).parent().find(".ajax-complete").delay(1500).fadeOut('slow');
							jq("#"+menuchahidihaiid).delay(3000).fadeOut('slow');
						},
						type: "POST",
						url: $baseURL+"/product/add/images?action=delete-photo",
						data: { "fileID": fileID,"listingID":listingID}
					})
					.done(function( data ) {
						jq("#"+menuchahidihaiid).parent().find(".ajax-running").hide();
						jq("#"+menuchahidihaiid).parent().append('<span style="color:green;font-size:15px;font-weight:bold;" class="ajax-complete">Deleted</span>');
					});
					
/* 					self.removeFile($(e.target).closest('.plupload_file').attr('id'));
					e.preventDefault(); */
				}

			});	
		});
		
			jq( ".highlights" ).blur(function() {	
				var fileID = jq(this).parent().find('.fileID').val();
				var listingID = jq(".listing_id").val();
				var customText = jq(this).val();
			
				var menuchahidihaiid = jq(this).parent().parent().attr("class");
				jq.ajax({
					beforeSend: function(){
						jq("."+menuchahidihaiid).parent().append('<span style="color:green;font-weight:bold;font-size:15px;" class="ajax-running">Saving...</span>');
					},
					complete: function(){
						jq("."+menuchahidihaiid).parent().find(".ajax-complete").delay(2000).fadeOut('slow');
					},
					type: "POST",
					url: $baseURL+"/product/add/images?action=add-text",
					data: { "fileID": fileID, "customText": customText,"listingID":listingID }
				})
				.done(function( data ) {
					jq("."+menuchahidihaiid).parent().find(".ajax-running").hide();
					jq("."+menuchahidihaiid).parent().append('<span style="color:green;font-size:15px;font-weight:bold;" class="ajax-complete">Saved</span>');
				});
			});
			
})
 

