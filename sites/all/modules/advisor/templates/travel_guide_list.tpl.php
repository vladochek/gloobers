<?php global $base_url; ?>
<section class="col-lg-12 user-sec nopadding requestrecive">
    <div class="dr-wrapper">
        <div class="col-lg-12 nopadding">
            <div class="guide-travel">
                <?php 	
                //echo "<pre>";print_r($tGuideList);die;	
                if(!empty($tGuideList) && is_array($tGuideList)):				
                foreach ($tGuideList as $guide) {

                 ?>
                    <div class="col-xs-12 col-sm-6 col-md-6 travelblock"> 
                        <a href="<?php echo $base_url . '/advice/recommendation/' . base64_encode($guide['tgid']); ?>"><img alt=" " src="<?php echo $base_url . '/' . drupal_get_path('theme', 'gloobers'); ?>/images/thumb1.jpg"></a>
                        <div class="listdetail" style="color: #fff;font-size: 13px;padding: 5px;border-radius: 3px;">
                            <?php 	
                                if($guide['listings'] !=''){

                                    $listings = ltrim($guide['listings'],',');

                                    $listings = explode(',', $listings);
                                   
                                    $sizeOflist=sizeof($listings); 
                                    echo    $sizeOflist;


                                }else{


                                    echo "0";
                                }
                               

                            /* $listings = explode(',',$guide['listings']);		
                            			$my_value = 0;							
                                         $filtered_array = array_filter($listings, function ($element) use ($my_value) { return ($element != $my_value); } );                              						    echo count($filtered_array); 							 */							?>						</div>
                        <div class="guidesec">
                            <a href="<?php echo $base_url . '/advice/recommendation/' . base64_encode($guide['tgid']); ?>">
                                <h3><?php echo stripslashes($guide['title']); ?></h3>
                                <p class="text"><?php echo stripslashes($guide['description']); ?></p>
                                <div class="topspace">
                                    <p>Recommended for<br>
                                        <span><?php echo $guide['first_name'].' '. $guide['last_name'];?></span>
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="edit_class">
                            <?php if ($editable == 'TRUE' || $editable == 'true') { ?>
                                <a href="javascript:void(0);" onclick="editTrevelGuide('<?php echo $guide['tgid']; ?>')">Edit</a> | 
                            <?php } ?>
                                <a href="<?php echo $base_url.'/advice/delete_guide/'. base64_encode('gloobe__'.$guide['tgid']); ?>">Delete</a>
                        </div>
                    </div>
   <?php } endif; ?>
            </div>		</div>	</div></section>