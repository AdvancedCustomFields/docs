---
title: acf_add_options_sub_page()
description: Add a global options sub page to the WordPress dashboard.
category: functions
---

## Description
Adds a new options sub page to the admin menu.

Options pages are used to store global settings. These settings are not tied to a specific post, but are instead stored in the `wp_options` table.

Once registered, your page will appear in the admin menu. You can then assign fields to your page via the "Options Page" location rule when editing a field group.

This function is essentially a wrapper for [acf_add_options_page()](https://www.advancedcustomfields.com/resources/acf_add_options_page/) providing a default value for the *parent_slug* attribute of "acf-options".

## Parameters
```
acf_add_options_sub_page( [$settings] );
```

### $settings
*(array)* *(Optional)* Array of arguments for registering an options page. [See list of available parameters](https://www.advancedcustomfields.com/resources/acf_add_options_page/)

## Examples

### Default options sub page
This example shows how to create a default options sub page.

#### functions.php
```
if( function_exists('acf_add_options_sub_page') ) {
	acf_add_options_sub_page();
}
```

### Customized options sub page
This example shows how to create a customized options sub page and store the data in a variable for later use.

#### functions.php
```
add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {
	
	// Check function exists.
	if( function_exists('acf_add_options_sub_page') ) {
		
		// Add parent.
		$parent = acf_add_options_page(array(
			'page_title'  => __('Theme General Settings'),
			'menu_title'  => __('Theme Settings'),
			'redirect'    => false,
		));
		
		// Add sub page.
		$child = acf_add_options_sub_page(array(
			'page_title'  => __('Social Settings'),
			'menu_title'  => __('Social'),
			'parent_slug' => $parent['menu_slug'],
		));
	}
}
```

## Notes

### Priority
This function must be used before the action `admin_menu` (priority 99) as this is when admin pages are registered in WordPress core. We advise using the "acf/init" action.
