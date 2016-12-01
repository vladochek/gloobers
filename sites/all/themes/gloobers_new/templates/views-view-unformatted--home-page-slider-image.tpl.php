<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<div class="carousel-inner">
<?php 
	$i = 1; 
	foreach ($rows as $id => $row): ?>
  <div class="item <?php echo ($i==1)?'active':''; ?>">
    <?php print $row; ?>
  </div>
<?php $i++;  endforeach; ?>
 </div>