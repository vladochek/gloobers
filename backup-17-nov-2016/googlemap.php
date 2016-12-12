<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script language="javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCrieeAcc8gUAxrnmM9dCO33N8X77-hkhs"></script>
<script type="text/javascript">
jQuery(document).ready(function () {

    var addresses = 'india';
    console.log(addresses);
   jQuery.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address='+addresses+'&sensor=false', null, function (data) {
           console.log(data.results[0].geometry.location);
            var p = data.results[0].geometry.location
          
            var myCenter=new google.maps.LatLng(p.lat,p.lng);
            console.log(myCenter);
            function initialize()
            {
            var mapProp = {
              center:myCenter,
              zoom:12,
              mapTypeId:google.maps.MapTypeId.ROADMAP
              };

            var map=new google.maps.Map(document.getElementById("map_canvas"),mapProp);

            var marker=new google.maps.Marker({
              position:myCenter,
              });

            marker.setMap(map);
            var infowindow = new google.maps.InfoWindow({
                            content:""+jQuery.trim(addresses)+""
               });
            google.maps.event.addListener(marker, 'click', function() {
              infowindow.open(map,marker);
            });

             
            }

            google.maps.event.addDomListener(window, 'load', initialize);
                  
          });
  
    

});
</script>



<body>
<div height="500px" width="500px" id="map_canvas"></div>
</body>
</html>

