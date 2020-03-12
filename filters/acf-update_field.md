---
title: acf/update_field
description: Filters the $field settings before being saved.
category: filters
---

## Description
Used to modify the `$field` settings array before being saved into the database.

This filter should not be confused with `acf/update_value` which is used similarly to modify field values.

## Changelog
- Added in version 5.0.0

## Parameters
```
apply_filters( 'acf/update_field', $field );
```
- `$field`		*(array)*		The field array containing all settings.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/update_field` 				Applies to all fields.
- `acf/update_field/type={$type}` 	Applies to all fields of a specific type.
- `acf/update_field/name={$name}` 	Applies to all fields of a specific name.
- `acf/update_field/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to modify a field's settings.

#### functions.php
```
<?php
function my_acf_update_field( $field ) {
	
	// Ensure all "company" fields are required.
	if( strpos($field['name'], 'company') !== false ) {
		$field['required'] = true;
	}
	return $field;
}

// Apply to all fields.
add_filter('acf/update_field', 'my_acf_update_field', 10, 1);

// Apply to textarea fields.
// add_filter('acf/update_field/type=textarea', 'my_acf_update_field', 10, 1);

// Apply to fields named "hero_text".
// add_filter('acf/update_field/name=hero_text', 'my_acf_update_field', 10, 1);

// Apply to field with key "field_123abcf".
// add_filter('acf/update_field/key=field_123abcf', 'my_acf_update_field', 10, 1);
```
