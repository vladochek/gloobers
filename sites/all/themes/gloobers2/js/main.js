/*! main.js - v0.1.1 - 2014-1-04
* http://admindesigns.com/
* Copyright (c) 2013 Admin Designs;*/

/* Primary theme functions required for
 * most of the sites vital functionality */
var Core = function () {
	
    // Init Eager JS DEMO Loading
    var runPrepJS = function () {
		var jq = jQuery.noConflict();
		jq(window).load(function() {
			
			// List of all available JS files. We're going to attempt to
			// cache them all after the first page has finished loading.
			// This is for DEMO purposes ONLY
			var scripts = {
				
				// HIGH PRIORITY
				gmap: 			 'vendor/plugins/map/gmaps.min.js',
				jquerymap:		 'vendor/plugins/gmap/jquery.ui.map.js',
				mixitup: 		 'vendor/plugins/mixitup/jquery.mixitup.min.js',
				mpopup: 		 'vendor/plugins/mfpopup/dist/jquery.magnific-popup.min.js',
				chosen:		  	 'vendor/plugins/chosen/chosen.jquery.min.js',
				moment:		 	 'vendor/plugins/daterange/moment.min.js',
				globalize:   	 'vendor/plugins/globalize/globalize.js',
	
				// FORM PICKERS
				cpicker: 	  	 'vendor/plugins/colorpicker/bootstrap-colorpicker.js',
				timepicker:      'vendor/plugins/timepicker/bootstrap-timepicker.min.js',
				datepicker:      'vendor/plugins/datepicker/bootstrap-datepicker.js',
				daterange: 	     'vendor/plugins/daterange/daterangepicker.js',
				
				// FORMS
				validate:		 'vendor/plugins/validate/jquery.validate.js',
				masked: 	 	 'vendor/plugins/jquerymask/jquery.maskedinput.min.js',
				
				// FORMS TOOLS
				holder: 	     'vendor/bootstrap/holder.js',
				tagmanager:      'vendor/plugins/tags/tagmanager.js',
				gritter:         'vendor/plugins/gritter/js/jquery.gritter.min.js',
				ladda:           'vendor/plugins/ladda/ladda.min.js',
				switcher:        'vendor/plugins/formswitch/js/bootstrap-switch.min.js',
				paginator:		 'vendor/bootstrap/paginator/src/bootstrap-paginator.js',
				knob:            'vendor/plugins/jquerydial/jquery.knob.js',
				rangeslider:     'vendor/plugins/rangeslider/jQAllRangeSliders.min.js',
				
				// MED PRIORITY - Large File sizes
				charts:       	 'js/charts.js',
				ckeditorCDN:     'http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js',
				xedit: 			 'vendor/editors/xeditable/js/bootstrap-editable.js',
				summernote:      'vendor/editors/summernote/summernote.js',
				elfinder: 		 'vendor/plugins/elfinder/js/elfinder.min.js',
				countdown:       'vendor/plugins/countdown/jquery.countdown.js',
				jcrop: 			 'vendor/plugins/imagecrop/js/jquery.Jcrop.min.js',
				imagezoom: 		 'vendor/plugins/imagezoom/jquery.elevatezoom.min.js',
				sketchpad:       'vendor/plugins/notepad/wPaint.min.js',
				scrollto: 		 'vendor/plugins/scrollto/jquery.scrollTo-1.4.3.1-min.js',
				fileupload:      'vendor/bootstrap/fileupload/fileupload.js',
				fitvids:		 'vendor/plugins/fitvids/jquery.fitvids.js'	,
				
				// LARGE IMAGES
				image1:			 'img/stock/22.jpg',
				image2: 		 'img/stock/21.jpg'
			};	

			var cacheCheck = function(o) {
				jq.each(o, function(i, p) {
					if (localStorage.getItem(i) !== 'cached') {
						jq.ajax({
							url: p,
							success: function(data) {
								localStorage.setItem(i, 'cached');
							}				
						});
					}
					else {}
				});
			}
			cacheCheck(scripts);
		});
    }
			
			
    // Init Delayed Animations
    var runDropdowns = function () {
		
		jq('.header-btns > div').on('show.bs.dropdown', function() {
				jq(this).children('.dropdown-menu').addClass('animated animated-short flipInY');
		});
		jq('.header-btns > div').on('hide.bs.dropdown', function() {
				jq(this).children('.dropdown-menu').removeClass('animated flipInY');
		});
		
    }
	
    // Init Delayed Animations
    var runAnimations = function () {

	  // if any element has ".animated-delay" we
	  // stop its animation and set a Timeout
	  jq('[data-animate]').each(function () {
		  var This = jq(this)
		  var delayTime = jq(this).data('animate')[0];
		  var delayAnimation = jq(this).data('animate')[1];
		  

 	      var delayAnimate = setTimeout(function () {
			  jq(This).removeClass('animated-delay').addClass('animated ' + delayAnimation);
		  }, delayTime); 
		  
	  });
    }
	
	
    // Init SideMenu Functions
    var runSideMenu = function () {

        // Collapse Side Menu on Click
        jq(".sidebar-toggle").click(toggleSideMenu);
		
        // Adds a single class to body which we use to
        // collapse entire side menu via preset CSS
        function toggleSideMenu() {
            if (jq('body').hasClass('sidebar-collapsed')) {
                jq('body').removeClass('sidebar-collapsed');
            } 
			else {jq('body').addClass('sidebar-collapsed');}
        }

        // If window is under 1200 we remove the sidemenu collapsed class
        // At <1200px CSS media queries will take over and JS will only interfere
        jq(window).resize(function () {
            if (jq(window).width() < 1200) {
                if (jq('body').hasClass('sidebar-collapsed')) {
                    jq('body').removeClass('sidebar-collapsed');
                }
            }
        });

        //SideMenu animated accordion toggle
        jq('#sidebar-menu .sidebar-nav a.accordion-toggle').click(function (e) {
            e.preventDefault();
			
            var SubMenus = jq('#sidebar-menu ul.sub-nav'),
                MenuUrl = jq(this).attr('href');
				
            if (jq(this).hasClass('collapsed')) {
				
                // To create accordion effect we collapse all open menus
                jq('#sidebar-menu .sidebar-nav > li > a.accordion-toggle').addClass('collapsed');
                jq(SubMenus).slideUp('fast');
				
                // When effect is complete we remove ".menu-open" class
                jq(SubMenus).promise().done(function () {
                    jq(SubMenus).removeClass('menu-open');
                });
				
				// We now open the targeted menu item.
                jq(this).removeClass('collapsed');
                jq(MenuUrl).slideDown('fast', function () {
                    // after the animation we apply the "menu-open" class. 
					// The animation leaves an inline "display:block" style.
					// We remove this as it interferes with media queries 
                    jq(MenuUrl).addClass('menu-open').attr('style', '');
                });
            } else {
                jq(this).addClass('collapsed');
                jq(MenuUrl).slideUp('fast', function () {
                    jq(MenuUrl).removeClass('menu-open');
                });
            }
        });
    }

    // Init Form Functions 
    var runTooltips = function () {
        // Init Bootstrap tooltips, if present 
        if (jq("[data-toggle=tooltip]").length) {
            jq('[data-toggle=tooltip]').tooltip();
        }
    }

    var runPersistCheckbox = function () {
        // Init Bootstrap persistent tooltips. This prevents a
        // popup from closing if a checkbox it contains is clicked
        if (jq('.dropdown-menu.checkbox-persist').length) {
            jq('.dropdown-menu.checkbox-persist').click(function (event) {
                event.stopPropagation();
            });
        }
    }

    var runFormElements = function () {
        // Init uniform checkboxes, if present
        if (jq(".checkbox").length) {
            jq(".checkbox").uniform();
        }
        // Init uniform radios, if present
        if (jq(".radio").length) {
            jq(".radio").uniform();
        }
    }

    // Init Clickable Checklists (header menus/tables)
    var runChecklists = function () {
		
        // Checklist state for table widgets and header menu buttons
        jq(".table-checklist tbody tr, .dropdown-checklist .dropdown-items li").click(function () {
            jq(this).toggleClass('task-checked');
            if (jq(this).hasClass('task-checked')) {
                jq(this).find('input.row-checkbox').prop("checked", true);
            } else {
                jq(this).find('input.row-checkbox').prop("checked", false);
            }
            jq.uniform.update('input.row-checkbox');
        });
		
        // Disable Selection on checklist to prevent excessive text-highlighting
        var disableSelection = function disableSelection() {
            return this.bind((jq.support.selectstart ? "selectstart" : "mousedown") + ".ui-disableSelection", function (event) {
                event.preventDefault();
            });
        };
        jq(".table-checklist tbody tr").disableSelection();
    }

    // Init Button "active" states
    var runButtonStates = function () {
        // if btn has ".btn-states" class we monitor it for user clicks. On Click we remove
        // the active class from its siblings and give it to the button clicked
        if (jq('.btn-states').length) {
            jq('.btn-states').click(function () {
                jq(this).addClass('active').siblings().removeClass('active');
            });
        }
    }
	
    // Init Header Button Animations
    var runHeader = function () {
        var messageMenu = jq('.messages-menu .glyphicon'),
            alertsMenu = jq('.alerts-menu .glyphicon'),
            tasksMenu = jq('.tasks-menu .glyphicon');
		
		if(jq('body').hasClass('dashboard')){
			var animate = window.setTimeout(function () {
				jq(alertsMenu).animate({color: '#d9534f'}).addClass('animated swing');
				var clear = window.setTimeout(function () {
					jq(alertsMenu).animate({color: '#666666'}, 'slow', function() {
						jq(this).attr('style','').removeClass('animated bounce');
					});
				}, 1500);
			}, 2300);
			var animate2 = window.setTimeout(function () {
				jq(messageMenu).animate({color: '#428bca'}).addClass('animated bounce');
				var clear = window.setTimeout(function () {
					jq(messageMenu).animate({color: '#666666'}, 'slow', function() {
						jq(this).attr('style','').removeClass('animated bounce');
					});
				}, 1500);
			}, 7300);
		}
    }

    // Init Theme Options/Preview Toolbar  
    var runPreviewPane = function () {

        // toggles skin toolbox
        jq('.skin-toolbox-toggle').click(function () {
            if (jq(this).hasClass('toolbox-open')) {
                jq(this).removeClass('toolbox-open').parent().animate({
                    'right': -182
                }, 'fast');
                localStorage.setItem('toolboxState', 'closed');
            } else {
                jq(this).addClass('toolbox-open').parent().animate({
                    'right': -4
                }, 'fast');
                localStorage.setItem('toolboxState', 'open');
            }
        });

        // switch statement for theme layout changes(not customizer)
        jq('#skin-toolbox .checkbox, #skin-toolbox .radio').click(function () {
            var id = jq(this).attr('id');
            if (jq(this).prop('checked')) {
                switch (id) {
                case 'header-option':
                    jq('.navbar').addClass('navbar-fixed-top');
                    jq('#sidebar-option').attr("disabled", false).parents('label').removeClass('option-disabled');
                    break;
                case 'sidebar-option':
                    jq('#sidebar').addClass('affix');
                    if (!jq('body').hasClass('boxed-layout')) {
                        jq('#breadcrumb-option').attr("disabled", false).parents('label').removeClass('option-disabled');
                    }
                    break;
                case 'breadcrumb-option':
                    jq('#topbar').addClass('affix');
                    jq('body').addClass('fixed-breadcrumbs');
                    break;
                case 'breadcrumb-hidden':
                    jq('body').addClass('hidden-breadcrumbs');
                    break;
                case 'fullwidth-option':
                    jq('body').removeClass('boxed-layout boxed-example wide-layout');
                    jq('#breadcrumb-option').attr("disabled", false).prop('checked', false).parents('label').removeClass('option-disabled');
                    break;
                case 'boxed-option':
                    jq('body').addClass('boxed-layout boxed-example');
                    jq('body').removeClass('fixed-breadcrumbs hidden-breadcrumbs hidden-searchbar');
                    jq('#topbar').removeClass('affix');
                    jq('#breadcrumb-option, #breadcrumb-hidden, #searchbar-hidden').attr('checked', false);
                    jq('#breadcrumb-option').attr("disabled", true).parents('label').addClass('option-disabled');
                    break;
                case 'searchbar-hidden':
                    jq('body').addClass('hidden-searchbar');
                    break;
                }
            } else {
                switch (id) {
                case 'header-option':
                    jq('.navbar').removeClass('navbar-fixed-top');
                    jq('body').removeClass('fixed-breadcrumbs');
                    jq('#sidebar, #topbar').removeClass('affix');
                    jq('#sidebar-option, #breadcrumb-option').attr("disabled", true).prop('checked', this.checked).parents('label').addClass('option-disabled');
                    break;
                case 'sidebar-option':
                    jq('#sidebar').removeClass('affix');
                    jq('body').removeClass('fixed-breadcrumbs');
                    jq('#breadcrumb-option').attr("disabled", true).prop('checked', this.checked).parents('label').addClass('option-disabled');
                    jq('#topbar').removeClass('affix');
                    break;
                case 'breadcrumb-option':
                    jq('#topbar').removeClass('affix');
                    jq('body').removeClass('fixed-breadcrumbs');
                    break;
                case 'breadcrumb-hidden':
                    jq('body').removeClass('hidden-breadcrumbs');
                    break;
                case 'searchbar-hidden':
                    jq('body').removeClass('hidden-searchbar');
                    break;
                }
            }
            jq.uniform.update();
        });
    }
	
	return {
        init: function () {
			runPrepJS();
			runDropdowns();
            runAnimations();
            runSideMenu();
            runFormElements();
            runPersistCheckbox();
            runTooltips();
            runChecklists();
            runButtonStates();
            runHeader();
            runPreviewPane();
        }
	}
	
    
}();