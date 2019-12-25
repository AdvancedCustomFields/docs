---
title: acf/render_field
description: Called when rendering a field input.
category: actions
status: draft
---

## Description
Used to render HTML before or after the field type’s input.

This action is called to render a field input. When creating a [custom field type](https://www.advancedcustomfields.com/resources/tutorials/creating-a-new-field-type/), this action runs the `render_field` function within the field type class.

## Changelog
- Added in version 5.0.0
- Prior to version 5.0.0, this action was known as `create_field`

## Examples
This action is called twice: globally (for all field types) and once for the specific field type.

The action is passed 1 parameter:
- `$field` *(array)* The field settings including name, label, etc.

_Note:_ In the below code, 'action_function_name' needs to be a unique function name each time it is utilized.

### Global
Each time a field input is rendered, the filter `acf/render_field` is called.
```
function action_function_name( $field ) {

	echo '<p>Some extra HTML</p>';

}
add_action( 'acf/render_field', 'action_function_name', 10, 1 );
```

### Specific
Each time a field input is rendered, the filter `acf/render_field/type=$field_type` is called. This example demonstrates how to add extra HTML to the image field.
```
function action_function_name( $field ) {

	echo '<p>Some extra HTML for the image field</p>';

}
add_action( 'acf/render_field/type=image', 'action_function_name', 10, 1 );
```

## Notes
- To render HTML before ACF does, use a priority of less than 10.
- To render HTML after ACF does, use a priority of 10 or higher.
