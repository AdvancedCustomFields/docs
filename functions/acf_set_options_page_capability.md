---
title: acf_set_options_page_capability()
description: Modifies the default Options Page capability setting
category: functions
status: draft
deprecated: true
---

## Description
[tip]
This function has been deprecated. Please use the [acf/options_page/settings](https://www.advancedcustomfields.com/resources/acf-options_page-settings/) setting instead.
[/tip]

Modifies the default Options Page capability setting.

The term ‘capability’ refers to the user roles and permissions that grant access to the options page. You can learn more about [capability settings here](http://codex.wordpress.org/Roles_and_Capabilities).

## Requirements
- [Options Page Add-on](https://www.advancedcustomfields.com/add-ons/options-page/) version 1.1.0 or later.

## Parameters
```
acf_set_options_page_capability( $capability );
```
- `$capability` *(string)* *(Required)* The name for the parent Options Page menu capability. Defaults to `edit_posts`.

## Example
This example demonstrates how to change the default Options page capability to 'manage_options'.

#### functions.php
```
if( function_exists('acf_set_options_page_capability') ) {
	acf_set_options_page_capability('manage_options');
}
```
