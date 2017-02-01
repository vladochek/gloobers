<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gloobers</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans:400,700" rel="stylesheet">
</head>
<body  >
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
            <?php //activities_count('Paris');// drupal_render(drupal_get_form('search_listings_form')) ?>
            <div class="search-area">
                <h1>Be Friendly, Travel for free</h1>
                <p class="sub-ttl">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                    Ipsum is simply dummy text of the printing and typesetting industry. </p>
                <div class="search-tabs">
                    <div data-target="#tab01" class="radio radio-inline">
                        <input id="lb01" value="tab01" type="radio" name="search-tabs" checked="checked">
                        <label for="lb01">Hotel</label>
                    </div>
                    <div data-target="#tab02" class="radio radio-inline">
                        <input id="lb02" value="tab02" type="radio" name="search-tabs">
                        <label for="lb02">Activities</label>
                    </div>
                    <div data-target="#tab03" class="radio radio-inline">
                        <input id="lb03" value="tab03" type="radio" name="search-tabs">
                        <label for="lb03">Find an advisor</label>
                    </div>
                </div>
                <div class="search-bar">
                    <div class="tab-content">
                        <form action="/search-hotel" method="get" class="tab-pane active" id="tab01">
                            <div class="col col01">
                                <span class="ttl">Where?</span>
                                <input type="text" id="destination-hotel" placeholder="Enter your destination" value=""
                                       onclick="hometowngeocode('destination-hotel')" name="destination">
                            </div>
                            <div class="col col02">
                                <span class="ttl">When?</span>
                                <div class="date-range">
                                    <input id="calendar-hotel" name="daterange" class="date-range-input" type="text" data-opens="left"
                                           placeholder="<?= date('d/m/Y') . ' - ' . date('d/m/Y', strtotime('+2 days')) ?>"
                                           value="<?= date('d/m/Y') . ' - ' . date('d/m/Y', strtotime('+2 days')) ?>">
                                </div>
                            </div>
                            <div class="col col03">
                                <span class="ttl">What?</span>
                                <div class="person-num">

                                    <span class="chosen open-drop" data-offset="-25px -15px" data-theme="drop-theme-arrows-bounce" data-position="bottom right" ><span id="all-persons-cnt">3</span> Persons <i class="gl-ico gl-ico-arrow-down"></i></span>

                                    <div class="drop-content hide">
                                        <div class="person-num-holder">
                                            <div class="person-row">
                                                <div class="operation-btns pull-right">
                                                    <span id="adult-minus" class="btns-col"><span class="btn-sub"><i class="gl-ico gl-ico-minus"></i></span></span>
                                                    <span id="adult-plus" class="btns-col"><span class="btn-add"><i class="gl-ico gl-ico-plus"></i></span></span>
                                                </div>
                                                <div class="text-h">
                                                    <strong><span id="adult-cnt">2</span>Adult</strong>
                                                </div>
                                            </div>
                                            <div class="person-row">
                                                <div class="operation-btns pull-right">
                                                    <span class="btns-col" id="children-minus"><span class="btn-sub"><i class="gl-ico gl-ico-minus"></i></span></span>
                                                    <span class="btns-col" id="children-plus"><span class="btn-add"><i class="gl-ico gl-ico-plus"></i></span></span>
                                                </div>
                                                <div class="text-h">
                                                    <strong class=""><span id="children-cnt">1</span>Childrens</strong>
                                                    <em class="person-info">Age 2 -12 </em>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="childrens-count" value="1" name="childrens">
                                    <input type="hidden" id="adults-count" value="2" name="adults">
                                    <input type="hidden" id="rooms-count" value="1" name="rooms">

                                    <input type="hidden" id="city-hotels" name="city" >
                                    <input type="hidden" id="country-hotels" name="country" >
                                    <input type="hidden" id="state-hotels" name="state">
                                    <input type="hidden" id="address-hotels" name="address" >
                                </div>
                            </div>
                        </form>
                        <form action="/search-destination" method="get" class="tab-pane" id="tab02">
                            <div class="col col01">
                                <span class="ttl">Where?</span>
                                <input type="text" id="destination-activity"
                                       onclick="hometowngeocode('destination-activity')"
                                       placeholder="Enter your destination" value="" name="destination">

                                <input type="hidden" id="city-activity" name="city" >
                                <input type="hidden" id="country-activity" name="country" >
                                <input type="hidden" id="state-activity" name="state">
                                <input type="hidden" id="address-activity" name="address" >
                            </div>
                            <div class="col col02">
                                <span class="ttl">When?</span>
                                <div class="date-range">
                                    <input name="daterange" id="calendar-activity" class="date-range-input" type="text"
                                           placeholder="<?= date('d/m/Y') . ' - ' . date('d/m/Y', strtotime('+2 days')) ?>"
                                           value="<?= date('d/m/Y') . ' - ' . date('d/m/Y', strtotime('+2 days')) ?>">
                                </div>
                            </div>
                            <div class="col col03">
                                <span class="ttl">What?</span>

                                <div class="person-num">
                                    <span class="chosen open-drop" data-offset="-25px -15px" data-theme="drop-theme-arrows-bounce" data-position="bottom right" ><span class="persons-cnt">2</span> Persons <i class="gl-ico gl-ico-arrow-down"></i></span>
                                    <div class="drop-content hide">
                                        <div class="person-num-holder">
                                            <div class="person-row">
                                                <div class="operation-btns pull-right">
                                                    <span id="persons-minus" class="btns-col"><span class="btn-sub"><i class="gl-ico gl-ico-minus"></i></span></span>
                                                    <span id="persons-plus" class="btns-col"><span class="btn-add"><i class="gl-ico gl-ico-plus"></i></span></span>
                                                </div>
                                                <div class="text-h">
                                                    <strong><span class="persons-cnt">2</span>Adult</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="persons-count" name="persons" value="2">
                        </form>
                        <form action="/search-advisor" method="get" class="tab-pane" id="tab03">
                            <div class="col col01">
                                <span class="ttl">Where?</span>
                                <input class="destination" id="destination-advisor"
                                       name="destination"
                                       onclick="hometowngeocode('destination-advisor')" type="text"
                                       placeholder="Enter your destination" value="">
                                <input type="hidden" id="persons-count-advisor" name="persons" value="2">

                                <input type="hidden" id="city-advisor" name="city">
                                <input type="hidden" id="country-advisor" name="country">
                                <input type="hidden" id="state-advisor" name="state">
                                <input type="hidden" id="address-advisor" name="address">
                                <input type="hidden" id="passport-advisor" name="passport-types" value="1">
                                <input type="hidden" id="search-type-advisor" name="search_type" value="recommendation">
                            </div>
                        </form>
                    </div>
                    <button id="submit-btn" form="tab01" type="submit" name="" class="btn-search"><i
                                class="fa fa-search" aria-hidden="true"></i></button>
                </div>
                <p class="search-info">Search through 6.000 items or browse 2.000 events.</p>
            </div>
            <a href="#tag" class="btn-scroll">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="45" viewBox="0 0 30 45">
                    <metadata><?xpacket begin="﻿" id="W5M0MpCehiHzreSzNTczkc9d"?>
                        <x:xmpmeta xmlns:x="adobe:ns:meta/" x:xmptk="Adobe XMP Core 5.6-c138 79.159824, 2016/09/14-01:09:01        ">
                            <rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
                                <rdf:Description rdf:about=""/>
                            </rdf:RDF>
                        </x:xmpmeta>
                        <?xpacket end="w"?></metadata>
                    <image id="mouse" width="30" height="45" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAtCAQAAAAT1xMqAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAACxIAAAsSAdLdfvwAAAAHdElNRQfgDBQNKSMu4uEhAAACG0lEQVRIx+3WvU9TYRTH8V8vEFBJkSiJLzEYizQ6EFCbdMJEAhqJhsioDjoxspgwODGw+PIfGBNdSDRsisRBGrtUXdTBVIsvkcQQaStCtYXefh3ahvb2aeUy95zl3nPP57nnmZ7HgwzRpwGdkE+tsrWiT3qlOX0x9FGezYzxgXyk+Mp30oW3MCN4yrvL6RALQIoHjLKvULPwcY2nZIEwx83YwxSwzi32IkN2MQ2kuFKJLR4CUXqMsJgXiAPjTnwXeEmbo/kJU46Kn0Uo/j1fGgXeVlDxi/mKmp8EKY4V8W6WWOOoYUwTFheBMJ48ngRuGPdoxmIaGEGimQQ/2OEKd5NjHlkaVrvu6a/cxEc912l1Wjor6bErKkmPJA1aCmhV71zjsKSAJZ+iylVpyehPlS8xZXWkUV4tV12/XytVvmT1W3saJWWq4miNwVdlWa53WxJ1XMd1XAW3bEt6ZVtKqmMbtElexS0tyK8G17hbDYpZimiXTrrGZyRFxHngds2z0ZQhbPaLJpZYptUV7QOe5c+qCWDSFZ4FBvJ4J99I07tlehWY3Tyfh8jxmY4t0VOskeRw6c3gJvCeA/+lAX5iM1x+rRB3gEX6a9LrpLC57LyTCDHOBnCfLiMM8gJIcG6z5hzqDWAzxxg9tCBEG0EmeA3ADIdK+53rW1wiRDHSbBSeMswQdE7jMd49D2pQvepUu3KKK6aIQkpWtv0DHYXYxCIfOB0AAAAASUVORK5CYII="/>
                </svg>
            </a>
        </div>
    </header>
    <main class="main">
        <section class="block">
            <div class="container">
                <div class="block-title">
                    <h2>Last followed recommendations</h2>
                </div>
                <div class="recommendations">
                    <?php foreach (get_last_followed_recommendations() as $recommendation): ?>
                        <div class="card">
                            <a href="/experience/<?= $recommendation["eid"] ?>" class="card-holder">
                                <div class="img-h">
									<span class="img-wrap">
                                        <img src="<?= get_listing_photos($recommendation) ?>" alt="image">
									</span>
                                    <div class="price">
                                        <strong><?= round($recommendation['base_price']*(variable_get('credit_value')/100), 2) ?><sup>TC</sup></strong>
                                        <span>You earn</span>
                                    </div>
                                </div>
                                <img class="avatar" src="<?= get_user_photo($recommendation) ?>" alt="image">
                                <strong class="ttl"><?= $recommendation['title'] ?></strong>
                                <span class="sub-ttl"><?= $recommendation['address1'] ?></span>
                                <footer>
                                    <span class="category"><?= $recommendation['experience_type'] ?></span>
                                    <em class="reviews"><strong><?= $recommendation['reviews_count'] ?></strong> Reviews</em>
                                </footer>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="btn-row center">
                    <a href="#" class="btn btn-more">See more</a>
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
                    <nav class="slider-tabs">
                        <ul>
                            <li class="slider-0 active"><a href="javascript:void(0);">Travel</a></li>
                            <li class="slider-1"><a href="javascript:void(0);">Advise</a></li>
                            <li class="slider-2"><a href="javascript:void(0);">Earn</a></li>
                        </ul>
                    </nav>
                    <div class="how-slider">
                        <div class="slide">
                            <div class="steps">
                                <div class="step">
                                    <div class="img-h"><img
                                                src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-help-travelers.png' ?>"
                                                alt="image" width="230" height="166"></div>
                                    <strong class="ttl">1. Help other travelers</strong>
                                </div>
                                <div class="step">
                                    <div class="img-h"><img
                                                src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-get-rewarded.png' ?>"
                                                alt="image" width="170" height="229"></div>
                                    <strong class="ttl">2. Get rewarded</strong>
                                </div>
                                <div class="step">
                                    <div class="img-h"><img
                                                src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-travel-free.png' ?>"
                                                alt="image" width="204" height="230"></div>
                                    <strong class="ttl">3. Travel for free</strong>
                                </div>
                            </div>
                        </div>
                        <div class="slide">
                            <div class="steps">
                                <div class="step">
                                    <div class="img-h"><img
                                                src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-trustful.png' ?>"
                                                alt="image" width="230" height="165"></div>
                                    <strong class="ttl">1. Find trustful advisors</strong>
                                </div>
                                <div class="step">
                                    <div class="img-h"><img
                                                src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-get-rewarded.png' ?>"
                                                alt="image" width="170" height="229"></div>
                                    <strong class="ttl">2. Get tailor-made recommendations</strong>
                                </div>
                                <div class="step">
                                    <div class="img-h"><img
                                                src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-travel-credits.png' ?>"
                                                alt="image" width="230" height="219"></div>
                                    <strong class="ttl">3. Travel using your Travel credits</strong>
                                </div>
                            </div>
                        </div>
                        <div class="slide">
                            <div class="steps">
                                <div class="step">
                                    <div class="img-h"><img
                                                src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-help-other.png' ?>"
                                                alt="image" width="223" height="230"></div>
                                    <strong class="ttl">Help other traveler</strong>
                                    <p>and earn up to 7% of booked amount in Travel credits</p>
                                </div>
                                <div class="step">
                                    <div class="img-h"><img
                                                src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-refer-travelers.png' ?>"
                                                alt="image" width="202" height="218"></div>
                                    <strong class="ttl">Refer travelers</strong>
                                    <p>and earn passively on every trip they'll book, or every recommendation they'll
                                        give</p>
                                </div>
                                <div class="step">
                                    <div class="img-h"><img
                                                src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-refer-prof.png' ?>"
                                                alt="image" width="230" height="210"></div>
                                    <strong class="ttl">Refer professionals</strong>
                                    <p>Earn a passive reward on every single reservation they will receive</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="block">
            <div class="container">
                <div class="block-title">
                    <h2>Cities we support</h2>
                </div>
                <div class="cities-list">
                    <div class="item big">
                        <a href="search-destination?destination=Berlin&daterange=<?= date('d/m/Y') . ' - ' . date('d/m/Y', strtotime('+2 days')) ?>&persons=2">
                            <div class="text-h">
                                <strong class="city-name">Berlin</strong>
                                <span class="events-num"><strong><?= activities_count('Berlin') ?></strong> events</span>
                            </div>
                            <img src="<?= drupal_get_path('theme', 'new_design') . '/images/img02.jpg' ?>" alt="images">
                        </a>
                    </div>
                    <div class="item">
                        <a href="search-destination?destination=Paris&daterange=<?= date('d/m/Y') . ' - ' . date('d/m/Y', strtotime('+2 days')) ?>&persons=2">
                            <div class="text-h">
                                <strong class="city-name">Paris</strong>
                                <span class="events-num"><strong><?= activities_count('Paris') ?></strong> events</span>
                            </div>
                            <img src="<?= drupal_get_path('theme', 'new_design') . '/images/img02.jpg' ?>" alt="images">
                        </a>
                    </div>
                    <div class="item">
                        <a href="search-destination?destination=Paris&daterange=<?= date('d/m/Y') . ' - ' . date('d/m/Y', strtotime('+2 days')) ?>&persons=2">
                            <div class="text-h">
                                <strong class="city-name">Paris</strong>
                                <span class="events-num"><strong><?= activities_count('Paris') ?></strong> events</span>
                            </div>
                            <img src="<?= drupal_get_path('theme', 'new_design') . '/images/img02.jpg' ?>" alt="images">
                        </a>
                    </div>
                    <div class="item">
                        <a href="search-destination?destination=Paris&daterange=<?= date('d/m/Y') . ' - ' . date('d/m/Y', strtotime('+2 days')) ?>&persons=2">
                            <div class="text-h">
                                <strong class="city-name">Paris</strong>
                                <span class="events-num"><strong><?= activities_count('Paris') ?></strong> events</span>
                            </div>
                            <img src="<?= drupal_get_path('theme', 'new_design') . '/images/img02.jpg' ?>" alt="images">
                        </a>
                    </div>
                    <div class="item">
                        <a href="search-destination?destination=Paris&daterange=<?= date('d/m/Y') . ' - ' . date('d/m/Y', strtotime('+2 days')) ?>&persons=2">
                            <div class="text-h">
                                <strong class="city-name">Paris</strong>
                                <span class="events-num"><strong><?= activities_count('Paris') ?></strong> events</span>
                            </div>
                            <img src="<?= drupal_get_path('theme', 'new_design') . '/images/img02.jpg' ?>" alt="images">
                        </a>
                    </div>
                </div>
                <div class="btn-row center">
                    <a href="#" class="btn btn-more">View more links</a>
                </div>
            </div>
        </section>
        <section class="block">
            <div class="container">
                <div class="block-title">
                    <h2>Testimonials</h2>
                </div>
                <div class="testimonials-slider">
                    <div class="testimonials-blockquote slider-for">
                        <div class="item">
                            <blockquote>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived, !</p>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet assumenda corporis
                                    distinctio quos repellendus. Cum deleniti facilis, inventore perferendis quae soluta
                                    unde. A deserunt distinctio molestiae similique suscipit ullam voluptas.</p>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>Adipisci atque earum, facilis illum nemo numquam officia optio perspiciatis quam
                                    saepe? Harum, mollitia, obcaecati?</p>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>4Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived, !</p>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>5Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived, !</p>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>1Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived, !</p>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>2Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived, !</p>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>3Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived, !</p>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>4Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived, !</p>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>5Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived, !</p>
                            </blockquote>
                        </div>
                    </div>
                    <div class="testimonials-carousel">
                        <div class="item">
                            <div class="img-h"><img
                                        src="<?= drupal_get_path('theme', 'new_design') . '/images/photo02.jpg' ?>"
                                        alt="image"></div>
                        </div>
                        <div class="item">
                            <div class="img-h"><img
                                        src="<?= drupal_get_path('theme', 'new_design') . '/images/photo03.jpg' ?>"
                                        alt="image"></div>
                        </div>
                        <div class="item">
                            <div class="img-h"><img
                                        src="<?= drupal_get_path('theme', 'new_design') . '/images/photo04.jpg' ?>"
                                        alt="image"></div>
                        </div>
                        <div class="item">
                            <div class="img-h"><img
                                        src="<?= drupal_get_path('theme', 'new_design') . '/images/photo05.jpg' ?>"
                                        alt="image"></div>
                        </div>
                        <div class="item">
                            <div class="img-h"><img
                                        src="<?= drupal_get_path('theme', 'new_design') . '/images/photo06.jpg' ?>"
                                        alt="image"></div>
                        </div>
                        <div class="item">
                            <div class="img-h"><img
                                        src="<?= drupal_get_path('theme', 'new_design') . '/images/photo02.jpg' ?>"
                                        alt="image"></div>
                        </div>
                        <div class="item">
                            <div class="img-h"><img
                                        src="<?= drupal_get_path('theme', 'new_design') . '/images/photo03.jpg' ?>"
                                        alt="image"></div>
                        </div>
                        <div class="item">
                            <div class="img-h"><img
                                        src="<?= drupal_get_path('theme', 'new_design') . '/images/photo04.jpg' ?>"
                                        alt="image"></div>
                        </div>
                        <div class="item">
                            <div class="img-h"><img
                                        src="<?= drupal_get_path('theme', 'new_design') . '/images/photo05.jpg' ?>"
                                        alt="image"></div>
                        </div>
                        <div class="item">
                            <div class="img-h"><img
                                        src="<?= drupal_get_path('theme', 'new_design') . '/images/photo06.jpg' ?>"
                                        alt="image"></div>
                        </div>
                    </div>
                    <div class="testimonials-cite slider-for">
                        <div class="item">
                            <em>
                                <strong>Eleanor Reagby </strong>
                                <span>Student in Medicine, Paris</span>
                            </em>
                        </div>
                        <div class="item">
                            <em>
                                <strong>Arnold </strong>
                                <span>Student</span>
                            </em>
                        </div>
                        <div class="item">
                            <em>
                                <strong>Natasha</strong>
                                <span>Kiev</span>
                            </em>
                        </div>
                        <div class="item">
                            <em>
                                <strong>Helen</strong>
                                <span>USA</span>
                            </em>
                        </div>
                        <div class="item">
                            <em>
                                <strong>Eleanor Reagby </strong>
                                <span>5Student in Medicine, Paris</span>
                            </em>
                        </div>
                        <div class="item">
                            <em>
                                <strong>Eleanor Reagby </strong>
                                <span>1Student in Medicine, Paris</span>
                            </em>
                        </div>
                        <div class="item">
                            <em>
                                <strong>Eleanor Reagby </strong>
                                <span>2Student in Medicine, Paris</span>
                            </em>
                        </div>
                        <div class="item">
                            <em>
                                <strong>Eleanor Reagby </strong>
                                <span>3Student in Medicine, Paris</span>
                            </em>
                        </div>
                        <div class="item">
                            <em>
                                <strong>Eleanor Reagby </strong>
                                <span>4Student in Medicine, Paris</span>
                            </em>
                        </div>
                        <div class="item">
                            <em>
                                <strong>Eleanor Reagby </strong>
                                <span>5Student in Medicine, Paris</span>
                            </em>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="block">
            <div class="container">
                <div class="block-title left">
                    <h2>FAQ</h2>
                </div>
                <div class="columns faq">
                    <div class="col">
                        <h3>Lorem Ipsum is simply dummy text of the printing?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the unknown printer took a galley of type
                            and scrambled Lorem Ipsum is simply dummy</p>
                        <h3>Lorem Ipsum is simply dummy text of the printing?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the unknown printer took a galley of type
                            and scrambled Lorem Ipsum is simply dummy</p>
                        <h3>Lorem Ipsum is simply dummy text of the printing?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the unknown printer took a galley of type
                            and scrambled Lorem Ipsum is simply dummy</p>
                        <h3>Lorem Ipsum is simply dummy text of the printing?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the unknown printer took a galley of type
                            and scrambled Lorem Ipsum is simply dummy</p>
                    </div>
                    <div class="col">
                        <h3>Lorem Ipsum is simply dummy text of the printing?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the unknown printer took a galley of type
                            and scrambled Lorem Ipsum is simply dummy</p>
                        <h3>Lorem Ipsum is simply dummy text of the printing?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the unknown printer took a galley of type
                            and scrambled Lorem Ipsum is simply dummy</p>
                        <h3>Lorem Ipsum is simply dummy text of the printing?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the unknown printer took a galley of type
                            and scrambled Lorem Ipsum is simply dummy</p>
                        <h3>Lorem Ipsum is simply dummy text of the printing?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the unknown printer took a galley of type
                            and scrambled Lorem Ipsum is simply dummy</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="block coloured">
            <div class="features">
                <div class="container">
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
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="img-h">
                                    <img src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-money.svg' ?>"
                                         alt="">
                                </div>
                                <div class="text-h">
                                    <h4>Leverage travelers' influence</h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="img-h">
                                    <img src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-people.svg' ?>"
                                         alt="">
                                </div>
                                <div class="text-h">
                                    <h4>Reach the Millenials</h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="img-h">
                                    <img src="<?= drupal_get_path('theme', 'new_design') . '/images/ico-bookings.svg' ?>"
                                         alt="">
                                </div>
                                <div class="text-h">
                                    <h4>Get more bookings</h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="img-col">
                        <img src="<?= drupal_get_path('theme', 'new_design') . '/images/img-screenshot.png' ?>" alt="">
                    </div>
                </div>
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
            <a href="#" class="logo"><img src="<?= drupal_get_path('theme', 'new_design') . '/images/logo.png' ?>" alt="Gloobers" height="59" width="160"></a>
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
<!--<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyA9ZXW_xxCYbGV5hAN13jO2yquESD3MY10 &libraries=places&language=en" async defer></script>-->
<?php

drupal_add_js('https://use.fontawesome.com/36fe5b07c5.js', 'external');
?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<!--<script src="js/custom-file-input.js"></script>-->
<!--<script src="js/jquery.fancybox.pack.js"></script>-->
<!---->
<!--<script type="text/javascript" src="js/moment.js"></script>-->
<!--<script type="text/javascript" src="js/daterangepicker.js"></script>-->
<!--<script type="text/javascript" src="js/slick.min.js"></script>-->
<!---->
<!--<script src="js/main.js"></script>-->
</body>
</html>
