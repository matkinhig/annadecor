<?php

//xtocky since 1.0.1

if ( ! function_exists( 'xtocky_is_dokan_activated' ) ) {
	/**
	 * Check if Dokan is activated
	 */
	function xtocky_is_dokan_activated() {
		return class_exists( 'WeDevs_Dokan' ) ? true : false;
	}
}

if ( ! function_exists( 'xtocky_is_wc_vendors_activated' ) ) {
	/**
	 * Check if WC Vendors is activated
	 */
	function xtocky_is_wc_vendors_activated() {
		return class_exists( 'WC_Vendors' ) ? true : false;
	}
}

if ( ! function_exists( 'xtocky_is_wc_marketplace_activated' ) ) {
	/**
	 * Check if WC Marketplace is activated
	 */
	function xtocky_is_wc_marketplace_activated() {
		return class_exists( 'WCMp' ) ? true : false;
	}
}

// ------------------------------------------------------------------------
// Conditional functions to check the status of various locations.
// ------------------------------------------------------------------------

if(!function_exists('xtocky_is_activated')) {
  function xtocky_is_activated() {
      // if ( xtocky_is_activated() != XTOCKY_PREFIX ) return false;
      if ( ! get_option( 'xtocky_is_activated' ) ) update_option( 'xtocky_is_activated', true );
      return get_option( 'xtocky_is_activated', false );
  }
}
// Is bbPress
//----------------

function xtocky_is_bbpress() {

  if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress
// ----------------------

function xtocky_is_buddypress() {

  if ( function_exists( 'is_buddypress' ) && is_buddypress() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress Activity Directory
// ----------------------------------------------

function xtocky_is_buddypress_activity_directory() {

  if ( function_exists( 'bp_is_activity_directory' ) && bp_is_activity_directory() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress Groups Directory
// ---------------------------------------------------

function xtocky_is_buddypress_groups_directory() {

  if ( function_exists( 'bp_is_groups_directory' ) && bp_is_groups_directory() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress Group
//----------------------------------------------------

function xtocky_is_buddypress_group() {

  if ( function_exists( 'bp_is_group' ) && bp_is_group() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress Members Directory
// --------------------------------------------------------------

function xtocky_is_buddypress_members_directory() {

  if ( function_exists( 'bp_is_members_directory' ) && bp_is_members_directory() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress User
// ------------------------------------------------------

function xtocky_is_buddypress_user() {

  if ( function_exists( 'bp_is_user' ) && bp_is_user() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress Blogs Directory
//------------------------------------------------------------

function xtocky_is_buddypress_blogs_directory() {

  if ( function_exists( 'bp_is_blogs_directory' ) && bp_is_blogs_directory() ) {
    return true;
  } else {
    return false;
  }

}

// Is BuddyPress Component
// ------------------------------------------------------------

//
// Component values.
//
// 01. members
// 02. activity
// 03. blogs
// 04. messages// 
// 05. groups
// 06. friends
// 07. forums
// 08. notifications
// 09. settings
// 10. activate
// 11. register
//

function xtocky_is_buddypress_component( $component ) {

  if ( function_exists( 'bp_is_current_component' ) && bp_is_current_component( $component ) ) {
    return true;
  } else {
    return false;
  }

}
// BuddyPress styles
// ------------------------------------------------------------
function xtocky_buddypress_styles() {
    $custom_skin_bg = xtocky_get_option_data('main_color_scheme', '#56cfe1'); 
    
    $css_buddypress = '#buddypress a.button, #buddypress input[type=button], #buddypress input[type=reset], #buddypress input[type=submit]{height: auto;line-height: inherit;}.buddypress .page-header h1{display:none}.buddypress .page-header[class*=text-]{text-align:left;padding:10px 0 9px}.buddypress .page-header .breadcrumb{padding:0}#buddypress div.item-list-tabs:not(#subnav) ul li{width:50%}@media (min-width:768px){#buddypress div.item-list-tabs:not(#subnav) ul li{width:33.3333%}}.buddypress .item-list-tabs:not(#subnav){margin:0 0 15px;border:1px solid #ddd;background-color:#fcfcfc;box-shadow:0 1px 2px rgba(0,0,0,.075),inset -1px -1px #fff}#buddypress div.item-list-tabs#subnav ul li a,#buddypress div.item-list-tabs#subnav ul li span{border-top:1px solid #ddd}#buddypress div.item-list-tabs#subnav ul li:first-child a,#buddypress div.item-list-tabs#subnav ul li:first-child span{border-left:1px solid #ddd}#buddypress div.item-list-tabs ul li a,#buddypress div.item-list-tabs ul li span{padding:10px;position:relative;border-right:1px solid #ddd;border-bottom:1px solid #ddd}#buddypress div.item-list-tabs ul li.last select{max-width:initial;width:calc(100% - 50px)}#buddypress div.item-list-tabs ul li a span{position:absolute;right:5px;width:25px;height:25px;padding:0;line-height:25px;color:#fff;z-index:5}.buddypress .item-list>li{margin:0 0 15px!important;border:1px solid #ddd;padding:15px!important;background-color:#fff;box-shadow:0 1px 2px rgba(0,0,0,.075)}#buddypress ul.item-list{border-top:none}#buddypress div#subnav.item-list-tabs{margin-bottom:25px}#buddypress .activity-list .activity-avatar{margin-top:5px}.widget.buddypress div.item-options{padding:0}#buddypress div.item-list-tabs ul li a{padding-left:20px}#buddypress div.activity-comments form .ac-textarea{border:1px solid #ccc}#buddypress div.activity-comments div.acomment-meta{font-size:85%}#buddypress div#item-header div#item-meta{font-size:90%;margin:0}#buddypress span.activity{display:inline-block;font-size:83%;margin-top:10px}#buddypress #item-header-cover-image #item-buttons{margin:0}#buddypress div.dir-search{float:none;margin:0 0 25px}#buddypress div.dir-search input[type=text],#buddypress li.groups-members-search input[type=text]{padding:1px 10px;width:calc(100% - 80px)}#buddypress input[type=submit]{vertical-align:middle}#buddypress #groups-order-select,.members #buddypress div#subnav.item-list-tabs ul li.last{display:flex;width:100%}.groups.bp-user div.item-list-tabs ul li label,.members #buddypress div.item-list-tabs ul li label{line-height:1.3}.groups.bp-user #buddypress div#subnav.item-list-tabs ul li.last{margin-top:20px}#buddypress div.pagination .pag-count{margin-left:0}#buddypress ul.item-list li div.item-title span{font-size:100%}#buddypress table.forum tr td.label,#buddypress table.messages-notices tr td.label,#buddypress table.notifications tr td.label,#buddypress table.notifications-settings tr td.label,#buddypress table.profile-fields tr td.label,#buddypress table.wp-profile-fields tr td.label{border:1px solid #eaeaea;font-weight:500}#buddypress table.forum tr td,#buddypress table.forum tr th,#buddypress table.messages-notices tr td,#buddypress table.messages-notices tr th,#buddypress table.notifications tr td,#buddypress table.notifications tr th,#buddypress table.notifications-settings tr td,#buddypress table.notifications-settings tr th,#buddypress table.profile-fields tr td,#buddypress table.profile-fields tr th,#buddypress table.profile-settings tr td,#buddypress table.wp-profile-fields tr td,#buddypress table.wp-profile-fields tr th{border:1px solid #eaeaea}#buddypress div.profile h2{margin:10px 0;font-weight:400}body.activity-permalink #buddypress ul.item-list>li.activity-item{border:1px solid #ddd}#buddypress #activity-stream{margin-top:0}#buddypress .activity-list li.mini{font-size:85%}#buddypress div.item-list-tabs ul li.groups-members-search{width:100%;margin-bottom:20px}#buddypress ul.item-list li div.action{right:15px}#buddypress ul.item-list li div.item-desc{font-size:90%}#buddypress ul.item-list h5{margin:0}#buddypress div.item-list-tabs ul li a span,#buddypress div.item-list-tabs ul li a:hover span,#buddypress div.item-list-tabs ul li.current a span,#buddypress div.item-list-tabs ul li.selected a span{background-color:' . esc_attr($custom_skin_bg) . '}';
           
    return $css_buddypress;
}