---
title: get_sub_field_object()
description: Returns the settings of a specific sub field.
category: functions
group: Loop
---

## Description
Returns the settings of a specific sub field within a have_rows() loop.

Each field contains many settings such as a label, name and type. This function can be used to load these settings as an array along with the field's value.

## Parameters
```
get_sub_field_object($selector, [$post_id = false], [$format_value = true], [$load_value = true]);
```
- `$selector`		*(string)*	*(Required)*	The field name or field key.
- `$format_value`	*(bool)*	*(Optional)*	Whether to apply formatting logic. Defaults to true.
- `$load_value`		*(bool)*	*(Optional)*	Whether to load the field’s value. Defaults to true.

## Return
*(array)* This function will return an array looking something like the following. Please note that each field contains unique settings.
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

## Changelog
- Added in version 4.0

## Example
This function works in a similar way to `get_sub_field()`, meaning it must be used within a `have_rows()` loop. This example shows how to list out a sub field's choices using its value to highlight the selected one.

```
<?php if( have_rows('repeater') ): ?>
	<?php while( have_rows('repeater') ): the_row(); ?>
		<?php 

		// Get the sub field called "select".
		$select = get_sub_field_object('select');
		
		// Get its value.
		$value = $select['value'];
		
		// Loop over its choices.
		?>
		<ul>
			<?php foreach( $select['choices'] as $k => $v ): ?>
				<li <?php echo ($k === $value) ? 'class="selected"' : ''; ?>>
					<?php echo $v; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endwhile; ?>
<?php endif; ?>
```
