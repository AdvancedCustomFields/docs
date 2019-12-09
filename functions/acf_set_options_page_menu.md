---
title: acf_set_options_page_menu()
description: Changes the name of the main options page menu item
category: functions
status: draft
---

[blockquote] This function is outdated. Please use the [acf/options_page/settings](https://www.advancedcustomfields.com/resources/acf-options_page-settings/) instead.
[/blockquote]

## Description
This function is used in combination with the [Options Page Add-on](https://www.advancedcustomfields.com/add-ons/options-page/) to change the name of the main options page menu item. This function is to be used inside your functions.php file and must be run before the ‘init’ action.

Warning: During the updating process, this function will not be available to your functions.php file. To ensure your website does not break, you MUST wrap the function in an if function_exists statement. Please see below for code examples.

## Requirements
- [Options Page Add-on](https://www.advancedcustomfields.com/add-ons/options-page/) version 1.2.0 or later

## Parameters
```
<?php acf_set_options_page_menu( $menu_name ); ?>
```

### $menu_name
*(String)* (Required) The name for the parent Options Page menu item.
 
## Examples

### Basic usage
This example demonstrates how to change the Options page menu to 'Extra'.

```
if( function_exists('acf_set_options_page_menu') ) {
	acf_set_options_page_menu( __('Extra') );
}
```
