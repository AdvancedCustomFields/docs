---
title: get_field_objects()
description: Returns the settings of all fields saved on a specific post.
category: functions
group: Basic
---

##Description
Returns the settings of all fields saved on a specific post.

Each field contains many settings such as a label, name and type. This function can be used to load these settings as an array along with the field's value.

##Parameters
```
get_field_objects( [$post_id = false], [$format_value = true], [$load_value = true] );
```
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.
- `$format_value`	*(bool)*	*(Optional)*	Whether to apply formatting logic. Defaults to true.
- `$load_value`		*(bool)*	*(Optional)*	Whether to load the field’s value. Defaults to true.

## Return
This function will return an array looking something like the following. Please note that each field contains unique settings.
```
array(
	"my_field" => array(
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
	),
	...
);
```

## Example

### Display all fields labels and values
This example shows how to load all fields and display their labels and values.
```
<?php
$fields = get_field_objects();
if( $fields ): ?>
	<ul>
		<?php foreach( $fields as $field ): ?>
			<li><?php echo $field['label']; ?>: <?php echo $field['value']; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
```
### Display all fields labels and values from a specific post
This example shows how to load all fields and display their labels and values from the post with ID = 123.
```
<?php
$fields = get_field_objects( 123 );
if( $fields ): ?>
	<ul>
		<?php foreach( $fields as $field ): ?>
			<li><?php echo $field['label']; ?>: <?php echo $field['value']; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
```

## Further Reading
- [get_field_object()](https://advancedcustomfields/resources/get_field_object)
