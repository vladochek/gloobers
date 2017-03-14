function doAdvisorsSearch($url, changeUrl, fitBounds) {
    $.get('ajax/search-advisor' + $url).done(function (data) {
        if (changeUrl) {
            se.changeUrl($url);
        }

        $('#search_results').html(data.advisors);
        paginate_advisors(data.advisors_overall_count, data.advisors_per_page);

        if (fitBounds) {
            var locations = data.advisor_coordinates;
            var markers = [];

            var map = initMap();
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

            map.addListener('dragend', function () {
                console.log(1111);
                getAndSendBoundsData(map, false);
            });
            map.addListener('zoom_changed', function () {
                console.log(2222);
                getAndSendBoundsData(map, false);
            });
        }

    });
}

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

    $("body").on("click", "#reviews", function () {
        $("#search-type-dropdown").html('Reviews');
        var newUrl = se.changeUrlParams('search_type', 'review');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl, true);
    }).on("click", "#recommendations", function () {
        $("#search-type-dropdown").html('Recommendations');
        var newUrl = se.changeUrlParams('search_type', 'recommendation');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl, true);
    }).on("click", "#rec20", function () {
        var newUrl = se.changeUrlParams('records', '20');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl, true);
    }).on("click", "#rec50", function () {
        var newUrl = se.changeUrlParams('records', '50');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl, true);
    }).on("click", "#rec100", function () {
        var newUrl = se.changeUrlParams('records', '100');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl, true);
    }).on("click", "#rec100more", function () {
        var newUrl = se.changeUrlParams('records', '>100');
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl, true);
    }).on("rating.change", "#choose-rating", function (event, value, caption) {
        console.log(value);
        var newUrl = se.changeUrlParams('rating', value);
        console.log('ajax/search-advisor' + newUrl);
        doAdvisorsSearch(newUrl, true);
    }).on("click", "#fb-friends", function () {
        var value = $(this).hasClass('disabled') ? 1 : 0;
        var newUrl = se.changeUrlParams('fb', value);
        doAdvisorsSearch(newUrl, true);
        $(this).toggleClass("disabled");
    }).on("click", "#mutual-interests", function () {
        var value = $(this).hasClass('disabled') ? 1 : 0;
        var newUrl = se.changeUrlParams('mutual-interests', value);
        doAdvisorsSearch(newUrl, true);
        $(this).toggleClass("disabled");
    }).on("click", "#local-advisors", function () {
        var value = $(this).hasClass('disabled') ? 1 : 0;
        var newUrl = se.changeUrlParams('local', value);
        doAdvisorsSearch(newUrl, true);
        $(this).toggleClass("disabled");
    })

});

