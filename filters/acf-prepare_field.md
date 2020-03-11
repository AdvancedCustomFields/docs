---
title: acf/prepare_field
description: Filters the $field settings in preparation for render.
category: filters
---

## Description
Used to modify the `$field` settings or to prevent the field from being rendered within a form.

This filter is similar to `acf/load_field`, only it is applied later in the lifecycle when the field is about to be rendered. By this time, the field's value has also been loaded.


## Changelog
- Added in version 5.0.0

## Parameters
```
apply_filters( 'acf/prepare_field', $field );
```
- `$field` *(array)* The field array containing all settings (including value).

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/prepare_field` 				Applies to all fields.
- `acf/prepare_field/type={$type}`	Applies to all fields of a specific type.
- `acf/prepare_field/name={$name}`	Applies to all fields of a specific name.
- `acf/prepare_field/key={$key}` 	Applies to all fields of a specific key.

## Examples

### Modifying a field
This example demonstrates how to modify a specific field's settings before it is rendered.

#### functions.php
```
<?php
function my_acf_prepare_field( $field ) {
	
	// Lock-in the value "Example".
	if( $field['value'] === 'Example' ) {
		$field['readonly'] = true;
	};
    return $field;
}

// Apply to all fields.
// add_filter('acf/prepare_field', 'my_acf_prepare_field');

// Apply to select fields.
// add_filter('acf/prepare_field/type=select', 'my_acf_prepare_field');

// Apply to fields named "example_field".
add_filter('acf/prepare_field/name=example_field', 'my_acf_prepare_field');

// Apply to field with key "field_123abcf".
// add_filter('acf/prepare_field/key=field_123abcf', 'my_acf_prepare_field');
```

### Preventing a field
This example demonstrates how to prevent a field from being rendered.

#### functions.php
```
<?php
function my_acf_prepare_field( $field ) {
	
	// Don't show this field once it contains a value.
	if( $field['value'] ) {
		return false;
	}
    return $field;
}

// Apply to fields named "example_field".
add_filter('acf/prepare_field/name=example_field', 'my_acf_prepare_field');
```


