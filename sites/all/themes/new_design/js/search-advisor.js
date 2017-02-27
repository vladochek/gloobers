$(document).ready(function () {
    (function () {
        var init, setupDrop, _Drop;

        _Drop = Drop.createContext({
            classPrefix: 'drop'
        });

        init = function () {
            return setupDrop();
        };

        setupDrop = function () {


            return $('.open-drop').each(function () {

                var $elm, content, drop, openOn, theme, position, offset;

                $elm = $(this);
                theme = $elm.data('theme');
                openOn = $elm.data('open-on') || 'click';
                offset = $elm.data('offset') || '0 0';
                position = $elm.data('position') || 'bottom center';

                $elm.addClass(theme);

                content = $($elm.data('drop-content')).html() || $elm.next('.drop-content').html();

                return drop = new _Drop({
                    target: $elm[0],
                    classes: theme,
                    position: position,
                    constrainToWindow: true,
                    constrainToScrollParent: false,
                    openOn: openOn,
                    content: content,
                    tetherOptions: {
                        offset: offset
                    }
                });

            });
        };

        init();

    }).call(this);

    function doAdvisorsSearch($url) {
        $.get('ajax/search-advisor' + $url).done(function (data) {
            se.changeUrl($url);
            $('#search_results').html(data.advisors);
            var locations = data.advisor_coordinates;
            var markers = [];

            var map,
                desktopScreen = Modernizr.mq("only screen and (min-width:1024px)"),
                zoom = desktopScreen ? 10 : 8,
                scrollable = draggable = !Modernizr.hiddenscroll || desktopScreen,
                isIE11 = !!(navigator.userAgent.match(/Trident/) && navigator.userAgent.match(/rv[ :]11/)),
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
                    }]

            var myLatLng = {
                lat: 50.768525, lng: -74.075736
            };
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: zoom,
                center: myLatLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: scrollable,
                draggable: draggable,
                styles: customStyles
            });
            console.log(locations);



            // locations.forEach(function (element, index) {
            for (var prop in locations) {
                var position = {lat: parseFloat(locations[prop].lat), lng: parseFloat(locations[prop].lon)};
                var marker = new google.maps.Marker({
                    position: position,
                    map: map,
//                    title: element.title,
//                    icon: element.icon,
//                    label: element.label
                });
                markers.push(marker);
            }
            // });

            var bounds = new google.maps.LatLngBounds();
            //  Go through each...
            for (var i = 0; i < markers.length; i++) {
                bounds.extend(markers[i].position);
            }
            //  Fit these bounds to the map
            map.fitBounds(bounds);


        });
    }


    $("body").on("click", "#reviews", function () {
        $("#search-type-dropdown").html('Reviews');
        var newUrl = se.changeUrlParams('search_type', 'review');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl);
    }).on("click", "#recommendations", function () {
        $("#search-type-dropdown").html('Recommendations');
        var newUrl = se.changeUrlParams('search_type', 'recommendation');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl);
    }).on("click", "#rec10", function () {
        // $(this).attr('class', 'active');
        var newUrl = se.changeUrlParams('records', '10');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl);
    }).on("click", "#rec20", function () {
        // $(this).attr('class', 'active');
        var newUrl = se.changeUrlParams('records', '20');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl);
    }).on("click", "#rec50", function () {
        // $(this).attr('class', 'active');
        var newUrl = se.changeUrlParams('records', '50');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl);
    }).on("click", "#rec100", function () {
        // $(this).attr('class', 'active');
        var newUrl = se.changeUrlParams('records', '100');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl);
    }).on("click", "#rec100more", function () {
        // $(this).attr('class', 'active');
        var newUrl = se.changeUrlParams('records', '>100');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl);
    }).on("rating.change", "#choose-rating", function (event, value, caption) {
        console.log(value);
        var newUrl = se.changeUrlParams('rating', value);
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl);
    }).on("click", "#fb-friends", function () {
        var value = $(this).hasClass('disabled') ? 1 : 0;
        var newUrl = se.changeUrlParams('fb', value);
        doAdvisorsSearch(newUrl);
        $(this).toggleClass("disabled");
    }).on("click", "#mutual-interests", function () {
        var value = $(this).hasClass('disabled') ? 1 : 0;
        var newUrl = se.changeUrlParams('mutual-interests', value);
        doAdvisorsSearch(newUrl);
        $(this).toggleClass("disabled");
    }).on("click", "#local-advisors", function () {
        var value = $(this).hasClass('disabled') ? 1 : 0;
        var newUrl = se.changeUrlParams('local', value);
        doAdvisorsSearch(newUrl);
        $(this).toggleClass("disabled");
    });

});

