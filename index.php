<?php
/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * The routines here dispatch control to the appropriate handler, which then
 * prints the appropriate page.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */

/**
 * Root directory of Drupal installation.
 */

//date_default_timezone_set('America/Los_Angeles');
//date_default_timezone_get();
 
set_time_limit(0);
define('DRUPAL_ROOT', getcwd());

@require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
@drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
menu_rebuild();
drupal_theme_rebuild();
@menu_execute_active_handler();
@flush();