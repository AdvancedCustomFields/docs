---
title: acf/save_post
description: Fires when saving $_POST data.
category: actions
---

## Description
Fires when saving the submitted `$_POST` data.

This action allows you to hook in before or after the `$_POST` data has been saved, making it useful to perform additional functionality when updating a post or other WP object.

## Parameters
```
do_action( 'acf/save_post', $post_id );
```
- `$post_id` *(int|string)* The ID of the post being edited.

## Changelog
- Changed namespace from `$_POST['fields']` to `$_POST['acf']` in version 5.0.0
- Added in version 4.0.0

## Examples

### Applied after save
This example demonstrates how to perform additional functionality after ACF has saved the `$_POST` data.

#### functions.php
```
add_action('acf/save_post', 'my_acf_save_post');
function my_acf_save_post( $post_id ) {
	
	// Get newly saved values.
	$values = get_fields( $post_id );
	
	// Check the new value of a specific field.
	$hero_image = get_field('hero_image', $post_id);
	if( $hero_image ) {
		// Do something...
	}
}
```

### Applied before save
This example demonstrates how to perform additional functionality before ACF has saved the `$_POST` data by using a priority less than 10.

#### functions.php
```
add_action('acf/save_post', 'my_acf_save_post', 5);
function my_acf_save_post( $post_id ) {
	
	// Get previous values.
	$prev_values = get_fields( $post_id );
	
	// Get submitted values.
	$values = $_POST['acf'];
	
	// Check if a specific value was updated.
	if( isset($_POST['acf']['field_abc123']) ) {
		// Do something.
	}
}
```

## Notes

### Parameters
Unlike the WordPress [save_post](https://codex.wordpress.org/Plugin_API/Action_Reference/save_post) action, this action does not contain the `$post` and `$updated` parameters. If you require access to these parameters, consider using an alternative action instead.
