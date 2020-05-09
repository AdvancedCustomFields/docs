---
title: acf/fields/post_object/result
description: Filters the text displayed for each post in the Post Object field.
category: filters
---

## Description
Filters the text displayed for each post in the Post Object field.

## Changelog
- Added in version 4.1.2

## Parameters
```
apply_filters( 'acf/fields/post_object/result', $text, $post, $field, $post_id );
```
- `$text`		*(string)*		The text displayed for this post (the post title).
- `$post`		*(WP_Post)*		The post object.
- `$field`		*(array)*		The field array containing all settings.
- `$post_id`	*(int|string)*	The current post ID being edited.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/fields/post_object/result` 				Applies to all fields.
- `acf/fields/post_object/result/name={$name}` 	Applies to all fields of a specific name.
- `acf/fields/post_object/result/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to append the post type to each result.

#### functions.php
```
<?php
add_filter('acf/fields/post_object/result', 'my_acf_fields_post_object_result', 10, 4);
function my_acf_fields_post_object_result( $text, $post, $field, $post_id ) {
	$text .= ' (' . $post->post_type .  ')';
    return $text;
}
```
