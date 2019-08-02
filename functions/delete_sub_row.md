---
title: delete_sub_row()
description: Deletes a row of data from an existing Repeater or Flexible Content sub field value.
category: functions
group: Update
---

Deletes a row of data from an existing Repeater or Flexible Content sub field value.

This function can be used inside or outside of a `have_rows()` loop. When used inside, the current row will be used to update the sub field value. When used outside, the rows and parents must be specified to target the correct value place.

Please note this function is used to modify a sub field value. To modify a parent field value, please use the [delete_row()](https://www.advancedcustomfields.com/resources/delete_row/) function.

## Parameters
```
delete_sub_row($selector, $row, [$post_id])
```
- `$selector`		*(string|array)*	*(Required)*	The sub field name or key, or an array of ancestors and row numbers.
- `$row`			*(int)*				*(Required)*	The row number to update.
- `$post_id`		*(mixed)*			*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(bool)* True on successful update, false on failure.

## Change Log
- Added in version 5.4.7

### Delete a sub row inside of a have_rows() loop
This example shows how to delete a row of data from an existing nested repeater field called 'images'. This nested repeater field contains 3 sub fields ('image', 'alt', 'link').
```
// Loop over all staff members.
if( have_rows('staff_members') ) {
	while( have_rows('staff_members') ) {
		the_row();
		
		// Delete this staff member's first image.
		delete_sub_row('images', 1);
	}
}
```

### Delete a sub row outside of a have_rows() loop
This example shows how to delete a row of data outside of a `have_rows()` loop. Here, the `$selector` parameter is provided an array containing a mixture of field names and row numbers. This array should read from left to right, the parents to children relationship separated by the row number.

Please see notes regarding index offset.
```
// Delete the first staff member's first image.
delete_sub_row( array('staff_members', 1, 'images'), 1 );

// Update the first staff member's second image.
delete_sub_row( array('staff_members', 1, 'images'), 2 );
```

## Notes

### Index offset
When targeting a sub field using a specific row number, please note that row numbers begin from 1 and not 0. This means that the first row has an index of 1, the second row has an index of 2, and so on.

To begin indexes from 0, please use the [row_index_offset](https://www.advancedcustomfields.com/resources/acf-settings/) setting like so.
#### functions.php
```
add_filter('acf/settings/row_index_offset', '__return_zero');
```
