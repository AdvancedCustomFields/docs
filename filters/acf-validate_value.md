---
title: acf/validate_value
description: Used to perform validation on the field's $value before being saved.
category: filters
---

## Description
Used to perform custom validation on the field's `$value` before it is saved into the database.

## Changelog
- Added in version 5.0.0

## Parameters
```
apply_filters( 'acf/validate_value', $valid, $value, $field, $input_name );
```
- `$valid`		*(mixed)*		Whether or not the value is valid (boolean) or a custom error message (string).
- `$value`		*(mixed)*		The field value.
- `$field`		*(array)*		The field array containing all settings.
- `$input_name`	*(string)*		The field DOM element name attribute.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/validate_value` 					Applies to all fields.
- `acf/validate_value/type={$type}` 	Applies to all fields of a specific type.
- `acf/validate_value/name={$name}` 	Applies to all fields of a specific name.
- `acf/validate_value/key={$key}` 		Applies to all fields of a specific key.

## Example
This example demonstrates how to validate a field's value and return a custom error message.

#### functions.php
```
<?php
function my_acf_validate_value( $valid, $value, $field, $input_name ) {
	
	// Bail early if value is already invalid.
	if( $valid !== true ) {
		return $valid;
	}
	
	// Prevent value from saving if it contains the companies old name.
	if( is_string($value) && strpos($value, 'Old Company Name') !== false ) {
		return __( 'Please remove mention of "Old Company Name".' );
	}
	return $valid;
}

// Apply to all fields.
add_filter('acf/validate_value', 'my_acf_validate_value', 10, 4);

// Apply to textarea fields.
// add_filter('acf/validate_value/type=textarea', 'my_acf_validate_value', 10, 4);

// Apply to fields named "hero_text".
// add_filter('acf/validate_value/name=hero_text', 'my_acf_validate_value', 10, 4);

// Apply to field with key "field_123abcf".
// add_filter('acf/validate_value/key=field_123abcf', 'my_acf_validate_value', 10, 4);
```
