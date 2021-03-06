<?php
/*
 * Note that we're using custom page handlers instead of the admin views
 * as there are problems with the friendspicker/userpicker inputs in admin
 * theme.
 */

// include our procedural functions
require_once 'lib/functions.php';
require_once 'lib/hooks.php';
require_once 'lib/batches.php';

// plugin init
function au_analytics_init(){
  
  // extend our views
	elgg_extend_view('css/admin', 'au_analytics/css');
  elgg_register_ajax_view('au_analytics/results/pageview');
  elgg_register_ajax_view('au_analytics/results/timeline');
  
  // register page-specific css
	elgg_register_css('au_analytics/jqplot', elgg_get_site_url() . 'mod/au_analytics/js/jqplot/jquery.jqplot.min.css');
  elgg_register_css('au_analytics/tablesorter', elgg_get_site_url() . 'mod/au_analytics/js/tablesorter/style.css');
	
	
	// Register our javascript
  
  //jqplot
	elgg_register_js('au_analytics/jqplot/canvas', elgg_get_site_url() . 'mod/au_analytics/js/jqplot/excanvas.min.js', 'head');
	elgg_register_js('au_analytics/jqplot', elgg_get_site_url() . 'mod/au_analytics/js/jqplot/jquery.jqplot.min.js', 'head');
	elgg_register_js('au_analytics/jqplot/highlighter', elgg_get_site_url() . 'mod/au_analytics/js/jqplot/plugins/jqplot.highlighter.min.js', 'head');
	elgg_register_js('au_analytics/jqplot/cursor', elgg_get_site_url() . 'mod/au_analytics/js/jqplot/plugins/jqplot.cursor.min.js', 'head');
	elgg_register_js('au_analytics/jqplot/dateaxis', elgg_get_site_url() . 'mod/au_analytics/js/jqplot/plugins/jqplot.dateAxisRenderer.min.js', 'head');
	elgg_register_js('au_analytics/jqplot/barRender', elgg_get_site_url() . 'mod/au_analytics/js/jqplot/plugins/jqplot.barRenderer.min.js', 'head');
	elgg_register_js('au_analytics/jqplot/categoryAxis', elgg_get_site_url() . 'mod/au_analytics/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js', 'head');
	elgg_register_js('au_analytics/jqplot/pointLabels', elgg_get_site_url() . 'mod/au_analytics/js/jqplot/plugins/jqplot.pointLabels.min.js', 'head');
	elgg_register_js('au_analytics/jqplot/canvasAxisLabel', elgg_get_site_url() . 'mod/au_analytics/js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js', 'head');
	elgg_register_js('au_analytics/jqplot/canvasText', elgg_get_site_url() . 'mod/au_analytics/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js', 'head');
  elgg_register_js('au_analytics/tablesorter', elgg_get_site_url() . 'mod/au_analytics/js/tablesorter/jquery.tablesorter.min.js', 'head');
  
  // tablesorter
  elgg_register_js('au_analytics/tablesorter/pager', elgg_get_site_url() . 'mod/au_analytics/js/tablesorter/jquery.tablesorter.pager.js', 'head');
  
  // pageview
  elgg_register_js('au_analytics/pageview', elgg_get_site_url() . 'mod/au_analytics/js/pageview.js', 'head');
  
  // timeline
  elgg_register_js('au_analytics/timeline', elgg_get_site_url() . 'mod/au_analytics/js/timeline.js', 'head');
  
  // navigation
  elgg_register_admin_menu_item('administer', 'au_pageview', 'statistics', 0);
  elgg_register_admin_menu_item('administer', 'au_timeline', 'statistics', 0);
  
  
  /*
   *  plugin hooks
   */
  // log page views
  elgg_register_plugin_hook_handler('output:before', 'page', 'au_analytics_pageview');
}

elgg_register_event_handler('init', 'system', 'au_analytics_init');
