---
title: acf/init
description: Fires after ACF is fully initialized.
category: actions
---

## Description
Fires after ACF is fully initialized.

This action is similar to the WordPress [init](https://developer.wordpress.org/reference/hooks/init/) action, and should be used to extend or register items such as Blocks, Forms and Options Pages.

## Changelog
- Added in version 5.2.7

## Example
#### functions.php
```
add_action('acf/init', 'my_acf_init');
function my_acf_init() {

	// Get ACF version.
	$version = acf_get_setting('version');

	// Do something.  
}
```

## Notes
### Timing
Under normal circumstances, this action will fire during the "init" action (priority of 5). However, it may alternatively be triggered earlier if a field value is loaded during the `functions.php` file.