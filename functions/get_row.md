---
title: get_row()
description: Returns an array containing all values for the current row.
category: functions
group: Loop
---

## Description
Returns an array containing all values (in the format name => value) for the current row within a `have_rows()` loop.

### Change Log
- Added in version 5.3.3

## Parameters
```
get_row([$format_value = true]);
```
- `$format_value`	*(bool)*	*(Optional)*	Whether to apply formatting logic. Defaults to true.

## Return
*(array)* Array of values in the format name => value.

## Example
This example demonstrates how to load the current row values and display them.
```
<?php if( have_rows('slides') ): ?>
	<?php while( have_rows('slides') ): the_row(); 
		
		// Get all values for this row.
		$row = get_row();
		
		// Check for image value.
		if( $row['image'] ): ?>
			<img src="<?php echo $row['image']; ?>" />
			<p><?php echo $row['caption']; ?></p>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>
```

## Notes

### Similarities to the_row()
This function returns the same data as `the_row()`, however, it doesn't step through the rows of a `have_rows()` loop.
