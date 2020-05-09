---
title: acf/fields/taxonomy/wp_list_categories
description: Filters the $args used to query terms in the Taxonomy field (list).
category: filters
---

## Description
Filters the query `$args` used by `WP_Term_Query` to display terms in the Taxonomy field when displayed as a Radio or Checkbox list.

## Changelog
- Added in version 4.0.0

## Parameters
```
apply_filters( 'acf/fields/taxonomy/wp_list_categories', $args, $field );
```
- `$args`		*(array)*		The query args. See [wp_list_categories()](https://developer.wordpress.org/reference/functions/wp_list_categories/) for available args.
- `$field`		*(array)*		The field array containing all settings.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/fields/taxonomy/wp_list_categories` 				Applies to all fields.
- `acf/fields/taxonomy/wp_list_categories/name={$name}` 	Applies to all fields of a specific name.
- `acf/fields/taxonomy/wp_list_categories/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to modify some of the Taxonomy field wp_list_categories args.

#### functions.php
```
<?php
add_filter('acf/fields/taxonomy/wp_list_categories', 'my_acf_fields_taxonomy_query', 10, 2);
function my_acf_fields_taxonomy_query( $args, $field ) {

	// Order by most used.
	$args['orderby'] = 'count';
    $args['order'] = 'DESC';
	
	return $args;
}
```
