---
title: update_sub_row()
description: Updates a row of data for an existing Repeater or Flexible Content sub field value.
category: functions
group: Update
status: draft
---

Updates a row of data for an existing Repeater or Flexible Content sub field value.

This function can be used inside or outside of a `have_rows()` loop. When used inside, the current row will be used to update the sub field value. When used outside, the rows and parents must be specified to target the correct value place.

Please note this function is used to modify a sub field value. To modify a parent field value, please use the [update_row()](https://www.advancedcustomfields.com/resources/update_row/) function.

## Parameters
```
update_sub_row($selector, $row, $value, [$post_id])
```
- `$selector`		*(string|array)*	*(Required)*	The sub field name or key, or an array of ancestors and row numbers.
- `$row`			*(int)*				*(Required)*	The row number to update.
- `$value`			*(array)*			*(Required)*	The new row data.
- `$post_id`		*(mixed)*			*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(bool)* True on successful update, false on failure.

## Change Log
- Added in version 5.4.7

### Update a sub row inside of a have_rows() loop
This example shows how to update a row of data to an existing nested repeater field called 'images'. This nested repeater field contains 3 sub fields ('image', 'alt', 'link').
```
// Loop over all staff members.
if( have_rows('staff_members') ) {
	while( have_rows('staff_members') ) {
		the_row();
		
		// Get this staff member's name.
		$name = get_sub_field('name');
		
		// Update this staff member's first image.
		$value = array(
			'image'	=> 123,
			'alt'	=> "The first photo of $name",
			'link'	=> 'http://website.com'
		);
		update_sub_row('images', 1, $value);
	}
}
```

### Update a sub row outside of a have_rows() loop
This example shows how to update a row of data outside of a `have_rows()` loop. Here, the `$selector` parameter is provided an array containing a mixture of field names and row numbers. This array should read from left to right, the parents to children relationship separated by the row number.

Please see notes regarding index offset.
```
// Update the first staff member's first image.
$value = array(
	'image'	=> 123,
	'alt'	=> "The first photo of the first staff member",
	'link'	=> 'http://website.com'
);
update_sub_row( array('staff_members', 1, 'images'), 1, $value );

// Update the first staff member's second image.
update_sub_row( array('staff_members', 1, 'images'), 2, $value );
```

## Notes

### Index offset
When targeting a sub field using a specific row number, please note that row numbers begin from 1 and not 0. This means that the first row has an index of 1, the second row has an index of 2, and so on.

To begin indexes from 0, please use the [row_index_offset](https://www.advancedcustomfields.com/resources/acf-settings/) setting like so.
#### functions.php
```
add_filter('acf/settings/row_index_offset', '__return_zero');
```
