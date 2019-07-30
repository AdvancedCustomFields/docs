---
title: update_sub_field()
description: Updates the value of a specific sub field.
category: functions
group: Update
---

## Description
Updates the value of a specific sub field.

This function can be used inside or outside of a `have_rows()` loop. When used inside, the current row will be used to update the sub field value. When used outside, the rows and parents must be specified to target the correct value place.

## Parameters
```
update_sub_field($selector, $value, [$post_id]);
```
- `$selector`		*(string|array)*	*(Required)*	The sub field name or key, or an array of ancestors and row numbers.
- `$value`			*(mixed)*	*(Required)*	The new value.
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(bool)* True on successful update, false on failure.

## Change Log
- Added in version 5.0.0

## Examples

### Update a sub field inside of a have_rows() loop
This example shows how to loop through a Repeater field and update one of its sub field values using the current row number.
```
if( have_rows('repeater') ) {
	$i = 0;
	while( have_rows('repeater') ) {
		the_row();
		$i++;
		update_sub_field('caption', "This caption is in row {$i}");
	}
}
```

### Update a sub field outside of a have_rows() loop
This example shows how to update a sub field value outside of a `have_rows()` loop. Here, the `$selector` parameter is provided an array containing a mixture of field names and row numbers. This array should read from left to right, the parents to children relationship separated by the row number.

Please see notes regarding index offset.
```
// Update "caption" within the first row of "repeater".
update_sub_field( array('repeater', 1, 'caption'), 'This caption is for the first row of the repeater!' );
```

### Update a nested sub field
The `update_sub_field()` function can also be used to target a nested sub field both inside and outside of a `have_rows()` loop. This example shows how to update a nested sub field function using both methods.
```
// Loop over parent rows.
if( have_rows('repeater') ) {
	$parent_i = 0;
	while( have_rows('repeater') ) {
		the_row();
		$parent_i++;

		// Loop over child rows.
		if( have_rows('sub_repeater') ) {
			$child_i = 0;
			while( have_rows('sub_repeater') ) {
				the_row();
				$child_i++;
				
				// Update nested sub field value with reference to both parent and child indexes.
				update_sub_field('sub_sub_field', "This value is for repeater row {$parent_i}, and sub_repeater row {$child_i}");
			}
		}
	}
}

// target a nested sub field directly.
update_sub_field( array('repeater', 1, 'sub_repeater', 2, 'sub_sub_field'), 'This value is for repeater row 1, and sub_repeater row 2!' );
```

## Notes

### Index offset
When targeting a sub field using a specific row number, please note that row numbers begin from 1 and not 0. This means that the first row has an index of 1, the second row has an index of 2, and so on.

To begin indexes from 0, please use the [row_index_offset](https://www.advancedcustomfields.com/resources/acf-settings/) setting like so.
#### functions.php
```
add_filter('acf/settings/row_index_offset', '__return_zero');
```
