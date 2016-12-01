<?php
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/jquery-ui.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/carousel.css','file'); 
drupal_add_css(drupal_get_path('theme', 'gloobers') .'/css/selectsumo.css','file'); 
//drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery-ui.min.js', 'file');
//drupal_add_js(drupal_get_path('theme', 'gloobers') .'/js/jquery.sumoselect.min.js', 'file');

?>
 
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">


	
	<div class="dr-wrapper">
    <div class="dr-innercont">
      <div class="dr-topbar">
        <div class="heading">
          <h1>Malaysia <span>( 9,158 Results )</span></h1>
        </div>
        <div class="dr-listpanel">
          <!--<div class="dr-sort">
            <label>Sort By:</label>
            <div class="colsel"> <span>
              <select class="SlectBox">
                <option value="Best Rated">Best Rated</option>
                <option value="Best Rated">Best Rated</option>
                <option value="Best Rated">Best Rated</option>
              </select>
              </span> </div>
          </div>-->
          <div class="dr-tabpanel" id="tabContaier">
            <ul>
              <li class="list"><a class="active" data-id="tab1">List</a></li>
              <li class="grid"><a data-id="tab2">Photo</a></li>
              <li class="map"><a data-id="tab3">Map</a></li>
            </ul>
          </div>
        </div>
      </div>
<!--      <div class="dr-filter">
        <h2>Filters:</h2>
        <div class="btnfilter">
          <div class="btntype"> <a href="#">ROOM TYPE<span>X</span></a> </div>
          <div class="btntype"> <a href="#">Bedrooms &amp; Bathrooms<span>X</span></a> </div>
          <div class="btntype"> <a href="#">PRICE<span>X</span></a> </div>
          <div class="btntype"> <a href="#">neighborhood<span>X</span></a> </div>
          <div class="btntype"> <a href="#">Amenities<span>X</span></a> </div>
          <div class="btntype"> <a href="#">rated stars<span>X</span></a> </div>
        </div>
      </div>-->
      <div class="dr-listview tabContents" id="tab1">
        <div class="dr-listblk">
          <div class="dr-leftimg">
            <div class="carousel-wrapper" id="products1">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
          </div>
          <div class="dr-rinfo">
            <h2>Lorem Lipsum Dollor Ismet Dummy</h2>
            <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
            <div class="rating"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " /></div>
            <div class="dr-review">
              <ul>
                <li class="mid"><a href="#"><span>15</span>
                  <p>Reviews</p>
                  </a></li>
                <li class="small"><a href="#"><span class="other"></span>
                  <p>Share</p>
                  </a></li>
                <li><a href="#"><span class="otherre"></span>
                  <p>Quick View <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/blue-arrow.png" alt=" " /></p>
                  </a></li>
              </ul>
            </div>
          </div>
          <div class="dr-priceblk">
            <p>From <span>$ 68</span></p>
            <p>per night</p>
            <!--<div class="btn-share"><a href="#">SHARE</a></div>-->
            <div class="btn-detail"><a href="#">DETAILS</a></div>
          </div>
        </div>
        <div class="dr-listblk">
          <div class="dr-leftimg">
            <div class="carousel-wrapper" id="products2">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
          </div>
          <div class="dr-rinfo">
            <h2>Lorem Lipsum Dollor Ismet Dummy</h2>
            <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
            <div class="rating"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " /></div>
            <div class="dr-review">
              <ul>
                <li class="mid"><a href="#"><span>15</span>
                  <p>Reviews</p>
                  </a></li>
                <li class="small"><a href="#"><span class="other"></span>
                  <p>Share</p>
                  </a></li>
                <li><a href="#"><span class="otherre"></span>
                  <p>Quick View <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/blue-arrow.png" alt=" " /></p>
                  </a></li>
              </ul>
            </div>
          </div>
          <div class="dr-priceblk">
            <p>From <span>$ 68</span></p>
            <p>per night</p>
            <!--<div class="btn-share"><a href="#">SHARE</a></div>-->
            <div class="btn-detail"><a href="#">DETAILS</a></div>
          </div>
        </div>
        <div class="dr-listblk">
          <div class="dr-leftimg">
            <div class="carousel-wrapper" id="products3">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
          </div>
          <div class="dr-rinfo">
            <h2>Lorem Lipsum Dollor Ismet Dummy</h2>
            <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
            <div class="rating"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " /></div>
            <div class="dr-review">
              <ul>
                <li class="mid"><a href="#"><span>15</span>
                  <p>Reviews</p>
                  </a></li>
                <li class="small"><a href="#"><span class="other"></span>
                  <p>Share</p>
                  </a></li>
                <li><a href="#"><span class="otherre"></span>
                  <p>Quick View <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/blue-arrow.png" alt=" " /></p>
                  </a></li>
              </ul>
            </div>
          </div>
          <div class="dr-priceblk">
            <p>From <span>$ 68</span></p>
            <p>per night</p>
            <!--<div class="btn-share"><a href="#">SHARE</a></div>-->
            <div class="btn-detail"><a href="#">DETAILS</a></div>
          </div>
        </div>
        <div class="dr-listblk">
          <div class="dr-leftimg">
            <div class="carousel-wrapper" id="products4">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
          </div>
          <div class="dr-rinfo">
            <h2>Lorem Lipsum Dollor Ismet Dummy</h2>
            <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
            <div class="rating"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " /></div>
            <div class="dr-review">
              <ul>
                <li class="mid"><a href="#"><span>15</span>
                  <p>Reviews</p>
                  </a></li>
                <li class="small"><a href="#"><span class="other"></span>
                  <p>Share</p>
                  </a></li>
                <li><a href="#"><span class="otherre"></span>
                  <p>Quick View <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/blue-arrow.png" alt=" " /></p>
                  </a></li>
              </ul>
            </div>
          </div>
          <div class="dr-priceblk">
            <p>From <span>$ 68</span></p>
            <p>per night</p>
            <!--<div class="btn-share"><a href="#">SHARE</a></div>-->
            <div class="btn-detail"><a href="#">DETAILS</a></div>
          </div>
        </div>
        <div class="dr-listblk">
          <div class="dr-leftimg">
            <div class="carousel-wrapper" id="products5">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
          </div>
          <div class="dr-rinfo">
            <h2>Lorem Lipsum Dollor Ismet Dummy</h2>
            <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
            <div class="rating"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " /></div>
            <div class="dr-review">
              <ul>
                <li class="mid"><a href="#"><span>15</span>
                  <p>Reviews</p>
                  </a></li>
                <li class="small"><a href="#"><span class="other"></span>
                  <p>Share</p>
                  </a></li>
                <li><a href="#"><span class="otherre"></span>
                  <p>Quick View <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/blue-arrow.png" alt=" " /></p>
                  </a></li>
              </ul>
            </div>
          </div>
          <div class="dr-priceblk">
            <p>From <span>$ 68</span></p>
            <p>per night</p>
            <!--<div class="btn-share"><a href="#">SHARE</a></div>-->
            <div class="btn-detail"><a href="#">DETAILS</a></div>
          </div>
        </div>
        <div class="dr-listblk">
          <div class="dr-leftimg">
            <div class="carousel-wrapper" id="products6">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
          </div>
          <div class="dr-rinfo">
            <h2>Lorem Lipsum Dollor Ismet Dummy</h2>
            <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
            <div class="rating"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " />
			<img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " /><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star.png" alt=" " /></div>
            <div class="dr-review">
              <ul>
                <li class="mid"><a href="#"><span>15</span>
                  <p>Reviews</p>
                  </a></li>
                <li class="small"><a href="#"><span class="other"></span>
                  <p>Share</p>
                  </a></li>
                <li><a href="#"><span class="otherre"></span>
                  <p>Quick View <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/blue-arrow.png" alt=" " /></p>
                  </a></li>
              </ul>
            </div>
          </div>
          <div class="dr-priceblk">
            <p>From <span>$ 68</span></p>
            <p>per night</p>
            <!--<div class="btn-share"><a href="#">SHARE</a></div>-->
            <div class="btn-detail"><a href="#">DETAILS</a></div>
          </div>
        </div>
        <div class="btn-load"><a href="#">LOAD MORE</a></div>
      </div>
      <div class="dr-gridblk tabContents" id="tab2" style="display:none;">
        <div class="dr-gblock">
          <div class="dr-slide">
            <div class="carousel-wrapper" id="products7">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="" class="carousel-left"></a> <a href="" class="carousel-right"></a> </div>
            <div class="priceoffer">
              <p>From <span>£70</span></p>
            </div>
            <div class="tagbar">
              <div class="ratingstar"> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> </div>
              <div class="icons"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cmnt.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/view.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/share.png" alt=" " /></a> </div>
              <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
            </div>
          </div>
          <h2>Lorem Lipsum Dollor ismet </h2>
          <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
        </div>
        <div class="dr-gblock space">
          <div class="dr-slide">
            <div class="carousel-wrapper" id="products8">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="priceoffer">
              <p>From <span>£70</span></p>
            </div>
            <div class="tagbar">
              <div class="ratingstar"> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> </div>
              <div class="icons"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cmnt.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/view.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/share.png" alt=" " /></a> </div>
              <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
            </div>
          </div>
          <h2>Lorem Lipsum Dollor ismet </h2>
          <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
        </div>
        <div class="dr-gblock">
          <div class="dr-slide">
            <div class="carousel-wrapper" id="products9">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="priceoffer">
              <p>From <span>£70</span></p>
            </div>
            <div class="tagbar">
              <div class="ratingstar"> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> </div>
              <div class="icons"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cmnt.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/view.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/share.png" alt=" " /></a> </div>
              <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
            </div>
          </div>
          <h2>Lorem Lipsum Dollor ismet </h2>
          <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
        </div>
        <div class="dr-gblock">
          <div class="dr-slide">
            <div class="carousel-wrapper" id="products10">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="priceoffer">
              <p>From <span>£70</span></p>
            </div>
            <div class="tagbar">
              <div class="ratingstar"> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> </div>
              <div class="icons"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cmnt.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/view.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/share.png" alt=" " /></a> </div>
              <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
            </div>
          </div>
          <h2>Lorem Lipsum Dollor ismet </h2>
          <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
        </div>
        <div class="dr-gblock space">
          <div class="dr-slide">
            <div class="carousel-wrapper" id="products11">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="priceoffer">
              <p>From <span>£70</span></p>
            </div>
            <div class="tagbar">
              <div class="ratingstar"> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> </div>
              <div class="icons"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cmnt.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/view.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/share.png" alt=" " /></a> </div>
              <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
            </div>
          </div>
          <h2>Lorem Lipsum Dollor ismet </h2>
          <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
        </div>
        <div class="dr-gblock">
          <div class="dr-slide">
            <div class="carousel-wrapper" id="products12">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="priceoffer">
              <p>From <span>£70</span></p>
            </div>
            <div class="tagbar">
              <div class="ratingstar"> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> </div>
              <div class="icons"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cmnt.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/view.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/share.png" alt=" " /></a> </div>
              <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
            </div>
          </div>
          <h2>Lorem Lipsum Dollor ismet </h2>
          <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
        </div>
        <div class="dr-gblock">
          <div class="dr-slide">
            <div class="carousel-wrapper" id="products13">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="priceoffer">
              <p>From <span>£70</span></p>
            </div>
            <div class="tagbar">
              <div class="ratingstar"> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> </div>
              <div class="icons"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cmnt.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/view.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/share.png" alt=" " /></a> </div>
              <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
            </div>
          </div>
          <h2>Lorem Lipsum Dollor ismet </h2>
          <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
        </div>
        <div class="dr-gblock space">
          <div class="dr-slide">
            <div class="carousel-wrapper" id="products14">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="priceoffer">
              <p>From <span>£70</span></p>
            </div>
            <div class="tagbar">
              <div class="ratingstar"> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> </div>
              <div class="icons"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cmnt.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/view.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/share.png" alt=" " /></a> </div>
              <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
            </div>
          </div>
          <h2>Lorem Lipsum Dollor ismet </h2>
          <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
        </div>
        <div class="dr-gblock">
          <div class="dr-slide">
            <div class="carousel-wrapper" id="products15">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="priceoffer">
              <p>From <span>£70</span></p>
            </div>
            <div class="tagbar">
              <div class="ratingstar"> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> </div>
              <div class="icons"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cmnt.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/view.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/share.png" alt=" " /></a> </div>
              <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
            </div>
          </div>
          <h2>Lorem Lipsum Dollor ismet </h2>
          <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
        </div>
        <div class="dr-gblock">
          <div class="dr-slide">
            <div class="carousel-wrapper" id="products16">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="priceoffer">
              <p>From <span>£70</span></p>
            </div>
            <div class="tagbar">
              <div class="ratingstar"> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> </div>
              <div class="icons"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cmnt.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/view.png" alt=" " /></a> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/share.png" alt=" " /></a> </div>
              <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
            </div>
          </div>
          <h2>Lorem Lipsum Dollor ismet </h2>
          <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
        </div>
        <div class="dr-gblock space">
          <div class="dr-slide">
            <div class="carousel-wrapper" id="products17">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="priceoffer">
              <p>From <span>£70</span></p>
            </div>
            <div class="tagbar">
              <div class="ratingstar"> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " />
			  </span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span>
			  <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> 
			  <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span>
			  <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> 
			  </div>
              <div class="icons"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cmnt.png" alt=" " /></a>
			  <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/view.png" alt=" " /></a> 
			  <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/share.png" alt=" " /></a>
			  </div>
              <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
            </div>
          </div>
          <h2>Lorem Lipsum Dollor ismet </h2>
          <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
        </div>
        <div class="dr-gblock">
          <div class="dr-slide">
            <div class="carousel-wrapper" id="products18">
              <ul class="carousel-inner clearfix">
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
                <li class="item"> <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/grid-img1.jpg"  alt=" " /> </li>
              </ul>
              <a href="#" class="carousel-left"></a> <a href="#" class="carousel-right"></a> </div>
            <div class="priceoffer">
              <p>From <span>£70</span></p>
            </div>
            <div class="tagbar">
              <div class="ratingstar"> 
			  <span>
			  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " />
			  </span> <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> 
			  <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span>
			  <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> 
			  <span><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star2.png" alt=" " /></span> 
			  </div>
              <div class="icons"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/cmnt.png" alt=" " /></a> 
			  <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/view.png" alt=" " /></a> 
			  <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/share.png" alt=" " /></a> 
			  </div>
              <div class="cust"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/client.png"  alt=" " /></div>
            </div>
          </div>
          <h2>Lorem Lipsum Dollor ismet </h2>
          <p>Apartment, Entire Place, Tel Lorem Ipsum </p>
        </div>
        <div class="btn-load"><a href="#">LOAD MORE</a></div>
      </div>
      <div class="dr-mapblk tabContents" id="tab3" style="display:none;">
        <div class="dr-leftsec">
          <div class="dr-listhead">
            <h2>1-20 of 1000+ listings</h2>
          </div>
          <div class="dr-maplist">
            <ul>
              <li>
                <div class="imgsec"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/list-img.jpg" alt=" " /></a> </div>
                <div class="abtinfo">
                  <h2>Lorem Lipsum Dollor</h2>
                  <p>Apartment, Entire Ipsum </p>
                  <p>From <span>£70</span></p>
                  <div class="star">
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /></div>
                </div>
              </li>
              <li>
                <div class="imgsec"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/list-img.jpg" alt=" " /></a> </div>
                <div class="abtinfo">
                  <h2>Lorem Lipsum Dollor</h2>
                  <p>Apartment, Entire Ipsum </p>
                  <p>From <span>£70</span></p>
                  <div class="star">
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /></div>
                </div>
              </li>
              <li>
                <div class="imgsec"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/list-img.jpg" alt=" " /></a> </div>
                <div class="abtinfo">
                  <h2>Lorem Lipsum Dollor</h2>
                  <p>Apartment, Entire Ipsum </p>
                  <p>From <span>£70</span></p>
                  <div class="star"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /></div>
                </div>
              </li>
              <li>
                <div class="imgsec"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/list-img.jpg" alt=" " /></a> </div>
                <div class="abtinfo">
                  <h2>Lorem Lipsum Dollor</h2>
                  <p>Apartment, Entire Ipsum </p>
                  <p>From <span>£70</span></p>
                  <div class="star"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /></div>
                </div>
              </li>
              <li>
                <div class="imgsec"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/list-img.jpg" alt=" " /></a> </div>
                <div class="abtinfo">
                  <h2>Lorem Lipsum Dollor</h2>
                  <p>Apartment, Entire Ipsum </p>
                  <p>From <span>£70</span></p>
                  <div class="star">
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  </div>
                </div>
              </li>
              <li>
                <div class="imgsec"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/list-img.jpg" alt=" " /></a> </div>
                <div class="abtinfo">
                  <h2>Lorem Lipsum Dollor</h2>
                  <p>Apartment, Entire Ipsum </p>
                  <p>From <span>£70</span></p>
                  <div class="star">
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
                </div>
              </li>
              <li>
                <div class="imgsec"> <a href="#"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/list-img.jpg" alt=" " /></a> </div>
                <div class="abtinfo">
                  <h2>Lorem Lipsum Dollor</h2>
                  <p>Apartment, Entire Ipsum </p>
                  <p>From <span>£70</span></p>
                  <div class="star"><img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " />
				  <img src="<?php print base_path() . drupal_get_path('theme', 'gloobers'); ?>/images/star3.png" alt=" " /></div>
                </div>
              </li>
            </ul>
          </div>
          <div class="dr-pagelist">
            <ul>
              <li><a href="#" class="prev"></a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li>. . .</li>
              <li><a href="#">15</a></li>
              <li><a href="#" class="next"></a></li>
            </ul>
          </div>
        </div>
        <div class="dr-rightsec">
          <div style="width:867px">
            <iframe width="867" height="1050" src="http://regiohelden.de/google-maps/map_en.php?width=1000&amp;height=1050&amp;hl=en&amp;q=Wilhelmstra%C3%9Fe%204A%2C%2070182%20Stuttgart+(Lorem%20Lipsum%20Dollor)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="http://www.regiohelden.de/google-maps/">Google Maps Generator</a> von <a href="http://www.regiohelden.de/">RegioHelden</a></iframe>
            <br />
          </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
var jq=jQuery.noConflict();
	jq(document).ready(function(){
		//$(".tabContents").hide(); // Hide all tab conten divs by default
		jq(".tabContents:first").css('display','block'); // Show the first div of tab content by default
		jq("#tabContaier ul li a").on( "click", customSlider );//Fire the click event
		customSlider();
	});
	
	
</script>
<script type="text/javascript">
var jq=jQuery.noConflict();
        jq(document).ready(function () {
            window.asd = jq('.SlectBox').SumoSelect({ csvDispCount: 3 });
            window.test = jq('.testsel').SumoSelect({okCancelInMulti:true });
        });
    </script>
<script>
var jq=jQuery.noConflict();
jq(function() {
jq( "#datepicker" ).datepicker();
});
jq(function() {
jq( "#datepicker2" ).datepicker();
});
</script>
<script>
var jq=jQuery.noConflict();
	jq(function() {
		jq( "#slider-range" ).slider({
			range: true,
			min: 0,
			max: 500,
			values: [ 75, 300 ],
			slide: function( event, ui ) {
				jq( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			}
		});
		jq( "#amount" ).val( "$" + jq( "#slider-range" ).slider( "values", 0 ) +
			" - $" + jq( "#slider-range" ).slider( "values", 1 ) );
	});
	</script>
<script>
/* jQuery(document).ready(function () {
    jQuery('.dr-nav').meanmenu();
}); */
</script>
  
  <script>
/*****
 * Carousel control
 */
 var jq=jQuery.noConflict();
 function customSlider(){
	 if(this == ""){
			var activeTab = jq(this).attr("data-id"); // Catch the click link
			jq("#tabContaier ul li a").removeClass("active"); // Remove pre-highlighted link
			jq(this).addClass("active"); // set clicked link to highlight state
			jq(".tabContents").hide(); // hide currently visible tab content div
			jq('#' + activeTab).fadeIn(); // show the target tab content div by matching clicked link.
	 }
  var Carousel = function (elId, mode) {
  var wrapper = document.getElementById(elId);
  var innerEl = wrapper.getElementsByClassName('carousel-inner')[0];
  var leftButton = wrapper.getElementsByClassName('carousel-left')[0];
  var rightButton = wrapper.getElementsByClassName('carousel-right')[0];
  var items = wrapper.getElementsByClassName('item');

  this.carouselSize = items.length;
  this.itemWidth = null;
  this.itemOuterWidth = null;
  this.currentStep = 0;
  this.itemsAtOnce = 3;
  this.minItemWidth = 200;
  this.position = innerEl.style;
  this.mode = mode;

  this.init = function (mode) {
    this.itemsAtOnce = mode;
    this.calcWidth(wrapper, innerEl, items);
    cb_addEventListener(leftButton, 'click', this.goLeft.bind(this));
    cb_addEventListener(rightButton, 'click', this.goRight.bind(this));
    cb_addEventListener(window, 'resize', this.calcWidth.bind(this, wrapper, innerEl, items));
  };
  return this.init(mode);
};

Carousel.prototype = {
  goLeft: function(e) {
    e.preventDefault();
    if (this.currentStep) {
      --this.currentStep;
    } else {
      this.currentStep = this.carouselSize - this.itemsAtOnce;
    }
    this.makeStep(this.currentStep);
    return false;
  },
  goRight: function(e) {
    e.preventDefault();
    if (this.currentStep < (this.carouselSize - this.itemsAtOnce)) {
      ++this.currentStep;
    } else {
      this.currentStep = 0;
    }
    this.makeStep(this.currentStep);
    return false;
  },
  makeStep: function(step) {
    this.position.left = -(this.itemOuterWidth * step) + 'px';
  },
  calcWidth: function(wrapper, innerEl, items) {
    this.beResponsive();

    var itemStyle = window.getComputedStyle(items[0]);  
    var innerElStyle = innerEl.style;
    var carouselLength = this.carouselSize;
    var wrapWidth = wrapper.offsetWidth - parseInt(itemStyle.marginRight, 10) * (this.itemsAtOnce + 1);

    innerElStyle.display = 'none';
    this.itemWidth = wrapWidth / this.itemsAtOnce;
    this.itemOuterWidth = this.itemWidth + parseInt(itemStyle.marginRight, 10);
    for (i = 0; i < carouselLength; i++) {
        items[i].style.width = this.itemWidth + 'px';
    }
    innerElStyle.width = this.itemOuterWidth * this.carouselSize + 'px';
    innerElStyle.display = 'block';
  },

  beResponsive: function() {
    var winWidth = window.innerWidth;
    if (winWidth >= 650 && winWidth < 950 && this.itemsAtOnce >= 2) {
      this.itemsAtOnce = 2;
    }
    else if (winWidth < 650) {
      this.itemsAtOnce = 1;
    }
    else {
      this.itemsAtOnce = this.mode;
    }
  }
}
/**
* Cross-browser Event Listener
**/
function cb_addEventListener(obj, evt, fnc) {
  if (obj && obj.addEventListener) {
      obj.addEventListener(evt, fnc, false);
      return true;
  } else if (obj && obj.attachEvent) {
      return obj.attachEvent('on' + evt, fnc);
  }
  return false;
}

//Initializing carousel
if (document.getElementById('products1')) {
  var productsCarousel = new Carousel('products1', 1);
}
if (document.getElementById('products2')) {
  var productsCarousel = new Carousel('products2', 1);
}
if (document.getElementById('products3')) {
  var productsCarousel = new Carousel('products3', 1);
}
if (document.getElementById('products4')) {
  var productsCarousel = new Carousel('products4', 1);
}
if (document.getElementById('products5')) {
  var productsCarousel = new Carousel('products5', 1);
}
if (document.getElementById('products6')) {
  var productsCarousel = new Carousel('products6', 1);
}
if (document.getElementById('products7')) {
  var productsCarousel = new Carousel('products7', 1);
}
if (document.getElementById('products8')) {
  var productsCarousel = new Carousel('products8', 1);
}
if (document.getElementById('products9')) {
  var productsCarousel = new Carousel('products9', 1);
}
if (document.getElementById('products10')) {
  var productsCarousel = new Carousel('products10', 1);
}
if (document.getElementById('products11')) {
  var productsCarousel = new Carousel('products11', 1);
}
if (document.getElementById('products12')) {
  var productsCarousel = new Carousel('products12', 1);
}
if (document.getElementById('products13')) {
  var productsCarousel = new Carousel('products13', 1);
}
if (document.getElementById('products14')) {
  var productsCarousel = new Carousel('products14', 1);
}
if (document.getElementById('products15')) {
  var productsCarousel = new Carousel('products15', 1);
}
if (document.getElementById('products16')) {
  var productsCarousel = new Carousel('products16', 1);
}
if (document.getElementById('products17')) {
  var productsCarousel = new Carousel('products17', 1);
}
if (document.getElementById('products18')) {
  var productsCarousel = new Carousel('products18', 1);
}

 }
</script>

  