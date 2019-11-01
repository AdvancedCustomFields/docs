---
title: acf_add_options_sub_page()
description: Add a global options sub page to the WordPress dashboard.
category: functions
status: draft
---

## Description
This function will add a new options sub page to the wp-admin sidebar.

All data saved on an options page is global. This means it is not attached to a particular post or page, but is saved in the `wp_options` table.

## Parameters
```
<?php acf_add_options_sub_page( $page ); ?>
```

### $page
*(mixed)* *(Optional)* A string for the page title, or an array of settings. If left blank, default settings will be used.

The parameters of `acf_add_options_sub_page()` are similar to those of [acf_add_options_page()](https://www.advancedcustomfields.com/resources/acf_add_options_page/) but with 1 difference; The ‘parent_slug’ setting cannot be blank.

By default, the _parent_slug_ setting is set to ‘acf-options’ (the default options page). If desired, this can be changed to any other admin page.

[See list of available parameters](https://www.advancedcustomfields.com/resources/acf_add_options_page/)

## Return
*(array)* The validated and final page settings. This is useful to find the page's menu_slug and use it later when adding child options pages. 

## Examples

### Default options sub page
This example shows how to create an options sub page called 'Social'. The following code is placed in the `functions.php` file.

By calling this function without a custom ‘parent_slug’, the default will be used. Furthermore, if the default options page does not yet exist, it will be added.

#### functions.php
```
if( function_exists('acf_add_options_sub_page') ) {
  acf_add_options_sub_page('Social');
}
```

### Customized options sub page
This example demonstrates how to create a customized options sub page and store the data in a variable for later use.

#### functions.php
```
if( function_exists('acf_add_options_page') ) {
  
  // Add parent
  $parent = acf_add_options_page(array(
    'page_title'  => 'Theme General Settings',
    'menu_title'  => 'Theme Settings',
    'redirect'    => false,
  ));
  
  // Add sub page
  acf_add_options_sub_page(array(
    'page_title'  => 'Social Settings',
    'menu_title'  => 'Social',
    'parent_slug' => $parent['menu_slug'],
  ));
  
}
```

## Notes

### Priority
This function must be used before the action `admin_menu` (priority 99) as this is when admin pages are registered in WordPress core.

### Requirements
This function requires at least ACF PRO version 5.0.0. or the [Options Page Add-on](https://www.advancedcustomfields.com/add-ons/options-page/).
