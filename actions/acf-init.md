---
title: acf/init
description: Called after ACF is finished loading
category: actions
status: draft
---

## Description
This action is called after ACF is finished loading and is similar to the WordPress `init` action.

## Changelog
- Added in version 5.2.7

## Example
#### functions.php
```
function my_acf_init() {

	// Get ACF version
	$version = acf_get_setting('version');

	// Do something...   
}

add_action('acf/init', 'my_acf_init');
```
