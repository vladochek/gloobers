function initMap() {

    var desktopScreen = Modernizr.mq("only screen and (min-width:1024px)"),
        zoom = desktopScreen ? 10 : 8,
        scrollable = draggable = !Modernizr.hiddenscroll || desktopScreen,
        myLatLng = {lat: 50.768525, lng: -74.075736},
        customStyles = [
            {
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [{"color": "#444444"}]
            }, {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [{"color": "#f2f2f2"}]
            }, {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "road",
                "elementType": "all",
                "stylers": [{"saturation": -100}, {"lightness": 45}]
            }, {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers": [{"visibility": "simplified"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "labels.icon",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "water",
                "elementType": "all",
                "stylers": [{"color": "#46bcec"}, {"visibility": "on"}]
            }];

    return new google.maps.Map(document.getElementById('map'), {
        zoom: zoom,
        center: myLatLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: scrollable,
        draggable: draggable,
        styles: customStyles
    });
}

function fitMapBounds(markers, map){
    var bounds = new google.maps.LatLngBounds();
//  Go through each...
    for (var i = 0; i < markers.length; i++) {
        bounds.extend(markers[i].position);
    }
//  Fit these bounds to the map
    map.fitBounds(bounds);
}
