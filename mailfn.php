<?php



$to = "designer@deftsoft.info, patrickphp4@gmail.com, testing4deftsoft@yahoo.in, vinaytester@rediffmail.com, arshpreet139@hotmail.com";

//$to = "testteam47@gmail.com, rashi.arnam139@yahoo.com, vinaytester@rediffmail.com, qa@deftsoft.info, arshpreet139@hotmail.com";

$subject = "My subject";

$headers = "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";



// More headers

$headers .= 'From: <webmaster@example.com>' . "\r\n";

$headers .= 'Cc: myboss@example.com' . "\r\n";



//automaticmailsend funtion

$body1='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Welcome email</title>

<style type="text/css">

@font-face {

    font-family: "lucida_granderegular";

    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");

    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),

         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),

         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),

         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),

         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");

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

    <td><center><img src="http://14.141.82.35/server3/Emailer-21-Dec/images/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /></center> </td>

  </tr>

  

  <tr>

    <td><h3 style="font-size:18px;font-weight:600;margin:10px 0"><center>Welcome</center></h3></td>

  </tr>

  

  <tr>

    <td>

    <p style="text-align:left">Thanks for signing up and joining the tribe. We are happy to welcome you. Before we get to know a bit better, please confirm your email.<p>



<p style="text-align:left"><a href="#" style="color:#139ABC;text-decoration:none;" target="_blank">Click here to confirm your email</a>  </p>    



    <p style="text-align:left">If you encounter any trouble, please feel free to drop us an email at: <a href="mailto:support@gloobers.com" style="color:#139ABC;text-decoration:none;" target="_blank">support@gloobers.com </a>   </p>

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

            <img src="http://14.141.82.35/server3/Emailer-21-Dec/images/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />

        </p>

    </td>

  </tr>

  </td>
  </tr>
</table>
</table>



</body>

</html>';



//echo $body1;exit;
$body2='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recommendation request email</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
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



    
    

<table width="650" border="0" bordercolor="efefef" cellspacing="0" cellpadding="0" align="center" style=" border-collapse: collapse;table-layout: fixed;Margin-left: auto;Margin-right: auto;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word; border:5px solid #efefef;">

<tr>
<td>

<table align="center" width="620" style="font-family:"lucida_sansregular", sans-serif, Arial, Helvetica;font-size:14px;color:#000;line-height:24px;text-align:center;margin:auto;letter-spacing:2px;padding:1%;background:#fff;box-sizing:border-box;max-width:620px;border:5px solid #efefef">
  <tr>
    <td><center><img src="http://staging.gloobers.net/img/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </center></td>
  </tr>
  
  <tr>
    <td>
    <center><img src="http://staging.gloobers.net/img/user-pic.jpg" alt="" title="" style="border-radius:50%;border:2px solid #efefef" /></center>
    <p style="width:100%;"><center><a href="#" style="color:#139ABC;text-decoration:none;" target="_blank">View request details</a></center></p>
    </td>
  </tr>
  
  <tr>
    <td><h3 style="font-size:18px;font-weight:600;margin:10px 0"><center>Your help is required !</center></h3></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left">Hi &lt;Username&gt;,<br />
    It seems the &lt;Username_requester&gt;, another tribe member needs your help to help him plan a &lt;type_of_trip&gt; to &lt;destination&gt;. She/hes looking for a &lt;type_of_rec&gt; and has an overall budget of &lt;Overall_budget&gt;. You can help him plan his trip with your precious recommendations and get rewarded for the recommendations he will follow. </p>
    
    <p style="text-align:left">You can view this requests details in your dashboard : <a href="#" style="color:#139ABC;text-decoration:none;" target="_blank">requests received</a> </p>
    
    <p style="text-align:left">This request will expire in 24 hours, if you cant help this member, you can always <a href="#" style="color:#139ABC;text-decoration:none;" target="_blank">decline this request</a>  </p>
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
      <img src="http://staging.gloobers.net/img/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
    </p>
  </td>
  </tr>
  
    </td>
  </tr>
  
</table>
</table>

</body>
</html>';


$body3='<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
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

<table align="center" width="650" border="0" cellspacing="0" cellpadding="0" style="Margin-left: auto;Margin-right: auto; border:5px solid #efefef; padding:10px">
  <tr>
    <td><center> <img src="http://staging.gloobers.net/sites/all/themes/gloobers_new/images/logo.png" alt="logo"> </center> </td>
  </tr>
      <tr>
    <td height="20"> </td>
  </tr>
  
  <tr>
  <td>
  
  
  <table align="center" width="400" border="0" cellspacing="0" cellpadding="0" style="Margin-left: auto;Margin-right: auto;">

<tr>
<td background="http://staging.gloobers.net/img/unnamed.jpg"  bgcolor="#fff" width="434" height="294" valign="top" style="background-image:url(http://staging.gloobers.net/img/unnamed.jpg) / cover; >
  <!--[if gte mso 9]>
  <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:434px;height:294px;">
    <v:fill type="tile" src="http://staging.gloobers.net/img/banner.jpg" color="#fff" />
    <v:textbox inset="0,0,0,0">
  <![endif]-->
  <div>
  
  <table width="400" border="0" cellspacing="0" cellpadding="0">
  
   <tr>
    <td height="20"></td>
  </tr>
  
  
  <tr>
    <td align="center"> <center> <img src="http://staging.gloobers.net/img/user-pic.jpg" width="150" height="150" alt="image" style="border-radius:50%;"/> </center> </td>
  </tr>
   <tr>
    <td height="20"></td>
  </tr>
    <tr align="center">
    <td style="font-size:24px; color:#fff; font-weight:bold; text-shadow:0px 3px 3px #000;"><center>Hotel Hilton</center></td>
  </tr>

    <tr>
    <td style="font-size:16px; color:#fff; font-weight:bold; text-shadow:0px 3px 3px #000;" align="center"><center>Miami beach, USA</center></td>
  </tr>
</table>

    </div>
  <!--[if gte mso 9]>
    </v:textbox>
  </v:rect>
  <![endif]-->
</td>
</tr>

</table>



  </td>
  </tr>
  

  
   <tr>
    <td height="20"> </td>
  </tr>
   <tr>
    <td ><center> <a href="#" style="font-size:16px; color:#209cbe; font-weight:normal; text-decoration:none;"> View in my dashboard</a> </center> </td>
  </tr>
    <tr>
    <td height="40"> </td>
  </tr>
  
   <tr>
    <td style="font-size:28px; color:#000; font-weight:normal; text-decoration:none;"><center> Confirmed recommendation ! </center> </td>
  </tr>
      <tr>
    <td height="20"> </td>
  </tr>
  
  
      <tr>
    <td style="font-size:14px; color:#000; font-weight:normal;"> Good news <Username>, </td>
  </tr>
       <tr>
    <td height="20"> </td>
  </tr>
  
  <tr>
  <td style="font-size:16px; color:#000; font-weight:normal; line-height:22px;"> Your friend <username_referredfriend> executed his reservation <Listing_name>. Your account has been credited of 149 gloobies that you can now use to book any listing within 2 years.  </td>
  </tr>
         <tr>
    <td height="20"> </td>
  </tr>
    <tr>
  <td style="font-size:16px; color:#000; font-weight:normal; line-height:22px;"> You can see <Username_booker> review on this recommendation <a href="#" style="font-size:16px; color:#209cbe; font-weight:normal; text-decoration:none;"> Here </a></td>
  </tr>
        <tr>
    <td height="40"> </td>
  </tr>
  
        <tr>
    <td style="font-size:16px; color:#000; font-weight:normal;"> Cheers,</td>
  </tr>
  
        <tr>
    <td height="20"> </td>
  </tr>
  
        <tr>
    <td style="font-size:16px; color:#000;  font-weight:normal;">The Gloobers team </td>
  </tr>
  
      <tr>
    <td height="40">  <p style="text-align:left">
      <img src="http://staging.gloobers.net/img/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
    </p></td>
  </tr>
</table>
</body>
</html>
';


$body4='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New recommendation received</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
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
    <td><center> <img src="http://staging.gloobers.net/img/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </center> </td>
  </tr>
  
  <tr>
  <td>
    <table style="width:100%;padding:0px 5%;box-sizing:border-box">
    <tr>
        <td style="background:#000 url(http://staging.gloobers.net/img/dumy_list_image.jpg) no-repeat 100% 100%;background-size:cover;width:50%;vertical-align:middle;padding:0">
        <h3 style="color:#fff;font-weight:bold;text-shadow:3px 1px 2px #333;font-size:20px;margin:0"><center>Hotel Hilton</center></h3>
        <p style="color:#fff;font-weight:400;text-shadow:1px 1px 1px #333;margin:0px 0 10px"><center style="color:#fff;">Miami beach, USA</center></p>
        </td>
    
        <td style="width:50%;padding:20px;vertical-align:top">
        <p style="text-align:left"><i>This place is tailormade for you. Try the salmon during  breakfast, its really a one  of a lifetime experience.  Hope youll enjoy. </i></p>
        </td>
    </tr>
      
      <tr>
      <td colspan="2"> <img src="http://staging.gloobers.net/img/user-pic.jpg" alt="" title="" style="border-radius:50%;border:2px solid #efefef;width:80px;float:right;margin:-50px 0 0" /></td>
      </tr>
      
  </table>
   </td>
  </tr>
  
  <tr>
    <td><h3 style="font-size:18px;font-weight:600;margin:10px 0"><center style=" color:#000;"> You received a new recommendation ! </center> </h3></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left;  color:#000;">Hi &lt;Username&gt;,<br />
    You received a new recommendation from &lt;Username_recommender&gt;, &lt;listing name&gt;. You can view the details of this recommendation in your dashboard or see all the recommendations received for this request.</p>
    
     <p style="text-align:left;"><a href="#" style="color:#139ABC;text-decoration:none;" target="_blank">View all the recommendations received</a></p>
    
    <p style="text-align:left;  color:#000;">You can now choose the recommendation that you think is the best and confirm your reservation. Obviously you can use your gloobies to fund the trip.</p>
    
    <p style="text-align:left;  color:#000;">
    If you encounter any trouble, Our support team is always happy to assist you.
    <a href="mailto:support@gloobers.com" style="color:#139ABC;text-decoration:none;" target="_blank"> support@gloobers.com </a>  </p>
    </td>
  </tr>
  
  <tr>
    <td><p style="text-align:left;  color:#000;">Cheers,</p></td>
  </tr>
  
  <tr>
    <td><p style="text-align:left;  color:#000;">The Gloobers team</p></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left">
      <img src="http://staging.gloobers.net/img/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
    </p>
  </td>
  </tr>
    </td>
  </tr>
  
</table>
</table>

</body>
</html>

';


$body5='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Followed recommendation email</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
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
    <td><center><img src="http://staging.gloobers.net/img/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </center></td>
  </tr>
  
  <tr>
    <td style="background:#000 url(http://staging.gloobers.net/img/dumy_list_image.jpg) no-repeat center;background-size:100%">
    <center><img src="http://staging.gloobers.net/img/user-pic.jpg" alt="" title="" style="border-radius:50%;border:2px solid #efefef;width:100px;margin:40px 0 0" /></center>
    <h3 style="color:#fff;font-weight:bold;text-shadow:3px 1px 2px #333;font-size:20px;margin:20px 0 0"><center style="color:#fff;">Hotel Hilton</center></h3>
    <p style="color:#fff;font-weight:400;text-shadow:1px 1px 1px #333;margin:0px 0 10px"><center style="color:#fff;">Miami beach, USA</center></p>
    </td>
  </tr>
  
  <tr>
    <td><p><a href="#" style="color:#139ABC;text-decoration:none;" target="_blank"> <center style="color:#139ABC;">View in my dashboard <center></a></p></td>
  </tr>
  
  <tr>
    <td><h3 style="font-size:18px;font-weight:600;margin:10px 0"> <center style="color:#000;"> Ylann followed your recommendation ! <center></h3></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left; color:#000;">Good news &lt;Username&gt;,<br />
    Your friend &lt;username_referredfriend&gt; followed your recommendation. As soon as he will execute his trip, your wallet will be credited of 149 gloobies. This amount is now pending in your account, it should be credited to your wallet on &lt;DayafterCheckout_date&gt;</p>
    
    <p style="text-align:left; color:#000;">You can see this pending recommendation is your <a href="#" style="color:#139ABC;text-decoration:none;" target="_blank">Dashboard</a> <span style="color:#139ABC">&gt;</span> <a href="#" style="color:#139ABC;text-decoration:none;" target="_blank">Pending recommendations</a>   </p>
    </td>
  </tr>
  
  <tr>
    <td><p style="text-align:left; color:#000;">Cheers,</p></td>
  </tr>
  
  <tr>
    <td><p style="text-align:left; color:#000;">The Gloobers team</p></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left">
      <img src="http://staging.gloobers.net/img/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
    </p>
  </td>
  </tr>
    </td>
  </tr>
  
</table>
</table>

</body>
</html>
';

$body6='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Accepted invitation email</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
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
    <td><center><img src="http://staging.gloobers.net/img/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </center></td>
  </tr>
  
  <tr>
    <td>
    <center><img src="http://staging.gloobers.net/img/user-pic.jpg" alt="" title="" style="border-radius:50%;border:2px solid #efefef" /> </center>
    <p><a href="#" style="color:#139ABC;text-decoration:none;" target="_blank"><center style="color:#139ABC;">View profile</center></a></p>
    </td>
  </tr>
  
  <tr>
    <td><h3 style="font-size:18px;font-weight:600;margin:10px 0"><center style="color:#000;">Ylann accepted your invitation !</center></h3></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left; color:#000;">Good news &lt;Username&gt;,<br />
    Your friend &lt;username_referredfriend&gt; just joined the tribe thanks to the invitaion you sent. From now on, you will be passively rewarded for every trip &lt;username_referredfriend&gt; will book, every followed recommendation &lt;username_referredfriend&gt; will give and/or every reservation &lt;username_referredfriend&gt; will receive.</p>
    
    <p style="text-align:left; color:#000;">If you have any question regarding Gloobers passive rewards please feel free to consult our <a href="#" style="color:#139ABC;text-decoration:none;" target="_blank">Help center</a> </p>
    </td>
  </tr>
  
  <tr>
    <td><p style="text-align:left; color:#000;">Cheers,</p></td>
  </tr>
  
  <tr>
    <td><p style="text-align:left; color:#000;">The Gloobers team</p></td>
  </tr>
  
   <tr>
    <td>
    <p style="text-align:left">
      <img src="http://staging.gloobers.net/img/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
    </p>
  </td>
  </tr>
    </td>
  </tr>
</table>
</table>

</body>
</html>
';

$body7=' <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New reservation email</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
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
    <td><center><img src="http://staging.gloobers.net/img/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </center></td>
  </tr>

  <tr>
  <td>
    <table style="width:100%;box-sizing:border-box;border-collapse:collapse">
    <tr>
        <td style="background:#000 url(http://staging.gloobers.net/img/dumy_list_image.jpg) no-repeat 100% 100%;background-size:cover;width:40%;vertical-align:middle;padding:0;border:1px solid #aaa;">
        <h3 style="color:#fff;font-weight:400;text-shadow:3px 1px 2px #333;font-size:18px;margin:0">Africanism</h3>
        <p style="color:#fff;font-weight:400;text-shadow:1px 1px 1px #333;margin:0px 0 10px">Namibia</p>
        </td>
    
        <td style="width:20%;padding:5px;border:1px solid #aaa;">
            <center> <img src="http://staging.gloobers.net/img/user-pic.jpg" alt="" title="" style="border-radius:50%;width:70px" /></center>
        <p style="color:#000;"><strong>Matt Ruiz</strong><br />
            Paris, France<br />
            <a href="mailto:matt@gmail.com" style="color:#139ABC;text-decoration:none;" target="_blank">matt@gmail.com</a></p>
        </td>
            
            <td style="width:20%;padding:5px;border:1px solid #aaa; color:#000;">
        <p style="color:#000;"><strong>Arrives on</strong><br />
            dd/mm/yyyy<br />
            15:00</p>
        </td>
            
            <td style="width:20%;padding:5px;border:1px solid #aaa;text-align:center; color:#000;">
        <p style="color:#000;"><strong>Travelers</strong><br />
            2 adults, 1 child, 1 baby</p>
        </td>
    </tr>
      
      <tr>  
            <td colspan="2" style="padding:0">&nbsp;</td>
            <td style="border:1px solid #aaa;border-right:0;text-align:center;background:#ccc;padding:0; color:#000;">
        <p style="margin:5px 0; color:#000;">Net Amount</p>
        </td>
            <td style="border:1px solid #aaa;border-left:0;;background:#ccc;padding:0; color:#000;">
        <p style="font-size:16px;margin:5px 0; color:#000;"><strong>$357</strong></p>
        </td>
    </tr>
      
  </table>
   </td>
  </tr>
  
  <tr>
  <td><a href="#" style="color:#139ABC;text-decoration:none;margin:20px 0 0;display:block" target="_blank"><center>View reservation details</center></a></td>
  </tr>
  
  <tr>
    <td><h3 style="font-size:18px;font-weight:600;margin:10px 0"><center style="font-size:18px; color:#000;">Cheer up, you just received a new reservation !</center></h3></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left; color:#000;">Good news &lt;Username&gt;,<br />
    You just received a new reservation for your listing &lt;listingname&gt;. This reservation is confirmed and paid, the net amount of : &lt;Net_amount&gt; will be issued to your account on &lt;Dayafterarrivaldate&gt;</p>
    
     <p style="text-align:left; color:#000;">You can view this reservation s details in your <a href="#" style="color:#139ABC;text-decoration:none;" target="_blank">upcoming reservations</a></p>
    
    <p style="text-align:left; color:#000;">  We encourage you to stay in touch with &lt;Username_booker&gt; via email or phone.  </p>
    </td>
  </tr>
  
  <tr>
    <td><p style="text-align:left; color:#000;">Cheers,</p></td>
  </tr>
  
  <tr>
    <td><p style="text-align:left">The Gloobers team</p></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left">
      <img src="http://staging.gloobers.net/img/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
    </p>
  </td>
  </tr>
    </td>
  </tr>
  
</table>
</table>

</body>
</html>
';

$body8=' <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upcoming reservation email</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
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
    <td><center><img src="http://staging.gloobers.net/img/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </center></td>
  </tr>

  <tr>
  <td>
    <table style="width:100%;box-sizing:border-box;border-collapse:collapse">
    <tr>
        <td style="background:#000 url(http://staging.gloobers.net/img/dumy_list_image.jpg) no-repeat 100% 100%;background-size:cover;width:40%;vertical-align:middle;padding:0;border:1px solid #aaa;">
        <h3 style="color:#fff;font-weight:400;text-shadow:3px 1px 2px #333;font-size:18px;margin:0">Africanism</h3>
        <p style="color:#fff;font-weight:400;text-shadow:1px 1px 1px #333;margin:0px 0 10px">Namibia</p>
        </td>
    
        <td style="width:20%;padding:5px;border:1px solid #aaa;">
            <center> <img src="http://staging.gloobers.net/img/user-pic.jpg" alt="" title="" style="border-radius:50%;width:70px" /></center>
        <p style="color:#000;"><strong>Matt Ruiz</strong><br />
            Paris, France<br />
            <a href="mailto:matt@gmail.com" style="color:#139ABC;text-decoration:none;" target="_blank">matt@gmail.com</a></p>
        </td>
            
            <td style="width:20%;padding:5px;border:1px solid #aaa; color:#000;">
        <p style="color:#000;"><strong>Arrives on</strong><br />
            dd/mm/yyyy<br />
            15:00</p>
        </td>
            
            <td style="width:20%;padding:5px;border:1px solid #aaa;text-align:center; color:#000;">
        <p style="color:#000;"><strong>Travelers</strong><br />
            2 adults, 1 child, 1 baby</p>
        </td>
    </tr>
      
      <tr>  
            <td colspan="2" style="padding:0">&nbsp;</td>
            <td style="border:1px solid #aaa;border-right:0;text-align:center;background:#ccc;padding:0; color:#000;">
        <p style="margin:5px 0; color:#000;">Net Amount</p>
        </td>
            <td style="border:1px solid #aaa;border-left:0;;background:#ccc;padding:0; color:#000;">
        <p style="font-size:16px;margin:5px 0; color:#000;"><strong>$357</strong></p>
        </td>
    </tr>
      
  </table>
   </td>
  </tr>
  
  <tr>
  <td><a href="#" style="color:#139ABC;text-decoration:none;margin:20px 0 0;display:block" target="_blank"><center>View reservation details</center></a></td>
  </tr>
  
  <tr>
    <td><h3 style="font-size:18px;font-weight:600;margin:10px 0"><center style="font-size:18px; color:#000;">You have an upcoming reservation !</center></h3></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left; color:#000;">Hi  &lt;Username&gt;,<br />
    Just a little reminder that you have an upcoming reservation for your listing &lt;listingname&gt;. This reservation is confirmed and paid, the net amount of : &lt;Net_amount&gt; will be issued to your account on &lt;Dayafterarrivaldate&gt;
    </p>
    
     <p style="text-align:left; color:#000;">You can view this reservation s details in your <a href="#" style="color:#139ABC;text-decoration:none;" target="_blank">upcoming reservations</a></p>
    
    <p style="text-align:left; color:#000;">  We encourage you to stay in touch with &lt;Username_booker&gt; via email or phone.  </p>
    </td>
  </tr>
  
  <tr>
    <td><p style="text-align:left; color:#000;">Cheers,</p></td>
  </tr>
  
  <tr>
    <td><p style="text-align:left; color:#000;">The Gloobers team</p></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left">
      <img src="http://staging.gloobers.net/img/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
    </p>
  </td>
  </tr>
    </td>
  </tr>
  
</table>
</table>

</body>
</html>
';
$body9='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upcoming trip email</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
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
    <td><center><img src="http://staging.gloobers.net/img/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </center></td>
  </tr>
  
  <tr>
    <td style="background:#000 url(http://staging.gloobers.net/img/dumy_list_image.jpg) no-repeat center;background-size:100%;padding:50px 0">
    <h3 style="color:#fff;font-weight:bold;text-shadow:3px 1px 2px #333;font-size:20px;margin:20px 0 0"> <center style="color:#fff;">Hotel Hilton </center></h3>
    <p style="color:#fff;font-weight:400;text-shadow:1px 1px 1px #333;margin:0px 0 10px"> <center style="color:#fff;">Miami beach, USA</center></p>
    </td>
  </tr>
  
  <tr>
    <td><p><a href="#" style="color:#139ABC;text-decoration:none;" target="_blank"><center>View reservation details</center></a></p></td>
  </tr>
  
  <tr>
    <td><h3 style="font-size:18px;font-weight:600;margin:10px 0"><center style="color:#000;">You have an upcoming trip !</center></h3></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left; color:#000;">Hi &lt;Username&gt;,<br />
    Just a little reminder that you have an upcoming trip at: &lt;listing name&gt; on &lt;arrival date&gt;. This reservation is confirmed and paid.</p>
   
    <p style="text-align:left; color:#000;">You can view this reservation s details in your <a href="#" style="color:#139ABC;text-decoration:none;" target="_blank">trips</a> </p>
    
    <p style="text-align:left; color:#000;">We encourage you to stay in touch with &lt;Username_operator&gt; via email or phone and let him know about your arrival plans.</p>
    </td>
  </tr>
  
  <tr>
    <td><p style="text-align:left; color:#000;">Cheers,</p></td>
  </tr>
  
  <tr>
    <td><p style="text-align:left; color:#000;">The Gloobers team</p></td>
  </tr>
  
  <tr>
    <td>
    <p style="text-align:left">
      <img src="http://staging.gloobers.net/img/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
    </p>
  </td>
  </tr>
    </td>
  </tr>
  
</table>
</table>

</body>
</html>
';


$registeredUser_DpImage='<img src="http://staging.gloobers.net/sites/default/files/styles/homepage_header/public/pictures/picture-1-1462774879.jpg?itok=1K8NNzZm" alt="" title="" style="border-radius:50%;border:2px solid #efefef" />';

$body='<tr><td>
<center>'.$registeredUser_DpImage.' </center>
<p><a href="'.$base_url.'/profile/'.$registeredUser_Data->uid.'"  style="color:#139ABC;text-decoration:none;" target="_blank"><center style="color:#139ABC;">View profile</center></a></p>
</td>
</tr>

<tr>
<td><h3 style="font-size:18px;font-weight:600;margin:10px 0"><center style="color:#000;">'.$registeredUser_Data_name.' accepted your invitation !</center></h3></td>
</tr>

<tr>
<td>
<p style="text-align:left; color:#000;">Good news '.$invitationSender_Data_name.',<br />
Your friend '.$registeredUser_Data_name.' just joined the tribe thanks to the invitaion you sent. From now on, you will be passively rewarded for every trip '.$registeredUser_Data_name.' will book, every followed recommendation '.$registeredUser_Data_name.' will give and/or every reservation '.$registeredUser_Data_name.' will receive.</p>

<p style="text-align:left; color:#000;">If you have any question regarding Gloobers passive rewards please feel free to consult our <a href="'.$base_url.'/help" style="color:#139ABC;text-decoration:none;" target="_blank">Help center</a> </p>
</td>
</tr>';


$bodytest='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Accepted invitation email</title>
<style type="text/css">
@font-face {
    font-family: "lucida_granderegular";
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot");
    src: url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.eot?#iefix") format("embedded-opentype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff2") format("woff2"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.woff") format("woff"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.ttf") format("truetype"),
         url("http://staging.gloobers.net/sites/all/themes/gloobers_new/fonts/6216-webfont.svg#lucida_granderegular") format("svg");
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
    <td><center><img src="http://staging.gloobers.net/sites/all/themes/gloobers2/images/logo.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" width="300" /> </center></td>
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
      <img src="http://staging.gloobers.net/img/signature.png" alt="Gloobers::Be friendly. Travel for free" title="Gloobers::Be friendly. Travel for free" />
    </p>
  </td>
  </tr>
    </td>
  </tr>
</table>
</table>

</body>
</html>';

echo $bodytest;


$to = "patrickphp4@gmail.com";

$mainvar= mail($to,$subject,$bodytest,$headers);

echo "here 909090";

echo "<pre>";

print_r($mainvar);

?> 