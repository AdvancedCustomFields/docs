---
title: add_row()
description: Adds a new row of data to an existing repeater field value.
category: functions
group: Update
---

Adds a new row of data to an existing repeater field value.

## Parameters
```
add_row($selector, $row, [$post_id])
```
- `$selector`		*(string)*	*(Required)*	The field name or field key.
- `$row`			*(array)*	*(Required)*	The new row data.
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(int|false)* The new total row count on successful update, false on failure.

## Change Log
- Added in version 5.3.2

## Examples

### Add a new row using field names
This example shows how to add a new row of data to an existing repeater field called 'images'. This repeater field contains 3 sub fields ('image', 'alt', 'link').
```
$row = array(
	'image'	=> 123,
	'alt'	=> 'Another great sunset',
	'link'	=> 'http://website.com'
);

add_row('images', $row);
```

### Add a new row using field keys
This example demonstrates how to add a new row of data to an existing repeater field using keys instead of names. The repeater field is the same above.
Similar to the `update_field()` function, using a field's key rather than its name allows ACF to correctly find the field if no existing value has been saved.
```
$row = array(
	'field_560389746a525'	=> 123,
	'field_560389746a524'	=> 'Another great sunset',
	'field_560389746a528'	=> 'http://website.com'
);
add_row('field_560389746a51f', $row);
```