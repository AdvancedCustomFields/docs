---
title: acf_set_options_page_menu()
description: Modifies the name of options page
category: functions
status: draft
deprecated: true
---

## Description
[tip]
This function has been deprecated. Please use the [acf/options_page/settings](https://www.advancedcustomfields.com/resources/acf-options_page-settings/) setting instead.
[/tip]

This function is used in combination with the [Options Page Add-on](https://www.advancedcustomfields.com/add-ons/options-page/) to change the name of the main options page menu item in the dashboard. This function is to be used inside your functions.php file and must be run before the ‘init’ action.

_Warning:_ During the updating process, this function will not be available to your functions.php file. To ensure your website does not break, you MUST wrap the function in an if function_exists statement. Please see below for a code example.

## Requirements
- [Options Page Add-on](https://www.advancedcustomfields.com/add-ons/options-page/) version 1.2.0 or later

## Parameters
```
acf_set_options_page_menu( $menu_name );
```
- `$menu_name` *(string)* *(Required)* The name for the parent Options Page menu item
 
## Example
This example demonstrates how to change the Options page menu name to 'Extra'.
```
if( function_exists('acf_set_options_page_menu') ) {
	acf_set_options_page_menu( __('Extra') );
}
```
