---
title: acf/load_value
description: Filters the field $value after being loaded.
category: filters
---

## Description
Filters the field `$value` after being loaded.

## Changelog
- Added in version 4.0.0

## Parameters
```
apply_filters( 'acf/load_value', $value, $post_id, $field );
```
- `$value`		*(mixed)*		The field value.
- `$post_id`	*(int|string)*	The post ID where the value is saved.
- `$field`		*(array)*		The field array containing all settings.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/load_value` 				Applies to all fields.
- `acf/load_value/type={$type}` Applies to all fields of a specific type.
- `acf/load_value/name={$name}` Applies to all fields of a specific name.
- `acf/load_value/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to modify a field's value.

#### functions.php
```
<?php
function my_acf_load_value( $value, $post_id, $field ) {
	if( is_string($value) ) {
		$value = str_replace( 'Old Company Name', 'New Company Name',  $value );
	}
	return $value;
}

// Apply to all fields.
add_filter('acf/load_value', 'my_acf_load_value', 10, 3);

// Apply to textarea fields.
// add_filter('acf/load_value/type=textarea', 'my_acf_load_value', 10, 3);

// Apply to fields named "hero_text".
// add_filter('acf/load_value/name=hero_text', 'my_acf_load_value', 10, 3);

// Apply to field with key "field_123abcf".
// add_filter('acf/load_value/key=field_123abcf', 'my_acf_load_value', 10, 3);
```
