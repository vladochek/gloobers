<?php
/**
 
* @ Diffrent HTML Template for each email
* @ Each HTML Contains Diffrent variables.
*/
global $base_url;
$WELCOME_EMAIL_TEMPLATE='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Welcome email</title>

<style type="text/css">

@font-face {

    font-family: "lucida_granderegular";

    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");

    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),

         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),

         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),

         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),

         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");

    font-weight: lighter;

    font-style: normal;



}



@font-face {

    font-family: "lucida_sansregular";

    src: url("fonts/lucida_sans_regular-webfont.eot");

    src: url("fonts/lucida_sans_regular-webfont.eot?#iefix") format("embedded-opentype"),

         url("fonts/lucida_sans_regular-webfont.woff2") format("woff2"),

         url("fonts/lucida_sans_regular-webfont.woff") format("woff"),

         url("fonts/lucida_sans_regular-webfont.ttf") format("truetype"),

         url("fonts/lucida_sans_regular-webfont.svg#lucida_sansregular") format("svg");

    font-weight: normal;

    font-style: normal;



}



</style>

</head>



<body>

<table width="650" border="5" bordercolor="efefef" cellspacing="0" cellpadding="0" align="center" style="border-collapse:collapse; border-color:#efefef; table-layout: fixed;Margin-left: auto;Margin-right: auto;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;">

<tr>
<td>

<table align="center" width="620" style="font-family:"lucida_sansregular", sans-serif, Arial, Helvetica;font-size:14px;color:#000;line-height:24px;text-align:center;margin:auto;letter-spacing:2px;padding:1%;background:#fff;box-sizing:border-box;border-collapse:separate;>

  <tr>

    <td><center><img src="http://gloobers.com/sites/all/themes/gloobers2/images/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /></center> </td>

  </tr>

  

  <tr>

    <td><h3 style="font-size:18px;font-weight:600;margin:10px 0"><center>Welcome to tribe</center></h3></td>

  </tr>

  

  <tr>

    <td>

    '.$body.'   


    <p style="text-align:left">If you encounter any trouble, please feel free to drop us an email at: <a href="mailto:'.SUPPORT_EMAIL_ID.'" style="color:#139ABC;text-decoration:none;" target="_blank">'.SUPPORT_EMAIL_ID.'</a>
      </p>

    </td>

  </tr>

  

  <tr>

    <td><p style="text-align:left">Cheers,</p></td>

  </tr>

  

  <tr>

    <td><p style="text-align:left">The Gloobers team</p></td>

  </tr>

  

  <tr>

    <td>

        <p style="text-align:left">

            <img src="http://gloobers.com/sites/all/themes/gloobers_new/images/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />

        </p>

    </td>

  </tr>

  </td>
  </tr>
</table>
</table>
</body>
</html>';

$RESET_PASSWORD_TEMPLATE='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
@font-face {
font-family: \'lucida_sansregular\';
src: url(\'http://gloobers.com/sites/all/themes/gloobers_new/fonts/lucida_sans_regular-webfont.eot\');
src: url(\'http://gloobers.com/sites/all/themes/gloobers_new/fonts/lucida_sans_regular-webfont.eot?#iefix\') format(\'embedded-opentype\'),
url(\'http://gloobers.com/sites/all/themes/gloobers_new/fonts/lucida_sans_regular-webfont.woff2\') format(\'woff2\'),
url(\'http://gloobers.com/sites/all/themes/gloobers_new/fonts/lucida_sans_regular-webfont.woff\') format(\'woff\'),
url(\'http://gloobers.com/sites/all/themes/gloobers_new/fonts/lucida_sans_regular-webfont.ttf\') format(\'truetype\'),
url(\'http://gloobers.com/sites/all/themes/gloobers_new/fonts/lucida_sans_regular-webfont.svg#lucida_sansregular\') format(\'svg\');
font-weight: normal;
font-style: normal;
}
</style>
</head>
<body>
<table style="font-family:sans-serif, Arial, Helvetica, \'lucida_sansregular\';font-size:14px;color:#000;line-height:24px;text-align:center;margin:0 auto;letter-spacing:2px;background:#fff;box-sizing:border-box;border-collapse:separate;border:5px solid #efefef;table-layout:fixed" width="620" height="100%" align="center" cellpadding="10" cellspacing="0">
  <tr>
	<td align="center" style="font-family:sans-serif, Arial, Helvetica, \'lucida_sansregular\';font-size:14px;color:#000;line-height:24px;text-align:center"><img src="http://gloobers.com/sites/all/themes/gloobers2/images/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" style="margin:0 auto;display:inline-block" /> </td>	
  </tr>
  <tr>
    <td style="font-family:sans-serif, Arial, Helvetica, \'lucida_sansregular\';font-size:14px;color:#000;line-height:24px;"><h3 style="font-size:18px;font-weight:600;margin:10px 0">Welcome</h3></td>
  </tr>
  <tr>
    <td style="font-family:sans-serif, Arial, Helvetica, \'lucida_sansregular\';font-size:14px;color:#000;line-height:24px;">'.$body.'<p style="text-align:left">If you encounter any trouble, please feel free to drop us an email at: <a href="mailto:'.SUPPORT_EMAIL_ID.'" style="color:#139ABC;text-decoration:none;" target="_blank">'.SUPPORT_EMAIL_ID.'</a></p>
    </td>
  </tr>
  <tr>
    <td style="font-family:sans-serif, Arial, Helvetica, \'lucida_sansregular\';font-size:14px;color:#000;line-height:24px;"><p style="text-align:left">Cheers,</p></td>
  </tr>
  <tr>
    <td style="font-family:sans-serif, Arial, Helvetica, \'lucida_sansregular\';font-size:14px;color:#000;line-height:24px;"><p style="text-align:left">The Gloobers team</p></td>
  </tr>
  <tr>
	<td style="font-family:sans-serif, Arial, Helvetica, \'lucida_sansregular\';font-size:14px;color:#000;line-height:24px;">
	<p style="text-align:left">
		<img src="http://gloobers.com/sites/all/themes/gloobers_new/images/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
	</p>
	</td>
 </tr>
</table>
</body>
</html>';
$Advisor_req_help_email='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recommendation request email</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
    font-weight: lighter;
    font-style: normal;

}

@font-face {
    font-family: "lucida_sansregular";
    src: url("fonts/lucida_sans_regular-webfont.eot");
    src: url("fonts/lucida_sans_regular-webfont.eot?#iefix") format("embedded-opentype"),
         url("fonts/lucida_sans_regular-webfont.woff2") format("woff2"),
         url("fonts/lucida_sans_regular-webfont.woff") format("woff"),
         url("fonts/lucida_sans_regular-webfont.ttf") format("truetype"),
         url("fonts/lucida_sans_regular-webfont.svg#lucida_sansregular") format("svg");
    font-weight: normal;
    font-style: normal;

}

</style>
</head>

<body>   
    

<table width="650" border="5" bordercolor="efefef" cellspacing="0" cellpadding="0" align="center" style="border-color:#efefef; border-collapse: collapse;table-layout: fixed;Margin-left: auto;Margin-right: auto;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;">

<tr>
<td>

<table align="center" width="620" style="font-family:"lucida_sansregular", sans-serif, Arial, Helvetica;font-size:14px;color:#000;line-height:24px;text-align:center;margin:auto;letter-spacing:2px;padding:1%;background:#fff;box-sizing:border-box;border-collapse:separate;max-width:620px;border:5px solid #efefef">
  <tr>
    <td><center><img src="http://gloobers.com/sites/all/themes/gloobers2/images/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </center></td>
  </tr>
  '.$body.' 
  
  <tr>
    <td><p style="text-align:left">Cheers,</p></td>
  </tr>
  
  <tr>
    <td><p style="text-align:left">The Gloobers team</p></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left">
      <img src="http://gloobers.com/sites/all/themes/gloobers_new/images/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
    </p>
  </td>
  </tr>
  
    </td>
  </tr>
  
</table>
</table>

</body>
</html>';

$LISTING_PROVIDER_RESERVATION_CONFIRMATION='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New reservation email</title>
<style type="text/css">
@font-face {
font-family: \'lucida_sansregular\';
src: url(\'http://gloobers.com/sites/all/themes/gloobers_new/fonts/lucida_sans_regular-webfont.eot\');
src: url(\'http://gloobers.com/sites/all/themes/gloobers_new/fonts/lucida_sans_regular-webfont.eot?#iefix\') format(\'embedded-opentype\'),
url(\'http://gloobers.com/sites/all/themes/gloobers_new/fonts/lucida_sans_regular-webfont.woff2\') format(\'woff2\'),
url(\'http://gloobers.com/sites/all/themes/gloobers_new/fonts/lucida_sans_regular-webfont.woff\') format(\'woff\'),
url(\'http://gloobers.com/sites/all/themes/gloobers_new/fonts/lucida_sans_regular-webfont.ttf\') format(\'truetype\'),
url(\'http://gloobers.com/sites/all/themes/gloobers_new/fonts/lucida_sans_regular-webfont.svg#lucida_sansregular\') format(\'svg\');
font-weight: normal;
font-style: normal;
}
</style>
</head>
<body>'.$body.'</body>
</html>';
$BOOKING_FROM_ADVISOR_ID='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Followed recommendation email</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
    font-weight: lighter;
    font-style: normal;

}

@font-face {
    font-family: "lucida_sansregular";
    src: url("fonts/lucida_sans_regular-webfont.eot");
    src: url("fonts/lucida_sans_regular-webfont.eot?#iefix") format("embedded-opentype"),
         url("fonts/lucida_sans_regular-webfont.woff2") format("woff2"),
         url("fonts/lucida_sans_regular-webfont.woff") format("woff"),
         url("fonts/lucida_sans_regular-webfont.ttf") format("truetype"),
         url("fonts/lucida_sans_regular-webfont.svg#lucida_sansregular") format("svg");
    font-weight: normal;
    font-style: normal;

}

</style>
</head>

<body>
<table width="650" border="5" bordercolor="efefef" cellspacing="0" cellpadding="0" align="center" style="border-color:#efefef; border-collapse: collapse;table-layout: fixed;Margin-left: auto;Margin-right: auto;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;">

<tr>
<td>

<table style="font-family:"lucida_sansregular", sans-serif, Arial, Helvetica;font-size:14px;color:#000;line-height:24px;text-align:center;margin:auto;letter-spacing:2px;padding:1%;background:#fff;box-sizing:border-box;border-collapse:separate;max-width:620px;border:5px solid #efefef">
   <tr>
    <td><center><img src="http://gloobers.com/sites/all/themes/gloobers2/images/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </center></td>
  </tr>
  
 '.$body.'
  
  <tr>
    <td><p style="text-align:left; color:#000;">Cheers,</p></td>
  </tr>
  
  <tr>
    <td><p style="text-align:left; color:#000;">The Gloobers team</p></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left">
      <img src="http://gloobers.com/sites/all/themes/gloobers_new/images/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
    </p>
  </td>
  </tr>
    </td>
  </tr>
  
</table>
</table>

</body>
</html>';
$INVITATION_OWNER_EMAIL='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Accepted invitation email</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
    font-weight: lighter;
    font-style: normal;

}

@font-face {
    font-family: "lucida_sansregular";
    src: url("fonts/lucida_sans_regular-webfont.eot");
    src: url("fonts/lucida_sans_regular-webfont.eot?#iefix") format("embedded-opentype"),
         url("fonts/lucida_sans_regular-webfont.woff2") format("woff2"),
         url("fonts/lucida_sans_regular-webfont.woff") format("woff"),
         url("fonts/lucida_sans_regular-webfont.ttf") format("truetype"),
         url("fonts/lucida_sans_regular-webfont.svg#lucida_sansregular") format("svg");
    font-weight: normal;
    font-style: normal;

}

</style>
</head>

<body>
<table width="650" border="5" bordercolor="efefef" cellspacing="0" cellpadding="0" align="center" style="border-color:#efefef; border-collapse: collapse;table-layout: fixed;Margin-left: auto;Margin-right: auto;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;">

<tr>
<td>

<table style="font-family:"lucida_sansregular", sans-serif, Arial, Helvetica;font-size:14px;color:#000;line-height:24px;text-align:center;margin:auto;letter-spacing:2px;padding:1%;background:#fff;box-sizing:border-box;border-collapse:separate;max-width:620px;border:5px solid #efefef">
  <tr>
    <td><center><img src="http://gloobers.com/sites/all/themes/gloobers2/images/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </center></td>
  </tr>
  
  '.$body.'
  
  <tr>
    <td><p style="text-align:left; color:#000;">Cheers,</p></td>
  </tr>
  
  <tr>
    <td><p style="text-align:left; color:#000;">The Gloobers team</p></td>
  </tr>
  
   <tr>
    <td>
    <p style="text-align:left">
      <img src="http://gloobers.com/sites/all/themes/gloobers_new/images/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
    </p>
  </td>
  </tr>
    </td>
  </tr>
</table>
</table>

</body>
</html>';
$TRAVLLER_CONFIRM_EMAIL='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New reservation email</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
    font-weight: lighter;
    font-style: normal;

}

@font-face {
    font-family: "lucida_sansregular";
    src: url("fonts/lucida_sans_regular-webfont.eot");
    src: url("fonts/lucida_sans_regular-webfont.eot?#iefix") format("embedded-opentype"),
         url("fonts/lucida_sans_regular-webfont.woff2") format("woff2"),
         url("fonts/lucida_sans_regular-webfont.woff") format("woff"),
         url("fonts/lucida_sans_regular-webfont.ttf") format("truetype"),
         url("fonts/lucida_sans_regular-webfont.svg#lucida_sansregular") format("svg");
    font-weight: normal;
    font-style: normal;

}

</style>
</head>

<body>'.$body.'

</body>
</html>';

//22/3/2016
$CONFIRM_RECOMMENDATION_TO_EMAIL='<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Confirm Recommendation</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
    font-weight: lighter;
    font-style: normal;

}

@font-face {
    font-family: "lucida_sansregular";
    src: url("fonts/lucida_sans_regular-webfont.eot");
    src: url("fonts/lucida_sans_regular-webfont.eot?#iefix") format("embedded-opentype"),
         url("fonts/lucida_sans_regular-webfont.woff2") format("woff2"),
         url("fonts/lucida_sans_regular-webfont.woff") format("woff"),
         url("fonts/lucida_sans_regular-webfont.ttf") format("truetype"),
         url("fonts/lucida_sans_regular-webfont.svg#lucida_sansregular") format("svg");
    font-weight: normal;
    font-style: normal;

}

</style>
</head>

<body>

'.$body.'
</body>
</html>';

$UPCOMING_TRIPS='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upcoming trip email</title>

</head>
<body>
'.$body.'
</body>
</html>';
$UPCOMING_RESERVATION='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upcoming reservation email</title>

</head>

<body>
    '.$body.'

</body>
</html>';
  
$RECEIVED_RECOMENDATION_TRAVELER='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New recommendation received</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://gloobers.com/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
    font-weight: lighter;
    font-style: normal;

}

@font-face {
    font-family: "lucida_sansregular";
    src: url("fonts/lucida_sans_regular-webfont.eot");
    src: url("fonts/lucida_sans_regular-webfont.eot?#iefix") format("embedded-opentype"),
         url("fonts/lucida_sans_regular-webfont.woff2") format("woff2"),
         url("fonts/lucida_sans_regular-webfont.woff") format("woff"),
         url("fonts/lucida_sans_regular-webfont.ttf") format("truetype"),
         url("fonts/lucida_sans_regular-webfont.svg#lucida_sansregular") format("svg");
    font-weight: normal;
    font-style: normal;

}

</style>
</head>
<body>
   '.$body.' 
</body>
</html>';
$REVIEW_HTML='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Review</title>

</head>

<body>
 '.$body.'
</body>
</html>';
if($key=='New register user'){
	//Register Welcome email
	echo $WELCOME_EMAIL_TEMPLATE;
}else if($key=='User_request_sending_to_Advisor'){
	//Advisor Request recieved mail
	echo $Advisor_req_help_email;
}else if($key=='Message_Listing_provider'){
	//Reservation confirmation email to listing owner
	echo $LISTING_PROVIDER_RESERVATION_CONFIRMATION;
}else if($key=='booking_from_advisor_id'){
	//BOOKING FROM ADVISOR ID
	echo $BOOKING_FROM_ADVISOR_ID;
}else if($key=='Invitation_Owner_email'){
	//BOOKING FROM ADVISOR ID
	echo $INVITATION_OWNER_EMAIL;
}else if($key=='message_to_traveller_confirmation'){
	//BOOKING FROM ADVISOR ID
	echo $TRAVLLER_CONFIRM_EMAIL;
}else if($key=='confirm_recommendation'){
	echo $CONFIRM_RECOMMENDATION_TO_EMAIL;

}else if($key=='upcoming_trip'){
	//UPCOMING TRIPS OF TRAVELER
	echo $UPCOMING_TRIPS;
}else if($key=='upcoming_reservation'){
	//UPCOMING RESERVATIONS
	echo $UPCOMING_RESERVATION;
}else if(($key=='Reset Your Password') || ($key =='Change Your Password')){
	//Reset password and Change Password
	echo $RESET_PASSWORD_TEMPLATE;
}else if($key=='traveler_receive_recomendation'){
	echo $RECEIVED_RECOMENDATION_TRAVELER;
}else if($key=='review_email'){
	echo $REVIEW_HTML;
}
?>