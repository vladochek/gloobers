<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gloobers</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans:400,700" rel="stylesheet">
    <?php
    $base_url = $_SERVER['SERVER_NAME'];
    ?>
	<style  type="text/css">
		html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font: inherit;
			vertical-align: baseline;
		}

		/* HTML5 display-role reset for older browsers */
		article, aside, details, figcaption, figure, footer, header, hgroup, menu, main, nav, section {
			display: block;
		}

		body {
			line-height: 1;
		}

		ol, ul {
			list-style: none;
		}

		blockquote, q {
			quotes: none;
		}

		blockquote:before, blockquote:after {
			content: "";
			content: none;
		}

		q:before, q:after {
			content: "";
			content: none;
		}

		table {
			border-collapse: collapse;
			border-spacing: 0;
		}

		*,
		*:before,
		*:after {
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
		}

		body {
			background: #fbfbfb;
			color: #000;
			font: 18px/28px 'Open Sans', sans-serif;
		}

		body .hp {
			background: #262626;
		}

		p {
			margin: 0 0 20px;
		}

		a {
			color: #1e97d8;
			text-decoration: none;
		}

		a:hover {
			text-decoration: underline;
		}

		h1, h2, h3, h4 {
			font: bold 40px/43px 'PT Sans', sans-serif;
			margin: 0 0 40px;
			color: #501e00;
		}

		h1 {
			font-size: 30px;
			line-height: 33px;
		}

		h2 {
			font-size: 40px;
			line-height: 43px;
			margin: 0 0 30px;
		}

		sup {
			font-size: 0.55em;
			position: relative;
			top: -0.65em;
		}

		.form-control,
		input[type=text],
		input[type=url],
		input[type=email],
		input[type=password],
		input[type=number] {
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
			min-height: 42px;
			width: 100%;
			padding: 5px 15px;
			font-family: 'Open Sans', sans-serif;
			font-size: 14px;
			vertical-align: middle;
			-webkit-border-radius: 10px;
			border-radius: 10px;
			outline: none;
			background: none;
			border: 2px solid #a1a1a1;
		}

		.form-control:disabled,
		input[type=text]:disabled,
		input[type=url]:disabled,
		input[type=email]:disabled,
		input[type=password]:disabled,
		input[type=number]:disabled {
			background-color: #eee;
			cursor: not-allowed;
		}

		.form-control::-webkit-input-placeholder,
		input[type=text]::-webkit-input-placeholder,
		input[type=url]::-webkit-input-placeholder,
		input[type=email]::-webkit-input-placeholder,
		input[type=password]::-webkit-input-placeholder,
		input[type=number]::-webkit-input-placeholder {
			color: #666;
		}

		.form-control:-moz-placeholder,
		input[type=text]:-moz-placeholder,
		input[type=url]:-moz-placeholder,
		input[type=email]:-moz-placeholder,
		input[type=password]:-moz-placeholder,
		input[type=number]:-moz-placeholder {
			color: #666;
		}

		.form-control::-moz-placeholder,
		input[type=text]::-moz-placeholder,
		input[type=url]::-moz-placeholder,
		input[type=email]::-moz-placeholder,
		input[type=password]::-moz-placeholder,
		input[type=number]::-moz-placeholder {
			color: #666;
		}

		.form-control:-ms-input-placeholder,
		input[type=text]:-ms-input-placeholder,
		input[type=url]:-ms-input-placeholder,
		input[type=email]:-ms-input-placeholder,
		input[type=password]:-ms-input-placeholder,
		input[type=number]:-ms-input-placeholder {
			color: #666;
		}

		.form-control,
		textarea {
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
			min-height: 42px;
			width: 100%;
			padding: 5px 15px;
			font-family: 'Open Sans', sans-serif;
			font-size: 14px;
			vertical-align: middle;
			-webkit-border-radius: 10px;
			border-radius: 10px;
			outline: none;
			background: none;
			border: 2px solid #a1a1a1;
			display: block;
			overflow: auto;
			min-height: 100px;
		}

		.form-control:disabled,
		textarea:disabled {
			background-color: #eee;
			cursor: not-allowed;
		}

		.form-control::-webkit-input-placeholder,
		textarea::-webkit-input-placeholder {
			color: #666;
		}

		.form-control:-moz-placeholder,
		textarea:-moz-placeholder {
			color: #666;
		}

		.form-control::-moz-placeholder,
		textarea::-moz-placeholder {
			color: #666;
		}

		.form-control:-ms-input-placeholder,
		textarea:-ms-input-placeholder {
			color: #666;
		}

		input[type=submit],
		input[type=button],
		button {
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
			cursor: pointer;
			min-height: 42px;
			padding: 17px 34px;
			font-family: inherit;
			font-size: 20px;
			border: none;
			-webkit-border-radius: 5px;
			border-radius: 5px;
			outline: none;
			text-decoration: none;
			display: inline-block;
			vertical-align: middle;
			color: #fff;
			background: -webkit-gradient(linear, left top, left bottom, from(#ffc200), to(#d5a200));
			background: -webkit-linear-gradient(top, #ffc200 0%, #d5a200 100%);
			background: linear-gradient(to bottom, #ffc200 0%, #d5a200 100%);
		}

		input[type=submit]::-moz-focus-inner,
		input[type=button]::-moz-focus-inner,
		button::-moz-focus-inner {
			border: 0;
		}

		input[type=submit]:hover, input[type=submit]:focus,
		input[type=button]:hover,
		input[type=button]:focus,
		button:hover,
		button:focus {
			background: -webkit-gradient(linear, left top, left bottom, from(#d5a200), to(#ffc200));
			background: -webkit-linear-gradient(top, #d5a200 0%, #ffc200 100%);
			background: linear-gradient(to bottom, #d5a200 0%, #ffc200 100%);
		}

		input[type=submit]:active,
		input[type=button]:active,
		button:active {
			background: -webkit-gradient(linear, left top, left bottom, from(#d5a200), to(#ffc200));
			background: -webkit-linear-gradient(top, #d5a200 0%, #ffc200 100%);
			background: linear-gradient(to bottom, #d5a200 0%, #ffc200 100%);
		}

		svg {
			vertical-align: middle;
			max-width: 100%;
			overflow: hidden;
		}

		html, body {
			height: 100%;
		}

		body {
			background: url(http://<?= $base_url ?>/bg-coming-soon.jpg) 50% 0 no-repeat;
			background-size: cover;
			background-attachment: fixed;
			min-height: 100%;
		}

		@media (min-width: 769px) {
			body {
				background-position: 100% 0;
			}
		}

		.logo {
			margin: -3vh 0 3vh;
			display: inline-block;
			vertical-align: top;
		}

		.logo img {
			display: block;
		}

		.wrapper {
			max-width: 1750px;
			height: 100vh;
			padding: 10vh 25px;
			margin: auto;
			position: relative;
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-orient: vertical;
			-webkit-box-direction: normal;
			-webkit-flex-direction: column;
			-ms-flex-direction: column;
			flex-direction: column;
			-webkit-box-pack: justify;
			-webkit-justify-content: space-between;
			-ms-flex-pack: justify;
			justify-content: space-between;
		}

		h1 {
			font-size: 35px;
			line-height: 38px;
			margin: 0 0 10px;
			color: #fff;
		}

		@media (min-width: 769px) {
			h1 {
				font-size: 70px;
				line-height: 73px;
			}
		}

		h2 {
			font-size: 20px;
			line-height: 23px;
			font-weight: normal;
			margin: 0 0 10vh;
			color: #fff;
		}

		@media (min-width: 769px) {
			h2 {
				font-size: 30px;
				line-height: 33px;
			}
		}

		.subscribe-form label {
			display: block;
			font-size: 17px;
			line-height: 21px;
			margin: 0 0 2.5vh;
			font-weight: bold;
			color: #fff;
		}

		@media (min-width: 769px) {
			.subscribe-form label {
				font-size: 18px;
				line-height: 21px;
			}
		}

		.search-group {
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			max-width: 500px;
		}

		.search-group input[type="text"] {
			-webkit-border-radius: 10px 0 0 10px;
			border-radius: 10px 0 0 10px;
			border-right-width: 0;
			border-color: #fff;
			color: #fff;
			font-size: 18px;
		}

		.search-group input[type="text"]::-webkit-input-placeholder {
			color: #fff;
		}

		.search-group input[type="text"]:-moz-placeholder {
			color: #fff;
		}

		.search-group input[type="text"]::-moz-placeholder {
			color: #fff;
		}

		.search-group input[type="text"]:-ms-input-placeholder {
			color: #fff;
		}

		.search-group .btn {
			-webkit-border-radius: 0 10px 10px 0;
			border-radius: 0 10px 10px 0;
			color: #501e00;
			padding: 17px 15px;
		}

		@media (min-width: 769px) {
			.search-group .btn {
				padding: 17px 34px;
			}
		}

	</style>
</head>
<body>
	<div class="wrapper">
		<a href="#" class="logo"><img src="http://<?= $base_url ?>/logo01.png" alt="Gloobers" height="82" width="224"></a>
		<div class="intro-holder">
			<h1>Be friendly, travel for free!</h1>
			<h2>Travel for free thanks to your helpful recommendations.</h2>
			<div class="subscribe-form">
				<label for="lb01">Subscribe for latest news here:</label>
				<div class="search-group">
					<input id="lb01" type="text" placeholder="Enter your e-mail here">
					<button id="sendmail" class="btn">SEND</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.2/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        xhrFields: {
            withCredentials: true
        }
    });
    function validateEmail(email) {
//        var x = document.forms["myForm"]["email"].value;
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
            alert("Not a valid e-mail address");
            return false;
        }
        return true;
    }
    var baseUrl = "<?= $base_url ?>";
    $("body").on("click", "#sendmail", function () {
        var email = $("#lb01").val();
        console.log('https://'.baseUrl.'/comingsoon.php');
        console.log(email);
        if(validateEmail(email)) {
            $.post('https://'.baseUrl.'/comingsoon.php', {email: email}).done(function (data) {
                console.log(data);
            });
        }
    });
	</script>
</html>
