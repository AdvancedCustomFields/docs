---
title: acf/format_value
description: Filters the field $value after being loaded by a template function such as get_field().
category: filters
---

## Description
Filters the field `$value` after being loaded by a template function such as `get_field()`.

## Changelog
- Added in version 5.0
- Previously named "acf/format_value_for_api" in version 4.0

## Parameters
```
apply_filters( 'acf/format_value', $value, $post_id, $field );
```
- `$value`		*(mixed)*		The field value.
- `$post_id`	*(int|string)*	The post ID where the value is saved.
- `$field`		*(array)*		The field array containing all settings.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/format_value` 				Applies to all fields.
- `acf/format_value/type={$type}` 	Applies to all fields of a specific type.
- `acf/format_value/name={$name}` 	Applies to all fields of a specific name.
- `acf/format_value/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to modify a field's value when loaded by a template function.

#### functions.php
```
<?php
function my_acf_format_value( $value, $post_id, $field ) {
	
	// Render shortcodes in all textarea values.
	return do_shortcode( $value );
}

// Apply to all fields.
// add_filter('acf/format_value', 'my_acf_format_value', 10, 3);

// Apply to textarea fields.
add_filter('acf/format_value/type=textarea', 'my_acf_format_value', 10, 3);

// Apply to fields named "hero_text".
// add_filter('acf/format_value/name=hero_text', 'my_acf_format_value', 10, 3);

// Apply to field with key "field_123abcf".
// add_filter('acf/format_value/key=field_123abcf', 'my_acf_format_value', 10, 3);
```
