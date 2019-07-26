---
title: get_field_object()
description: Returns the settings of a specific field.
category: functions
group: Basic
---

## Description
Returns the settings of a specific field.

Each field contains many settings such as a label, name and type. This function can be used to load these settings as an array along with the field's value.

## Parameters
```
get_field_object($selector, [$post_id = false], [$format_value = true], [$load_value = true]);
```
- `$selector`		*(string)*	*(Required)*	The field name or field key.
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.
- `$format_value`	*(bool)*	*(Optional)*	Whether to apply formatting logic. Defaults to true.
- `$load_value`		*(bool)*	*(Optional)*	Whether to load the field’s value. Defaults to true.

## Return

This function will return an array looking something like the following. Please note that each field contains unique settings.
```
array(
	'ID'				=> 0,
	'key'				=> '',
	'label'				=> '',
	'name'				=> '',
	'prefix'			=> '',
	'type'				=> 'text',
	'value'				=> null,
	'menu_order'		=> 0,
	'instructions'		=> '',
	'required'			=> 0,
	'id'				=> '',
	'class'				=> '',
	'conditional_logic'	=> 0,
	'parent'			=> 0,
	'wrapper'			=> array(
		'width'				=> '',
		'class'				=> '',
		'id'				=> ''
	)
);
```

## Example

### Display a field's label and value
This example shows how to load a field and display its label and value.
```
<?php
$field = get_field_object('my_field');
?>
<p><?php echo $field['label']; ?>: <?php echo $field['value']; ?></p>
```

### Display a field's label and value from a specific post
This example shows how to load a field and display its label and value from the post with ID = 123.
```
<?php
$field = get_field_object('my_field', 123);
?>
<p><?php echo $field['label']; ?>: <?php echo $field['value']; ?></p>
```

### Retrieve a field using its key
In some circumstances it may be necessary to load a field by its key, such as when a value has not yet been saved.
This example shows how to load a field using its key.
```
<?php
$field = get_field_object('field_123456');
?>
```

### Display field type specific data
Some field types store extra data such as the Select field. This example shows how to loop over a Select field's choices and display them in a list.
```
<?php
$field = get_field_object('my_select');
if( $field['choices'] ): ?>
	<ul>
		<?php foreach( $field['choices'] as $value => $label ): ?>
			<li><?php echo $label; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
```