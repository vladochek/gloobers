<?php
$link = fboauth_action_link_properties('connect');
$fbImage = '<img src="'. $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']) . '/images/fb.png">';
$fbAuthLink = l($fbImage, $link['href'], array('html' => true, 'query' => $link['query']));
//var_dump($link);die;
$form = drupal_get_form('user_login_block');
?><!--Landding page Css Here-->
<style type="text/css">
    #messages {
        position: relative;
        z-index: 9;
        float: left;
        width: 100%;
        text-align: center;
        margin: -30px 0 0
    }

    div.status {
        display: inline-block;
        margin: 0 auto
    }

</style>
<link rel="stylesheet"
      href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/stylesheet/style.css">
<link rel="stylesheet"
      href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/stylesheet/pop_up.css">
<!--Fonts Css Here-->
<link rel="stylesheet"
      href="<?php print $GLOBALS['base_url'] . '/' . drupal_get_path('theme', $GLOBALS['theme']); ?>/fonts/stylesheet.css">


<div class="bgback3">
    <div class="bgdark">
        <div class="loginsec">
            <div class="login_box">


                <h3><?php print t('Back on Gloobers?'); ?></h3>
                <p><?php print t('Log into your account'); ?> </p>
                <div class="facebook">
                    <?= $fbAuthLink ?>
                </div>
                <p><?php print t('Or log in with your Email'); ?> </p>
                <div class="alert-message alert" style="display:none;"></div>

                <?php
                print '<div class="rowlogin">';
                print drupal_render($form);

                print '</div>';

                ?>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery.noConflict();

    jQuery("#user-login-form").validate({
        rules: {
            name: {
                required: true,
                email: true
            }

        }
    });
    jQuery(document).ready(function () {
        jQuery("footer").css({display: 'none'});
    });

</script>
