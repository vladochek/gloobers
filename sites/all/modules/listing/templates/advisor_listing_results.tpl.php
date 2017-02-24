<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gloobers</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyA9ZXW_xxCYbGV5hAN13jO2yquESD3MY10 &libraries=places&language=en" async defer></script>
    <?php
    drupal_add_css('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans:400,700', ['type' => 'external']);
    drupal_add_css('sites/all/themes/new_design/css/sprite.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/jquery.fancybox.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/daterangepicker.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/drop-theme-arrows.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/bootstrap.min.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/bootstrap-theme.min.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/star-rating.min.css', ['type' => 'file']);
    drupal_add_css('sites/all/themes/new_design/css/all.css', ['type' => 'file']);
    ?>

</head>
<body>
<script>

</script>
<div class="wrapper">
    <header class="header">
        <div class="header-holder container-fluid">
            <a href="#" class="logo"><img src="<?= drupal_get_path('theme', 'new_design') . '/images/logo-inner.png' ?>"
                                          alt="Gloobers" height="60" width="49"></a>
            <nav class="nav">
                <ul class="main-nav">
                    <li><a href="#">About <i class="gl-ico gl-ico-arrow-down"></i></a></li>
                    <li class="active"><a href="#">Professionals</a></li>
                    <li><a href="#">Log in</a></li>
                </ul>
                <a href="#" id="refresh-prices" class="btn btn-default">Refer a professional</a>
            </nav>
            <div class="object-type">
                <a href="#" class="open-drop" data-offset="-10px 0" data-theme="drop-theme-arrows-bounce">
                    Hotels <i class="gl-ico gl-ico-arrow-down"></i>
                </a>
                <div class="drop-content hide">
                    <div class="drop-list">
                        <ul>
                            <li><a href="#">Hotels</a></li>
                            <li><a href="#">Activites</a></li>
                            <li class="active"><a href="#">Advisors</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="search-row">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input onclick="searchAutocompletePrompt('search-advisor-prompt')" id="search-advisor-prompt" class="search-field" type="text" placeholder="Start searching">
            </div>
        </div>
    </header>
    <main class="main">
        <section class="search-wrapper">
            <div class="search-sidebar col-xs-12 col-sm-6">
                <div class="search-nav">
                    <div class="search-nav-row">
                        <div class="col">
                            <span class="ttl">Type of search</span>
                            <div class="person-num" style="cursor: pointer">
                                <span id="search-type-dropdown" class="chosen open-drop" data-offset="-15px 0"
                                      data-theme="drop-theme-arrows-bounce" data-position="bottom left"> <?php if ($_GET['search_type'] == 'review') {
                                        echo 'Reviews';
                                    }else{
                                        echo 'Recommendations';
                                    } ?> <i
                                            class="gl-ico gl-ico-arrow-down"></i></span>
                                <div class="drop-content hide">
                                    <div class="drop-list rooms-drop">
                                        <ul>
                                            <li id="reviews"  <?php if ($_GET['search_type'] == 'review') {
                                                echo 'class="active"';
                                            } ?> ><a>Reviews</a>
                                            </li>
                                            <li id="recommendations" <?php if ($_GET['search_type'] == 'recommendation') {
                                                echo 'class="active"';
                                            } ?> ><a>Recommendation</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <span class="ttl">№ records</span>
                            <div class="person-num" style="cursor: pointer">
                                <span class="chosen open-drop" data-offset="-15px 0"
                                      data-theme="drop-theme-arrows-bounce" data-position="bottom left">51-100 <i
                                            class="gl-ico gl-ico-arrow-down"></i></span>
                                <div class="drop-content hide">
                                    <div class="drop-list rooms-drop">
                                        <ul>
                                            <li id="rec10" <?php if ($_GET['records'] == '10') {
                                                echo 'class="active"';
                                            } ?>><a>1–10</a></li>
                                            <li id="rec20" <?php if ($_GET['records'] == '20') {
                                                echo 'class="active"';
                                            } ?>><a>11–20</a></li>
                                            <li id="rec50" <?php if ($_GET['records'] == '50') {
                                                echo 'class="active"';
                                            } ?>><a>21–50</a></li>
                                            <li id="rec100" <?php if ($_GET['records'] == '100') {
                                                echo 'class="active"';
                                            } ?>><a>51–100</a></li>
                                            <li id="rec100more" <?php if ($_GET['records'] == '>100') {
                                                echo 'class="active"';
                                            } ?>><a>>100</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <span class="ttl">Rating</span>
                            <input id="choose-rating" class="rating" value="3" data-step=1 data-size="md" data-symbol="&#xe011;"
                                   data-glyphicon="false" data-rating-class="rating-gloobers">
                        </div>
                    </div>
                    <div class="advansed-filter">
                        <div class="ttl-row">
                            <strong class="ttl">Advanced options</strong>
                            <a class="lnk-expand collapsed" href="#filterDropdown" data-toggle="collapse"
                               aria-expanded="false" aria-controls="collapseExample"
                               data-lnk-expand-text-show="Show more" data-lnk-expand-text-hide="Hide"></a>
                        </div>
                    </div>
                    <div class="filter-dropdown collapse" id="filterDropdown">
                        <div class="filter-section">
                            <strong class="filter-section-ttl">Passport:</strong>
                            <div class="filter-area">
                                <div class="filter-check-list">
                                    <div class="check-col">
                                        <ul class="check-list">
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="chk1" type="checkbox"
                                                           name="conditions">
                                                    <label for="chk1">I live there</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="chk2" type="checkbox"
                                                           name="conditions">
                                                    <label for="chk2">I’ve been living there</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="chk3" type="checkbox"
                                                           name="conditions">
                                                    <label for="chk3">I've been there in a business trip</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="chk4" type="checkbox"
                                                           name="conditions">
                                                    <label for="chk4">I've been there in a romantic trip
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="check-col">
                                        <ul class="check-list">
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="chk5" type="checkbox"
                                                           name="conditions">
                                                    <label for="chk5">
                                                        I've been there with a group</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="chk6" type="checkbox"
                                                           name="conditions">
                                                    <label for="chk6">I've been there alone</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="chk7" type="checkbox"
                                                           name="conditions">
                                                    <label for="chk7">
                                                        I've been there with the friend</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="chk8" type="checkbox"
                                                           name="conditions">
                                                    <label for="chk8">I've been in a family trip</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-section">
                            <strong class="filter-section-ttl">Categories of advisor:</strong>
                            <div class="recommendations-btns">

                                <a id="fb-friends" class="btn btn-sm
                                <?php if (!$fb) { ?>
                                 disabled
                                 <?php } ?>
                                ">Facebook friends</a>
                                <a id="mutual-interests" class="btn btn-sm
                                <?php if (!$mutualInterests) { ?>
                                 disabled
                                 <?php } ?>
                                 ">With mutual interests</a>
                                <a id="local-advisors" class="btn btn-sm
                                <?php if (!$local) { ?>
                                 disabled
                                 <?php } ?>
                                ">Local experts</a>
                            </div>
                        </div>
                        <div class="filter-section">
                            <strong class="filter-section-ttl">Passionate about:</strong>
                            <div class="filter-area">
                                <div class="filter-check-list">
                                    <div class="check-col">
                                        <ul class="check-list">
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb1" type="checkbox" name="conditions">
                                                    <label for="lb1">Local Culture</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb2" type="checkbox" name="conditions">
                                                    <label for="lb2">Art &amp; Culture</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb3" type="checkbox" name="conditions">
                                                    <label for="lb3">Sightseeing</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb6" type="checkbox" name="conditions">
                                                    <label for="lb6">Wildlife</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb8" type="checkbox" name="conditions">
                                                    <label for="lb8">Nightlife</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb9" type="checkbox" name="conditions">
                                                    <label for="lb9">Luxury</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb13" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb13">Trekking</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb14" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb14">Camping</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb17" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb17">Wine</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="check-col">
                                        <ul class="check-list">
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb18" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb18">Extrême</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb19" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb19">Motor sports</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb20" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb20">Water sports</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb21" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb21">Scuba diving</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb22" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb22">Sailing</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb23" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb23">Fishing</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb24" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb24">Photography</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb25" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb25">Wellness</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb26" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb26">Road trips</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="check-col">
                                        <ul class="check-list">
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb27" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb27">Archeology</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb28" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb28">Fitness</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb29" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb29">Golf</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb30" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb30">Kids activities</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb35" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb35">Music</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb36" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb36">Beach</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb38" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb38">Shopping</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="lb42" type="checkbox"
                                                           name="conditions">
                                                    <label for="lb42">Fooding</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btns-row">
                            <div class="flex-auto-width">
                                <a href="#" class="btn btn-link">CLEAR SEARCH FILTERS</a>
                            </div>
                            <span id="cancelFilters" class="btn">Cancel</span>
                            <span id="confirmSearch" class="btn btn-primary">Confirm search</span>
                        </div>
                    </div>
                    <div class="results-found-info text-right"><strong>35+ Advisors</strong> search results</div>
                </div>
                <div class="result-wrapper">
                    <div class="result-list row" id="search_results">
                        <div class="col-xs-12 col-sm-6">
                            <?php if (count($advisorsLeft)) {
                                foreach ($advisorsLeft as $advisorLeft) {
                                    ?>
                                    <div class="card card-advisor">
                                        <div class="img-h">
										<span class="img-wrap ">
                                            <?php
                                            $cover = isset($advisorLeft['cover_img']) ? image_style_url('cover_pic', $advisorLeft['cover_img']) : 'sites/all/themes/new_design/images/bg-main.jpg';
                                            $avatar = isset($advisorLeft['profile_img']) ? image_style_url('reservation_popup_listing_img', $advisorLeft['profile_img']) : 'sites/all/themes/new_design/images/photo01-big.jpg';
                                            ?>
                                            <img src="<?= $cover ?>"
                                                 alt="image">
										</span>
                                            <span class="photo-adv">
											<img src="<?= $avatar ?>"
                                                 alt="avatar">
										</span>
                                        </div>
                                        <div class="card-ttl">
                                            <div class="card-ttl-col">
                                                <strong class="ttl"><a
                                                            href="#"><?= $advisorLeft['first_name'] . ' ' . $advisorLeft['last_name'] ?> </a></strong>
                                                <span class="sub-ttl">
                                                     <?php if ($advisorLeft['advisor_city']) {
                                                         ?>
                                                         <?= $advisorLeft['advisor_city'] ?>
                                                     <?php } ?>
                                                    <?php if ($advisorLeft['advisor_city'] && $advisorLeft['advisor_country']) { ?>
                                                        ,
                                                    <?php } ?>
                                                    <?php if ($advisorLeft['advisor_country']) {
                                                        ?>
                                                        <?= $advisorLeft['advisor_country'] ?>
                                                    <?php } ?>
                                                </span>
                                            </div>
                                            <div class="card-rate-info">
                                                <div class="rating">
                                                    <strong class="rating-ttl"><?= $advisorLeft['rates_count'] ?></strong>
                                                    <div class="stars">
                                                        <?php for ($i = 0; $i < $advisorLeft['overall_advisor_rating']; $i++) { ?>
                                                            <span class="star"><i class="fa fa-star"
                                                                                  aria-hidden="true"></i></span>
                                                        <?php } ?>
                                                        <?php for ($k = 0; $k < 5 - $advisorLeft['overall_advisor_rating']; $k++) { ?>
                                                            <span class="star full"><i class="fa fa-star"
                                                                                       aria-hidden="true"></i></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <?php if ($searchType == 'recommendation') { ?>
                                                    <em class="recommend"><strong><?= $advisorLeft['rec_count'] ?></strong>
                                                        Recommendation<?php if ($advisorLeft['rec_count'] != 1) {
                                                            echo 's';
                                                        } ?>
                                                    </em>
                                                <?php } else { ?>
                                                    <em class="recommend"><strong><?= $advisorLeft['rev_count'] ?> </strong>
                                                        Review<?php if ($advisorLeft['rev_count'] != 1) {
                                                            echo 's';
                                                        } ?></em>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <footer>
                                            <span class="adv-desc-info">
                                                <?php if ($advisorLeft['birth_date']) {
                                                    $presentYear = date('Y');
                                                    $birthYear = date('Y', $advisorLeft['birth_date']);
                                                    $age = $presentYear - $birthYear;
                                                    ?>
                                                    <?= $age ?> years, <br>
                                                <?php } ?>
                                                <?php if ($advisorLeft['occupation']) {
                                                    ?>
                                                    <?= $advisorLeft['occupation'] ?>
                                                <?php } ?>

                                                <?php if ($advisorLeft['company']) {
                                                    ?>
                                                    in
                                                    <?= $advisorLeft['company'] ?>
                                                <?php } ?>
                                            </span>
                                            <a href="#" class="btn"><?php
                                                if ($searchType == 'recommendation') {
                                                    ?> Recommendation<?php
                                                    if ($advisorLeft['rec_count'] != 1) {
                                                        ?>s<?php
                                                    }
                                                    ?> on map <?php
                                                } else {
                                                    ?> Review<?php
                                                    if ($advisorLeft['rev_count'] != 1) {
                                                        ?>s<?php
                                                    }
                                                    ?> on map
                                                <?php }
                                                ?></a>
                                        </footer>
                                        <div class="more-info">
                                            <div class="show-more-row">
                                                <a class="lnk-expand collapsed"
                                                   href="#adv-drop<?= $advisorLeft['uid'] ?>"
                                                   data-toggle="collapse" aria-expanded="false"
                                                   aria-controls="collapseExample"
                                                   data-lnk-expand-text-show="SHOW INTERESTS (<?php
                                                   if ($advisorLeft['passions']) {
                                                       $passionsArr = explode(', ', $advisorLeft['passions']);
                                                       $passionsCount = count($passionsArr);
                                                   } else {
                                                       $passionsCount = 0;
                                                   }
                                                   echo $passionsCount;
                                                   ?>)"
                                                   data-lnk-expand-text-hide="HIDe INTERESTS"><i
                                                            class="gl-ico gl-ico-arrow-down"></i></a>
                                            </div>
                                            <div class="more-drop collapse" id="adv-drop<?= $advisorLeft['uid'] ?>">
                                                <div class="more-drop-area">
                                                    <div class="interests-tags">
                                                        <?= $advisorLeft['passions'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php if (count($advisorsRight)) {
                                foreach ($advisorsRight as $advisorRight) {
                                    ?>
                                    <div class="card card-advisor">
                                        <div class="img-h">
										<span class="img-wrap">
                                            <?php
                                            $cover = isset($advisorRight['cover_img']) ? image_style_url('cover_pic', $advisorRight['cover_img']) : 'sites/all/themes/new_design/images/bg-main.jpg';
                                            $avatar = isset($advisorRight['profile_img']) ? image_style_url('reservation_popup_listing_img', $advisorRight['profile_img']) : 'sites/all/themes/new_design/images/photo01-big.jpg';
                                            ?>
                                            <img src="<?= $cover ?>"
                                                 alt="image">
										</span>
                                            <span class="photo-adv">
											<img src="<?= $avatar ?>"
                                                 alt="avatar">
										</span>
                                        </div>
                                        <div class="card-ttl">
                                            <div class="card-ttl-col">
                                                <strong class="ttl"><a
                                                            href="#"><?= $advisorRight['first_name'] . ' ' . $advisorRight['last_name'] ?> </a></strong>
                                                <span class="sub-ttl">
                                                     <?php if ($advisorRight['advisor_city']) {
                                                         ?>
                                                         <?= $advisorRight['advisor_city'] ?>
                                                     <?php } ?>
                                                    <?php if ($advisorRight['advisor_city'] && $advisorRight['advisor_country']) { ?>
                                                        ,
                                                    <?php } ?>
                                                    <?php if ($advisorRight['advisor_country']) {
                                                        ?>
                                                        <?= $advisorRight['advisor_country'] ?>
                                                    <?php } ?>
                                                </span>
                                            </div>
                                            <div class="card-rate-info">
                                                <div class="rating">
                                                    <strong class="rating-ttl"><?= $advisorRight['rates_count'] ?></strong>
                                                    <div class="stars">
                                                        <?php for ($i = 0; $i < $advisorRight['overall_advisor_rating']; $i++) { ?>
                                                            <span class="star"><i class="fa fa-star"
                                                                                  aria-hidden="true"></i></span>
                                                        <?php } ?>
                                                        <?php for ($k = 0; $k < 5 - $advisorRight['overall_advisor_rating']; $k++) { ?>
                                                            <span class="star full"><i class="fa fa-star"
                                                                                       aria-hidden="true"></i></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <?php if ($searchType == 'recommendation') { ?>
                                                    <em class="recommend"><strong><?= $advisorRight['rec_count'] ?></strong>
                                                        Recommendation<?php if ($advisorRight['rec_count'] != 1) {
                                                            echo 's';
                                                        } ?>
                                                    </em>
                                                <?php } else { ?>
                                                    <em class="recommend"><strong><?= $advisorRight['rev_count'] ?> </strong>
                                                        Review<?php if ($advisorRight['rev_count'] != 1) {
                                                            echo 's';
                                                        } ?></em>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <footer>
                                            <span class="adv-desc-info">
                                                <?php if ($advisorRight['birth_date']) {
                                                    $presentYear = date('Y');
                                                    $birthYear = date('Y', $advisorRight['birth_date']);
                                                    $age = $presentYear - $birthYear;
                                                    ?>
                                                    <?= $age ?> years, <br>
                                                <?php } ?>
                                                <?php if ($advisorRight['occupation']) {
                                                    ?>
                                                    <?= $advisorRight['occupation'] ?>
                                                <?php } ?>

                                                <?php if ($advisorRight['company']) {
                                                    ?>
                                                    in
                                                    <?= $advisorRight['company'] ?>
                                                <?php } ?>
                                            </span>
                                            <a href="#" class="btn">
                                                <?php
                                                if ($searchType == 'recommendation') {
                                                    ?> Recommendation<?php
                                                    if ($advisorRight['rec_count'] != 1) {
                                                    ?>s<?php
                                                    }
                                                     ?> on map <?php
                                                } else {
                                                    ?> Review<?php
                                                    if ($advisorRight['rev_count'] != 1) {
                                                    ?>s<?php
                                                    }
                                                    ?>  on map
                                                <?php }
                                                ?>
                                            </a>
                                        </footer>
                                        <div class="more-info">
                                            <div class="show-more-row">
                                                <a class="lnk-expand collapsed"
                                                   href="#adv-drop<?= $advisorRight['uid'] ?>"
                                                   data-toggle="collapse" aria-expanded="false"
                                                   aria-controls="collapseExample"
                                                   data-lnk-expand-text-show="SHOW INTERESTS (<?php
                                                   if ($advisorRight['passions']) {
                                                       $passionsArr = explode(', ', $advisorRight['passions']);
                                                       $passionsCount = count($passionsArr);
                                                   } else {
                                                       $passionsCount = 0;
                                                   }
                                                   echo $passionsCount;
                                                   ?>)"
                                                   data-lnk-expand-text-hide="HIDe INTERESTS"><i
                                                            class="gl-ico gl-ico-arrow-down"></i></a>
                                            </div>
                                            <div class="more-drop collapse" id="adv-drop<?= $advisorRight['uid'] ?>">
                                                <div class="more-drop-area">
                                                    <div class="interests-tags">
                                                        <?= $advisorRight['passions'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <ul class="pagination">
                            <li class="disabled"><a href="#" aria-label="Previous"><i aria-hidden="true"
                                                                                      class="gl-ico gl-ico-arrow-left"></i></a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><span>...</span></li>
                            <li><a href="#">12</a></li>
                            <li><a href="#" aria-label="Next"><i aria-hidden="true"
                                                                 class="gl-ico gl-ico-arrow-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="map col-sm-6 hidden-xs" id="map"></div>
        </section>
    </main>
</div>
<?php
drupal_add_js('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', 'external');
drupal_add_js('https://use.fontawesome.com/36fe5b07c5.js', 'external');

drupal_add_js('sites/all/themes/new_design/js/custom-file-input.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/moment.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/daterangepicker.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/bootstrap.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/slick.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/popover-extra-placements.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/bootstrap-slider.min.js', 'file');

drupal_add_js('https://d3js.org/d3.v4.min.js', 'external');
drupal_add_js('https://d3js.org/d3-selection-multi.v1.min.js', 'external');
drupal_add_js('https://d3js.org/d3-ease.v1.min.js', 'external');
drupal_add_js('sites/all/themes/new_design/js/modernizr.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/tether.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/star-rating.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/search.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/search-advisor.js', 'file');

?>

<script>
    /* start map init */
    $(document).ready(function () {
        $.ajaxSetup({
            xhrFields: {
                withCredentials: true
            }
        });

//        console.log(se.changeUrlParams('fb', 456));
        var markers = [];
        var locations = <?= json_encode($allAdvisors); ?>;
        console.log(locations);
        var map,
            desktopScreen = Modernizr.mq("only screen and (min-width:1024px)"),
            zoom = desktopScreen ? 10 : 8,
            scrollable = draggable = !Modernizr.hiddenscroll || desktopScreen,
            isIE11 = !!(navigator.userAgent.match(/Trident/) && navigator.userAgent.match(/rv[ :]11/)),
            customStyles = [
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [{"color": "#444444"}]
                }, {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [{"color": "#f2f2f2"}]
                }, {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [{"saturation": -100}, {"lightness": 45}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [{"visibility": "simplified"}]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [{"color": "#46bcec"}, {"visibility": "on"}]
                }]

        var myLatLng = {
            lat: 50.768525, lng: -74.075736
        };
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: zoom,
            center: myLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: scrollable,
            draggable: draggable,
            styles: customStyles
        });

//            var locations = [
//                {
//                    title: 'point1',
//                    position: {lat: 45.768525, lng: -74.075736},
//                    label: '22'/*,
//                 icon: {
//                 url: isIE11 ? "images/ico-map-marker.png" : "images/ico-map-marker.png",//svg
//                 scaledSize: new google.maps.Size(53, 69)
//                 }*/
//
//                }
//            ];
//        console.log(locations.length);
//for(var i = 0; i<locations.length; i++){
//
//}

        locations.forEach(function (element, index) {
//                console.log(element.advisor_latitude);
            var position = {lat: parseFloat(element.advisor_latitude), lng: parseFloat(element.advisor_longitude)};
            var marker = new google.maps.Marker({
                position: position,
                map: map,
//                    title: element.title,
//                    icon: element.icon,
//                    label: element.label
            });
            markers.push(marker);
        });

        var bounds = new google.maps.LatLngBounds();
        //  Go through each...
        for (var i = 0; i < markers.length; i++) {
            bounds.extend(markers[i].position);
        }
        //  Fit these bounds to the map
        map.fitBounds(bounds);

        map.addListener('dragend', function () {
            var bounds = map.getBounds();
            var ne = bounds.getNorthEast();
            var sw = bounds.getSouthWest();

            var NElat = ne.lat();
            var NElon = ne.lng();

            var SWlat = sw.lat();
            var SWlon = sw.lng();

//            var NWlat = sw.lat();
//            var NWlon = ne.lng();
//
//            var SElat = ne.lat();
//            var SElon = sw.lng();
            var searchBoundsQuery = '&NElat='+NElat+'&'+'NElon='+NElon+'&'+'SWlat='+SWlat+'&'+'SWlon='+SWlon;
            console.log('NElat = '+NElat);
            console.log('NElon = '+NElon);
            console.log('SWlat = '+SWlat);
            console.log('SWlon = '+SWlon);
//            console.log('NWlat'+NWlat);
//            console.log('NWlon'+NWlon);
//            console.log('SElat'+SElat);
//            console.log('SElon'+SElon);

            var decodedParameters = location.search.substr(1);
            console.log(decodedParameters);
            $.get( "ajax/search-advisor?"+decodedParameters+searchBoundsQuery).done(function( data ) {
                $('#search_results').html(data);
            });
        });
        map.addListener('zoom_changed', function () {
            var bounds = map.getBounds();
            var ne = bounds.getNorthEast();
            var sw = bounds.getSouthWest();
            console.log(ne);
            console.log(sw);
        });


    })
    ;
    /* end map init */

    var newUrl = '';
var passportsAndPassions = {
    passport_types: '',
    passions: ''
};
    //passport types filtration

    var passportTypes = <?= json_encode($passportTypes); ?>;
    var passportIdsStr = '';

    var passportTypesInitially = [];
    if (passportTypes) {
        console.log('passportTypes: '+passportTypes);

        var passportTypesLength = passportTypes.length;
        console.log('length: '+passportTypesLength);
        for (var i = 0; i < passportTypesLength; i++) {
            passportTypesInitially.push(passportTypes[i]);
            $('#chk' + passportTypes[i]).prop('checked', true);
        }
        passportsAndPassions.passport_types = passportTypesInitially.join();
    }
        var passportIds = $("[id^=chk]:checked");
        $("[id^=chk]").change(function () {
            var passportIdsArr = [];
            passportIds = $("[id^=chk]:checked");
            var passportIdsLength = passportIds.length;
            for (var i = 0; i < passportIdsLength; i++) {
                var passId = passportIds[i].id.replace("chk", "");
                passportIdsArr.push(passId);
            }
            passportIdsStr = passportIdsArr.join();
            passportsAndPassions.passport_types = passportIdsStr;
            console.log(passportsAndPassions);
        });

    console.log(passportIdsStr);


    //passions filtration
    var passionTypes = <?= json_encode($passions); ?>;
    var passionIdsStr = '';
    var passionTypesInitially = [];
    if (passionTypes) {
        var passionTypesLength = passionTypes.length;
        for (var i = 0; i < passionTypesLength; i++) {
            passionTypesInitially.push(passionTypes[i]);
            $('#lb' + passionTypes[i]).prop('checked', true);
        }
        passportsAndPassions.passions = passionTypesInitially.join();
    }
        var passionIds = $("[id^=lb]:checked");

        $("[id^=lb]").change(function () {
            var passionIdsArr = [];
            passionIds = $("[id^=lb]:checked");
            var passionIdsLength = passionIds.length;


            for (var i = 0; i < passionIdsLength; i++) {
                var passId = passionIds[i].id.replace("lb", "");
                passionIdsArr.push(passId);
            }
            passionIdsStr = passionIdsArr.join();
            passportsAndPassions.passions = passionIdsStr;
            console.log(passportsAndPassions);
        });

    console.log(passionIdsStr);


    //cancelling filters
    $("#cancelFilters").click(function () {
        $('[id^=chk], [id^=lb]').prop('checked', false);
        console.log(passportTypesInitially);
        console.log(passportTypesInitially.length);
        if (passportTypesInitially.length) {
            for (var i = 0; i < passportTypesInitially.length; i++) {
                $('#chk' + passportTypesInitially[i]).prop('checked', true);
            }
            passportIdsStr = passportTypesInitially.join();
            passportsAndPassions.passport_types = passportIdsStr;

        }else{
            passportsAndPassions.passport_types = '';
        }

        if (passionTypesInitially.length) {
            for (var i = 0; i < passionTypesInitially.length; i++) {
                $('#lb' + passionTypesInitially[i]).prop('checked', true);
            }
            passionIdsStr = passionTypesInitially.join();
            passportsAndPassions.passions = passionIdsStr;
        }else{
            passportsAndPassions.passions = '';
        }
        console.log(passportsAndPassions);
    });

    function doAdvisorsSearch($url){
        $.get( 'ajax/search-advisor'+$url ).done(function( data ) {
            se.changeUrl($url);
            $('#search_results').html(data);
        });
    }

    $("#confirmSearch").click(function(){
        var newUrl = se.changeUrlParams(passportsAndPassions);
        console.log(newUrl);
        doAdvisorsSearch(newUrl);
    });



</script>
<?php
//drupal_add_js(
//    'https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyA9ZXW_xxCYbGV5hAN13jO2yquESD3MY10&callback=initMap',
//    array('type' => 'external', 'async' => TRUE, 'defer' => TRUE
//    ));
?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<!--<script src="https://use.fontawesome.com/36fe5b07c5.js"></script>-->
<!---->
<!--<script src="js/custom-file-input.js"></script>-->
<!---->
<!--<script src="js/moment.js"></script>-->
<!--<script src="js/daterangepicker.js"></script>-->
<!--<script src="js/bootstrap.min.js"></script>-->
<!--<script src="js/slick.min.js"></script>-->
<!--<script src="js/popover-extra-placements.min.js"></script>-->
<!--<script src="js/bootstrap-slider.min.js"></script>-->
<!---->
<!--<script src="https://d3js.org/d3.v4.min.js"></script>-->
<!--<script src="https://d3js.org/d3-selection-multi.v1.min.js"></script>-->
<!--<script src="https://d3js.org/d3-ease.v1.min.js"></script>-->
<!---->
<!--<script src="js/modernizr.js"></script>-->
<!---->
<!---->
<!--<script src="js/tether.min.js"></script>-->
<!--<script src="js/drop.min.js"></script>-->
<!---->
<!--<script src="js/star-rating.min.js"></script>-->
<!---->
<!--<script src="js/main.js"></script>-->
<!---->
<!--<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>-->

</body>
</html>