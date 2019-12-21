---
title: acf_set_options_page_title()
description: Modifies the default Options Page title setting.
category: functions
deprecated: true
---

## Description
[tip]
This function has been deprecated. Please use the [acf/options_page/settings](https://www.advancedcustomfields.com/resources/acf-options_page-settings/) filter instead.
[/tip]

Modifies the default Options Page title, displayed when viewing the admin page.

## Requirements
- [Options Page Add-on](https://www.advancedcustomfields.com/add-ons/options-page/) version 1.1.0 or later

## Parameters
```
acf_set_options_page_title( $title );
```
- `$title` *(string)* *(Required)* The title for the default Options Page. Defaults to 'Options'.
 
## Example
This example demonstrates how to change the default Options Page title to 'Theme Options'.
```
if( function_exists('acf_set_options_page_title') ) {
	acf_set_options_page_title( __('Theme Options') );
}
```
