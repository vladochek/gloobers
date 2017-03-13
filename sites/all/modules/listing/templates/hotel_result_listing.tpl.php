<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gloobers</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyA9ZXW_xxCYbGV5hAN13jO2yquESD3MY10 &libraries=places&language=en"></script>
    <script src="https://cdn.sobekrepository.org/includes/gmaps-markerwithlabel/1.9.1/gmaps-markerwithlabel-1.9.1.min.js"></script>
    <!--    <script src="-->
    <? //= $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'new_design') . '/js/daterangepicker.js'?><!--"></script>-->
    <!--    <script src="-->
    <? //= $GLOBALS['base_url'] . '/' . drupal_get_path('theme', 'new_design') . '/js/drop.min.js'?><!--"></script>-->
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
                            <span class="ttl">When</span>
                            <div class="date-range">
                                <input class="daterange-input" data-position="bottom left"
                                       data-single-date-picker="false" data-offset="-15px 0"
                                       data-theme="drop-theme-arrows-bounce" name="date" type="text"
                                       data-start-date="<?= date('d/m/Y') ?>" data-end-date="<?= date('d/m/Y', strtotime('+2 days')) ?>"
                                       placeholder="<?= date('d/m/Y') . ' - ' . date('d/m/Y', strtotime('+2 days')) ?>"
                                       value="<?= date('d/m/Y') . ' - ' . date('d/m/Y', strtotime('+2 days')) ?>">
                            </div>
                        </div>
                        <div class="col">
                            <span class="ttl">Adult</span>
                            <div class="person-num">
                                <span class="chosen open-drop" data-offset="-15px 0"
                                      data-theme="drop-theme-arrows-bounce"><?= $adults ?> adults <i
                                            class="gl-ico gl-ico-arrow-down"></i></span>
                                <div class="drop-content hide">
                                    <div class="person-num-holder">
                                        <div class="person-row">
                                            <div class="operation-btns pull-right">
                                                <span class="btns-col"><a href="#" class="btn-sub"><i
                                                                class="gl-ico gl-ico-minus"></i></a></span>
                                                <span class="btns-col"><a href="#" class="btn-add"><i
                                                                class="gl-ico gl-ico-plus"></i></a></span>
                                            </div>
                                            <div class="text-h">
                                                <strong><span><?= $adults ?> </span>Adults</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <span class="ttl">Children</span>
                            <div class="person-num">
                                <span class="chosen open-drop" data-offset="-15px 0"
                                      data-theme="drop-theme-arrows-bounce"><?= $children ?> Clildren <i
                                            class="gl-ico gl-ico-arrow-down"></i></span>
                                <div class="drop-content hide">
                                    <div class="person-num-holder">
                                        <div class="person-row">
                                            <div class="operation-btns pull-right">
                                                <span class="btns-col"><a href="#" class="btn-sub"><i
                                                                class="gl-ico gl-ico-minus"></i></a></span>
                                                <span class="btns-col"><a href="#" class="btn-add"><i
                                                                class="gl-ico gl-ico-plus"></i></a></span>
                                            </div>
                                            <div class="text-h">
                                                <strong class=""><span
                                                            class=""><?= $children ?> </span>Children</strong>
                                                <em class="person-info">Age 2 -12 </em>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <span class="ttl">Rooms</span>
                            <div class="person-num">
                                <!--                                <span class="chosen open-drop" data-offset="-15px 0" data-theme="drop-theme-arrows-bounce">8 rooms </span>-->
                                <!--                                <div class="drop-content hide">-->
                                <!--                                    <div class="drop-list rooms-drop">-->
                                <!--                                        <ul>-->
                                <!--                                            <li><a href="#">1</a></li>-->
                                <!--                                            <li><a href="#">2</a></li>-->
                                <!--                                            <li><a href="#">3</a></li>-->
                                <!--                                            <li><a href="#">4</a></li>-->
                                <!--                                            <li><a href="#">5</a></li>-->
                                <!--                                            <li><a href="#">6</a></li>-->
                                <!--                                            <li><a href="#">7</a></li>-->
                                <!--                                            <li class="active"><a href="#">8</a></li>-->
                                <!--                                        </ul>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                                <select class="sel" name="" id="rooms-quantity">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>rooms
                            </div>
                        </div>
                        <div class="col">
                            <span class="ttl">Rating</span>
                            <input class="rating" value="3" data-step=1 data-size="md" data-symbol="&#xe018;"
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
                            <strong class="filter-section-ttl">Hotel types:</strong>
                            <div class="filter-area">
                                <div class="filter-check-list">
                                    <?php
                                    $hotelTypesCount = count($hotelTypes);

                                    if ($hotelTypesCount % 3 == 0) {
                                        $firstHtCountColumn = $secondHtCountColumn = $thirdHtCountColumn = $hotelTypesCount / 3;
                                    } else {
                                        $firstHtCountColumn = ceil($hotelTypesCount / 3);
                                        $secondHtCountColumn = $firstHtCountColumn;
                                        $thirdAtCountColumn = $firstHtCountColumn - 1;
                                    }
                                    ?>
                                    <div class="check-col">
                                        <ul class="check-list">
                                            <?php
                                            for ($i = 0; $i < $firstHtCountColumn; $i++) {
                                                ?>
                                                <li>
                                                    <div class="checkbox checkbox-inline">
                                                        <input id="chk<?= $hotelTypes[$i]['ext_id'] ?>" type="checkbox"
                                                               name="conditions">
                                                        <label for="chk<?= $hotelTypes[$i]['ext_id'] ?>"><?= $hotelTypes[$i]['hotel_type'] ?></label>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <div class="check-col">
                                        <ul class="check-list">
                                            <?php
                                            for ($i = $firstHtCountColumn; $i < $secondHtCountColumn + $firstHtCountColumn; $i++) {
                                                ?>
                                                <li>
                                                    <div class="checkbox checkbox-inline">
                                                        <input id="chk<?= $hotelTypes[$i]['ext_id'] ?>" type="checkbox"
                                                               name="conditions">
                                                        <label for="chk<?= $hotelTypes[$i]['ext_id'] ?>"><?= $hotelTypes[$i]['hotel_type'] ?></label>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <div class="check-col">
                                        <ul class="check-list">
                                            <?php
                                            for ($i = $secondHtCountColumn + $firstHtCountColumn; $i < $hotelTypesCount; $i++) {
                                                ?>
                                                <li>
                                                    <div class="checkbox checkbox-inline">
                                                        <input id="chk<?= $hotelTypes[$i]['ext_id'] ?>" type="checkbox"
                                                               name="conditions">
                                                        <label for="chk<?= $hotelTypes[$i]['ext_id'] ?>"><?= $hotelTypes[$i]['hotel_type'] ?></label>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="filter-section">
                            <strong class="filter-section-ttl">Dining category filter:</strong>
                            <div class="filter-area">
                                <div class="filter-check-list">
                                    <?php
                                    $hotelBoardsCount = count($hotelBoards);

                                    if ($hotelBoardsCount % 2 == 0) {
                                        $firstBtCountColumn = $secondBtCountColumn = $hotelBoardsCount / 3;
                                    } else {
                                        $firstBtCountColumn = ceil($hotelBoardsCount / 2);
                                        $secondBtCountColumn = $firstBtCountColumn - 1;
                                    }
                                    ?>
                                    <div class="check-col">
                                        <ul class="check-list">
                                            <?php
                                            for ($i = 0; $i < $firstBtCountColumn; $i++) {
                                                ?>
                                                <li>
                                                    <div class="checkbox checkbox-inline">
                                                        <input id="bo<?= $hotelBoards[$i]['code'] ?>" type="checkbox"
                                                               name="conditions">
                                                        <label for="bo<?= $hotelBoards[$i]['code'] ?>"><?= $hotelBoards[$i]['name'] ?></label>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <div class="check-col">
                                        <ul class="check-list">
                                            <?php
                                            for ($i = $firstBtCountColumn; $i < $hotelBoardsCount; $i++) {
                                                ?>
                                                <li>
                                                    <div class="checkbox checkbox-inline">
                                                        <input id="bo<?= $hotelBoards[$i]['code'] ?>" type="checkbox"
                                                               name="conditions">
                                                        <label for="bo<?= $hotelBoards[$i]['code'] ?>"><?= $hotelBoards[$i]['name'] ?></label>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="filter-section">
                            <strong class="filter-section-ttl">Accomodations:</strong>
                            <div class="filter-area">
                                <div class="filter-check-list">
                                    <?php
                                    $hotelAccomodationsCount = count($hotelAccomodations);

                                    if ($hotelAccomodationsCount % 3 == 0) {
                                        $firstAtCountColumn = $secondAtCountColumn = $thirdAtCountColumn = $hotelAccomodationsCount / 3;
                                    } else {
                                        $firstAtCountColumn = ceil($hotelAccomodationsCount / 3);
                                        $secondAtCountColumn = $firstAtCountColumn;
                                        $thirdAtCountColumn = $firstAtCountColumn - 1;
                                    }
                                    ?>
                                    <div class="check-col">
                                        <ul class="check-list">
                                            <?php
                                            for ($i = 0; $i < $firstAtCountColumn; $i++) {
                                                ?>
                                                <li>
                                                    <div class="checkbox checkbox-inline">
                                                        <input id="acc<?= $hotelAccomodations[$i]['code'] ?>"
                                                               type="checkbox" name="conditions">
                                                        <label for="acc<?= $hotelAccomodations[$i]['code'] ?>"><?= $hotelAccomodations[$i]['multi_description'] ?></label>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <div class="check-col">
                                        <ul class="check-list">
                                            <?php
                                            for ($i = $firstAtCountColumn; $i < $secondAtCountColumn + $firstAtCountColumn; $i++) {
                                                ?>
                                                <li>
                                                    <div class="checkbox checkbox-inline">
                                                        <input id="acc<?= $hotelAccomodations[$i]['code'] ?>"
                                                               type="checkbox" name="conditions">
                                                        <label for="acc<?= $hotelAccomodations[$i]['code'] ?>"><?= $hotelAccomodations[$i]['multi_description'] ?></label>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <div class="check-col">
                                        <ul class="check-list">
                                            <?php
                                            for ($i = $secondAtCountColumn + $firstAtCountColumn; $i < $hotelAccomodationsCount; $i++) {
                                                ?>
                                                <li>
                                                    <div class="checkbox checkbox-inline">
                                                        <input id="acc<?= $hotelAccomodations[$i]['code'] ?>"
                                                               type="checkbox" name="conditions">
                                                        <label for="acc<?= $hotelAccomodations[$i]['code'] ?>"><?= $hotelAccomodations[$i]['multi_description'] ?></label>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="filter-section">
                            <strong class="filter-section-ttl">Rates for packaging:</strong>
                            <div class="filter-area">
                                <div class="filter-check-list">

                                    <div class="check-col">
                                        <ul class="check-list">
                                            <li>
                                                <div class="checkbox checkbox-inline">
                                                    <input id="pkg" type="checkbox" name="conditions">
                                                    <label for="pkg">Add rates for packaging</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="filter-section">
                            <strong class="filter-section-ttl">Rates per room:</strong>
                            <div class="filter-area">
                                <div class="filter-check-list">
                                    <div class="check-col">
                                        <div class="radio radio-inline">
                                            <input id="rad01" type="radio" checked="checked" name="rates">
                                            <label for="rad01">1-3</label>
                                        </div>
                                    </div>
                                    <div class="check-col">
                                        <div class="radio radio-inline">
                                            <input id="rad02" type="radio" name="rates">
                                            <label for="rad02">4-6</label>
                                        </div>
                                    </div>
                                    <div class="check-col">
                                        <div class="radio radio-inline">
                                            <input id="rad03" type="radio" name="rates">
                                            <label for="rad03">7-10</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="filter-section">
                            <strong class="filter-section-ttl">Categories of adisor:</strong>
                            <div class="recommendations-btns">
                                <a href="#" class="btn btn-sm disabled">Facebook friends</a>
                                <a href="#" class="btn btn-sm">With mutual interests</a>
                                <a href="#" class="btn btn-sm disabled">Local experts</a>
                            </div>
                        </div>

                        <div class="filter-section">
                            <strong class="filter-section-ttl">Pricing:</strong>
                            <div class="histo-slider">
                                <div id="chart" class="histo-chart"></div>
                                <input id="ex2" type="text" class="span2" value="" data-slider-min="10"
                                       data-slider-max="1000" data-slider-step="5" data-slider-value="[10, 1000]"/>
                                <b class="price-min" id="price-min">$ <span>10</span></b>
                                <b class="price-max" id="price-max">$ <span>1000</span></b>
                            </div>
                        </div>
                        <div class="btns-row">
                            <div class="flex-auto-width">
                                <a href="#" class="btn btn-link">CLEAR SEARCH FILTERS</a>
                            </div>
                            <a href="#" class="btn">Cancel</a>
                            <a href="#" class="btn btn-primary">Confirm search</a>
                        </div>
                    </div>
                    <div class="results-found-info text-right"><strong>35+ Advisors</strong> search results</div>
                </div>
                <div class="result-wrapper">
                    <div class="result-list row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="card">
                                <div class="img-h">
										<span class="img-wrap">
											<img src="<?= drupal_get_path('theme', 'new_design') . '/images/img01.jpg' ?>"
                                                 alt="image">
										</span>
                                    <div class="price">
                                        <span>From</span>
                                        <strong>$34</strong>
                                    </div>
                                </div>
                                <strong class="ttl"><a href="#">Lorem Ipsum is simply </a></strong>
                                <span class="sub-ttl">Long  location name</span>
                                <footer>
                                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#exampleModal"><i
                                                class="gl-ico gl-ico-logo"></i>Recommend</a>
                                    <div class="card-rate-info">
                                        <div class="rating">
                                            <strong class="rating-ttl">7</strong>
                                            <div class="stars">
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                            aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                        <em class="recommend"><strong>25</strong> Recommendations</em>
                                    </div>
                                </footer>
                                <div class="more-info">
                                    <div class="show-more-row">
                                        <a class="lnk-expand collapsed" href="#hotel-drop01" data-toggle="collapse"
                                           aria-expanded="false" aria-controls="collapseExample"
                                           data-lnk-expand-text-show="Show more" data-lnk-expand-text-hide="Hide"><i
                                                    class="gl-ico gl-ico-arrow-down"></i></a>
                                    </div>
                                    <div class="more-drop collapse" id="hotel-drop01">
                                        <div class="more-drop-area">
                                            <div class="recommend-row">
                                                <div class="recommend-avatar">
                                                    <img src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                         alt="">
                                                </div>
                                                <div class="text-h">
                                                    <strong class="recommend-author-name">Very long username recommends
                                                        this hotel for:</strong>
                                                    <div class="tags">
                                                        Golf, Music, Scuba diving, Road trip
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="reviews-wave">
                                                <strong class="reviews-wave-ttl">Reviews (2)</strong>
                                                <div class="reviews-list">
                                                    <div class="item">
                                                        <div class="ttl">
                                                            <div class="flex-auto-width">
                                                                <div class="ava"><img
                                                                            src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                                            alt="ava"></div>
                                                                <span class="name">Vincent Vega</span>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="stars">
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star empty"><i
                                                                                class="gl-ico gl-ico-star"
                                                                                aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-area">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the ndustry's
                                                                standard dummy text ever since the unknown printer too a
                                                                galley of type and scrambled Lorem sum is simply dummy
                                                                text of the printing and. typesetting industry. Lorem
                                                                Ipsum has been the indus</p>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="ttl">
                                                            <div class="flex-auto-width">
                                                                <div class="ava"><img
                                                                            src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                                            alt="ava"></div>
                                                                <span class="name">Vincent Vega</span>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="stars">
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star empty"><i
                                                                                class="gl-ico gl-ico-star"
                                                                                aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-area">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the ndustry's
                                                                standard dummy text ever since the unknown printer too a
                                                                galley of type and scrambled Lorem sum is simply dummy
                                                                text of the printing and. typesetting industry. Lorem
                                                                Ipsum has been the indus</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="img-h">
										<span class="img-wrap">
											<img src="<?= drupal_get_path('theme', 'new_design') . '/images/img01.jpg' ?>"
                                                 alt="image">
										</span>
                                    <div class="price">
                                        <span>From</span>
                                        <strong>$34</strong>
                                    </div>
                                </div>
                                <strong class="ttl"><a href="#">Lorem Ipsum is simply </a></strong>
                                <span class="sub-ttl">Long  location name</span>
                                <footer>
                                    <a href="#" class="btn btn-default"><i class="gl-ico gl-ico-logo"></i>Recommend</a>
                                    <div class="card-rate-info">
                                        <div class="rating">
                                            <strong class="rating-ttl">7</strong>
                                            <div class="stars">
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                            aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                        <em class="recommend"><strong>25</strong> Recommendations</em>
                                    </div>
                                </footer>
                                <div class="more-info">
                                    <div class="show-more-row">
                                        <a class="lnk-expand collapsed" href="#hotel-drop02" data-toggle="collapse"
                                           aria-expanded="false" aria-controls="collapseExample"
                                           data-lnk-expand-text-show="Show more" data-lnk-expand-text-hide="Hide"><i
                                                    class="gl-ico gl-ico-arrow-down"></i></a>
                                    </div>
                                    <div class="more-drop collapse" id="hotel-drop02">
                                        <div class="more-drop-area">
                                            <div class="recommend-row">
                                                <div class="recommend-avatar">
                                                    <img src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                         alt="">
                                                </div>
                                                <div class="text-h">
                                                    <strong class="recommend-author-name">Very long username recommends
                                                        this hotel for:</strong>
                                                    <div class="tags">
                                                        Golf, Music, Scuba diving, Road trip
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="reviews-wave">
                                                <strong class="reviews-wave-ttl">Reviews (2)</strong>
                                                <div class="reviews-list">
                                                    <div class="item">
                                                        <div class="ttl">
                                                            <div class="flex-auto-width">
                                                                <div class="ava"><img
                                                                            src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                                            alt="ava"></div>
                                                                <span class="name">Vincent Vega</span>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="stars">
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star empty"><i
                                                                                class="gl-ico gl-ico-star"
                                                                                aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-area">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the ndustry's
                                                                standard dummy text ever since the unknown printer too a
                                                                galley of type and scrambled Lorem sum is simply dummy
                                                                text of the printing and. typesetting industry. Lorem
                                                                Ipsum has been the indus</p>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="ttl">
                                                            <div class="flex-auto-width">
                                                                <div class="ava"><img
                                                                            src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                                            alt="ava"></div>
                                                                <span class="name">Vincent Vega</span>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="stars">
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star empty"><i
                                                                                class="gl-ico gl-ico-star"
                                                                                aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-area">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the ndustry's
                                                                standard dummy text ever since the unknown printer too a
                                                                galley of type and scrambled Lorem sum is simply dummy
                                                                text of the printing and. typesetting industry. Lorem
                                                                Ipsum has been the indus</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="img-h">
										<span class="img-wrap">
											<img src="<?= drupal_get_path('theme', 'new_design') . '/images/img01.jpg' ?>"
                                                 alt="image">
										</span>
                                    <div class="price">
                                        <span>From</span>
                                        <strong>$34</strong>
                                    </div>
                                </div>
                                <strong class="ttl"><a href="#">Lorem Ipsum is simply </a></strong>
                                <span class="sub-ttl">Long  location name</span>
                                <footer>
                                    <a href="#" class="btn btn-default"><i class="gl-ico gl-ico-logo"></i>Recommend</a>
                                    <div class="card-rate-info">
                                        <div class="rating">
                                            <strong class="rating-ttl">7</strong>
                                            <div class="stars">
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                            aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                        <em class="recommend"><strong>25</strong> Recommendations</em>
                                    </div>
                                </footer>
                                <div class="more-info">
                                    <div class="show-more-row">
                                        <a class="lnk-expand collapsed" href="#hotel-drop03" data-toggle="collapse"
                                           aria-expanded="false" aria-controls="collapseExample"
                                           data-lnk-expand-text-show="Show more" data-lnk-expand-text-hide="Hide"><i
                                                    class="gl-ico gl-ico-arrow-down"></i></a>
                                    </div>
                                    <div class="more-drop collapse" id="hotel-drop03">
                                        <div class="more-drop-area">
                                            <div class="recommend-row">
                                                <div class="recommend-avatar">
                                                    <img src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                         alt="">
                                                </div>
                                                <div class="text-h">
                                                    <strong class="recommend-author-name">Very long username recommends
                                                        this hotel for:</strong>
                                                    <div class="tags">
                                                        Golf, Music, Scuba diving, Road trip
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="reviews-wave">
                                                <strong class="reviews-wave-ttl">Reviews (2)</strong>
                                                <div class="reviews-list">
                                                    <div class="item">
                                                        <div class="ttl">
                                                            <div class="flex-auto-width">
                                                                <div class="ava"><img
                                                                            src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                                            alt="ava"></div>
                                                                <span class="name">Vincent Vega</span>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="stars">
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star empty"><i
                                                                                class="gl-ico gl-ico-star"
                                                                                aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-area">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the ndustry's
                                                                standard dummy text ever since the unknown printer too a
                                                                galley of type and scrambled Lorem sum is simply dummy
                                                                text of the printing and. typesetting industry. Lorem
                                                                Ipsum has been the indus</p>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="ttl">
                                                            <div class="flex-auto-width">
                                                                <div class="ava"><img
                                                                            src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                                            alt="ava"></div>
                                                                <span class="name">Vincent Vega</span>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="stars">
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star empty"><i
                                                                                class="gl-ico gl-ico-star"
                                                                                aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-area">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the ndustry's
                                                                standard dummy text ever since the unknown printer too a
                                                                galley of type and scrambled Lorem sum is simply dummy
                                                                text of the printing and. typesetting industry. Lorem
                                                                Ipsum has been the indus</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="card">
                                <div class="img-h">
										<span class="img-wrap">
											<img src="<?= drupal_get_path('theme', 'new_design') . '/images/img01.jpg' ?>"
                                                 alt="image">
										</span>
                                    <div class="price">
                                        <span>From</span>
                                        <strong>$34</strong>
                                    </div>
                                </div>
                                <strong class="ttl"><a href="#">Lorem Ipsum is simply </a></strong>
                                <span class="sub-ttl">Long  location name</span>
                                <footer>
                                    <a href="#" class="btn btn-default"><i class="gl-ico gl-ico-logo"></i>Recommend</a>
                                    <div class="card-rate-info">
                                        <div class="rating">
                                            <strong class="rating-ttl">7</strong>
                                            <div class="stars">
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                            aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                        <em class="recommend"><strong>25</strong> Recommendations</em>
                                    </div>
                                </footer>
                                <div class="more-info">
                                    <div class="show-more-row">
                                        <a class="lnk-expand collapsed" href="#hotel-drop04" data-toggle="collapse"
                                           aria-expanded="false" aria-controls="collapseExample"
                                           data-lnk-expand-text-show="Show more" data-lnk-expand-text-hide="Hide"><i
                                                    class="gl-ico gl-ico-arrow-down"></i></a>
                                    </div>
                                    <div class="more-drop collapse" id="hotel-drop04">
                                        <div class="more-drop-area">
                                            <div class="recommend-row">
                                                <div class="recommend-avatar">
                                                    <img src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                         alt="">
                                                </div>
                                                <div class="text-h">
                                                    <strong class="recommend-author-name">Very long username recommends
                                                        this hotel for:</strong>
                                                    <div class="tags">
                                                        Golf, Music, Scuba diving, Road trip
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="recommendation-types">
                                                <div class="col">
                                                    <strong class="ttl">Username recommends this activity for:</strong>
                                                    <div class="tags">Golf, Music, Scuba diving, Road trip</div>
                                                </div>
                                                <div class="col">
                                                    <strong class="ttl">Type of trip</strong>
                                                    <div class="tags">Trip with a friend</div>
                                                </div>
                                            </div>
                                            <div class="reviews-wave">
                                                <strong class="reviews-wave-ttl">Reviews (2)</strong>
                                                <div class="reviews-list">
                                                    <div class="item">
                                                        <div class="ttl">
                                                            <div class="flex-auto-width">
                                                                <div class="ava"><img
                                                                            src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                                            alt="ava"></div>
                                                                <span class="name">Vincent Vega</span>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="stars">
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star empty"><i
                                                                                class="gl-ico gl-ico-star"
                                                                                aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-area">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the ndustry's
                                                                standard dummy text ever since the unknown printer too a
                                                                galley of type and scrambled Lorem sum is simply dummy
                                                                text of the printing and. typesetting industry. Lorem
                                                                Ipsum has been the indus</p>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="ttl">
                                                            <div class="flex-auto-width">
                                                                <div class="ava"><img
                                                                            src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                                            alt="ava"></div>
                                                                <span class="name">Vincent Vega</span>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="stars">
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star empty"><i
                                                                                class="gl-ico gl-ico-star"
                                                                                aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-area">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the ndustry's
                                                                standard dummy text ever since the unknown printer too a
                                                                galley of type and scrambled Lorem sum is simply dummy
                                                                text of the printing and. typesetting industry. Lorem
                                                                Ipsum has been the indus</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="img-h">
										<span class="img-wrap">
											<img src="<?= drupal_get_path('theme', 'new_design') . '/images/img01.jpg' ?>"
                                                 alt="image">
										</span>
                                    <div class="price">
                                        <span>From</span>
                                        <strong>$34</strong>
                                    </div>
                                </div>
                                <strong class="ttl"><a href="#">Lorem Ipsum is simply </a></strong>
                                <span class="sub-ttl">Long  location name</span>
                                <footer>
                                    <a href="#" class="btn btn-default"><i class="gl-ico gl-ico-logo"></i>Recommend</a>
                                    <div class="card-rate-info">
                                        <div class="rating">
                                            <strong class="rating-ttl">7</strong>
                                            <div class="stars">
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                            aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                        <em class="recommend"><strong>25</strong> Recommendations</em>
                                    </div>
                                </footer>
                                <div class="more-info">
                                    <div class="show-more-row">
                                        <a class="lnk-expand collapsed" href="#hotel-drop05" data-toggle="collapse"
                                           aria-expanded="false" aria-controls="collapseExample"
                                           data-lnk-expand-text-show="Show more" data-lnk-expand-text-hide="Hide"><i
                                                    class="gl-ico gl-ico-arrow-down"></i></a>
                                    </div>
                                    <div class="more-drop collapse" id="hotel-drop05">
                                        <div class="more-drop-area">
                                            <div class="recommend-row">
                                                <div class="recommend-avatar">
                                                    <img src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                         alt="">
                                                </div>
                                                <div class="text-h">
                                                    <strong class="recommend-author-name">Very long username recommends
                                                        this hotel for:</strong>
                                                    <div class="tags">
                                                        Golf, Music, Scuba diving, Road trip
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="reviews-wave">
                                                <strong class="reviews-wave-ttl">Reviews (2)</strong>
                                                <div class="reviews-list">
                                                    <div class="item">
                                                        <div class="ttl">
                                                            <div class="flex-auto-width">
                                                                <div class="ava"><img
                                                                            src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                                            alt="ava"></div>
                                                                <span class="name">Vincent Vega</span>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="stars">
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star empty"><i
                                                                                class="gl-ico gl-ico-star"
                                                                                aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-area">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the ndustry's
                                                                standard dummy text ever since the unknown printer too a
                                                                galley of type and scrambled Lorem sum is simply dummy
                                                                text of the printing and. typesetting industry. Lorem
                                                                Ipsum has been the indus</p>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="ttl">
                                                            <div class="flex-auto-width">
                                                                <div class="ava"><img
                                                                            src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                                            alt="ava"></div>
                                                                <span class="name">Vincent Vega</span>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="stars">
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star empty"><i
                                                                                class="gl-ico gl-ico-star"
                                                                                aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-area">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the ndustry's
                                                                standard dummy text ever since the unknown printer too a
                                                                galley of type and scrambled Lorem sum is simply dummy
                                                                text of the printing and. typesetting industry. Lorem
                                                                Ipsum has been the indus</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="img-h">
										<span class="img-wrap">
											<img src="<?= drupal_get_path('theme', 'new_design') . '/images/img01.jpg' ?>"
                                                 alt="image">
										</span>
                                    <div class="price">
                                        <span>From</span>
                                        <strong>$34</strong>
                                    </div>
                                </div>
                                <strong class="ttl"><a href="#">Lorem Ipsum is simply </a></strong>
                                <span class="sub-ttl">Long  location name</span>
                                <footer>
                                    <a href="#" class="btn btn-default"><i class="gl-ico gl-ico-logo"></i>Recommend</a>
                                    <div class="card-rate-info">
                                        <div class="rating">
                                            <strong class="rating-ttl">7</strong>
                                            <div class="stars">
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star"><i class="gl-ico gl-ico-star" aria-hidden="true"></i></span>
                                                <span class="star empty"><i class="gl-ico gl-ico-star"
                                                                            aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                        <em class="recommend"><strong>25</strong> Recommendations</em>
                                    </div>
                                </footer>
                                <div class="more-info">
                                    <div class="show-more-row">
                                        <a class="lnk-expand collapsed" href="#hotel-drop06" data-toggle="collapse"
                                           aria-expanded="false" aria-controls="collapseExample"
                                           data-lnk-expand-text-show="Show more" data-lnk-expand-text-hide="Hide"><i
                                                    class="gl-ico gl-ico-arrow-down"></i></a>
                                    </div>
                                    <div class="more-drop collapse" id="hotel-drop06">
                                        <div class="more-drop-area">
                                            <div class="recommend-row">
                                                <div class="recommend-avatar">
                                                    <img src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                         alt="">
                                                </div>
                                                <div class="text-h">
                                                    <strong class="recommend-author-name">Very long username recommends
                                                        this hotel for:</strong>
                                                    <div class="tags">
                                                        Golf, Music, Scuba diving, Road trip
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="reviews-wave">
                                                <strong class="reviews-wave-ttl">Reviews (2)</strong>
                                                <div class="reviews-list">
                                                    <div class="item">
                                                        <div class="ttl">
                                                            <div class="flex-auto-width">
                                                                <div class="ava"><img
                                                                            src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                                            alt="ava"></div>
                                                                <span class="name">Vincent Vega</span>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="stars">
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star empty"><i
                                                                                class="gl-ico gl-ico-star"
                                                                                aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-area">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the ndustry's
                                                                standard dummy text ever since the unknown printer too a
                                                                galley of type and scrambled Lorem sum is simply dummy
                                                                text of the printing and. typesetting industry. Lorem
                                                                Ipsum has been the indus</p>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="ttl">
                                                            <div class="flex-auto-width">
                                                                <div class="ava"><img
                                                                            src="<?= drupal_get_path('theme', 'new_design') . '/images/photo01.jpg' ?>"
                                                                            alt="ava"></div>
                                                                <span class="name">Vincent Vega</span>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="stars">
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star"><i class="gl-ico gl-ico-star"
                                                                                          aria-hidden="true"></i></span>
                                                                    <span class="star empty"><i
                                                                                class="gl-ico gl-ico-star"
                                                                                aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-area">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the ndustry's
                                                                standard dummy text ever since the unknown printer too a
                                                                galley of type and scrambled Lorem sum is simply dummy
                                                                text of the printing and. typesetting industry. Lorem
                                                                Ipsum has been the indus</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<!-- start modal window recommendation -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-custom-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Recommend this activity</h4>
                <strong class="sub-ttl">And get rewarded when other travelers follow your recommendatuion</strong>
            </div>
            <div class="modal-body">
                <div class="edit-recommendation-holder">
                    <div class="column">
                        <textarea class="form-control" id="message-text">Write your recommendation here</textarea>
                    </div>
                    <div class="column">
                        <div class="tags-wrap">
                            <div class="tags-box">
                                <div class="tags-ttl-holder rating-wrap-ttl">
                                    <strong class="tags-ttl">Set a rating </strong>
                                    <input class="rating" value="3" data-step=1 data-size="lg" data-symbol="&#xe018;"
                                           data-glyphicon="false" data-rating-class="rating-gloobers">
                                </div>
                            </div>
                            <div class="tags-box">
                                <div class="tags-ttl-holder">
                                    <strong class="tags-ttl">Recomends this activity for</strong>
                                    <i class="ttl-extra-info">Tap to select</i>
                                </div>
                                <div class="tags-list">
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip type 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip type 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip type 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip type 1</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-airplane"></i>Trip 1</a>
                                </div>
                            </div>
                            <div class="tags-box">
                                <div class="tags-ttl-holder">
                                    <strong class="tags-ttl">Travelers passionate about</strong>
                                    <i class="ttl-extra-info">Tap to select</i>
                                </div>
                                <div class="tags-list">
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>bla bla bla</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>bla bla bla</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>bla bla</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>bla bla</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                    <a href="#" class="tag btn btn-sm"><i class="gl-ico gl-ico-like"></i>Passion</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btns-row text-right">
                    <a href="#" class="btn btn-link">Cancel</a>
                    <a href="#" class="btn btn-default">SAVE</a>
                </div>
            </div>
        </div>
    </div>
</div>

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

        var roomsQuantity = '<?= $rooms ?>';
        $("#rooms-quantity option[value=" + roomsQuantity + "]").attr({selected: "selected"});


        $('.search-tabs .radio').click(function () {
            $(this).tab('show');
        });

        $('.how-slider')
            .slick({
                slidesToShow: 1,
                arrows: false
            })
            .on('afterChange', function (event, slick, currentSlide, nextSlide) {
                $('.slider-tabs li').removeClass("active").eq(currentSlide).addClass("active");
            });

        $('.slider-tabs li').each(function (i) {
            $(this).click(function () {
                $('.slider-tabs li').removeClass("active");
                $(this).addClass("active");
                $('.how-slider').slick('slickGoTo', i);
            })
        });





        (function () {

            function datapickerDropEmbedding(target) {

                $(target).each(function () {

                    var dropElm,
                        $elm,
                        content,
                        drop,
                        theme,
                        position,
                        offset,
                        dropDatapicker,
                        _this = $(this);

                    var startDate = '<?= $checkin_date ?>';
                    startDate = startDate ? startDate : moment();

                    var endDate = '<?= $checkout_date ?>';
                    endDate = endDate ? endDate :moment().add(2, 'days');
                    console.log(startDate+' '+endDate);

                    if (_this[0].nodeName != "A") {
                        _this.daterangepicker({
                            "autoApply": true,
                            "showCustomRangeLabel": false,
                            "startDate": startDate,
                            "endDate": endDate,
                            "minDate": startDate,
                            locale: {
                                format: 'DD/MM/YYYY'
                            },
                            "dateLimit": {
                                "days": 60
                            },
                            "alwaysShowCalendars": true,
                            "autoApply": true
                        }, function (start, end, label) {
                            $('.date-range-input').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
                        });
                    } else {
                        _this.daterangepicker({
                            "autoApply": true,
                            "showCustomRangeLabel": false,
                            "startDate": startDate,
                            "endDate": endDate,
                            locale: {
                                format: 'DD/MMM/YYYY'
                            },
                            "minDate": startDate,
                            "dateLimit": {
                                "days": 60
                            },
                            "alwaysShowCalendars": true,
                            "autoApply": true
                        }, function (start, end, label) {
                            $('.date-range-input').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
                        }).on("click", function () {
                            return false;
                        });

                        _this.data('daterangepicker').updateElement = function () {
                            if (this.element.is('input') && !this.singleDatePicker && this.autoUpdateInput) {
                                this.element.val(this.startDate.format(this.locale.format) + this.locale.separator + this.endDate.format(this.locale.format));
                                this.element.trigger('change');
                            } else if (this.element.is('input') && this.autoUpdateInput) {
                                this.element.val(this.startDate.format(this.locale.format));
                                this.element.trigger('change');
                            } else if (this.element.is('a') && this.autoUpdateInput) {
                                this.element.children(".date-field").html(this.startDate.format(this.locale.format));
                            }
                        };

                        _this.children(".date-field").html(_this.data("startDate"));
                    }

                    _this.on('show.daterangepicker', function () {
                        dropDatapicker.position();
                    });

                    dropElm = _this.data('daterangepicker').container;

                    $elm = _this;
                    theme = $elm.data('theme');
                    offset = $elm.data('offset') || '0 0';
                    position = $elm.data('position') || 'bottom center';

                    dropElm.addClass(theme).wrapInner("<div class='drop-content'></div>");

                    dropDatapicker = new Tether({
                        classPrefix: 'drop',
                        element: dropElm,
                        target: _this,
                        attachment: 'top left',
                        targetAttachment: position,
                        offset: offset,
                        constraints: [
                            {
                                to: 'scrollParent'
                            }
                        ]
                    });


                });


            }

            datapickerDropEmbedding('.daterange-input');

        }).call(this);


        if ($('#ex2').length) {
            $('#ex2').slider({
                tooltip: 'hide'
            });
            $("#ex2").on("slide", function (slideEvt) {
                $("#price-min span").text(slideEvt.value[0]);
                $("#price-max span").text(slideEvt.value[1]);

            });

        }


        (function () {


            function rndArr(size) {
                var arr = [];

                for (var i = 0, l = size; i < l; i++) {
                    arr.push(Math.round(Math.random() * l))
                }

                return arr;
            }

            /*var chartdata = [500, 100, 10, 10, 500, 100, 10, 10, 0, 35, 1000, 0, 35, 100, 100, 500, 300, 500, 100, 10, 10, 0, 35, 2100, 1000, 500, 300, 300, 500, 100, 10, 10, 0, 35, 1000, 500, 300, 500, 100, 10, 10, 0, 35, 1000, 1000, 500, 1000, 1000, 500, 300];*/

            var chartdata = rndArr(50),
                height = 35,
                width = '100%',
                persentageItemWidth = 100 / chartdata.length;


            var yScale = d3.scaleLinear()
                .domain([0, d3.max(chartdata)])
                .range([0, height]);


            var rect;

            var awesome, dd3;


            var ww = function () {


                dd3 = d3.select('#chart').append('svg');
                rect = dd3
                    .attr('width', width)
                    .attr('height', height)
                    .append('g')
                    .selectAll('rect').data(chartdata);

                chartdata = rndArr(50);

                awesome = rect
                    .enter().append('rect')
                    .style('fill', '#acacac')
                    .attr('width', persentageItemWidth + "%")
                    .attr('x', function (data, i) {
                        return persentageItemWidth * i + "%";
                    })
                    .attr('height', 0)
                    .attr('y', height);

            };

            ww();

            var qq = function () {

                awesome.transition()
                    .attr('height', function (data) {
                        return yScale(data);
                    })
                    .attr('y', function (data) {
                        return height - yScale(data);
                    })
                    .delay(function (/*data,*/ i) {
                        return i * 10;
                    })
                    .duration(1000)
                    .ease(d3.easeElastic);

            };
            qq();

            var refreshGraph = function () {
                var qw = rndArr(50);
                awesome.data(qw);
                qq();

            };


            $("#refresh-prices").click(function () {
                refreshGraph();
            })


        })();

    })


</script>


</body>
</html>