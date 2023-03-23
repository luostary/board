<?php
/*
Plugin Name: JQuery Menu
Plugin URI: http://www.osclass.org/
Description: This Plugin Shows a JQuery Navigation Menu Where Ever You Want.
Version: 10.0
Author: RajaSekar
Author URI: http://www.osclass.org/
Short Name: JQuery Menu
*/

function jMenu_call_after_install() {
  $conn = getConnection() ;
  $path = osc_plugin_resource('jquery_menu/struct.sql') ;
  $sql  = file_get_contents($path) ;
  $conn->osc_dbImportSQL($sql) ;
  $conn = getConnection();
  $conn->autocommit(false);
  try {
    $conn->commit();
    osc_set_preference('parent-selectable', '1', 'plugin-jMenu', 'INTEGER');
    osc_set_preference('show-arrow', '1', 'plugin-jMenu', 'INTEGER');
    osc_set_preference('show-ad-count', '1', 'plugin-jMenu', 'INTEGER');
  } catch (Exception $e) {
    $conn->rollback();
    echo $e->getMessage();
  }
  $conn->autocommit(true);
}

function jMenu_call_after_uninstall() {
  $conn = getConnection() ;
  $conn->osc_dbExec('DROP TABLE %st_jMenu', DB_TABLE_PREFIX) ;
  $conn = getConnection();
  $conn->autocommit(false);
  try {
    osc_delete_preference('parent-selectable', 'plugin-jMenu');
    osc_delete_preference('show-arrow', 'plugin-jMenu');
    osc_delete_preference('show-ad-count', 'plugin-jMenu');
  }   catch (Exception $e) {
    $conn->rollback();
    echo $e->getMessage();
  }
  $conn->autocommit(true);
}
    
// HELPER
function menu_disable() {
  return(osc_get_preference('parent-selectable', 'plugin-jMenu')) ;
}

function sArrow() {
  return(osc_get_preference('show-arrow', 'plugin-jMenu')) ;
}

function sAd() {
  return(osc_get_preference('show-ad-count', 'plugin-jMenu')) ;
}

function jquery_menu_js(){
  //echo '<link href="'.osc_base_url().'oc-content/plugins/jquery_menu/jquery_menu.css" rel="stylesheet" type="text/css" />';
  //echo '<script type="text/javascript" src="'.osc_base_url().'oc-content/plugins/jquery_menu/jquery_menu.js"></script>';

  osc_register_script('jquery_menu_js', osc_base_url() . 'oc-content/plugins/jquery_menu/jquery_menu.js', 'jquery');
  osc_enqueue_script('jquery_menu_js');
  osc_enqueue_style('jquery_menu_css', osc_base_url() . 'oc-content/plugins/jquery_menu/jquery_menu.css');
}
	 
function jquery_subcat_list($categories) {
  $search_params = sofia_search_params();

  foreach($categories as $c) {
    $search_params['sCategory'] = $c['pk_i_id'];

    echo '<li>';
      echo '<a href="' . osc_search_url($search_params) . '">'. $c['s_name'] .'</a>';

      if(isset($c['categories']) && is_array($c['categories']) && !empty($c['categories'])) {
        echo '<div class="icon-add-next"></div>';
        echo '<ul class="subnav" style="display:none">';
          jquery_subcat_list($c['categories']);
        echo '</ul>';
      }
    echo '</li>';
  }     
}

function jquery_menu(){
  $zindex = 90;
  $count = 1;
  $categories = Category::newInstance()->toTree();
  $total = count($categories);
  $search_params = sofia_search_params();
  echo '<div id="search-bar">';
    echo '<ul class="topnav">';
      echo '<li class="home-but" style="z-index: 92;"><a href="'. osc_base_url() .'"></a></li>';
      foreach($categories as $c) {
        echo '<li class="but" style="z-index: ' . $zindex . ($count==$total ? '; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;' : '') . '">';
          $search_params['sCategory'] = $c['pk_i_id'];

          echo '<a href="' . osc_search_url($search_params) . '">'. $c['s_name'] .'</a>';
          if(isset($c['categories']) && is_array($c['categories']) && count($c['categories']) > 0) {
            echo '<ul class="subnav">';
              jquery_subcat_list($c['categories']); 
            echo '</ul>';
          }
        echo '</li>';
        $zindex--;
        $count++;
      }
    echo '</ul>';
  echo '</div>';
}
	
function jquery_admin_menu() {
  echo '<h3><a href="#">JQuery Menu</a></h3>
  <ul>
    <li><a href="'.osc_admin_render_plugin_url("jquery_menu/settings.php") . '">&raquo; ' . __('JQuery Menu Settings', 'JQuery_Menu') . '</a></li>
    <li><a href="'.osc_admin_render_plugin_url("jquery_menu/help.php").'?section=types">&raquo; ' . __('F.A.Q. / Help', 'JQuery_Menu') . '</a></li>
  </ul>';
}

function jquery_menu_help() {
  osc_admin_render_plugin(osc_plugin_path(dirname(__FILE__)) . '/help.php') ;
}

// This is needed in order to be able to activate the plugin
osc_register_plugin(osc_plugin_path(__FILE__), 'jMenu_call_after_install');

// This is a hack to show a Uninstall link at plugins table (you could also use some other hook to show a custom option panel)
osc_add_hook(osc_plugin_path(__FILE__) . '_uninstall', 'jMenu_call_after_uninstall');

//Header
//osc_add_hook('header', 'jquery_menu_js');

// Admin menu
osc_add_hook('admin_menu', 'jquery_admin_menu');

// This is a hack to show a Configure link at plugins table (you could also use some other hook to show a custom option panel)
osc_add_hook(osc_plugin_path(__FILE__) . '_configure', 'jquery_menu_help');
?>