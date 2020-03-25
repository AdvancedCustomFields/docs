---
title: acf/fields/post_object/query
description: Filters the $args used to query posts in the Post Object field.
category: filters
---

## Description
Filters the query `$args` used by `WP_Query` to query posts in the Post Object field.

## Changelog
- Added in version 4.1.2

## Parameters
```
apply_filters( 'acf/fields/post_object/query', $args, $field, $post_id );
```
- `$args`		*(array)*		The query args. See [WP_Query](https://developer.wordpress.org/reference/classes/wp_query/) for available args.
- `$field`		*(array)*		The field array containing all settings.
- `$post_id`	*(int|string)*	The current post ID being edited.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/fields/post_object/query` 				Applies to all fields.
- `acf/fields/post_object/query/name={$name}` 	Applies to all fields of a specific name.
- `acf/fields/post_object/query/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to modify the Post Object query args.

#### functions.php
```
<?php
add_filter('acf/fields/post_object/query', 'my_acf_fields_post_object_query', 10, 3);
function my_acf_fields_post_object_query( $args, $field, $post_id ) {
	
	// Show 40 posts per AJAX call.
	$args['posts_per_page'] = 40;
	
	// Restrict results to children of the current post only.
	$args['post_parent'] = $post_id;
	
	return $args;
}
```
