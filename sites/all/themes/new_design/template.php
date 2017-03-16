<?php
function new_design_preprocess_html(&$vars) {
// Query the view and add a class
    if(drupal_is_front_page()) {
        $vars['classes_array'][] = 'hp';
    }
    if(current_path()=='professional'){

        $vars['classes_array'][] = 'prof-page';
    }
}
