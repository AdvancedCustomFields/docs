---
title: acf/update_value
description: Filters the field $value before being saved.
category: filters
---

## Description
Used to modify the field's `$value` before it is saved into the database.

## Changelog
- Added `$original` parameter in 5.8.0
- Added in version 4.0.0

## Parameters
```
apply_filters( 'acf/update_value', $value, $post_id, $field, $original );
```
- `$value`		*(mixed)*		The field value.
- `$post_id`	*(int|string)*	The post ID where the value is saved.
- `$field`		*(array)*		The field array containing all settings.
- `$original`	*(mixed)*		The original value before modification.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/update_value` 				Applies to all fields.
- `acf/update_value/type={$type}` 	Applies to all fields of a specific type.
- `acf/update_value/name={$name}` 	Applies to all fields of a specific name.
- `acf/update_value/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to modify a field's value.

#### functions.php
```
<?php
function my_acf_update_value( $value, $post_id, $field, $original ) {
	if( is_string($value) ) {
		$value = str_replace( 'Old Company Name', 'New Company Name',  $value );
	}
	return $value;
}

// Apply to all fields.
add_filter('acf/update_value', 'my_acf_update_value', 10, 4);

// Apply to textarea fields.
// add_filter('acf/update_value/type=textarea', 'my_acf_update_value', 10, 4);

// Apply to fields named "hero_text".
// add_filter('acf/update_value/name=hero_text', 'my_acf_update_value', 10, 4);

// Apply to field with key "field_123abcf".
// add_filter('acf/update_value/key=field_123abcf', 'my_acf_update_value', 10, 4);
```
