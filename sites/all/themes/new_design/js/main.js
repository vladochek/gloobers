$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results ? results[1] : false;
}

function paginate_advisors(advisorsOverallCount, advisorsPerPage) {
    var pagesCount = Math.ceil(advisorsOverallCount / advisorsPerPage);
    var currentPageNum = $.urlParam('page') || 1;
//        currentPageNum = 4;
    console.log(currentPageNum);


    var format = '';
    var prevClass = '';
    var nextClass = '';
    if (pagesCount >= 0 && pagesCount <= 6) {
        switch (pagesCount) {
            case 0:
                format = '< c >';
                prevClass = 'class="disabled"';
                nextClass = 'class="disabled"';
                break;
            case 1:
                format = '< c >';
                prevClass = 'class="disabled"';
                break;
            case 2:
                format = '< nc >';
                break;
            case 3:
                format = '< ncn! >';
                break;
            case 4:
                format = '< ncnn! >';
                break;
            case 5:
                format = '< nncnn! >';
                break;
            case 6:
                format = '< nnncnn! >';
                break;
        }
    } else {
        var formatEnd = '';
        var formatStart = '';
        var formatMid = 'nncnn';

        if ((pagesCount - currentPageNum) == 3) {
            formatMid = 'nnncnnn';
            formatStart = '';
        }

//            if ((pagesCount - currentPageNum) <= 3) {
//                console.log(1);
//                formatEnd = '(-)';
//            }
        if ((pagesCount - currentPageNum) < 3) {
            console.log(2);
            formatMid = 'nncnn';
            formatStart = '([-)';
            formatEnd = '(-)';
//                if((currentPageNum - 1) >= 4) {
//                    formatEnd = '(-])';
//                }
        } else {
            formatMid = 'nncnn';
//                formatStart = '([-)';
            formatEnd = '(-])';
        }

        if ((currentPageNum - 1) == 3 && pagesCount - currentPageNum == 3) {
            formatMid = 'nnncnnn';
            formatEnd = '';
        }
        if ((currentPageNum - 1) == 3 && pagesCount - currentPageNum >= 3) {
            console.log(3);
            formatMid = 'nncnn';
            formatEnd = '(-])';
            formatStart = '([-)';
        }
        if ((currentPageNum) >= 4) {
            formatStart = '([-)';
        } else {
            formatStart = '(-)';
        }

        format = '<' + formatStart + formatMid + formatEnd + '>';
    }

    if (currentPageNum == pagesCount) {
        nextClass = 'class="disabled"';
    }
    if (currentPageNum == 1) {
        prevClass = 'class="disabled"';
    }

    console.log(format);
    $("#advisors-pagination").paging(advisorsOverallCount, { // make 1337 elements navigatable
        format: format, // define how the navigation should look like and in which order onFormat() get's called
        perpage: advisorsPerPage, // show n elements per page
        lapping: 0, // don't overlap pages for the moment
        page: currentPageNum, // start at page, can also be "null" or negative
        onSelect: function (page, qw) {
            // add code which gets executed when user selects a page, how about $.ajax() or $(...).slice()?
//                console.log(this);
//                console.log(qw);
        },
        onFormat: function (type) {
            switch (type) {
                case 'block': // n and c
                    var className = 'pager-element-' + this.value;
                    if (this.value == currentPageNum) {
                        className = 'pager-element-' + this.value + ' active';
                    }
                    return '<li class="' + className + '"><span>' + this.value + '</span></li>';
                case 'next': // >
                    return '<li id="nextlink" ' + nextClass + ' ><span aria-label="Next"><i aria-hidden="true" class="gl-ico gl-ico-arrow-right"></i></span></li>';
                case 'prev': // <
                    return '<li id="prevlink" ' + prevClass + ' ><span aria-label="Previous"><i aria-hidden="true" class="gl-ico gl-ico-arrow-left"></i></span></li>';
                case 'first': // [
                    var className = 'pager-element-' + this.value;
                    if (this.value == currentPageNum) {
                        className = 'pager-element-' + this.value + ' active';
                    }
                    return '<li class="' + className + '"><span>' + this.value + '</span></li>';
                case 'last': // ]
                    var className = 'pager-element-' + this.value;
                    if (this.value == currentPageNum) {
                        className = 'pager-element-' + this.value + ' active';
                    }
                    return '<li class="' + className + '"><span>' + this.value + '</span></li>';// class="active"
                case 'left': // q
                    return 'lf';
                case 'right': // p
                    return 'rt';
                case 'fill':
                    if (this.active) {
                        return "<li><span>...</span></li>";
                    }
                    return "";
            }
        }
    });

    // $("body").on("click", "#prevlink", function () {
    //     console.log(currentPageNum);
    //     console.log(pagesCount);
    //     if (currentPageNum !== 1 && pagesCount !== 1){
    //         var prevPageNum = currentPageNum - 1;
    //         var newUrl = se.changeUrlParams('page', prevPageNum);
    //         doAdvisorsSearch(newUrl);
    //     }
    // }).on("click", "#nextlink", function () {
    //     console.log(currentPageNum);
    //     console.log(pagesCount);
    //     if (currentPageNum != pagesCount && pagesCount !== 1){
    //         var nextPageNum = currentPageNum + 1;
    //         console.log(nextPageNum);
    //         var newUrl = se.changeUrlParams('page', nextPageNum);
    //         doAdvisorsSearch(newUrl);
    //     }
    // })
}

function searchAutocompletePrompt(id) {
    var home_autocomplete = new google.maps.places.Autocomplete(
        /** @type {HTMLInputElement} */
        (document.getElementById(id)),
        {types: ['geocode']});
    var fullAddress = {
        address: false,
        city: false,
        state: false,
        country: false,
        destination: false
    };
    google.maps.event.addListener(home_autocomplete, 'place_changed', function () {
        var place = home_autocomplete.getPlace();
        var arrAddress = place.address_components;
        fullAddress['destination'] = place.formatted_address;
        for (var i = 0; i < arrAddress.length; i++) {
            var addressType = arrAddress[i].types[0];
            switch (addressType) {
                case "route" :
                    fullAddress['address'] = arrAddress[i].long_name;
                    break;
                case "locality" :
                    fullAddress['city'] = arrAddress[i].long_name;
                    break;
                case "administrative_area_level_1" :
                    fullAddress['state'] = arrAddress[i].long_name;
                    break;
                case "country" :
                    fullAddress['country'] = arrAddress[i].long_name;
                    break;
            }
        }
        var newUrl = se.changeUrlParams(fullAddress);
        doAdvisorsSearch(newUrl);
    });
}

function hometowngeocode(id) {

    var home_autocomplete = new google.maps.places.Autocomplete(
        /** @type {HTMLInputElement} */

        (document.getElementById(id)),

        {types: ['geocode']});

    var fullAddress = {
        address: false,
        city: false,
        state: false,
        country: false
    };


    switch (id) {
        case 'destination-hotel':
            var searchType = 'hotels';
            break;
        case 'destination-advisor':
            var searchType = 'advisor';
            break;
        case 'destination-activity':
            var searchType = 'activity';
            break;
        default:
            var searchType = 'hotels';
    }

    home_autocomplete.addListener('place_changed', function () {
        var place = home_autocomplete.getPlace();
        var arrAddress = place.address_components;

        for (var i = 0; i < arrAddress.length; i++) {
            var addressType = arrAddress[i].types[0];
            switch (addressType) {
                case "route" :
                    fullAddress['address'] = arrAddress[i].long_name;
                    break;
                case "locality" :
                    fullAddress['city'] = arrAddress[i].long_name;
                    break;
                case "administrative_area_level_1" :
                    fullAddress['state'] = arrAddress[i].long_name;
                    break;
                case "country" :
                    fullAddress['country'] = arrAddress[i].long_name;
                    break;
            }
        }
        $('#country-' + searchType).val(fullAddress['country']);
        $('#state-' + searchType).val(fullAddress['state']);
        $('#city-' + searchType).val(fullAddress['city']);
        $('#address-' + searchType).val(fullAddress['address']);
        console.log(fullAddress);
    });


}


$(document).ready(function () {

    $('.testimonials-carousel').slick({
        centerMode: true,
        slidesToShow: 5,
        swipeToSlide: true,
        arrows: false,
        variableWidth: true,
        focusOnSelect: true,
        asNavFor: '.slider-for'
    });

    $('.slider-for').slick({
        slidesToShow: 1,
        arrows: false,
        fade: true,
        draggable: false,
        swipe: false,
        touchMove: false
        //adaptiveHeight: true
    });

    $('.main-slider').slick({
        slidesToShow: 1,
        fade: true,
        arrows: true,
        prevArrow: '<a href="#" class="btn-prev"><i class="gl-ico gl-ico-arrow-left"></i></a>',
        nextArrow: '<a href="#" class="btn-next"><i class="gl-ico gl-ico-arrow-right"></i></a>',
        /*draggable: false,
         swipe: false,
         touchMove: false*/
    });

    $("[data-toggle=popover]").popover({
        html: true,
        content: function () {
            return $($(this).data("popoverHtmlId")).html();
        }
    }).on('shown.bs.popover', function (e) {
        var popover = $(this);

        $(document).on("click", '.popover .lnk-close', function () {
            popover.popover('hide');
            return false;
        });

    });

    $('.search-tabs .radio').click(function () {
        $("[data-toggle=popover]").popover('hide');
        $(this).tab('show');
    });


    $('.how-slider')
        .slick({
            slidesToShow: 1,
            arrows: false
        })
        .on('afterChange', function (event, slick, currentSlide, nextSlide) {
            $('.slider-tabs li').removeClass("active").eq(currentSlide).addClass("active");
        });

    $('.slider-tabs li').each(function (i) {
        $(this).click(function () {
            $('.slider-tabs li').removeClass("active");
            $(this).addClass("active");
            $('.slider').slick('slickGoTo', i);
        })
    });


    $('.search-tabs .radio input').click(function () {
        $('#submit-btn').attr('form', $(this).val());
    });

    var selectedRadio = $('input[name=search-tabs]:checked').val();
    $('#submit-btn').attr('form', selectedRadio);


    $(document).on("click", '#adult-minus', function () {
        $(this).parent().parent().find("#adult-cnt").html(function (i, oldval) {
            if (oldval > 1) {
                $('#all-persons-cnt').html(function (i, oldval) {
                    return --oldval;
                });
                $('#adults-count').val(function (i, oldval) {
                    return --oldval;
                });
                return --oldval;
            }
        });
    });

    $(document).on("click", '#adult-plus', function () {
        $(this).parent().parent().find("#adult-cnt").html(function (i, oldval) {
            $('#all-persons-cnt').html(function (i, oldval) {
                return ++oldval;
            });
            $('#adults-count').val(function (i, oldval) {
                return ++oldval;
            });
            return ++oldval;
        });
    });

    $(document).on("click", '#children-minus', function () {
        $(this).parent().parent().find("#children-cnt").html(function (i, oldval) {
            if (oldval > 0) {
                $('#all-persons-cnt').html(function (i, oldval) {
                    return --oldval;
                });
                $('#childrens-count').val(function (i, oldval) {
                    return --oldval;
                });
                return --oldval;
            }
        });
    });

    $(document).on("click", '#children-plus', function () {
        $(this).parent().parent().find("#children-cnt").html(function (i, oldval) {
            $('#all-persons-cnt').html(function (i, oldval) {
                return ++oldval;
            });
            $('#childrens-count').val(function (i, oldval) {
                return ++oldval;
            });
            return ++oldval;
        });
    });


    $(document).on("click", '#persons-minus, #persons-minus-advisor', function () {
        $(this).parent().parent().find(".persons-cnt").html(function (i, oldval) {
            if (oldval > 1) {
                $('.persons-cnt').html(function (i, oldval) {
                    return --oldval;
                });
                $('#persons-count, #persons-count-advisor').val(function (i, oldval) {
                    return --oldval;
                });
                return --oldval;
            }
        });
    });

    $(document).on("click", '#persons-plus, #persons-plus-advisor', function () {
        $(this).parent().parent().find(".persons-cnt").html(function (i, oldval) {
            $('.persons-cnt').html(function (i, oldval) {
                return ++oldval;
            });
            $('#persons-count, #persons-count-advisor').val(function (i, oldval) {
                return ++oldval;
            });
            return ++oldval;
        });
    });

    // $('.date-range-input').daterangepicker({
    //     "autoApply": true,
    //     "showCustomRangeLabel": false,
    //     "startDate": "12/16/2016",
    //     "endDate": "12/22/2016"
    // }, function(start, end, label) {
    //     console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    // });
    var startDate = moment();
    var endDate = moment().add(2, 'days');
    $('#calendar-activity').daterangepicker({
        "autoUpdateInput": false,
        "showCustomRangeLabel": false,
        "startDate": startDate,
        "endDate": endDate,
        "minDate": startDate,
        "dateLimit": {
            "days": 60
        },
        "autoApply": true,
        "opens": "left"
    }, function (start, end, label) {
        $('.date-range-input').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    });

    $('#calendar-hotel').daterangepicker({
        "autoUpdateInput": false,
        "showCustomRangeLabel": false,
        "startDate": startDate,
        "endDate": endDate,
        "minDate": startDate,
        "dateLimit": {
            "days": 30
        },
        "autoApply": true,
        "opens": "left"
    }, function (start, end, label) {
        $('.date-range-input').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    });

    $('#calendar-advisor').daterangepicker({
        "autoUpdateInput": false,
        "showCustomRangeLabel": false,
        "startDate": startDate,
        "endDate": endDate,
        "minDate": startDate,
        "autoApply": true,
        "opens": "left"
    }, function (start, end, label) {
        $('.date-range-input').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    });


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

                content = $('drop-content').html() || $elm.next('.drop-content').html();

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

    $(function () {

        var eventDate = moment();

        function setDate(eventDate) {
            $('#eventCalendar span').html(eventDate.format('DD/MM/YYYY'));
        }

        $('#eventCalendar').daterangepicker({
            singleDatePicker: true
        }, setDate)
            .on("click", function () {
                return false;
            });

        setDate(eventDate);

    });


    /*(function () {

     //  the data that powers the bar chart, a simple array of numeric values
     var chartdata = [40, 60, 80, 100, 70, 120, 100, 60, 70, 150, 120, 140];

     //  the size of the overall svg element
     var height = 200,
     width = 720,

     //  the width of each bar and the offset between each bar
     barWidth = 40,
     barOffset = 20;


     d3.select('#chart').append('svg')
     .attr('width', width)
     .attr('height', height)
     .style('background', '#dff0d8')
     .selectAll('rect').data(chartdata)
     .enter().append('rect')
     .style('fill', '#3c763d')
     .attr('width', barWidth)
     .attr('height', function (data) {
     return data;
     })
     .attr('x', function (data, i) {
     return i * (barWidth + barOffset);
     })
     .attr('y', function (data) {
     return height - data;
     });

     })();*/

    // $('#ex2').slider({
    //     tooltip: 'hide'
    // });
    // $("#ex2").on("slide", function(slideEvt) {
    //     $("#price-min span").text(slideEvt.value[0]);
    //     $("#price-max span").text(slideEvt.value[1]);
    //
    // });

    //
    // (function(){
    //
    //
    //
    //     function rndArr(size) {
    //         var arr = [];
    //
    //         for (var i = 0, l = size; i < l; i++) {
    //             arr.push(Math.round(Math.random() * l))
    //         }
    //
    //         return arr;
    //     }
    //
    //     /*var chartdata = [500, 100, 10, 10, 500, 100, 10, 10, 0, 35, 1000, 0, 35, 100, 100, 500, 300, 500, 100, 10, 10, 0, 35, 2100, 1000, 500, 300, 300, 500, 100, 10, 10, 0, 35, 1000, 500, 300, 500, 100, 10, 10, 0, 35, 1000, 1000, 500, 1000, 1000, 500, 300];*/
    //
    //     var chartdata = rndArr(50),
    //         height = 35,
    //         width = '100%',
    //         persentageItemWidth = 100 / chartdata.length;
    //
    //
    //     var yScale = d3.scaleLinear()
    //         .domain([0, d3.max(chartdata)])
    //         .range([0, height]);
    //
    //
    //     var rect;
    //
    //     var awesome, dd3;
    //
    //
    //     var ww = function () {
    //
    //
    //         dd3 = d3.select('#chart').append('svg');
    //         rect = dd3
    //             .attr('width', width)
    //             .attr('height', height)
    //             .append('g')
    //             .selectAll('rect').data(chartdata);
    //
    //         chartdata = rndArr(50);
    //
    //         awesome = rect
    //             .enter().append('rect')
    //             .style('fill', '#acacac')
    //             .attr('width', persentageItemWidth + "%")
    //             .attr('x', function (data, i) {
    //                 return persentageItemWidth * i + "%";
    //             })
    //             .attr('height', 0)
    //             .attr('y', height);
    //
    //     };
    //
    //     ww();
    //
    //     var qq = function () {
    //
    //         awesome.transition()
    //             .attr('height', function (data) {
    //                 return yScale(data);
    //             })
    //             .attr('y', function (data) {
    //                 return height - yScale(data);
    //             })
    //             .delay(function (/*data,*/ i) {
    //                 return i * 10;
    //             })
    //             .duration(1000)
    //             .ease(d3.easeElastic);
    //
    //     };
    //     qq();
    //
    //     var refreshGraph = function () {
    //         var qw = rndArr(50);
    //         awesome.data(qw);
    //         qq();
    //
    //     };
    //
    //
    //
    //     $("#refresh-prices").click(function () {
    //         refreshGraph();
    //     })
    //
    //
    // })();


});


/* start map init */
/*

 var map,
 desktopScreen = Modernizr.mq( "only screen and (min-width:1024px)" ),
 zoom = desktopScreen ? 18 : 17,
 scrollable = draggable = !Modernizr.hiddenscroll || desktopScreen,
 isIE11 = !!(navigator.userAgent.match(/Trident/) && navigator.userAgent.match(/rv[ :]11/));

 function initMap() {
 var myLatLng = {lat: 50.00443710942676, lng: 36.23346689339087};
 map = new google.maps.Map(document.getElementById('map'), {
 zoom: zoom,
 center: myLatLng,
 mapTypeId: google.maps.MapTypeId.ROADMAP,
 scrollwheel: scrollable,
 draggable: draggable
 });

 var locations = [
 {
 title: 'точка раз',
 position: {lat: 50.00374184280692, lng: 36.23352648315631},
 icon: {
 url: isIE11 ? "images/ico-map-marker.png" : "images/ico-map-marker.png",//svg
 scaledSize: new google.maps.Size(53, 69)
 }

 },
 {
 title: 'точка два',
 position: {lat: 50.00506754709841, lng: 36.233161702730285},
 icon: {
 url: isIE11 ? "images/ico-map-marker.png" : "images/ico-map-marker.png",//svg
 scaledSize: new google.maps.Size(53, 69)
 }
 }
 ];

 locations.forEach( function( element, index ){
 var marker = new google.maps.Marker({
 position: element.position,
 map: map,
 title: element.title,
 icon: element.icon,
 });
 });

 }
 */

/* end map init */