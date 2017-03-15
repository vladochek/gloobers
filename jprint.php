
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>jQuery.Print</title>
        <meta name="description" content="jQuery.print is a plugin for printing specific parts of a page">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="http://doersguild.github.io/jQuery.print/demo/css/normalize.min.css">

        <link href='https://fonts.googleapis.com/css?family=Chivo:900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="http://doersguild.github.io/jQuery.print/stylesheets/stylesheet.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="http://doersguild.github.io/jQuery.print/stylesheets/pygment_trac.css" media="screen" />

        <style type='text/css'>
            .a {
                background: black;
                color: white;
            }

            .b {
                color: #aaa;
            }
        </style>

        <!--[if lt IE 9]>
        <script src="js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--[if lt IE 9]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id="container">
            <div class="inner">
                <div id="content_holder">
                    <div id="ele1" class="a">
                        <h3>Element 1</h3>
                        <p>
                            Some random text.
                        </p>
                        <button class="print-link no-print" onclick="jQuery('#ele1').print()">
                            Print this
                        </button>
                    </div>
                    <div id="ele2" class="b">
                        <h3>Element 2</h3>
                        <p>
                            Some other random text.
                        </p>
                        <button class="print-link no-print">
                            Print this
                        </button>
                    </div>
                    <div id="ele3" class="a">
                        <h3>Element 3</h3>
                        <p class="no-print">
                            Some more random text.
                        </p>
                        <button class="print-link" onclick="jQuery.print('#ele3')">
                            Print this
                        </button>
                    </div>
                    <div id="ele4" class="b">
                        <h3 class='avoid-this'>Element 4</h3>
                        <p>
                            Some really random text.
                        </p>
                        <button class="print-link avoid-this">
                            Print this
                        </button>
                    </div>
                    <br/>
                    <button class="print-link" onclick="jQuery.print()">
                        Print page
                    </button>
                </div>
            </div>
        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>
            window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')
        </script>

        <script src="http://doersguild.github.io/jQuery.print/jQuery.print.js"></script>

        <script type='text/javascript'>
            //<![CDATA[
            $(function() {
                $("#ele2").find('.print-link').on('click', function() {
                    //Print ele2 with default options
                    $.print("#ele2");
                });

                $("#ele4").find('button').on('click', function() {
                    //Print ele4 with custom options
                    $("#ele4").print({
                        //Use Global styles
                        globalStyles : false,

                        //Add link with attrbute media=print
                        mediaPrint : false,

                        //Custom stylesheet
                        stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",

                        //Print in a hidden iframe
                        iframe : false,

                        //Don't print this
                        noPrintSelector : ".avoid-this",

                        //Add this at top
                        prepend : "Hello World!!!<br/>",
                        
                        //Add this on bottom
                        append : "<br/>Buh Bye!"
                    });
                });

                // Fork https://github.com/doersguild/jQuery.print for the full list of options
            });
            //]]>

        </script>

    </body>
</html>
