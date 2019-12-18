---
title: acf_set_options_page_menu()
description: Modifies the default Options Page menu name setting
category: functions
status: draft
deprecated: true
---

## Description
[tip]
This function has been deprecated. Please use the [acf/options_page/settings](https://www.advancedcustomfields.com/resources/acf-options_page-settings/) setting instead.
[/tip]

Modifies the default Options Page menu name displayed in the admin menu item.

## Requirements
- [Options Page Add-on](https://www.advancedcustomfields.com/add-ons/options-page/) version 1.2.0 or later

## Parameters
```
acf_set_options_page_menu( $menu_name );
```
- `$menu_name` *(string)* *(Required)* The menu name for the default Options Page.
 
## Example
This example demonstrates how to change the default Options page menu name to 'Extra'.
```
if( function_exists('acf_set_options_page_menu') ) {
	acf_set_options_page_menu( __('Extra') );
}
```
