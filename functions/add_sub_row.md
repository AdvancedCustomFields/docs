---
title: add_sub_row()
description: Adds a new row of data to a Repeater or Flexible Content sub field value.
category: functions
group: Update
status: draft
---

Adds a new row of data to a Repeater or Flexible Content sub field value.

This function can be used inside or outside of a `have_rows()` loop. When used inside, the current row will be used to update the sub field value. When used outside, the rows and parents must be specified to target the correct value place.

Please note this function is used to modify a sub field value. To update a modify field value, please see [add_row()](https://www.advancedcustomfields.com/resources/add_row/).

## Parameters
```
add_sub_row($selector, $value, [$post_id]);
```
- `$selector`		*(string|array)*	*(Required)*	The sub field name or key, or an array of ancestors and row numbers.
- `$value`			*(array)*			*(Required)*	The new row data.
- `$post_id`		*(mixed)*			*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(bool)* True on successful update, false on failure.

## Change Log
- Added in version 5.4.7

### Add a new sub row inside of a have_rows() loop
This example shows how to add a new row of data to an existing nested repeater field called 'images'. This nested repeater field contains 3 sub fields ('image', 'alt', 'link').
```
// Loop over all staff members.
if( have_rows('staff_members') ) {
	while( have_rows('staff_members') ) {
		the_row();
		
		// Get this staff member name.
		$name = get_sub_field('name');
		
		// Append new row to this staff member's images.
		$row = array(
			'image'	=> 123,
			'alt'	=> "Another photo of $name",
			'link'	=> 'http://website.com'
		);
		add_sub_row('images', $row);
	}
}
```

### Add a new sub row outside of a have_rows() loop
This example shows how to add a new row of data outside of a `have_rows()` loop. Here, the `$selector` parameter is provided an array containing a mixture of field names and row numbers. This array should read from left to right, the parents to children relationship separated by the row number.

Please see notes regarding index offset.
```
// Update only the first staff member's images.
$row = array(
	'image'	=> 123,
	'alt'	=> "Another photo of the first staff member",
	'link'	=> 'http://website.com'
);
add_sub_row( array('staff_members', 1, 'images'), $row );
```

## Notes

### Index offset
When targeting a sub field using a specific row number, please note that row numbers begin from 1 and not 0. This means that the first row has an index of 1, the second row has an index of 2, and so on.

To begin indexes from 0, please use the [row_index_offset](https://www.advancedcustomfields.com/resources/acf-settings/) setting like so.
#### functions.php
```
add_filter('acf/settings/row_index_offset', '__return_zero');
```
