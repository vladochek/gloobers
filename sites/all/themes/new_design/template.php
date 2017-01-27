<?php
function new_design_preprocess_html(&$vars) {
// Query the view and add a class
        $vars['classes_array'][] = 'hp';
}