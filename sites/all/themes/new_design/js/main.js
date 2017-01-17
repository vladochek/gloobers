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
        default: var searchType = 'hotels';
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
        $('#country-'+searchType).val(fullAddress['country']);
        $('#state-'+searchType).val(fullAddress['state'] );
        $('#city-'+searchType).val(fullAddress['city']);
        $('#address-'+searchType).val(fullAddress['address']);
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
        touchMove: false,
        //adaptiveHeight: true
    });
    $("#open-person-popover").popover({
        html: true,
        content: function () {
            return $('#popover-content').html();
        }
    });

    $(document).on("click", "#close-person-popover", function () {
        $('#open-person-popover').popover('hide');
        return false;
    });

    $("#open-person-popover01").popover({
        html: true,
        content: function () {
            return $('#popover-content01').html();
        }
    });
    $(document).on("click", "#close-person-popover01", function () {
        $('#open-person-popover01').popover('hide');
        return false;
    });

    $("#open-person-popover02").popover({
        html: true,
        content: function () {
            return $('#popover-content02').html();
        }
    });
    $(document).on("click", "#close-person-popover02", function () {
        $('#open-person-popover02').popover('hide');
        return false;
    });

    $('.search-tabs .radio').click(function () {
        $('#open-person-popover').popover('hide');
        $('#open-person-popover01').popover('hide');
        $('#open-person-popover02').popover('hide');
        $(this).tab('show');
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


    $('.slider')
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

    /*
     $("#btn-toggle").on("click", function() {
     $("#elm-expand").toggleClass("open");
     return false;
     });
     $(".lang .lang-choice").on("click", function() {
     $(this).parent().toggleClass("open");
     return false;
     });

     $('body').click(function() {
     $("#elm-expand").removeClass("open");
     $(".lang").removeClass("open");
     });

     $(".fancybox").fancybox({
     autoSize: true
     });

     // sticked elm

     var didScroll;
     var lastScrollTop = 0;
     var delta = 20;
     var elm = $('#elm-expand');
     var navbarHeight = elm.outerHeight();

     $(window).scroll(function(event) {
     didScroll = true;
     });

     setInterval(function() {
     if (didScroll) {
     hasScrolled();
     didScroll = false;
     }
     }, 250);

     function hasScrolled() {
     var st = $(this).scrollTop();
     if (Math.abs(lastScrollTop - st) <= delta)
     return;
     if (st > lastScrollTop && st > navbarHeight) {
     // Scroll Down
     elm.removeClass('sticked-down').addClass('sticked-up');
     } else {
     // Scroll Up
     if (st + $(window).height() < $(document).height()) {
     elm.removeClass('sticked-up').addClass('sticked-down');
     }
     }

     lastScrollTop = st;
     }



     // menu

     function toggleClassMenu(event) {
     var target = event.target;
     while (target != this) {
     if (target.tagName == 'A' && target.parentNode.classList.contains("has-drop")) {
     event.preventDefault();
     }
     if (target.classList.contains("has-drop")) {
     if (!target.classList.contains("open-drop")) {
     target.classList.add('open-drop');
     } else {
     target.classList.remove('open-drop');
     }
     return;
     }
     target = target.parentNode;
     }
     myMenu.classList.add("menu--animatable");
     if (!myMenu.classList.contains("menu--visible")) {
     myMenu.classList.add("menu--visible");
     } else {
     myMenu.classList.remove('menu--visible');
     }
     }

     function OnTransitionEnd() {
     myMenu.classList.remove("menu--animatable");
     }

     var myMenu = document.querySelector(".extra-nav");
     var oppMenu = document.querySelector(".menu-icon");


     myMenu.addEventListener("transitionend", OnTransitionEnd, false);
     oppMenu.addEventListener("click", toggleClassMenu, false);
     myMenu.addEventListener("click", toggleClassMenu, false);

     */

});
