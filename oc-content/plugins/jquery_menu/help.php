<div id="settings_form" style="border: 1px solid #ccc; background: #eee; ">
  <div style="padding: 0 20px 20px;">
    <div>
       <fieldset>
        <legend>
          <h1><?php _e('OC JQuery Menu Help', 'JQuery Menu'); ?></h1>
        </legend>
        <h2>
          <?php _e('What is JQuery Menu Plugin?', 'JQuery Menu'); ?>
        </h2>
        <p>
          <?php _e('JQuery Menu Plugin allows you to show a JQuery Navigation Menu on any part of your site you want.', 'JQuery Menu'); ?>
        </p>
        <h2>
          <?php _e('How does JQuery Menu Plugin work?', 'JQuery Menu'); ?>
        </h2>
        <p>
          <?php _e('In order to use JQuery Menu Plugin, you should edit your theme files and add the following line anywhere in the code you want the JQuery Navigation Menu to appear.', 'JQuery Menu'); ?>
        </p>
        <pre>
          &lt;?php jquery_menu(); ?&gt;
        </pre>
        <h2>
        <?php _e('Recommened Place', 'JQuery Menu'); ?>
        </h2>
        <p>
          <?php _e('Locate these line in your main.php', 'JQuery Menu'); ?>
        </p>
        <pre>
          &lt;div class="content home"&gt;
        </pre>
        <p>
          <?php _e('Replace the above line with this', 'JQuery Menu'); ?>
        </p>
        <pre>
          &lt;?php jquery_menu(); ?&gt;
          &lt;div class="content home"&gt;
        </pre>
      </fieldset>
    </div>
  </div>
</div>
