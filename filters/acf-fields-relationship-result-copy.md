---
title: acf/fields/relationship/result
description: Filters the text displayed for each post in the Relationship field.
category: filters
---

## Description
Filters the text displayed for each post in the Relationship field.

## Changelog
- Added in version 4.1.2

## Parameters
```
apply_filters( 'acf/fields/relationship/result', $text, $post, $field, $post_id );
```
- `$text`		*(string)*		The text displayed for this post (the post title).
- `$post`		*(WP_Post)*		The Relationship.
- `$field`		*(array)*		The field array containing all settings.
- `$post_id`	*(int|string)*	The current post ID being edited.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/fields/relationship/result` 				Applies to all fields.
- `acf/fields/relationship/result/name={$name}` 	Applies to all fields of a specific name.
- `acf/fields/relationship/result/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to append a custom field value from each post to the text displayed.

#### functions.php
```
<?php
add_filter('acf/fields/relationship/result', 'my_acf_fields_relationship_result', 10, 4);
function my_acf_fields_relationship_result( $text, $post, $field, $post_id ) {
	$page_views = get_field( 'page_views', $post->ID );
	if( $page_views ) {
        $text .= ' ' . sprintf( '(%s views)', $page_views );
    }
    return $text;
}
```
