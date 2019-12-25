---
title: acf/input/admin_enqueue_scripts
description: Fires during the "enqueue_scripts" action when editing a post.
category: actions
---

## Description
Used to enqueue scripts and styles on pages where ACF fields appear.

This action is similar to the WordPress [admin_enqueue_scripts](https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/), except that it is only fired on pages where ACF fields appear - such as when editing posts, users, taxonomy terms, options pages and front-end forms.

## Changelog
- Added in version 5.0.0

## Example
This example demonstrates how to enqueue custom styles and scripts for your fields.

#### functions.php
```
<?php
add_action( 'acf/input/admin_enqueue_scripts', 'my_acf_admin_enqueue_scripts' );
function my_acf_admin_enqueue_scripts() {
	wp_enqueue_style( 'my-acf-input-css', get_stylesheet_directory_uri() . '/css/my-acf-input.css', false, '1.0.0' );
	wp_enqueue_script( 'my-acf-input-js', get_stylesheet_directory_uri() . '/js/my-acf-input.js', false, '1.0.0' );
}
```