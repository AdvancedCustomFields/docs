---
title: acf/field_group/admin_enqueue_scripts
description: Fires during the "enqueue_scripts" action when editing a field group.
category: actions
---

## Description
Used to enqueue scripts and styles on the field group admin edit page.

This action is similar to the WordPress [admin_enqueue_scripts](https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/), except that it is only fired on the field group admin edit page.

## Changelog
- Added in version 5.0.0

## Example
This example demonstrates how to enqueue custom styles and scripts to customize field group settings.

#### functions.php
```
<?php
add_action('acf/field_group/admin_enqueue_scripts', 'my_acf_field_group_admin_enqueue_scripts');
function my_acf_field_group_admin_enqueue_scripts() {
	wp_enqueue_style( 'my-acf-field-group-css', get_stylesheet_directory_uri() . '/css/my-acf-field-group.css', false, '1.0.0' );
	wp_enqueue_script( 'my-acf-field-group-js', get_stylesheet_directory_uri() . '/js/my-acf-field-group.js', false, '1.0.0' );
}
```