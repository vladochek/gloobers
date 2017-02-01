<?php
global $base_path;
?>
<div class="content-box">
                        <h2>Reviews (<?= $reviews[0]['reviews_count'] ?>)</h2>
<div class="reviews-list">
    <?php foreach ($reviews as $review) { ?>
        <div class="review">
            <div class="img-h">
                <img src="<?= $base_path ?>sites/default/files/styles/reservation_popup_listing_img/public/pictures/
                                                        <?= $review['author_pic'] ?>"
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
                                <span class="star full"><i class="gl-ico gl-ico-star"
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
    <strong><?= count($reviews) ?></strong> from
    <strong><?= $reviews[0]['reviews_count'] ?></strong></p>
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
</div>