!function(a){var b={},c=0;a.fn.once=function(d,e){"string"!=typeof d&&(d in b||(b[d]=++c),e||(e=d),d="jquery-once-"+b[d]);var f=d+"-processed",g=this.not("."+f).addClass(f);return a.isFunction(e)?g.each(e):g},a.fn.removeOnce=function(b,c){var d=b+"-processed",e=this.filter("."+d).removeClass(d);return a.isFunction(c)?e.each(c):e}}(jQuery);