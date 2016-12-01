/* 

    Author     : Tomaz Dragar

    Mail       : <tomaz@dragar.net>

    Homepage   : http://www.dragar.net

*/

/********************************************/



(function($) {

/***************************************************************/

function loading_img() {

 

	 var over = '<div class="img-overlay">' +

				'<img id="img-loading" src="'+$baseURL+'/sites/all/themes/gloobers/images/gloober-preloader.gif">' +'<span class="loading-text">LOADING...</span>'+

				'</div>';

			$(over).appendTo('body');

	 }

/***************************************************************/



  $.fn.simpleCropper = function() {



    var image_dimension_x = 300;

    var image_dimension_y = 300;

    var scaled_width = 0;

    var scaled_height = 0;

    var x1 = 0;

    var y1 = 0;

    var x2 = 0;

    var y2 = 0;

    var current_image = null;

    var aspX = 1;

    var aspY = 1;

    var file_display_area = null;

    var ias = null;

    var jcrop_api;

    var bottom_html = "<input type='file' id='fileInput' name='files[]'/><canvas id='myCanvas' style='display:none;'></canvas><div id='modal'></div><div id='preview'><div class='buttons'><div class='cancel'></div><div class='ok'></div></div></div>";

 

	$('body').append(bottom_html);

        

    //add click to element

    this.click(function() {

	

      aspX = $(this).width();

      aspY = $(this).height();

      file_display_area = $(this);

      $('#fileInput').click();

	  

    });



    $(document).ready(function() {

	

      //capture selected filename

      $('#fileInput').change(function(click) {

	 // loading_img();//new line

        imageUpload($('#preview').get(0));

	//$('#img-overlay').remove();	//new line

        // Reset input value

        $(this).val("");

      });

    

 

      //ok listener

      $('.ok').click(function() {

        var dataURL = preview();

          loading_img();

		

		

		jQuery.ajax({

			type: 'POST',

			async:false,

			url : $baseURL+"/user/update/picture",

			cache:false,

			data : {'dataURL':dataURL},

			success: function(data){

			if(data==1)

				{		

					$('#preview').delay(100).hide();

					$('#modal').hide();

					jcrop_api.destroy();

					reset();

					$('.img-overlay').remove();

				}

                 else 

                {

				alert('something went wrong');

                } 				

				

			},

			error: function(data){

				alert("ajax error occured…"+data);

			}

		})

      });



      //cancel listener

      $('.cancel').click(function(event) {

        $('#preview').delay(100).hide();

        $('#modal').hide();

        jcrop_api.destroy();

        reset();

      });

    });



    function reset() {

      scaled_width = 0;

      scaled_height = 0;

      x1 = 0;

      y1 = 0;

      x2 = 0;

      y2 = 0;

      current_image = null;

      aspX = 1;

      aspY = 1;

      file_display_area = null;

    }



    function imageUpload(dropbox) {

	  loading_img();

      var file = $("#fileInput").get(0).files[0];

      //var file = document.getElementById('fileInput').files[0];

      var imageType = /image.*/;



      if (file.type.match(imageType)) {

        var reader = new FileReader();



        reader.onload = function(e) {

		

		/*******************************************************/

		

          // Clear the current image.

          $('#photo').remove();

			jQuery("#preview img").remove();

			jQuery("#preview .jcrop-holder").remove();

          // Create a new image with image crop functionality

          current_image = new Image();

          current_image.src = reader.result;

          current_image.id = "photo";

          current_image.style['maxWidth'] = image_dimension_x + 'px';

          current_image.style['maxHeight'] = image_dimension_y + 'px';

          current_image.onload = function() {

		  $('.img-overlay').remove();

            // Calculate scaled image dimensions

            if (current_image.width > image_dimension_x || current_image.height > image_dimension_y) {

              if (current_image.width > current_image.height) {

                scaled_width = image_dimension_x;

                scaled_height = image_dimension_x * current_image.height / current_image.width;

              }

              if (current_image.width < current_image.height) {

                scaled_height = image_dimension_y;

                scaled_width = image_dimension_y * current_image.width / current_image.height;

              }

              if (current_image.width == current_image.height) {

                scaled_width = image_dimension_x;

                scaled_height = image_dimension_y;

              }

            }

            else {

              scaled_width = current_image.width;

              scaled_height = current_image.height;

            }





            // Position the modal div to the center of the screen

            $('#modal').css('display', 'block');

            var window_width = $(window).width() / 2 - scaled_width / 2 + "px";

            var window_height = $(window).height() / 2 - scaled_height / 2 + "px";



            // Show image in modal view

            $("#preview").css("top", window_height);

            $("#preview").css("left", window_width);

            $('#preview').show(500);





            // Calculate selection rect

            var selection_width = 0;

            var selection_height = 0;



            var max_x = Math.floor(scaled_height * aspX / aspY);

            var max_y = Math.floor(scaled_width * aspY / aspX);





            if (max_x > scaled_width) {

              selection_width = scaled_width;

              selection_height = max_y;

            }

            else {

              selection_width = max_x;

              selection_height = scaled_height;

            }



            ias = $(this).Jcrop({

              onSelect: showCoords,

              onChange: showCoords,

              bgColor: '#747474',

              bgOpacity: .4,

              aspectRatio: aspX / aspY,

              setSelect: [0, 0, selection_width, selection_height]

            }, function() {

              jcrop_api = this;

            });

			

			

          }

             

			 jQuery("#preview .buttons").show();

			 

			 jQuery(".err-msg").remove();

          // Add image to dropbox element

		  

          dropbox.appendChild(current_image);

		  

          //dropbox.appendChild("<div class='buttons'><div class='cancel'></div><div class='ok'></div></div>");

        }

        reader.readAsDataURL(file);



      } else {

	  jQuery("#preview img").remove();

	  jQuery("#preview .jcrop-holder").remove();

	  jQuery("#preview .buttons").hide();

	  $('.img-overlay').remove();

	  if(!$('#preview').find('img').attr('src'))

	  {

		$('#modal').hide();

	  }

	  jQuery(".err-msg").remove();

	  jQuery(".cropme").after('<div class="err-msg"><span>File Not Supported</span></div>');

      }

    }



    function showCoords(c) {

      x1 = c.x;

      y1 = c.y;

      x2 = c.x2;

      y2 = c.y2;

    }



    function preview() {

      // Set canvas

      var canvas = document.getElementById('myCanvas');

      var context = canvas.getContext('2d');



      // Delete previous image on canvas

      context.clearRect(0, 0, canvas.width, canvas.height);



      // Set selection width and height

      var sw = x2 - x1;

      var sh = y2 - y1;



      

      // Set image original width and height

      var imgWidth = current_image.naturalWidth;

      var imgHeight = current_image.naturalHeight;

	  

      // Set selection koeficient

      var kw = imgWidth / $("#preview").width();

      var kh = imgHeight / $("#preview").height();



      // Set canvas width and height and draw selection on it

      canvas.width = aspX;

      canvas.height = aspY;

      context.drawImage(current_image, (x1 * kw), (y1 * kh), (sw * kw), (sh * kh), 0, 0, aspX, aspY);



      // Convert canvas image to normal img

      var dataUrl = canvas.toDataURL("image/png");

      var imageFoo = document.createElement('img');

      imageFoo.src = dataUrl;



      // Append it to the body element

      $('#preview').delay(100).hide();

      $('#modal').hide();

      file_display_area.html('');

      file_display_area.append(imageFoo);

	  

	  $('.img-pro img').attr('src',dataUrl);

	  $('.cropme').append(imageFoo);

	  return dataUrl;

    }



    $(window).resize(function() {

      // Position the modal div to the center of the screen

      var window_width = $(window).width() / 2 - scaled_width / 2 + "px";

      var window_height = $(window).height() / 2 - scaled_height / 2 + "px";



      // Show image in modal view

      $("#preview").css("top", window_height);

      $("#preview").css("left", window_width);

    });

  }

}(jQuery));

