<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gloobers</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans:400,700" rel="stylesheet">
    <?php
    drupal_add_css('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans:400,700', ['type' => 'external']);
    drupal_add_css('sites/all/themes/new_design/css/sprite.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/jquery.fancybox.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/drop-theme-arrows.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/bootstrap.min.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/bootstrap-theme.min.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/all.css', ['type' => 'file']);
    ?>

</head>

<div class="wrapper">
    <header class="header">
    <div class="container">
            <div class="header-holder">
                <a href="#" class="logo"><img src="<?= drupal_get_path('theme', 'new_design') . '/images/logo.png' ?>"
                                              alt="Gloobers" height="59" width="160"></a>
                <nav class="nav">
                    <ul class="main-nav">
                        <li><a href="#">About <i class="gl-ico gl-ico-arrow-down"></i></a></li>
                        <li class="active"><a href="#">Professionals</a></li>
                        <li><a href="#">Log in</a></li>
                    </ul>
                    <a href="#" class="btn btn-default">Refer a professional</a>
                </nav>
            </div>
            <div class="search-area">
                <h1>Gloobers for professionals</h1>
                <p class="sub-ttl">Collaborate with millions of travelers worldwide.</p>
                <a href="#" class="btn btn-primary">Try it now</a>
            </div>
            <a href="#tag" class="btn-scroll">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30"
                     height="45" viewBox="0 0 30 45">
                    <metadata><? xpacket begin = "﻿" id = "W5M0MpCehiHzreSzNTczkc9d"?>
                        <x:xmpmeta xmlns:x="adobe:ns:meta/"
                                   x:xmptk="Adobe XMP Core 5.6-c138 79.159824, 2016/09/14-01:09:01        ">
                            <rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
                                <rdf:Description rdf:about=""/>
                            </rdf:RDF>
                        </x:xmpmeta>
                        <? xpacket end = "w"?></metadata>
                    <image id="mouse" width="30" height="45"
                           xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAtCAQAAAAT1xMqAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAACxIAAAsSAdLdfvwAAAAHdElNRQfgDBQNKSMu4uEhAAACG0lEQVRIx+3WvU9TYRTH8V8vEFBJkSiJLzEYizQ6EFCbdMJEAhqJhsioDjoxspgwODGw+PIfGBNdSDRsisRBGrtUXdTBVIsvkcQQaStCtYXefh3ahvb2aeUy95zl3nPP57nnmZ7HgwzRpwGdkE+tsrWiT3qlOX0x9FGezYzxgXyk+Mp30oW3MCN4yrvL6RALQIoHjLKvULPwcY2nZIEwx83YwxSwzi32IkN2MQ2kuFKJLR4CUXqMsJgXiAPjTnwXeEmbo/kJU46Kn0Uo/j1fGgXeVlDxi/mKmp8EKY4V8W6WWOOoYUwTFheBMJ48ngRuGPdoxmIaGEGimQQ/2OEKd5NjHlkaVrvu6a/cxEc912l1Wjor6bErKkmPJA1aCmhV71zjsKSAJZ+iylVpyehPlS8xZXWkUV4tV12/XytVvmT1W3saJWWq4miNwVdlWa53WxJ1XMd1XAW3bEt6ZVtKqmMbtElexS0tyK8G17hbDYpZimiXTrrGZyRFxHngds2z0ZQhbPaLJpZYptUV7QOe5c+qCWDSFZ4FBvJ4J99I07tlehWY3Tyfh8jxmY4t0VOskeRw6c3gJvCeA/+lAX5iM1x+rRB3gEX6a9LrpLC57LyTCDHOBnCfLiMM8gJIcG6z5hzqDWAzxxg9tCBEG0EmeA3ADIdK+53rW1wiRDHSbBSeMswQdE7jMd49D2pQvepUu3KKK6aIQkpWtv0DHYXYxCIfOB0AAAAASUVORK5CYII="/>
                </svg>
            </a>
        </div>
    </header>
    <main class="main">
        <section class="block coloured">
            <div class="container">
                <div class="block-title">
                    <h2>About Gloobers</h2>
                </div>
                <div class="columns faq">
                    <div class="col">
                        <p>Gloobers is a travel marketplace considering every traveler as a trustful advisor.
                            Considering tourism should be promoted by travelers themselves, Gloobers allows
                            professionals to connect </p>
                    </div>
                    <div class="col">
                        <p>to millions of travelers around the world. Retributing perceived commissions as discounts,
                            Gloobers allows helpful advisors to book any listing for free.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="block">
            <div class="statistics">
                <div class="container">
                    <div class="row">
                        <div class="img-col">
                            <img src="<?= drupal_get_path('theme', 'new_design') . '/images/img05.jpg' ?>" alt="">
                        </div>
                        <div class="text-col">
                            <div class="block-title left">
                                <h2>Heading (statistics)</h2>
                            </div>
                            <div class="counters">
                                <div class="col">
                                    <span>300</span>
                                    <strong>Subheading</strong>
                                </div>
                                <div class="col">
                                    <span>24</span>
                                    <strong>Subheading</strong>
                                </div>
                                <div class="col">
                                    <span>0.07</span>
                                    <strong>Subheading</strong>
                                </div>
                            </div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the unknown printer took a
                                galley</p>
                            <p>of type and scrambled Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the </p>
                            <a href="#" class="btn btn-second-color">Get my invitation & a free upgrade</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="block coloured">
            <div class="features">
                <div class="container">
                    <div class="row">
                        <div class="text-col">
                            <div class="block-title left">
                                <h2>Main advantages of pro account</h2>
                            </div>
                            <div class="features-list">
                                <div class="item">
                                    <div class="img-h">
                                        <img src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-hand.svg' ?>"
                                             alt="">
                                    </div>
                                    <div class="text-h">
                                        <h4>Partner up with millions of travelers worldwide </h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                            industry. </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="img-h">
                                        <img src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-money.svg' ?>"
                                             alt="">
                                    </div>
                                    <div class="text-h">
                                        <h4>Leverage travelers' influence</h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                            industry. </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="img-h">
                                        <img src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-people.svg' ?>"
                                             alt="">
                                    </div>
                                    <div class="text-h">
                                        <h4>Reach the Millenials</h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                            industry. </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="img-h">
                                        <img src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-bookings.svg' ?>"
                                             alt="">
                                    </div>
                                    <div class="text-h">
                                        <h4>Get more bookings</h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                            industry. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="img-col">
                            <img src="<?= drupal_get_path('theme', 'new_design') . '/images/img-screenshot.jpg' ?>"
                                 alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="block wood">
            <div class="container">
                <div class="block-title">
                    <h2>How it works</h2>
                    <p class="sub-ttl">You recommend, you earn. It's that simple !</p>
                </div>
                <div class="how-it-works-slider">
                    <div class="how-slider">
                        <div class="slide">
                            <div class="steps">
                                <div class="step">
                                    <div class="img-h"><img
                                                src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-help-other.png' ?>"
                                                alt="image" width="223"
                                                height="230"></div>
                                    <strong class="ttl">1. Publish your services</strong>
                                    <p>Create your listings and let the community promote you to their networks.</p>
                                </div>
                                <div class="step">
                                    <div class="img-h"><img
                                                src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-refer-travelers.png' ?>"
                                                alt="image" width="202"
                                                height="218"></div>
                                    <strong class="ttl">2. Focus on your clients</strong>
                                    <p>Completely hasslefree, we take care of the payments so you can focus on providing
                                        unique experiences to your travelers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="block coloured">
            <div class="container">
                <div class="block-title">
                    <h2>Pricing</h2>
                </div>
                <p class="text-center">Just like in a plane, decide where you want your listing to show up. <br>We charge a 20% fix commission, we behave exactly as a classic travel agency. The only <br>difference is that we give that commission away to reward the advisors that promoted you.</p>
                <div class="pricing-list">
                    <div class="pricing-card">
                        <div class="card-bg-image">
                            <img src="<?= drupal_get_path('theme', 'new_design') . '/images/img06.jpg' ?>" alt="">
                        </div>
                        <div class="card-holder">
                            <strong class="name">Economy</strong>
                            <strong class="price"><span class="cur">$</span>0<span class="month"> /month</span></strong>
                            <strong>Real profit</strong>
                            <p>First advantage <br>Second advantage here</p>
                        </div>
                        <a class="choice-plan" href="#"><span>Choose this plan</span><span class="hover-text">Choose me now</span></a>
                    </div>
                    <div class="pricing-card">
                        <div class="card-bg-image">
                            <img src="<?= drupal_get_path('theme', 'new_design') . '/images/img06.jpg' ?>" alt="">
                        </div>
                        <div class="card-holder">
                            <strong class="name">BUSINESS</strong>
                            <strong class="price"><span class="cur">$</span>29<span class="month"> /month</span></strong>
                            <strong>Real profit</strong>
                            <p>First advantage <br>Second advantage here <br>Third advantage with %</p>
                        </div>
                        <a class="choice-plan" href="#"><span>Choose this plan</span><span class="hover-text">Choose me now</span></a>
                    </div>
                    <div class="pricing-card">
                        <div class="card-bg-image">
                            <img src="<?= drupal_get_path('theme', 'new_design') . '/images/img06.jpg' ?>" alt="">
                        </div>
                        <div class="card-holder">
                            <strong class="name">PREMIERE</strong>
                            <strong class="price"><span class="cur">$</span>59<span class="month"> /month</span></strong>
                            <strong>Real profit</strong>
                            <p>First advantage <br>Second advantage here <br>Third advantage here
                            </p>
                        </div>
                        <a class="choice-plan" href="#"><span>Choose this plan</span><span class="hover-text">Choose me now</span></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="block">
            <div class="container">
                <div class="block-title">
                    <h2>More advantages</h2>
                </div>
                <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                <ul class="markered-list">
                    <li>
							<span class="ico">
								<svg version="1.1" id="&#x421;&#x43B;&#x43E;&#x439;_1"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px" viewBox="0 0 40 37.8364182"
                                     style="enable-background:new 0 0 40 37.8364182;" xml:space="preserve">
								<g>
									<path style="fill:#501E00;" d="M35.552227,10.2645264c-0.6142273,0-1.1135025,0.498807-1.1135025,1.1136227v20.3338184
										c0,2.1488457-1.748127,3.8974419-3.8969727,3.8974419H6.1244512c-2.1487265,0-3.8973243-1.7485962-3.8973243-3.8974419V7.2946696
										c0-2.1488452,1.7485979-3.8974466,3.8973243-3.8974466h24.4173012c0.6152821,0,1.1136208-0.49822,1.1136208-1.1135023
										c0-0.6148183-0.4983387-1.113506-1.1136208-1.113506H6.1244512C2.7479806,1.1702148,0,3.917609,0,7.2946696v24.4172974
										c0,3.3770599,2.7479806,6.1244507,6.1244512,6.1244507h24.4173012c3.377533,0,6.1245689-2.7473907,6.1245689-6.1244507V11.378149
										C36.6658478,10.7633333,36.167984,10.2645264,35.552227,10.2645264L35.552227,10.2645264z M35.552227,10.2645264"/>
									<path style="fill:#FFC200;" d="M39.6739082,0.3260927c-0.4351501-0.4347902-1.140625-0.4347902-1.5744705,0L15.7240562,22.7005329
										l-5.5925179-5.592165c-0.4347916-0.4351463-1.1394405-0.4351463-1.5745869,0c-0.4346733,0.4347916-0.4346733,1.1397953,0,1.5745869
										l6.38099,6.3795757c0.2178669,0.2173996,0.5024624,0.3260937,0.787529,0.3260937
										c0.2850657,0,0.5701361-0.1086941,0.7874117-0.3260937c0-0.000946,0-0.0014133,0.0009441-0.0018845L39.6739082,1.9010378
										C40.108696,1.466244,40.108696,0.7607677,39.6739082,0.3260927L39.6739082,0.3260927z M39.6739082,0.3260927"/>
								</g>
								</svg>
							</span>
                        <div class="text-h">
                            <strong class="list-ttl">Advantage</strong>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the</p>
                        </div>
                    </li>
                    <li>
							<span class="ico">
								<svg version="1.1" id="&#x421;&#x43B;&#x43E;&#x439;_1"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px" viewBox="0 0 40 37.8364182"
                                     style="enable-background:new 0 0 40 37.8364182;" xml:space="preserve">
								<g>
									<path style="fill:#501E00;" d="M35.552227,10.2645264c-0.6142273,0-1.1135025,0.498807-1.1135025,1.1136227v20.3338184
										c0,2.1488457-1.748127,3.8974419-3.8969727,3.8974419H6.1244512c-2.1487265,0-3.8973243-1.7485962-3.8973243-3.8974419V7.2946696
										c0-2.1488452,1.7485979-3.8974466,3.8973243-3.8974466h24.4173012c0.6152821,0,1.1136208-0.49822,1.1136208-1.1135023
										c0-0.6148183-0.4983387-1.113506-1.1136208-1.113506H6.1244512C2.7479806,1.1702148,0,3.917609,0,7.2946696v24.4172974
										c0,3.3770599,2.7479806,6.1244507,6.1244512,6.1244507h24.4173012c3.377533,0,6.1245689-2.7473907,6.1245689-6.1244507V11.378149
										C36.6658478,10.7633333,36.167984,10.2645264,35.552227,10.2645264L35.552227,10.2645264z M35.552227,10.2645264"/>
									<path style="fill:#FFC200;" d="M39.6739082,0.3260927c-0.4351501-0.4347902-1.140625-0.4347902-1.5744705,0L15.7240562,22.7005329
										l-5.5925179-5.592165c-0.4347916-0.4351463-1.1394405-0.4351463-1.5745869,0c-0.4346733,0.4347916-0.4346733,1.1397953,0,1.5745869
										l6.38099,6.3795757c0.2178669,0.2173996,0.5024624,0.3260937,0.787529,0.3260937
										c0.2850657,0,0.5701361-0.1086941,0.7874117-0.3260937c0-0.000946,0-0.0014133,0.0009441-0.0018845L39.6739082,1.9010378
										C40.108696,1.466244,40.108696,0.7607677,39.6739082,0.3260927L39.6739082,0.3260927z M39.6739082,0.3260927"/>
								</g>
								</svg>
							</span>
                        <div class="text-h">
                            <strong class="list-ttl">Advantage</strong>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the</p>
                        </div>
                    </li>
                    <li>
							<span class="ico">
								<svg version="1.1" id="&#x421;&#x43B;&#x43E;&#x439;_1"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px" viewBox="0 0 40 37.8364182"
                                     style="enable-background:new 0 0 40 37.8364182;" xml:space="preserve">
								<g>
									<path style="fill:#501E00;" d="M35.552227,10.2645264c-0.6142273,0-1.1135025,0.498807-1.1135025,1.1136227v20.3338184
										c0,2.1488457-1.748127,3.8974419-3.8969727,3.8974419H6.1244512c-2.1487265,0-3.8973243-1.7485962-3.8973243-3.8974419V7.2946696
										c0-2.1488452,1.7485979-3.8974466,3.8973243-3.8974466h24.4173012c0.6152821,0,1.1136208-0.49822,1.1136208-1.1135023
										c0-0.6148183-0.4983387-1.113506-1.1136208-1.113506H6.1244512C2.7479806,1.1702148,0,3.917609,0,7.2946696v24.4172974
										c0,3.3770599,2.7479806,6.1244507,6.1244512,6.1244507h24.4173012c3.377533,0,6.1245689-2.7473907,6.1245689-6.1244507V11.378149
										C36.6658478,10.7633333,36.167984,10.2645264,35.552227,10.2645264L35.552227,10.2645264z M35.552227,10.2645264"/>
									<path style="fill:#FFC200;" d="M39.6739082,0.3260927c-0.4351501-0.4347902-1.140625-0.4347902-1.5744705,0L15.7240562,22.7005329
										l-5.5925179-5.592165c-0.4347916-0.4351463-1.1394405-0.4351463-1.5745869,0c-0.4346733,0.4347916-0.4346733,1.1397953,0,1.5745869
										l6.38099,6.3795757c0.2178669,0.2173996,0.5024624,0.3260937,0.787529,0.3260937
										c0.2850657,0,0.5701361-0.1086941,0.7874117-0.3260937c0-0.000946,0-0.0014133,0.0009441-0.0018845L39.6739082,1.9010378
										C40.108696,1.466244,40.108696,0.7607677,39.6739082,0.3260927L39.6739082,0.3260927z M39.6739082,0.3260927"/>
								</g>
								</svg>
							</span>
                        <div class="text-h">
                            <strong class="list-ttl">Advantage</strong>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the</p>
                        </div>
                    </li>
                    <li>
							<span class="ico">
								<svg version="1.1" id="&#x421;&#x43B;&#x43E;&#x439;_1"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px" viewBox="0 0 40 37.8364182"
                                     style="enable-background:new 0 0 40 37.8364182;" xml:space="preserve">
								<g>
									<path style="fill:#501E00;" d="M35.552227,10.2645264c-0.6142273,0-1.1135025,0.498807-1.1135025,1.1136227v20.3338184
										c0,2.1488457-1.748127,3.8974419-3.8969727,3.8974419H6.1244512c-2.1487265,0-3.8973243-1.7485962-3.8973243-3.8974419V7.2946696
										c0-2.1488452,1.7485979-3.8974466,3.8973243-3.8974466h24.4173012c0.6152821,0,1.1136208-0.49822,1.1136208-1.1135023
										c0-0.6148183-0.4983387-1.113506-1.1136208-1.113506H6.1244512C2.7479806,1.1702148,0,3.917609,0,7.2946696v24.4172974
										c0,3.3770599,2.7479806,6.1244507,6.1244512,6.1244507h24.4173012c3.377533,0,6.1245689-2.7473907,6.1245689-6.1244507V11.378149
										C36.6658478,10.7633333,36.167984,10.2645264,35.552227,10.2645264L35.552227,10.2645264z M35.552227,10.2645264"/>
									<path style="fill:#FFC200;" d="M39.6739082,0.3260927c-0.4351501-0.4347902-1.140625-0.4347902-1.5744705,0L15.7240562,22.7005329
										l-5.5925179-5.592165c-0.4347916-0.4351463-1.1394405-0.4351463-1.5745869,0c-0.4346733,0.4347916-0.4346733,1.1397953,0,1.5745869
										l6.38099,6.3795757c0.2178669,0.2173996,0.5024624,0.3260937,0.787529,0.3260937
										c0.2850657,0,0.5701361-0.1086941,0.7874117-0.3260937c0-0.000946,0-0.0014133,0.0009441-0.0018845L39.6739082,1.9010378
										C40.108696,1.466244,40.108696,0.7607677,39.6739082,0.3260927L39.6739082,0.3260927z M39.6739082,0.3260927"/>
								</g>
								</svg>
							</span>
                        <div class="text-h">
                            <strong class="list-ttl">Advantage</strong>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the</p>
                        </div>
                    </li>
                    <li>
							<span class="ico">
								<svg version="1.1" id="&#x421;&#x43B;&#x43E;&#x439;_1"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px" viewBox="0 0 40 37.8364182"
                                     style="enable-background:new 0 0 40 37.8364182;" xml:space="preserve">
								<g>
									<path style="fill:#501E00;" d="M35.552227,10.2645264c-0.6142273,0-1.1135025,0.498807-1.1135025,1.1136227v20.3338184
										c0,2.1488457-1.748127,3.8974419-3.8969727,3.8974419H6.1244512c-2.1487265,0-3.8973243-1.7485962-3.8973243-3.8974419V7.2946696
										c0-2.1488452,1.7485979-3.8974466,3.8973243-3.8974466h24.4173012c0.6152821,0,1.1136208-0.49822,1.1136208-1.1135023
										c0-0.6148183-0.4983387-1.113506-1.1136208-1.113506H6.1244512C2.7479806,1.1702148,0,3.917609,0,7.2946696v24.4172974
										c0,3.3770599,2.7479806,6.1244507,6.1244512,6.1244507h24.4173012c3.377533,0,6.1245689-2.7473907,6.1245689-6.1244507V11.378149
										C36.6658478,10.7633333,36.167984,10.2645264,35.552227,10.2645264L35.552227,10.2645264z M35.552227,10.2645264"/>
									<path style="fill:#FFC200;" d="M39.6739082,0.3260927c-0.4351501-0.4347902-1.140625-0.4347902-1.5744705,0L15.7240562,22.7005329
										l-5.5925179-5.592165c-0.4347916-0.4351463-1.1394405-0.4351463-1.5745869,0c-0.4346733,0.4347916-0.4346733,1.1397953,0,1.5745869
										l6.38099,6.3795757c0.2178669,0.2173996,0.5024624,0.3260937,0.787529,0.3260937
										c0.2850657,0,0.5701361-0.1086941,0.7874117-0.3260937c0-0.000946,0-0.0014133,0.0009441-0.0018845L39.6739082,1.9010378
										C40.108696,1.466244,40.108696,0.7607677,39.6739082,0.3260927L39.6739082,0.3260927z M39.6739082,0.3260927"/>
								</g>
								</svg>
							</span>
                        <div class="text-h">
                            <strong class="list-ttl">Advantage</strong>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the</p>
                        </div>
                    </li>
                    <li>
							<span class="ico">
								<svg version="1.1" id="&#x421;&#x43B;&#x43E;&#x439;_1"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px" viewBox="0 0 40 37.8364182"
                                     style="enable-background:new 0 0 40 37.8364182;" xml:space="preserve">
								<g>
									<path style="fill:#501E00;" d="M35.552227,10.2645264c-0.6142273,0-1.1135025,0.498807-1.1135025,1.1136227v20.3338184
										c0,2.1488457-1.748127,3.8974419-3.8969727,3.8974419H6.1244512c-2.1487265,0-3.8973243-1.7485962-3.8973243-3.8974419V7.2946696
										c0-2.1488452,1.7485979-3.8974466,3.8973243-3.8974466h24.4173012c0.6152821,0,1.1136208-0.49822,1.1136208-1.1135023
										c0-0.6148183-0.4983387-1.113506-1.1136208-1.113506H6.1244512C2.7479806,1.1702148,0,3.917609,0,7.2946696v24.4172974
										c0,3.3770599,2.7479806,6.1244507,6.1244512,6.1244507h24.4173012c3.377533,0,6.1245689-2.7473907,6.1245689-6.1244507V11.378149
										C36.6658478,10.7633333,36.167984,10.2645264,35.552227,10.2645264L35.552227,10.2645264z M35.552227,10.2645264"/>
									<path style="fill:#FFC200;" d="M39.6739082,0.3260927c-0.4351501-0.4347902-1.140625-0.4347902-1.5744705,0L15.7240562,22.7005329
										l-5.5925179-5.592165c-0.4347916-0.4351463-1.1394405-0.4351463-1.5745869,0c-0.4346733,0.4347916-0.4346733,1.1397953,0,1.5745869
										l6.38099,6.3795757c0.2178669,0.2173996,0.5024624,0.3260937,0.787529,0.3260937
										c0.2850657,0,0.5701361-0.1086941,0.7874117-0.3260937c0-0.000946,0-0.0014133,0.0009441-0.0018845L39.6739082,1.9010378
										C40.108696,1.466244,40.108696,0.7607677,39.6739082,0.3260927L39.6739082,0.3260927z M39.6739082,0.3260927"/>
								</g>
								</svg>
							</span>
                        <div class="text-h">
                            <strong class="list-ttl">Advantage</strong>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <section class="block marketing">
            <div class="container">
                <div class="block-title left">
                    <a href="#" class="btn btn-marketing-b pull-right">Marketing button A</a>
                    <a href="#" class="btn btn-marketing-a pull-right">Marketing button B</a>
                    <h2>Marketing slogan with picture </h2>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="container">
            <a href="#" class="logo"><img src="<?= drupal_get_path('theme', 'new_design') . '/images/logo.png' ?>"
                                          alt="Gloobers" height="59" width="160"></a>
            <div class="soc-list">
                <a class="item" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a class="item" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a class="item" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
            </div>
            <ul class="footer-nav">
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Gloobers for professionals</a></li>
            </ul>
        </div>
        <div class="footer-row container">
            <p class="copy"><strong>Gloobers Global Ltd.</strong> 2016. All rights reserved</p>
            <ul class="extra-nav">
                <li><a href="#">Help center</a></li>
                <li><a href="#">Terms and Conditions</a></li>
            </ul>
        </div>
    </footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://use.fontawesome.com/36fe5b07c5.js"></script>

<script src="<?= drupal_get_path('theme', 'new_design') . '/js/custom-file-input.js' ?>"></script>

<script type="text/javascript" src="<?= drupal_get_path('theme', 'new_design') . '/js/moment.js' ?>"></script>
<script type="text/javascript" src="<?= drupal_get_path('theme', 'new_design') . '/js/daterangepicker.js' ?>"></script>
<script type="text/javascript" src="<?= drupal_get_path('theme', 'new_design') . '/js/bootstrap.min.js' ?>"></script>
<script type="text/javascript" src="<?= drupal_get_path('theme', 'new_design') . '/js/slick.min.js' ?>"></script>

<script src="<?= drupal_get_path('theme', 'new_design') . '/js/tether.min.js' ?>"></script>
<script src="<?= drupal_get_path('theme', 'new_design') . '/js/drop.min.js' ?>"></script>
<script src="<?= drupal_get_path('theme', 'new_design') . '/js/main.js' ?>"></script>
</html>