---
title: acf/load_field
description: Filters the $field settings after being loaded.
category: filters
---

## Description
Filters the `$field` settings array after being loaded.

A field is loaded anytime it is displayed, or its value is loaded. This filter applies to both fields saved in the database and also those registered locally via PHP or [JSON](https://www.advancedcustomfields.com/resources/local-json/).

## Changelog
- Added in version 4.0.0

## Parameters
```
apply_filters( 'acf/load_field', $field );
```
- `$field` *(array)* The field array containing all settings.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/load_field` 				Applies to all fields.
- `acf/load_field/type={$type}` Applies to all fields of a specific type.
- `acf/load_field/name={$name}` Applies to all fields of a specific name.
- `acf/load_field/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to modify a specific field's settings.

#### functions.php
```
<?php
function my_acf_load_field( $field ) {
	$field['required'] = true;
	$field['choices'] = array(
        'custom'	=> 'My Custom Choice',
        'custom_2'	=> 'My Custom Choice 2'
    );
    return $field;
}

// Apply to all fields.
// add_filter('acf/load_field', 'my_acf_load_field');

// Apply to select fields.
// add_filter('acf/load_field/type=select', 'my_acf_load_field');

// Apply to fields named "custom_select".
add_filter('acf/load_field/name=custom_select', 'my_acf_load_field');

// Apply to field with key "field_123abcf".
// add_filter('acf/load_field/key=field_123abcf', 'my_acf_load_field');
```
