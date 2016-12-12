<?php global $base_url;
drupal_add_css(drupal_get_path('theme', $GLOBALS['theme']) . '/css/gloobers.css', 'file');
?>
<section class="bgback1">
  <div class="dr-wrapper">
      <section class="bs_faq_page">
          <div class="<?php print $classes; ?>">
  <?php 
  print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php if ($header): ?>
    <div class="view-header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>

  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>

  <?php 
  //echo "<pre>";Print_r($rows);exit;
  if ($rows): ?>
    <div class="view-content">
      <?php print $rows; ?>
    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>

  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
      <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div>
      </section> 
  </div>
</section>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery(".node-faq > h2 > a").attr('href','');
jQuery(".node-faq > h2 > a").attr('href','javascript:void(0);');
jQuery(".node-faq > .content").hide();
	jQuery('.node-faq h2').click(function(){
	jQuery(".node-faq > .content").hide();
	jQuery(this).parent().find('.content').slideToggle();
	});
});
</script>