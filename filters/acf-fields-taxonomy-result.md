---
title: acf/fields/taxonomy/result
description: Filters the text displayed for each term in the Taxonomy field.
category: filters
---

## Description
Filters the text displayed for each term in the Taxonomy field when displayed as a Select or Multiselect dropdown.

## Changelog
- Added in version 5.0.0

## Parameters
```
apply_filters( 'acf/fields/taxonomy/result', $text, $term, $field, $post_id );
```
- `$text`		*(string)*		The text displayed for this term (the term name).
- `$term`		*(WP_Term)*		The term object.
- `$field`		*(array)*		The field array containing all settings.
- `$post_id`	*(int|string)*	The current post ID being edited.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/fields/taxonomy/result` 				Applies to all fields.
- `acf/fields/taxonomy/result/name={$name}` Applies to all fields of a specific name.
- `acf/fields/taxonomy/result/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to append the term slug to each result.

#### functions.php
```
<?php
add_filter('acf/fields/taxonomy/result', 'my_acf_fields_taxonomy_result', 10, 4);
function my_acf_fields_taxonomy_result( $text, $term, $field, $post_id ) {
	$text .= ' (' . $term->slug .  ')';
    return $text;
}
```
