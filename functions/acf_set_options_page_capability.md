---
title: acf_set_options_page_capability()
description: Changes capability of the main options page title
category: functions
status: draft
---

## Description
This function is used in combination with the [Options Page Add-on](https://www.advancedcustomfields.com/add-ons/options-page/) to change the capability of the main options page title. This function is to be used inside your functions.php file and must be run before the 'init' action.

The term ‘capability’ refers to the user roles and permissions that grant access to the options page. [You can learn more about capability settings here](http://codex.wordpress.org/Roles_and_Capabilities).

## Requirements
- [Options Page Add-on](https://www.advancedcustomfields.com/add-ons/options-page/) version 1.1.0 or later

## Parameters
```
<?php acf_set_options_page_capability( $capability ); ?>
```

### $capability
*(String)* (Required) The name for the parent Options Page menu capability. Defaults to `edit_posts`.
 
## Examples

### Basic usage
This example demonstrates how to change the Options page capability to 'manage_options'.

#### functions.php
```
if( function_exists('acf_set_options_page_capability') ) {
	acf_set_options_page_capability('manage_options');
}
```
