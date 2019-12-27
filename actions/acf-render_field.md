---
title: acf/render_field
description: Fires when rendering a field.
category: actions
---

## Description
Used to output additional HTML before or after a field's input.

## Changelog
- Added in version 5.0.0

## Parameters
```
do_action( 'acf/render_field', $field );
```
- `$field` *(array)* The field array containing all settings.

## Modifers
This action provides modifiers to target specific fields. The following action names are available:
- `acf/render_field` 				Applies to all fields.
- `acf/render_field/type={$type}` 	Applies to all fields of a specific type.
- `acf/render_field/name={$name}` 	Applies to all fields of a specific name.
- `acf/render_field/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to output additional HTML after a field.

#### functions.php
```
<?php
function my_acf_render_field( $field ) {
	echo '<p>Some extra HTML.</p>';
}

// Apply to all fields.
add_action('acf/render_field', 'my_acf_render_field');

// Apply to image fields.
// add_action('acf/render_field/type=image', 'my_acf_render_field');

// Apply to fields named "hero_text".
// add_action('acf/render_field/name=hero_text', 'my_acf_render_field');

// Apply to field with key "field_123abcf".
// add_action('acf/render_field/key=field_123abcf', 'my_acf_render_field');
```

## Notes

### Priority
In order to hook-in before ACF outputs any field HTML, use a priority less than 10 with either the "global" or "type" action names.
