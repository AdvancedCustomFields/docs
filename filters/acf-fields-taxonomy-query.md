---
title: acf/fields/taxonomy/query
description: Filters the $args used to query terms in the Taxonomy field.
category: filters
---

## Description
Filters the query `$args` used by `WP_Term_Query` to display terms in the Taxonomy field when displayed as a Select or Multiselect dropdown.

## Changelog
- Added in version 5.0.0

## Parameters
```
apply_filters( 'acf/fields/taxonomy/query', $args, $field, $post_id );
```
- `$args`		*(array)*		The query args. See [WP_Term_Query](https://developer.wordpress.org/reference/classes/WP_Term_Query/__construct/) for available args.
- `$field`		*(array)*		The field array containing all settings.
- `$post_id`	*(int|string)*	The current post ID being edited.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/fields/taxonomy/query` 				Applies to all fields.
- `acf/fields/taxonomy/query/name={$name}` 	Applies to all fields of a specific name.
- `acf/fields/taxonomy/query/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to modify some of the Taxonomy field query args.

#### functions.php
```
<?php
add_filter('acf/fields/taxonomy/query', 'my_acf_fields_taxonomy_query', 10, 3);
function my_acf_fields_taxonomy_query( $args, $field, $post_id ) {
	
	// Show 40 terms per AJAX call.
	$args['number'] = 40;
	
	// Order by most used.
	$args['orderby'] = 'count';
    $args['order'] = 'DESC';
	
	return $args;
}
```
