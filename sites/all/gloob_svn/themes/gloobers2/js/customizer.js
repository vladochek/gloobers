var Customizer=function(){var e=function(){function i(e,t){function r(){$(e).removeClass("btn-gradient");var t=$(e).css("background-color");$(e).addClass("btn-gradient");return t}var n=$(e).attr("class");if(t=="css"){if($(e).is(".btn-light,.btn-light2,.btn-light3,.btn-light4,.btn-light5,.btn-light6,.btn-light7")){var i={"background-color":r(),"background-repeat":"repeat-x","background-image":"-webkit-linear-gradient(top, rgba(255,255,255, 0.9) 50%,rgba(255,255,255,0.10) 100%)","background-image":"linear-gradient(to bottom, rgba(255,255,255, 0.9) 10%,rgba(255,255,255,0.10) 100%)",filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr="#80ffffff",endColorstr="#00ffffff",GradientType=0)'};return i}else{var i={"background-color":r(),"background-repeat":"repeat-x","background-image":"-webkit-linear-gradient(top, rgba(255, 255, 255, 0.15) 35%,rgba(0, 0, 0, 0.12) 100%)","background-image":"linear-gradient(to bottom, rgba(255, 255, 255, 0.15) 35%,rgba(0, 0, 0, 0.12) 100%)",filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr="#80ffffff",endColorstr="#00ffffff",GradientType=0)'};return i}}else{if($(e).is(".btn-light,.btn-light2,.btn-light3,.btn-light4,.btn-light5,.btn-light6,.btn-light7")){var i="background-color: "+r()+';\nbackground-image:-webkit-linear-gradient(top, rgba(255,255,255, 0.9) 50%,rgba(255,255,255,0.1) 100%);background-image: linear-gradient(to bottom, rgba(255,255,255, 0.9) 10%,rgba(255,255,255,0.1) 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#80ffffff",endColorstr="#00ffffff",GradientType=0);background-repeat:repeat-x';return i}else{var i="background-color: "+r()+'; background-image:-webkit-linear-gradient(top, rgba(255, 255, 255, 0.15) 35%,rgba(0, 0, 0, 0.12) 100%);background-image:linear-gradient(to bottom, rgba(255, 255, 255, 0.15) 35%,rgba(0, 0, 0, 0.12) 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#80ffffff",endColorstr="#00ffffff",GradientType=0);background-repeat:repeat-x';return i}}}jQuery.expr[":"].parents=function(e,t,n){return jQuery(e).parents(n[3]).length<1};var e=function(e){var t="";for(var n in e){t+=n+": "+e[n]+";"}return t};$("body").on("click",".skin-modal-open",function(){var e={};$("#skinGenerate textarea").empty();$.each(t,function(t,n){if(e[n.ele]==undefined){e[n.ele]=[];e[n.ele].push(n.p)}else{e[n.ele].push(n.p)}});$.each(e,function(e,t){arr=t.join("");if(e=="#sidebar"){$("#skinGenerate textarea").append(arr)}else{$("#skinGenerate textarea").append(e+"{"+arr+"} \n")}})});$("body").on("click","#skin-menu .panel-body input.checkbox",function(r){var i=$(this).data("modify").selector;var s=$(this).data("modify").style;var o=$(this);if(!$(this).data("modify").dataid){$(this).data("modify").dataid="change-"+n++}var u=$(this).data("modify").dataid;if(s=="gradient"){if($(i).hasClass("skin-gradient")){$(i).removeClass("skin-gradient").children().each(function(e,t){$(this).removeClass("btn-gradient")})}else{$(i).addClass("skin-gradient").children().each(function(e,t){$(this).addClass("btn-gradient")})}return}if(i==".navbar-logo img"){if($(o).prop("checked")){$(".navbar-logo").html('<img src="img/logo-white.png" class="img-responsive"/>')}else{$(".navbar-logo").html('<img src="img/logos/logo-red.png" class="img-responsive" alt="logo"/>')}return}if($.type(s)==="number"){if($(o).prop("checked")){t[u]={ele:i,p:e(cssStyles.modified[s])};if($(i).hasClass("panel")){var i=$(".panel").filter(":parents(.panel-group)")}$(i).css(cssStyles.modified[s])}else{$(i).css(cssStyles.original[s]);delete t[u]}}$(".checkbox").uniform()});$("body").on("click","#skin-menu .panel-body .form-group input.radio",function(r){var i=$(this).data("modify").selector;var s=$(this).data("modify").style;var o=$(this);if(!$(this).parents(".form-group").data("radio-count")){$(this).parents(".form-group").data("radio-count","radio-"+n++)}var u=$(this).parents(".form-group").data("radio-count");if($.type(s)==="string"){$(i).removeClass($(i).data("saveClass")).removeData("saveClass");$(i).addClass(s).data("saveClass",s);t[u]={ele:i,p:sidemenuStyles[s]}}if($.type(s)==="number"){t[u]={ele:i,p:e(cssStyles.modified[s])};if($(i).hasClass("panel-heading")){var i=$(".panel-heading").filter(":parents(.panel-group)")}if($(i).hasClass("panel")){var i=$(".panel").filter(":parents(.panel-group)")}$(i).css(cssStyles.modified[s])}});$("body").on("change","#skin-menu .panel-body .form-group select",function(e){var r=$(this).data("modify").selector;var i=$(this).data("modify").style;var s=$(this).val();var o=$(this);if(!$(this).data("modify").dataid){$(this).data("modify").dataid="change-"+n++}var u=$(this).data("modify").dataid;if($.type(i)==="string"){var a=function(e){var t="";for(var n in e){if(typeof e[n]=="string"){t+=n+e[n]}else{t+=a(e[n])+"\n"}}return t};$(r).css(i,s);t[u]={ele:r,p:i+":"+s+";"}}$(".checkbox").uniform()});$("body").on("click","#skin-menu .panel-body .skin-items > div",function(e){var r=$(this).parents(".skin-items");var s=$(r).data("modify").selector;var o=$(r).data("modify").style;var u=$(this).css("background-color");var a=$(this).data("pattern");var f=$(this);if(!$(r).data("modify").dataid){$(r).data("modify").dataid="change-"+n++}var l=$(r).data("modify").dataid;var c=$(f).parents(".popover").find(".popover-title b").text();if(c==" Caret"||c==" Active Caret"){$("ul.sidebar-nav span.caret").toggle().toggle()}if(s==".navbar"&&o=="background-color"){if(!$(this).is(".btn-light,.btn-light2,.btn-light3,.btn-light4,.btn-light5,.btn-light6,.btn-light7")){$(".navbar-logo").html('<img src="img/logos/logo-white.png" class="img-responsive"/>')}else{$(".navbar-logo").html('<img src="img/logos/logo-red.png" class="img-responsive" alt="logo"/>')}}if($(r).hasClass("skin-gradient")){t[l]={ele:s,p:i(f)+";"};if($(s).hasClass("panel-heading")){var s=$(".panel-heading").filter(":parents(.panel-group)")}if($(s).hasClass("panel")){var s=$(".panel").filter(":parents(.panel-group)")}$(s).css(i(f,"css"))}else{if(s=="#content"){$(s).css(o,u);$(s).css("box-shadow","0 -1px 3px 0 rgba(0, 0, 0, 0.33) inset");var s="#content:after";t[l]={ele:s,p:o+":"+u+";"+"background-image:none;"}}else if($(r).hasClass("pattern-popover")){t.breadcrumb={ele:s,p:"background: url(../img/patterns/"+a+".png) repeat top left;"};$(s).css("background","url(img/patterns/"+a+".png) repeat top left")}else if($(r).hasClass("breadcrumb-bg")){t.breadcrumb={ele:s,p:o+":"+u+";"+"background-image:none;"};$(s).css(o,u);if(o=="background-color"){$(s).css("background-image","none")}}else{if(o=="background-color"){$(s).css("background-image","none");t[l]={ele:s,p:o+":"+u+";"+"background-image:none;"}}else{t[l]={ele:s,p:o+":"+u+";"}}if($(s).hasClass("panel-heading")){var s=$(".panel-heading").filter(":parents(.panel-group)")}if($(s).hasClass("panel")){var s=$(".panel").filter(":parents(.panel-group)")}$(s).css(o,u)}}});var t={};var n=0;var r=0;cssStyles={original:{1:{"box-shadow":"0 1px 3px rgba(0, 0, 0, 0.15),0 -1px 1px rgba(0, 0, 0, 0.05)"},2:{"border-width":"1px"},3:{"text-shadow":"0 1px #FFF"},4:{background:""},5:{"border-bottom-width":"1px"},6:{"box-shadow":"0 1px 3px rgba(0, 0, 0, 0.15),0 -1px 1px rgba(0, 0, 0, 0.05)"},7:{"border-bottom":"1px solid #FFF"},8:{"vertical-align":"middle",width:"45px"},9:{"border-right-width":"1px"}},modified:{1:{"box-shadow":"none"},2:{"border-width":"0"},3:{"text-shadow":"none"},4:{background:"none"},5:{"border-bottom-width":"0"},6:{"box-shadow":"0 1px 3px rgba(0, 0, 0, 0.15),0 -1px 1px rgba(0, 0, 0, 0.05)"},7:{"box-shadow":"0 1px 1px rgba(255, 255, 255, 8),0 -1px 1px rgba(255, 255, 255, 0.05)"},8:{"vertical-align":"middle",width:"45px"},9:{"border-right-width":"0"}}};sidemenuStyles={"sidebar-default":'#sidebar ul.sidebar-nav > li > a{border-color: #c9c9c9;background-color:transparent;background-image:-webkit-linear-gradient(top,#ffffff 0,#f5f5f5 100%); background-image:linear-gradient(to bottom,#ffffff 0,#f5f5f5 100%); background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#f5f5f5",GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled=false);}\n#sidebar ul.sidebar-nav li ul.sub-nav{background: #fafafa;border-color: #c9c9c9;}\n',"sidebar-alt-white":"#sidebar ul.sidebar-nav > li > a{background: #FFF;border-color: #ddd;}\n#sidebar ul.sidebar-nav li ul.sub-nav{background: #f8f8f8;border-color: #ddd;}\n","sidebar-alt-grey":"#sidebar:before{background: #f2f2f2;}\n#sidebar ul.sidebar-nav > li > a{background: #f2f2f2;border-color: #ddd;}\n#sidebar ul.sidebar-nav li ul.sub-nav{background: #f8f8f8;border-color: #ddd;}\n"};popOptions={html:true,trigger:"manual",title:function(){var e=$(this).data("modify").popover;var t=$(this).data("modify").selector;var n=$(this).text();var r=$(this).data("popover-id");if($(this).data("help-text")){modTitle="<span><b>"+$(this).data("help-text")+"</b></span>";return modTitle}if(e=="gradient"){modTitle="<label class='checkbox-inline'><input data-modify='{\"selector\": \"."+r+"\", \"style\": \"gradient\"}' class='checkbox' type='checkbox'> Toggle <b>Gradient</b></label>";return modTitle}if(e=="icon-border"){modTitle="<label class='checkbox-inline'><input data-modify='{\"selector\": \"ul.sidebar-nav > li > a span.glyphicon\", \"style\": 9}' class='checkbox' type='checkbox'>Toggle Icon <b>Border</b></label>";return modTitle}if(e=="border"){modTitle="<label class='checkbox-inline'><input data-modify='{\"selector\": \""+t+"\", \"style\": 2}' class='checkbox' type='checkbox'>Toggle <b>Border</b></label>";return modTitle}if(e=="text-shadow"){modTitle="<label class='checkbox-inline'><input data-modify='{\"selector\": \""+t+"\", \"style\": 3}' class='checkbox' type='checkbox'> Toggle <b>Text Shadow</b></label>";return modTitle}else{modTitle="<span><b>"+n+"</b></span>";return modTitle}},placement:"top",content:function(){var e=$(this).data("modify").selector;var t=$(this).data("modify").style;var n=$(this).data("modify").popover;if(n=="gradient"){var r=$(this).data("popover-id")}else if(n=="breadcrumb-bg"){var r="breadcrumb-bg"}else{var r=""}var i="<div class='skin-items skin-popover skin-sm "+r+'\' data-modify=\'{"selector": "'+e+'", "style": "'+t+"\"}'> <div class='btn-blue'></div> <div class='btn-blue2'></div> <div class='btn-blue3'></div> <div class='btn-blue4'></div> <div class='btn-blue5'></div> <div class='btn-blue6'></div> <div class='btn-blue7'></div> <div class='btn-green'></div> <div class='btn-green2'></div> <div class='btn-green3'></div><div class='btn-green4'></div><div class='btn-green5'></div> <div class='btn-purple'></div> <div class='btn-purple2'></div> <div class='btn-purple3'></div> <div class='btn-purple3'></div> <div class='btn-red'></div> <div class='btn-red2'></div> <div class='btn-red3'></div> <div class='btn-red4'></div> <div class='btn-orange'></div> <div class='btn-orange2'></div> <div class='btn-yellow'></div> <div class='btn-yellow2'></div> <div class='btn-creme'></div> <div class='btn-creme2'></div> <div class='btn-brown'></div> <div class='btn-brown2'></div> <div class='btn-brown3'></div><div class='btn-dark5'></div> <div class='btn-dark4'></div><div class='btn-dark2'></div> <div class='btn-dark'></div> <div class='btn-light7'></div> <div class='btn-light6'></div> <div class='btn-light5'></div> <div class='btn-light4'></div> <div class='btn-light3'></div> <div class='btn-light2'></div><div class='btn-light'></div></div><div class='clearfix'></div>";if(n=="breadcrumb-patterns"){var i="<div class='skin-items pattern-popover skin-sm "+r+'\' data-modify=\'{"selector": "'+e+'", "style": "'+t+"\"}'><div class='pattern1' data-pattern='1'></div><div class='pattern2' data-pattern='2'></div><div class='pattern3' data-pattern='3'></div><div class='pattern4' data-pattern='4'></div><div class='pattern5' data-pattern='5'></div><div class='pattern6' data-pattern='6'></div><div class='pattern7' data-pattern='7'></div><div class='pattern8' data-pattern='8'></div></div><div class='clearfix'></div>"}return i}};$("[data-toggle=popover]").popover(popOptions);$(document).on("click","[data-toggle=popover]",function(){if(!$(this).data("popover-id")){$(this).data("popover-id","popcount-"+r++).popover("show");$(".checkbox").uniform()}else{$(this).next(".popover").css("display","block")}});$("body").on("click",function(e){$('[data-toggle="popover"]').each(function(){if(!$(this).is(e.target)&&$(this).has(e.target).length===0&&$(".popover").has(e.target).length===0){$(this).next(".popover").css("display","none")}})})};return{init:function(){e()}}}()


	
	
		
