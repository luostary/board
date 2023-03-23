<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
  <head>
    <?php osc_current_web_theme_path('head.php'); ?>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
  </head>
  
  <body>
    <?php osc_current_web_theme_path('header.php'); ?>
    <div class="content user_forms">
      <div class="inner">
        <h1><i class="fa fa-refresh"></i>&nbsp;<?php _e('Recover your password', 'sofia'); ?></h1>
        <form action="<?php echo osc_base_url(true); ?>" method="post" id="forgot-pass" >
          <input type="hidden" name="page" value="login" />
          <input type="hidden" name="action" value="recover_post" />
          <fieldset>
            <label for="email"><?php _e('E-mail', 'sofia'); ?></label> <?php UserForm::email_text(); ?><br />
            <?php osc_show_recaptcha('recover_password'); ?>
            <button type="submit"><?php _e('Send me a new password', 'sofia'); ?></button>
          </fieldset>
        </form>
      </div>
      <div class="right">
       <h2><?php _e('If you lost password', 'sofia'); ?></h2>
       <div class="delim"></div>
       <div class="text"><i class="fa fa-chevron-right"></i>&nbsp;<?php _e('You will recieve new password in few minutes', 'sofia'); ?></div>
       <div class="text"><i class="fa fa-chevron-right"></i>&nbsp;<?php _e('You do not have to create new account', 'sofia'); ?></div>       
      </div>
    </div>
    <?php osc_current_web_theme_path('footer.php'); ?>
  </body>
</html>