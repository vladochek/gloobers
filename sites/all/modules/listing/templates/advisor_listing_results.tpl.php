<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gloobers</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyA9ZXW_xxCYbGV5hAN13jO2yquESD3MY10 &libraries=places&language=en"></script>
    <script src="https://cdn.sobekrepository.org/includes/gmaps-markerwithlabel/1.9.1/gmaps-markerwithlabel-1.9.1.min.js"></script>
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
                <!--                <a href="#" class="open-drop" data-offset="-10px 0" data-theme="drop-theme-arrows-bounce">-->
                <!--                    Hotels <i class="gl-ico gl-ico-arrow-down"></i>-->
                <!--                </a>-->
                <!--                <div class="drop-content hide">-->
                <!--                    <div class="drop-list">-->
                <!--                        <ul>-->
                <!--                            <li><a href="#">Hotels</a></li>-->
                <!--                            <li><a href="#">Activites</a></li>-->
                <!--                            <li class="active"><a href="#">Advisors</a></li>-->
                <!--                        </ul>-->
                <!--                    </div>-->
                <!--                </div>-->
                <select class="sel" name="" id="search-items">
                    <option>Hotels</option>
                    <option>Activities</option>
                    <option>Advisors</option>
                </select>
            </div>
            <div class="search-row">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input value="<?= $destination ?>" onclick="searchAutocompletePrompt('search-advisor-prompt')"
                       id="search-advisor-prompt" class="search-field" type="text" placeholder="Start searching">
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
                                      data-theme="drop-theme-arrows-bounce"
                                      data-position="bottom left"> <?php if ($_GET['search_type'] == 'review') {
                                        echo 'Reviews';
                                    } else {
                                        echo 'Recommendations';
                                    } ?> <i
                                            class="gl-ico gl-ico-arrow-down"></i></span>
                                <div class="drop-content hide">
                                    <div class="drop-list rooms-drop">
                                        <ul>
                                            <li id="reviews" <?php if ($_GET['search_type'] == 'review') {
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
                            <div class="person-num" style=cursor: pointer
                            ">
                            <?php
                            $records = '1-10';
                            if ($_GET['records'] == '10' || !isset($_GET['records'])) {
                                $records = '1-10';
                            } elseif ($_GET['records'] == '20') {
                                $records = '11-20';
                            } elseif ($_GET['records'] == '50') {
                                $records = '21-50';
                            } elseif ($_GET['records'] == '100') {
                                $records = '51-100';
                            } elseif ($_GET['records'] == '>100') {
                                $records = '>100';
                            }
                            ?>
                            <span class="chosen open-drop" data-offset="-15px 0"
                                  data-theme="drop-theme-arrows-bounce" data-position="bottom left"><?= $records ?> <i
                                        class="gl-ico gl-ico-arrow-down"></i></span>
                            <div class="drop-content hide">
                                <div class="drop-list rooms-drop">
                                    <ul>
                                        <li id="rec10" <?php if ($_GET['records'] == '10' || !isset($_GET['records'])) {
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
                        <input id="choose-rating" class="rating" <?php if (!isset($_GET['rating'])) { ?>
                            value="0"
                        <?php } elseif ($_GET['rating'] >= 0 || $_GET['rating'] <= 5) { ?>
                            value="<?= $_GET['rating'] ?>"
                        <?php } ?>
                               data-step=1 data-size="md" data-symbol="&#xe018;"
                               data-glyphicon="false" data-rating-class="rating-gloobers">
                    </div>
                </div>
                <div class="advanced-filter">
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
                                <div class="card card-advisor" id="advisor-card-<?= $advisorLeft['uid'] ?>">
                                    <div class="img-h">
                                        <a href="profile/<?= $advisorLeft['uid'] ?>">
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
                                            <div class="categories-adv">
                                                <?php if ($advisorLeft['is_local']) { ?>
                                                    <span class="category">Local interests</span>
                                                <?php }
                                                if ($advisorLeft['is_mutual']) { ?>
                                                    <span class="category">Mutual interests</span>
                                                <?php }
                                                if ($advisorLeft['is_fb_friend']) { ?>
                                                    <span class="category">Facebook friends</span>
                                                <?php } ?>
                                            </div>
                                        </a>
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
                                                        <span class="star"><i class="gl-ico gl-ico-star"
                                                                              aria-hidden="true"></i></span>
                                                    <?php } ?>
                                                    <?php for ($k = 0; $k < 5 - $advisorLeft['overall_advisor_rating']; $k++) { ?>
                                                        <span class="star empty"><i class="gl-ico gl-ico-star"
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
                                        <?php
                                        if ($searchType == 'recommendation') {
                                            ?><span id="adv-rec<?= $advisorLeft['uid'] ?>" class="btn recs-on-map">
                                            Recommendation<?php
                                            if ($advisorLeft['rec_count'] != 1) {
                                                ?>s<?php
                                            }
                                            ?> on map</span> <?php
                                        } else { ?>
                                            <span id="adv-rev<?= $advisorLeft['uid'] ?>" class="btn revs-on-map">Review
                                                <?php if ($advisorLeft['rev_count'] != 1) { ?>s<?php } ?>
                                                on map</span>
                                        <?php } ?>
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
                                <div class="card card-advisor" id="advisor-card-<?= $advisorRight['uid'] ?>">
                                    <div class="img-h">
                                        <a href="profile/<?= $advisorRight['uid'] ?>">
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
                                            <div class="categories-adv">
                                                <?php if ($advisorLeft['is_local']) { ?>
                                                    <span class="category">Local interests</span>
                                                <?php }
                                                if ($advisorLeft['is_mutual']) { ?>
                                                    <span class="category">Mutual interests</span>
                                                <?php }
                                                if ($advisorLeft['is_fb_friend']) { ?>
                                                    <span class="category">Facebook friends</span>
                                                <?php } ?>
                                            </div>
                                        </a>
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
                                                        <span class="star"><i class="gl-ico gl-ico-star"
                                                                              aria-hidden="true"></i></span>
                                                    <?php } ?>
                                                    <?php for ($k = 0; $k < 5 - $advisorRight['overall_advisor_rating']; $k++) { ?>
                                                        <span class="star empty"><i class="gl-ico gl-ico-star"
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
                                        <?php
                                        if ($searchType == 'recommendation') {
                                            ?><span id="adv-rec<?= $advisorRight['uid'] ?>" class="btn recs-on-map">
                                            Recommendation<?php
                                            if ($advisorRight['rec_count'] != 1) {
                                                ?>s<?php
                                            }
                                            ?> on map</span> <?php
                                        } else { ?>
                                            <span id="adv-rev<?= $advisorRight['uid'] ?>" class="btn revs-on-map">Review
                                                <?php if ($advisorRight['rev_count'] != 1) { ?>s<?php } ?>
                                                on map</span>
                                        <?php } ?>
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
                    <ul class="pagination" id="advisors-pagination"></ul>
                </div>
            </div>
</div>
<div class="map col-sm-6 hidden-xs" id="map"></div>
</section>
</main>
</div>
<div style="display:none" id="tempCard"></div>
<?php
drupal_add_js('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', 'external');
drupal_add_js('https://use.fontawesome.com/36fe5b07c5.js', 'external');

drupal_add_js('sites/all/themes/new_design/js/jquery.paging.min.js', 'file');
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
drupal_add_js('sites/all/themes/new_design/js/drop.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/star-rating.min.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/map.js', 'file');
drupal_add_js('sites/all/themes/new_design/js/search.js', 'file');
//drupal_add_js('sites/all/themes/new_design/js/search-advisor.js', 'file');

?>
<script src="sites/all/themes/new_design/js/search-advisor.js"></script>
<script>
    /* start map init */
    $(document).ready(function () {
        $.ajaxSetup({
            xhrFields: {
                withCredentials: true
            }
        });

        var advisorsOverallCount = <?= $advisorsOverallCount ?>;
//        var advisorsOverallCount = 300;
        var advisorsPerPage = <?= ADVISORS_PER_PAGE ?>;
        var pagesCount = Math.ceil(advisorsOverallCount / advisorsPerPage);
        var currentPageNum = $.urlParam('page') || 1;

        paginate_advisors(advisorsOverallCount, advisorsPerPage);

        $("body").on("click", "#prevlink", function () {
            var currentPageNum = $.urlParam('page') || 1;
            if (currentPageNum !== 1 && pagesCount !== 1) {
                var prevPageNum = parseInt(currentPageNum) - 1;
                var newUrl = se.changeUrlParams('page', prevPageNum);
                doAdvisorsSearch(newUrl);
            }
        }).on("click", "#nextlink", function () {
            var currentPageNum = $.urlParam('page') || 1;
            if (currentPageNum != pagesCount && pagesCount !== 1) {
                var nextPageNum = parseInt(currentPageNum) + 1;
                console.log(nextPageNum);
                var newUrl = se.changeUrlParams('page', nextPageNum);
                doAdvisorsSearch(newUrl);
            }
        }).on("click", "[class^=pager-element]", function () {
            if (!$(this).hasClass('active')) {
                var currId = $(this).attr('class').replace("pager-element-", "").replace(" active", "");
                console.log(currId);
                var newUrl = se.changeUrlParams('page', currId);
                doAdvisorsSearch(newUrl);
            }
        });

        //        $(".pager-element-"+currentPageNum).addClass('active');


        var advisorPopup = '' +
            '<div class="card card-advisor">' +
            '<div class="img-h"><span class="img-wrap">' +
            '<img src="images/bg-main.jpg" alt="image">' +
            '</span><span class="photo-adv">' +
            '<img src="images/photo01-big.jpg" alt="avatar">' +
            '</span><div class="categories-adv">' +
            '<span class="category"></span></div></div>' +
            '<div class="card-ttl"><div  class="card-ttl-col"><strong class="ttl">' +
            '<a href="#">Lorem Ipsum is simply </a></strong>' +
            '<span class="sub-ttl">Long  location name</span></div>' +
            '<div class="card-rate-info"><div class="rating">' +
            '<strong class="rating-ttl">7</strong>' +
            '<div class="stars"><span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true">' +
            '</i></span><span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true">' +
            '</i></span><span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true">' +
            '</i></span><span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span><span class="star empty">' +
            '<i class="gl-ico gl-ico-star" aria-hidden="true"></i></span></div></div><em class="recommend"><strong>25</strong> Recommendations</em></div></div>' +
            '<footer><span class="adv-desc-info">21 years, <br>IT engeneer in Deftsoft</span><a href="#" class="btn">Recommendations on map</a></footer>' +
            '<div class="more-info"><div class="show-more-row"><a class="lnk-expand collapsed" href="#adv-drop100" data-toggle="collapse" aria-expanded="false"' +
            ' aria-controls="collapseExample" data-lnk-expand-text-show="Show interests (25)" data-lnk-expand-text-hide="Hide interests">' +
            '<i class="gl-ico gl-ico-arrow-down"></i></a></div><div class="more-drop collapse" id="adv-drop100"><div class="more-drop-area">' +
            '<div class="interests-tags">Golf, Music, Scuba diving, Road trip</div></div></div></div></div>';


        //        console.log(se.changeUrlParams('fb', 456));
        var markers = [];
        var infoWindows = [];
        var locations = <?= json_encode($allAdvisors); ?>;
//        var locations = [
//            {
//                "content": "bla bla bla",
//                'advisor_latitude': 49.768525,
//                "advisor_longitude": -70.075736,
//                "rate": 3,
//                "currency": "$",
//                "price": 88,
//                "reviews": 8
//            },
//            {
//                "content": "bla bla bla",
//                "advisor_latitude": 50.768525,
//                "advisor_longitude": -74.075736,
//                "rate": 1,
//                "currency": "$",
//                "price": 8,
//                "reviews": 1
//            },
//            {
//                "content": "bla bla bla",
//                "advisor_latitude": 51.768525,
//                "advisor_longitude": -76.075736,
//                "rate": 5,
//                "currency": "$",
//                "price": 104,
//                "reviews": 20
//            }
//        ];
//        console.dir(locations[0].advisor_latitude);
        var map = initMap();
        initMarkers(map, locations, getAdvisorMarker, getAdvisorPopupHtml);

        $("#search-items").change(function () {
            console.log($(this).val());
            var itemType = $(this).val();
            var url = window.location.protocol + '//' + window.location.host + '/';
            switch (itemType) {
                case 'Advisors':
                    url += 'search-advisor';
                    break;
                case 'Hotels':
                    url += 'search-hotel';
                    break;
                case 'Activities':
                    url = 'search-activity';
                    break;
                default:
                    url += 'search-advisor';

            }
            /*
             console.log(itemType);
             fullAddress['destination'] = place.formatted_address;
             for (var i = 0; i < arrAddress.length; i++) {
             var addressType = arrAddress[i].types[0];
             switch (addressType) {
             case "route" :
             // fullAddress['address'] = arrAddress[i].long_name;
             addrTypes.push('address='+arrAddress[i].long_name);
             break;
             case "locality" :
             // fullAddress['city'] = arrAddress[i].long_name;
             addrTypes.push('city='+arrAddress[i].long_name);
             break;
             case "administrative_area_level_1" :
             // fullAddress['state'] = arrAddress[i].long_name;
             addrTypes.push('state='+arrAddress[i].long_name);
             break;
             case "country" :
             // fullAddress['country'] = arrAddress[i].long_name;
             addrTypes.push('country='+arrAddress[i].long_name);
             break;
             }
             }
             url += '?'+addrTypes.join('&');
             console.log(url);
             window.location.replace(url);*/
        });

        function getRatingMarker(element) {

            var markerIcon = {
                url: "<?= drupal_get_path('theme', 'new_design') . '/images/transparent.png' ?>",
                scaledSize: new google.maps.Size(0, 0),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 0)
            };

            var position = {
                lat: parseFloat(element.advisor_latitude),
                lng: parseFloat(element.advisor_longitude)
            };

            var star = '<i class="gl-ico gl-ico-star"></i>',
                markerText = Array(element.rate + 1).join(star),
                markerLabel = '<div class="marker-h">' + markerText + '</div>';

            $('.calcMarkerWidthElm').find('.custom-marker').remove();

            var calcWidthElm = '<div class="custom-marker rating-marker">' + markerLabel + '</div>';

            var offsetAnchorX = ($('.calcMarkerWidthElm').append(calcWidthElm).width()) / 2;

            var marker = new MarkerWithLabel({
                map: map,
                animation: google.maps.Animation.DROP,
                position: position,
                icon: markerIcon,
                labelContent: markerLabel,
                labelAnchor: new google.maps.Point(offsetAnchorX, 40),
                labelClass: "custom-marker rating-marker",
                labelInBackground: true
            });

            return marker;

        };

        function getHotelMarker(element, map) {
            console.log(element);
            var markerIcon = {
                url: "<?= drupal_get_path('theme', 'new_design') . '/images/transparent.png' ?>",
                scaledSize: new google.maps.Size(0, 0),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 0)
            };

            var position = {
                lat: parseFloat(element.latitude),
                lng: parseFloat(element.longitude)
            };

            var markerText = '$' + element.base_price,
                markerLabel = '<div class="marker-h">' + markerText + '</div>';

            $('.calcMarkerWidthElm').find('.custom-marker').remove();

            var calcWidthElm = '<div class="custom-marker">' + markerLabel + '</div>';

            var offsetAnchorX = ($('.calcMarkerWidthElm').append(calcWidthElm).width()) / 2;

            var marker = new MarkerWithLabel({
                map: map,
                animation: google.maps.Animation.DROP,
                position: position,
                icon: markerIcon,
                labelContent: markerLabel,
                labelAnchor: new google.maps.Point(offsetAnchorX, 40),
                labelClass: "custom-marker",
                labelInBackground: true
            });

            return marker;

        };

        function getAdvisorMarker(element) {

            var markerIcon = {
                url: "<?= drupal_get_path('theme', 'new_design') . '/images/transparent.png' ?>",
                scaledSize: new google.maps.Size(0, 0),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 0)
            };

            var position = {
                lat: parseFloat(element.advisor_latitude),
                lng: parseFloat(element.advisor_longitude)
            };

            var entityTypeCount = element.rec_count || element.rev_count;

            var markerText = '<i class="gl-ico gl-ico-user"></i>' + entityTypeCount,
                markerLabel = '<div class="marker-h">' + markerText + '</div>';

            $('.calcMarkerWidthElm').find('.custom-marker').remove();

            var calcWidthElm = '<div class="custom-marker">' + markerLabel + '</div>';

            var offsetAnchorX = ($('.calcMarkerWidthElm').append(calcWidthElm).width()) / 2;

            var marker = new MarkerWithLabel({
                map: map,
                animation: google.maps.Animation.DROP,
                position: position,
                icon: markerIcon,
                labelContent: markerLabel,
                labelAnchor: new google.maps.Point(offsetAnchorX, 40),
                labelClass: "custom-marker advisor-marker",
                labelInBackground: true
            });

            return marker;

        };

        function getAdvisorPopupHtml(element) {
            var clonedElt = $("#advisor-card-" + element.uid).clone();
            clonedElt.find("a[href*='adv-drop" + element.uid + "']").attr({href: "#infownd" + element.uid});
            clonedElt.find("#adv-drop" + element.uid).attr({id: "infownd" + element.uid});
//                    $("#tempCard")
            return clonedElt[0].outerHTML;
        }

        function initMarkers(map, objects, markerTemplate, popupHtml) {

            var marker,
                infowindow;
//var map = initMap();
            $('body').append('<div class="calcMarkerWidthElm"></div>');
            var markersCollection = [];
            objects.forEach(function (element) {


                infowindow = new google.maps.InfoWindow({
                    content: "holding ..."
                });

                infoWindows.push(infowindow);

                marker = markerTemplate(element, map);

                marker.addListener('click', function () {

//                    console.log(element.uid);
//                    console.log("advisor-card-"+element.uid);


//                    console.log(popup);
                    var popup = popupHtml !== false ? popupHtml(element, objects) : element.popup;
                    infowindow.setContent(popup);

                    google.maps.event.addListener(infowindow, 'domready', function () {

                        // Reference to the DIV that wraps the bottom of infowindow
                        var iwOuter = $('.gm-style-iw');
                        var iwBackground = iwOuter.prev();
                        // Removes background shadow DIV
                        iwBackground.children(':nth-child(1)').css({'display': 'none'});

                        // Removes background shadow DIV
                        iwBackground.children(':nth-child(2)').css({'display': 'none'});

                        // Removes white background DIV
                        iwBackground.children(':nth-child(4)').css({'display': 'none'});

                        iwBackground.children(':nth-child(3)').css({
                            marginTop: '-9px'
                        });

                        iwBackground.children(':nth-child(3)').children(':nth-child(1)').css({
                            width: '20px',
                            height: '20px',
                            left: '-11px'
                        });
                        iwBackground.children(':nth-child(3)').children(':nth-child(2)').css({
                            width: '20px',
                            height: '20px',
                            left: '9px'
                        });


                        iwBackground.children(':nth-child(3)').children(':nth-child(1)').children().css({
                            'left': 0,
                            'width': '100%',
                            'height': '100%',
                            'box-shadow': 'none',
                            'z-index': '1',
                            opacity: '1',
                            transform: 'skewX(45deg)'
                        });
                        iwBackground.children(':nth-child(3)').children(':nth-child(2)').children().css({
                            'left': 0,
                            'width': '100%',
                            'height': '100%',
                            'box-shadow': 'none',
                            'z-index': '1',
                            opacity: '1',
                            transform: 'skewX(-45deg)'
                        });

                        // Reference to the div that groups the close button elements.
                        var iwCloseBtn = iwOuter.next();

                        // Apply the desired effect to the close button
                        //iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});

                        // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
                        $('.iw-bottom-gradient').css({display: 'none'});

                        // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
                        iwCloseBtn.mouseout(function () {
                            $(this).css({opacity: '1'});
                        });
                    });

                    closeAllInfoWindows(infoWindows);

                    infowindow.open(map, this);

                    $('.map').find('.img-slider').slick({
                        slidesToShow: 1,
                        swipeToSlide: true,
                        fade: true
                    });
                });

                markers.push(marker);
                markersCollection.push(marker);
            });
            fitMapBounds(markersCollection, map);
        }


        function closeAllInfoWindows(infoWindows) {
            for (var i = 0; i < infoWindows.length; i++) {
                infoWindows[i].close();
            }
        }

        function getEntityPopupHtml(e, data) {
            console.log(data);
            var avatar = '<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>';
            var entityImg = '<?= drupal_get_path('theme', 'new_design') . '/images/bg-main.jpg' ?>';
            return;
        }

        fitMapBounds(markers, map);

        console.log(locations);


        map.addListener('dragend', function () {
//            console.log(1111);
            getAndSendBoundsData(map, false);
        });
        map.addListener('zoom_changed', function () {
//            console.log(2222);
            getAndSendBoundsData(map, false);
        });
        //        map.maxZoom = 3;

        $("body").on("click", ".recs-on-map", function () {
            var advisorId = this.id.replace("adv-rec", "");
            $.post("advisor/recommendations/ajax", {advisor_id: advisorId})
                .done(function (data) {
//                    console.log(data);
                    var map = initMap();
                    initMarkers(map, data, getHotelMarker, false);
//                    fitMapBounds(markers);
                });
        }).on("click", ".revs-on-map", function () {
            var advisorId = this.id.replace("adv-rev", "");
            $.post("advisor/reviews/ajax", {advisor_id: advisorId})
                .done(function (data) {
//                    console.log(data);
                    var map = initMap();
                    initMarkers(map, data, getHotelMarker, false);
//                    fitMapBounds(markers);
                });
        })

    });

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
//        console.log('passportTypes: ' + passportTypes);

        var passportTypesLength = passportTypes.length;
//        console.log('length: ' + passportTypesLength);
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

        } else {
            passportsAndPassions.passport_types = '';
        }

        if (passionTypesInitially.length) {
            for (var i = 0; i < passionTypesInitially.length; i++) {
                $('#lb' + passionTypesInitially[i]).prop('checked', true);
            }
            passionIdsStr = passionTypesInitially.join();
            passportsAndPassions.passions = passionIdsStr;
        } else {
            passportsAndPassions.passions = '';
        }
        console.log(passportsAndPassions);
    });


    $("#confirmSearch").click(function () {
        var newUrl = se.changeUrlParams(passportsAndPassions);
        console.log(newUrl);
        doAdvisorsSearch(newUrl);
    });

    function getAndSendBoundsData(map, fitBounds=true) {
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
//        console.log('NElat = ' + NElat);
//        console.log('NElon = ' + NElon);
//        console.log('SWlat = ' + SWlat);
//        console.log('SWlon = ' + SWlon);
//            console.log('NWlat'+NWlat);
//            console.log('NWlon'+NWlon);
//            console.log('SElat'+SElat);
//            console.log('SElon'+SElon);

        var boundsData = {
            NElat: NElat,
            NElon: NElon,
            SWlat: SWlat,
            SWlon: SWlon
        };

        var newUrl = se.changeUrlParams(boundsData);
        console.log(newUrl);
        doAdvisorsSearch(newUrl, false, fitBounds);
    }


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