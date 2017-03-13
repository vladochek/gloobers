<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gloobers</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans:400,700" rel="stylesheet">
    <?php
    global $base_path;
    drupal_add_js('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', 'external');
    drupal_add_js('https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyA9ZXW_xxCYbGV5hAN13jO2yquESD3MY10 &libraries=places&language=en', 'external');
    drupal_add_js('https://use.fontawesome.com/36fe5b07c5.js', 'external');
    ?>
</head>
<body>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=217340822061120";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div class="wrapper">
    <header class="header">
        <div class="header-holder container-fluid">
            <a href="#" class="logo"><img
                        src="<?= $base_path . drupal_get_path('theme', 'new_design') . '/images/logo-inner.png' ?>"
                        alt="Gloobers" height="60" width="49"></a>
            <nav class="nav">
                <ul class="main-nav">
                    <li><a href="#">About <i class="gl-ico gl-ico-arrow-down"></i></a></li>
                    <li class="active"><a href="#">Professionals</a></li>
                    <li><a href="#">Log in</a></li>
                </ul>
                <a href="#" class="btn btn-default">Refer a professional</a>
            </nav>
            <div class="object-type">
                <a href="#" class="open-drop" data-offset="-10px 0" data-theme="drop-theme-arrows-bounce">
                    Hotels <i class="gl-ico gl-ico-arrow-down"></i>
                </a>
                <div class="drop-content hide">
                    <div class="drop-list">
                        <ul>
                            <li class="active"><a href="#">Hotels</a></li>
                            <li><a href="#">Activites</a></li>
                            <li><a href="#">Advisors</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="search-row">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input class="search-field" type="text" placeholder="Start searching">
            </div>
        </div>
    </header>
    <main class="main">
        <div class="main-slider">
            <?php
            if (is_array($listingPhotosData) && count($listingPhotosData)) {
                foreach ($listingPhotosData as $listingPhoto) {
                    ?>
                    <div class="item"><img
                                src="<?= $listingPhoto ?>"
                                width="1920" height="550" alt="image"></div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="object-desc container">
            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <div class="object-desc-heading">
                        <div class="object-ttl">
                            <h1><?= $listingInfo['listing_details']['title'] ?>
                                (<?= $listingInfo['listing_details']['city'] ?>)</h1>
                            <span class="location"><?= $listingInfo['listing_details']['state'] ?>
                                , <?= $listingInfo['listing_details']['country'] ?></span>
                            <div class="ttl-info">
                                <span class="type">Adrenalyne</span>
                                <div class="object-rate-info">
                                    <div class="rating">
                                        <strong class="rating-ttl"><?= $listingInfo['listing_reviews'][0]['reviews_count'] ?></strong>
                                        <div class="stars">
                                            <?php for ($i = 0; $i < $listingInfo['avg_overall_rating']; $i++) { ?>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                            <?php } ?>
                                            <?php for ($k = 0; $k < 5 - $listingInfo['avg_overall_rating']; $k++) { ?>
                                                <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                           aria-hidden="true"></i></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <em class="recommend"><strong><?= $listingInfo['listing_details']['recommendations_count'] ?></strong>
                                        Recommendations</em>
                                </div>
                            </div>
                        </div>
                        <div class="recommended-for">
                            <span class="recommended-for-ttl">Recommended for:</span>
                            <div class="recommend-eval-wrap">
                                <div class="recommend-eval">
                                    <strong class="eval-percent"><?= $listingInfo['passions_ratings'][0]['percentage'] ?>
                                        <sup>%</sup></strong>
                                    <span class="eval-name"><?= $listingInfo['passions_ratings'][0]['passion_category'] ?></span>
                                </div>
                                <div class="recommend-eval eval-luxury">
                                    <strong class="eval-percent"><?= $listingInfo['passions_ratings'][1]['percentage'] ?>
                                        <sup>%</sup></strong>
                                    <span class="eval-name"><?= $listingInfo['passions_ratings'][1]['passion_category'] ?></span>
                                </div>
                                <div class="recommend-eval eval-budget">
                                    <strong class="eval-percent"><?= $listingInfo['passions_ratings'][2]['percentage'] ?>
                                        <sup>%</sup></strong>
                                    <span class="eval-name"><?= $listingInfo['passions_ratings'][2]['passion_category'] ?></span>
                                </div>
                            </div>
                            <i class="extra-info-line">Based on travelers experience</i>
                        </div>
                    </div>
                    <div class="content-box">
                        <div class="recommendations-from">
                            <strong class="recommendations-from-ttl">Daily recommendations from</strong>
                            <div class="recommendations-btns pull-right">
                                <span class="btn btn-sm <?php if(!isset($listingInfo['last_recommendation']['fbfriend'])){ ?>
                                    disabled
                               <?php }?>">Facebook friends</span>
                                <span class="btn btn-sm<?php if(!isset($listingInfo['last_recommendation']['mutual'])){ ?>
                                    disabled
                               <?php }?>">With mutual interests</span>
                                <span class="btn btn-sm<?php if(!isset($listingInfo['last_recommendation']['local'])){ ?>
                                    disabled
                               <?php }?>">Local experts</span>
                            </div>
                        </div>
                        <div class="person-card">
                            <div class="aside">
                                <div class="avatar"><img
                                            src="<?= $base_path ?>sites/default/files/styles/reservation_popup_listing_img/public/pictures/<?= $listingInfo['last_recommendation']['advisor_pic'] ?>"
                                            width="170" height="170" alt="image"></div>
                                <h2 class="name"><?= $listingInfo['last_recommendation']['first_name'] . ' ' . $listingInfo['last_recommendation']['last_name'] ?></h2>
                                <strong class="sub-ttl"><?= $listingInfo['last_recommendation']['occupation'] . ', ' . $listingInfo['last_recommendation']['city'] ?></strong>
                                <div class="rating">
                                    <strong class="rating-ttl"><?= $listingInfo['last_recommendation']['advisor_rating_count'] ?></strong>
                                    <div class="stars">
                                        <?php for ($i = 0; $i < $listingInfo['last_recommendation']['advisor_rating']; $i++) { ?>
                                            <span class="star"><i class="gl-ico gl-ico-star"
                                                                  aria-hidden="true"></i></span>
                                        <?php } ?>
                                        <?php for ($k = 0; $k < 5 - $listingInfo['last_recommendation']['advisor_rating']; $k++) { ?>
                                            <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                       aria-hidden="true"></i></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="friends-row">
                                    <span class="friends-ttl"><?php
                                        $countOfRecommendations = count($listingInfo['recommendations']);
                                        if ($countOfRecommendations > 20) { ?>
                                            +20
                                        <?php } else {
                                            echo $countOfRecommendations;
                                        }
                                        ?></span>
                                    <ul class="friends-avatars-list">
                                        <?php
                                        $firstFourAdvisors = array_slice($listingInfo['recommendations'], 0, 4);
                                        if ($firstFourAdvisors) {
                                            foreach ($firstFourAdvisors as $advisor) {
                                                ?>
                                                <li>
                                                    <img src="<?= $base_path ?>sites/default/files/styles/reservation_popup_listing_img/public/pictures/<?= $advisor['advisor_pic'] ?>"
                                                         width="70" height="70" alt="image">
                                                </li>
                                            <?php }
                                        } ?>
                                    </ul>
                                </div>

                            </div>
                            <div class="text-h">
                                <p><?= $listingInfo['last_recommendation']['comment'] ?></p>
                                <div class="tags-wrap row">
                                    <div class="col-sm-6">
                                        <strong class="tags-ttl">Recomends this activity for</strong>
                                        <div class="tags-list">
                                            <?php
                                            if (is_array($listingInfo['last_user_trip_types']) && count($listingInfo['last_user_trip_types'])) {
                                                foreach ($listingInfo['last_user_trip_types'] as $tripType) { ?>
                                                    <span class="tag btn btn-sm"><i
                                                                class="gl-ico gl-ico-airplane"></i><?= $tripType ?></span>
                                                    <?php
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong class="tags-ttl">Travelers passionate about</strong>
                                        <div class="tags-list">
                                            <?php
                                            if (is_array($listingInfo['last_user_passions']) && count($listingInfo['last_user_passions'])) {
                                                foreach ($listingInfo['last_user_passions'] as $passion) { ?>
                                                    <span class="tag btn btn-sm"><i
                                                                class="gl-ico gl-ico-like"></i><?= $passion ?></span>
                                                <?php }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-box">
                        <h2>Description</h2>
                        <?= $listingInfo['listing_details']['brief_description'] ?>
                        <ul class="requirements-list">
                            <li>
									<span class="img-h">
										<img src="<?= $base_path . drupal_get_path('theme', 'new_design') . '/images/ico-bed.png' ?>"
                                             width="40" height="20" alt="image">
									</span>
                                <p>Requirement</p>
                            </li>
                            <li>
									<span class="img-h">
										<img src="<?= $base_path . drupal_get_path('theme', 'new_design') . '/images/ico-bed.png' ?>"
                                             width="40" height="20" alt="image">
									</span>
                                <p>Requirement</p>
                            </li>
                            <li>
									<span class="img-h">
										<img src="<?= $base_path . drupal_get_path('theme', 'new_design') . '/images/ico-bed.png' ?>"
                                             width="40" height="20" alt="image">
									</span>
                                <p>Requirement</p>
                            </li>
                            <li>
									<span class="img-h">
										<img src="<?= $base_path . drupal_get_path('theme', 'new_design') . '/images/ico-bed.png' ?>"
                                             width="40" height="20" alt="image">
									</span>
                                <p>Requirement</p>
                            </li>
                            <li>
									<span class="img-h">
										<img src="<?= $base_path . drupal_get_path('theme', 'new_design') . '/images/ico-bed.png' ?>"
                                             width="40" height="20" alt="image">
									</span>
                                <p>Requirement</p>
                            </li>
                            <li>
									<span class="img-h">
										<img src="<?= $base_path . drupal_get_path('theme', 'new_design') . '/images/ico-bed.png' ?>"
                                             width="40" height="20" alt="image">
									</span>
                                <p>Requirement</p>
                            </li>
                        </ul>
                    </div>
                    <div class="content-box">
                        <h2>Experience requirements</h2>
                        <div class="condition-list">
                            <div class="condition-list-row clearfix">
                                <div class="checkbox checkbox-inline">
                                    <input id="chk01" type="checkbox" checked="checked" name="conditions">
                                    <label for="chk01">Condition 1</label>
                                </div>
                                <div class="operation-btns pull-right">
                                    <span class="btns-col"><a href="#" class="btn-sub"><i
                                                    class="gl-ico gl-ico-minus"></i></a></span>
                                    <span class="btns-col"><strong class="num">2</strong></span>
                                    <span class="btns-col"><a href="#" class="btn-add"><i
                                                    class="gl-ico gl-ico-plus"></i></a></span>
                                </div>
                            </div>
                            <div class="condition-list-row clearfix">
                                <div class="checkbox checkbox-inline">
                                    <input id="chk02" type="checkbox" checked="checked" name="conditions">
                                    <label for="chk02">Condition 2</label>
                                </div>
                                <div class="operation-btns pull-right">
                                    <span class="btns-col"><a href="#" class="btn-sub"><i
                                                    class="gl-ico gl-ico-minus"></i></a></span>
                                    <span class="btns-col"><strong class="num">2</strong></span>
                                    <span class="btns-col"><a href="#" class="btn-add"><i
                                                    class="gl-ico gl-ico-plus"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <strong class="ttl">Calendar</strong>
                        <div class="clearfix">
                            <a id="eventCalendar" href="#" class="btn btn-sm btn-primary"><i
                                        class="gl-ico gl-ico-calendar"></i> <span class="date-field">31/12/2016</span>
                                <i class="gl-ico gl-ico-arrow-down"></i></a>
                            <div class="switch-toggle pull-right custom">
                                <input id="week" name="view" type="radio" checked>
                                <label for="week" onclick="">5 Days</label>

                                <input id="month" name="view" type="radio">
                                <label for="month" onclick="">week</label>

                                <a class="btn btn-sm btn-primary"></a>
                            </div>
                        </div>
                    </div>
                    <div class="content-box">
                        <h2>Cancellation policies</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the unknown printer took a galley of type
                            and scrambled Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry. </p>
                        <p>Lorem Ipsum has been the industry's standard dummy. Text ever since the unknown printer took
                            a galley of type and </p>
                        <p>scrambled Lorem Ipsum is simply dummy text of the printing and </p>

                        <div class="cancellation-polocies-graph">
                            <div class="point first-range">
                                <div class="point-bubble"></div>
                                <span class="percent-refund">100%</span>
                                <span class="point-label">Booking date</span>
                            </div>
                            <div class="point second-range">
                                <div class="point-bubble"></div>
                                <span class="percent-refund">50%</span>
                                <span class="point-label">15 days to arrival</span>
                            </div>
                            <div class="point third-range">
                                <div class="point-bubble"></div>
                                <span class="percent-refund">0%</span>
                                <span class="point-label">7 days to arrival</span>
                            </div>
                            <div class="point end-date">
                                <div class="point-bubble"></div>
                                <span class="point-label">Arrival date</span>
                            </div>
                        </div>
                        <div class="map">
                            <h1>map</h1>
                        </div>
                        <h2>Ratings</h2>
                        <div class="ratings">
                            <div class="rating">
                                <strong class="rating-ttl">Overall experience</strong>
                                <div class="stars">
                                    <?php for ($m = 0;
                                               $m < $listingInfo['listing_details']['overall_money'];
                                               $m++) { ?>
                                        <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                    <?php } ?>
                                    <?php for ($b = 0;
                                               $b < 5 - $listingInfo['listing_details']['overall_money'];
                                               $b++) { ?>
                                        <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                   aria-hidden="true"></i></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="rating">
                                <strong class="rating-ttl">Communication</strong>
                                <div class="stars">
                                    <?php for ($c = 0;
                                               $c < $listingInfo['listing_details']['overall_communication'];
                                               $c++) { ?>
                                        <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                    <?php } ?>
                                    <?php for ($h = 0;
                                               $h < 5 - $listingInfo['listing_details']['overall_communication'];
                                               $h++) { ?>
                                        <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                   aria-hidden="true"></i></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="rating">
                                <strong class="rating-ttl">Professionalism</strong>
                                <div class="stars">
                                    <?php for ($l = 0;
                                               $l < $listingInfo['listing_details']['overall_professional'];
                                               $l++) { ?>
                                        <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                    <?php } ?>
                                    <?php for ($p = 0;
                                               $p < 5 - $listingInfo['listing_details']['overall_professional'];
                                               $p++) { ?>
                                        <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                   aria-hidden="true"></i></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="rating">
                                <strong class="rating-ttl">Safety</strong>
                                <div class="stars">
                                    <?php for ($u = 0;
                                               $u < $listingInfo['listing_details']['overall_safety'];
                                               $u++) { ?>
                                        <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                    <?php } ?>
                                    <?php for ($f = 0;
                                               $f < 5 - $listingInfo['listing_details']['overall_safety'];
                                               $f++) { ?>
                                        <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                   aria-hidden="true"></i></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-box">
                        <h2>Reviews (<?= $listingInfo['listing_reviews'][0]['reviews_count'] ?>)</h2>
                        <div class="reviews-list">
                            <?php foreach ($listingInfo['listing_reviews'] as $review) { ?>
                                <div class="review">
                                    <div class="img-h">
                                        <img src="<?= $base_path ?>sites/default/files/styles/reservation_popup_listing_img/public/pictures/<?= $review['author_pic'] ?>"
                                             width="70" height="70" alt="image">
                                        <strong class="name"><?= $review['first_name'] . ' ' . $review['last_name'] ?></strong>
                                        <span class="status"><?= $review['occupation'] ?></span>
                                    </div>
                                    <div class="review-holder">
                                        <div class="review-text">
                                            <?= $review['comments'] ?>
                                        </div>
                                        <div class="review-details">
                                            <em class="date"><?= date('d.m.Y', strtotime($review['created'])) ?></em>
                                            <div class="rating">
                                                <div class="stars">
                                                    <?php for ($i = 0;
                                                               $i < $review['overall_rating'];
                                                               $i++) { ?>
                                                        <span class="star"><i class="gl-ico gl-ico-star"
                                                                              aria-hidden="true"></i></span>
                                                    <?php } ?>
                                                    <?php for ($i = 0;
                                                               $i < 5 - $review['overall_rating'];
                                                               $i++) { ?>
                                                        <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                                   aria-hidden="true"></i></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <p class="review-pages-info">Reviews
                            <strong><?= count($listingInfo['listing_reviews']) ?></strong> from
                            <strong><?= $listingInfo['listing_reviews'][0]['reviews_count'] ?></strong></p>
                        <div class="text-center">
                            <ul class="pagination">
                                <li class="disabled slick-list dragging "><span class="slick-list dragging"
                                                                                aria-label="Previous"><i
                                                aria-hidden="true" class="gl-ico gl-ico-arrow-left"></i></span></li>
                                <li class="active pagination-pointer"><span>1</span></li>
                                <li class="slick-list dragging"><span>2</span></li>
                                <li class="slick-list dragging"><span>3</span></li>
                                <li class="slick-list dragging"><span>4</span></li>
                                <li class="slick-list dragging"><span>...</span></li>
                                <li class="slick-list dragging"><span>12</span></li>
                                <li class="slick-list dragging"><span aria-label="Next"><i aria-hidden="true"
                                                                                           class="gl-ico gl-ico-arrow-right"></i></span>
                                </li>
                            </ul>
                        </div>
                        <?php echo $pagination ?>
                    </div>
                    <div class="content-box">
                        <h2>About</h2>
                        <div class="person-card">
                            <div class="aside">
                                <div class="avatar"><img src="
<?= $base_path ?>sites/default/files/styles/reservation_popup_listing_img/public/pictures/
<?= $listingInfo['listing_details']['author_pic'] ?>"
                                                         width="170" height="170" alt="image">
                                </div>
                                <h2 class="name"><?= $listingInfo['listing_details']['first_name'] . ' ' . $listingInfo['listing_details']['last_name'] ?></h2>
                                <strong class="sub-ttl"><?= $listingInfo['listing_details']['occupation'] ?>
                                    <?php
                                    if (strlen($listingInfo['listing_details']['city'])) {
                                        echo ', ' . $listingInfo['listing_details']['city'];
                                    }
                                    ?></strong>
                                <a href="/profile/<?= $listingInfo['listing_details']['uid'] ?>"
                                   class="btn btn-primary">Profile</a>
                                <?php if ($listingInfo['listing_details']['fbid']) { ?>
                                    <a href="https://fb.com/<?= $listingInfo['listing_details']['fbid'] ?>" class="btn"><i class="gl-ico gl-ico-facebook"></i>Facebook</a>
                                    <span class="connection-status">Connected</span>
                                <?php } else { ?>
                                    <span class="btn disabled"><i class="gl-ico gl-ico-facebook"></i>Facebook</span>
                                    <span class="connection-status disabled">Not verified</span>
                                <?php } ?>
                                <?php if ($listingInfo['listing_details']['fbid']) { ?>
                                    <a href="mailto:<?= $listingInfo['listing_details']['mail'] ?>" class="btn"><i class="gl-ico gl-ico-mail"></i>E-mail</a>
                                    <span class="connection-status">Connected</span>
                                <?php } else { ?>
                                    <span class="btn disabled"><i class="gl-ico gl-ico-mail"></i>E-mail</span>
                                    <span class="connection-status disabled">Not verified</span>
                                <?php } ?>
                            </div>
                            <div class="text-h">
                                <p>
                                    <?= $listingInfo['listing_details']['about_yourself'] ?>
                                </p>
                                <div class="about-desc">
                                    <div class="desc">
                                        <dl>
                                            <dt>Languages:</dt>
                                            <dd>
                                                <?php $languages = unserialize($listingInfo['listing_details']['language']); ?>
                                                <?php if (count($languages)) {
                                                    ?>
                                                    <?= implode(',', $languages) ?>.
                                                    <?php

                                                } else { ?>
                                                    No information
                                                <?php } ?>
                                            </dd>
                                            <dt>Occupation:</dt>
                                            <dd><?= $listingInfo['listing_details']['occupation'] . ' @ ' . $listingInfo['listing_details']['company'] ?></dd>
                                        </dl>
                                    </div>
                                    <div class="listings-img">
                                        <a href="#">
                                            <div class="text-h">
                                                <strong class="img-ttl"><?= $listingInfo['listing_details']['count_of_authors_listings'] ?>
                                                    listings</strong>
                                                <span class="tap-info">Tap to see all</span>
                                            </div>
                                            <img src="<?= $base_path . drupal_get_path('theme', 'new_design') . '/images/img02.jpg' ?>"
                                                 alt="images">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-box">
                        <h2>Last followed recommendations</h2>
                        <div class="recommendations">
                            <?php foreach ($listingInfo['last_followed_recommendations'] as $lfr) { ?>
                                <div class="card">
                                    <div class="img-h">
										<span class="img-wrap">
											<img src="<?= get_listing_photos($lfr) ?>" alt="image">
										</span>
                                        <div class="price">
                                            <strong><?= round($lfr['base_price'] * (variable_get('credit_value') / 100), 2) ?>
                                                <sup>TC</sup></strong>
                                            <span>You earn</span>
                                        </div>
                                    </div>
                                    <strong class="ttl"><?= $lfr['title'] ?></strong>
                                    <span class="sub-ttl"><?= $lfr['address1'] ?></span>
                                    <footer>
                                        <a href="#" class="btn btn-default btn-recommend"><i
                                                    class="gl-ico gl-ico-logo"></i></a>
                                        <div class="card-rate-info">
                                            <div class="rating">
                                                <strong class="rating-ttl">7</strong>
                                                <div class="stars">
                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                          aria-hidden="true"></i></span>
                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                          aria-hidden="true"></i></span>
                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                          aria-hidden="true"></i></span>
                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                          aria-hidden="true"></i></span>
                                                    <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                               aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                            <em class="recommend"><strong><?= $lfr['recommendations_count'] ?></strong>
                                                Recommendations</em>
                                        </div>
                                    </footer>
                                    <div class="more-info">
                                        <div class="show-more-row">
                                            <a href="#" class="expander-ttl">SHOW MORE <i
                                                        class="gl-ico gl-ico-arrow-down"></i></a>
                                        </div>
                                        <div class="more-drop hide">
                                            <div class="recommend-row">
                                                <div class="recommend-avatar">
                                                    <img src="images/photo01.jpg" alt="">
                                                </div>
                                                <strong class="recommend-author-name">Very long username recommends this
                                                    hotel for:</strong>
                                                <div class="tags">
                                                    Golf, Music, Scuba diving, Road trip
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="btn-row center">
                            <a href="#" class="btn btn-more">See more</a>
                        </div>
                    </div>
                    <div class="content-box">
                        <div class="recommendation-block">
                            <div class="recommendation-heading">
                                <h2>How do you want to recommend this activity?</h2>
                                <a href="#" class="btn btn-second-color"><i class="gl-ico gl-ico-logo"></i>RECOMMEND</a>
                            </div>
                            <div class="share-area">
                                <strong class="share-ttl">Share this link</strong>
                                <div class="form-group">
                                    <input class="form-control" type="text" value="<?= $recLink ?>">
                                </div>
                                <div class="share-group">
                                    <a href="#" class="btn"><i class="gl-ico gl-ico-push-pin"></i> Embed</a>
                                    <a href="#" class="btn"><i class="gl-ico gl-ico-street-map"></i> Add to travel guide</a>
                                    <a href="mailto:#?body='<?= $recLink ?>'"
                                       class="btn"><i class="gl-ico gl-ico-mail"></i> Send via Email</a>
                                </div>
                            </div>
                            <div class="share-soc">
                                <strong class="share-ttl">Revommend on your socials</strong>
                                <div class="soc-btns-row">
                                    <a target="_blank"
                                       href="https://www.facebook.com/sharer/sharer.php?u=<?= $recLink  ?>"
                                       class="btn btn-facebook"><i class="gl-ico gl-ico-facebook"></i> Facebook</a>
                                    <a href="https://plus.google.com/share?url=<?= $recLink ?>"
                                       class="btn btn-google-plus"><i class="gl-ico gl-ico-google-plus"></i>
                                        Google +</a>
                                    <a href="#" class="btn btn-instagram"><i class="gl-ico gl-ico-instagram"></i>
                                        Instagram</a>
                                    <a target="_blank"
                                       href="https://twitter.com/intent/tweet?url=<?= $recLink ?>"
                                       class="btn btn-twitter"><i class="gl-ico gl-ico-twitter"></i>
                                        Twitter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 pull-right">
                    sidebar
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <a href="#" class="logo"><img
                        src="<?= $base_path . drupal_get_path('theme', 'new_design') . '/images/logo.png' ?>"
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
<?php
drupal_add_js('https://d3js.org/d3.v4.min.js', 'external');
drupal_add_js('https://d3js.org/d3-selection-multi.v1.min.js', 'external');
drupal_add_js('https://d3js.org/d3-ease.v1.min.js', 'external');
?>

<!--<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>-->

</body>
</html>
