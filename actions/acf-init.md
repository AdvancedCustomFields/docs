---
title: acf/init
description: Called after ACF is finished loading
category: actions
status: draft
---

## Description
Used to run functions after ACF has loaded and is active.

This action is called after ACF is finished loading.

It is similar to the WordPress [init](https://developer.wordpress.org/reference/hooks/init/) action.

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
