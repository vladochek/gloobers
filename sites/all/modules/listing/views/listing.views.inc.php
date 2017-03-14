<?php
/**
 * Implements hook_views_data().
 */
function listing_views_data() {
    $data = array();
    $data['views']['listing_area_text_custom'] = array(
        'title' => t('Custom field'),
        'help' => t('Just a field created for development purposes.'),
        'area' => array(
            'handler' => 'listing_views_handler_area_text_custom',
        ),
    );

    return $data;
}
