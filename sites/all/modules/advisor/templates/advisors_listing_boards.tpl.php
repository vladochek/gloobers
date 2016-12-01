<?php global $base_url; ?>

<?php if (!empty($advisorList)) { ?>

    <div class="dr-wrapper">

        <div class="col-lg-12 nopadding">

            <div class="finder-list">

                <?php if(!empty($counselors)){ ?>

                    <div class="col-lg-12" style="margin-bottom: 30px;"><h2>Filter by</h2>

                        <?php foreach ($counselors as $counselorsList) : ?>

                        <span class="label label-info"><?php echo str_replace('_',' ',strtoupper($counselorsList)); ?></span>

                        <?php endforeach; ?>

                    </div>

                <?php } 

                

                foreach ($advisorList as $advisor) {

                    $file = file_load($advisor['picture']);

                    $imgpath = $file->uri;

                    $src = file_create_url($imgpath);

                    $noImage = $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']).'/images/default_images/banner-listing_img.jpg';

                    $src = ($src) ? $src : $noImage;

                    

                    //GET Mutual Passion

                    $mutualStore = getMutualPassion($advisor['uid']);

                    

                    //GET ADVISOR INFO

                    $advisorInfo = (getAdvisorInfo($advisor['uid'])); 

                    $advisorInfo = $advisorInfo[0];

                    ?>

                    <div class="col-md-4 finder-block"> 

                        <img src="<?php echo $src; ?>" class="img-responsive" alt="" onerror="ErrorOnImage(this,'<?php echo $noImage; ?>')" style="height: 278px;">

                        <div class="upimg">

                            <img src="<?php echo $src; ?>" alt="" onerror="ErrorOnImage(this,'<?php echo $noImage; ?>')">

                            <h2><?php echo (strlen($advisor['name']) > 15) ? substr($advisor['name'], 0,14) : $advisor['name']; ?></h2>

                        </div>

                        <div class="finder-det">

                            <div class="smallimg"> <img src="<?php echo $src; ?>" alt=" " onerror="ErrorOnImage(this,'<?php echo $noImage; ?>')"> </div>

                            <h2><?php echo $advisor['name']; ?></h2>

                            <div class="poprating"> 

                                <!--GET RATING HTML FROM -->

                                <?php $starValue = abs($advisorInfo['rating_avg']); echo handleRating($starValue); ?>

                                <p>( <?php echo $advisorInfo['review_count']; ?> recommandations )</p>

                                <?php if(!empty($mutualStore)) { ?>

                                    <div class="poprating">

                                        <h3>MUTUAL PASSIONS</h3>

                                        <ul>

                                            <?php 

                                            foreach($mutualStore as $passion) {

                                                $imageSrcPassion = $passion['pid'].'.png';

                                                ?>

                                                <li><img title="<?php echo $passion['passion'];?>" src="<?php echo $base_url . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/images/passion/<?php echo $imageSrcPassion; ?>"></li>

                                            <?php } ?>

                                        </ul>

                                    </div>

                                <?php } ?>

                                

                                <div class="col-lg-12 mutualsec">

                                    <div class="col-md-6">

                                        <p>Countries Visited <br>

                                            <span><?php echo ($advisorInfo['country_visited']) ? $advisorInfo['country_visited'] : 0;?></span></p>

                                    </div>

                                    <div class="col-md-3">

                                        <p>Guides <br>

                                            <span><?php echo ($advisorInfo['guided']) ? $advisorInfo['guided']: 0 ;?></span></p>

                                    </div>

                                    <div class="col-md-3">

                                        <p>Reviews <br>

                                            <span><?php echo ($advisorInfo['review_count']) ? $advisorInfo['review_count']: 0 ;?></span></p>

                                    </div>

                                </div>

                            </div>

                            <div class="btnselect"><a href="javascript:void(0)" onclick="forward_request('<?php echo base64_encode($advisor['uid']); ?>','<?php echo $advisor['name']; ?>')">SELECT</a></div>

                        </div>

                    </div>  

                <?php } ?>

            </div>

        </div>

    </div>

<?php } else { ?>

    <div class="advisor-init-message">

        <h1>No Advisors found</h1>

        <a href="javascript:void(0)" id="_search_advisor_anchor">Click here to search again</a>

    </div>

<?php } ?>





