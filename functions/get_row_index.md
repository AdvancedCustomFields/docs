---
title: get_row_index()
description: Returns the current row index within a have_rows() loop
category: functions
group: Loop
status: draft
---

## Description
Returns the current row index within a `have_rows()` loop.

### Return
*(int)* A numeric index of the current row. See notes regarding index offset.

### Change Log
- Added in version 5.3.4

## Example
This example demonstrates how to use this function to output unique ID's into each row's wrapper. This is useful for CSS / JS customization.

```
<?php if( have_rows('slides') ): ?>
	<?php while( have_rows('slides') ): the_row(); ?>
		<div class="accordion" id="accordion-<?php echo get_row_index(); ?>">
			<h3><?php the_sub_field('title'); ?></h3>
			<?php the_sub_field('text'); ?>
		</div>
	<?php endwhile; ?>
<?php endif; ?>
```
```
<div class="accordion" id="accordion-1">
	<h3>My first accordion</h3>
	<p>Some text here.</p>
</div>
<div class="accordion" id="accordion-2">
	<h3>My second accordion</h3>
	<p>Some moretext here.</p>
</div>
```

## Notes

### Index offset
The index returned from this function begins at 1. This means a Repeater field with 3 rows of data will produce indexes of 1, 2 and 3.

To begin indexes from 0, please use the [row_index_offset](https://www.advancedcustomfields.com/resources/acf-settings/) setting like so.
#### functions.php
```
add_filter('acf/settings/row_index_offset', '__return_zero');
```
