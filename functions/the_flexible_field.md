---
title: the_flexible_field()
description: Loops through rows of a flexible content field
category: functions
status: draft
deprecated: true
---

## Description
[tip]
This function has been deprecated. Please use the [have_rows()](https://www.advancedcustomfields.com/resources/have_rows/) function instead.
[/tip]

This function is used in a “while loop” to loop through each row of a flexible content field. This function requires the flexible content field.

This function will return either: the current row (continue loop) or false (end of loop). Within the “while loop”, you can use these functions:
- [get_row_layout()](https://www.advancedcustomfields.com/docs/functions/get_row_layout/)
- [get_sub_field()](https://www.advancedcustomfields.com/docs/functions/get_sub_field/)
- [the_sub_field()](https://www.advancedcustomfields.com/docs/functions/the_sub_field/)

## Change Log
- Deprecated in version 3.3.4
- Added in version 3.1.0

## Parameters
```
the_flexible_field( $field_name, $post_id );
```
- $field_name *(string)* (Required) The name of the flexible content field to be retrieved.
- $post_id *(integer)* Specific post ID where your value was entered. Defaults to current post ID. Can also be options/taxonomies/users/etc.
 
## Example
This example demonstrates looping through a Flexible Content field displaying different content depending on the chosen layout.
```
while(the_flexible_field("content")): ?>

	<?php if(get_row_layout() == "paragraph"): // layout: Content ?>

		<div>
			<?php the_sub_field("content"); ?>
		</div>

	<?php elseif(get_row_layout() == "file"): // layout: File ?>

		<div>
			<a href="<?php the_sub_field("file"); ?>" ><?php the_sub_field("name"); ?></a>
		</div>

	<?php elseif(get_row_layout() == "featured_posts"): // layout: Featured Posts ?>

		<div>
			<h2><?php the_sub_field("title"); ?></h2>
			<?php the_sub_field("content"); ?>

			<?php if(get_sub_field("posts")): ?>
				<ul>
				<?php foreach(get_sub_field("posts") as $p): ?>
					<li><a href="<?php echo get_permalink($p->ID); ?>"><?php echo get_the_title($p->ID); ?></a></li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>

		</div>

	<?php endif; ?>

<?php endwhile; ?>
```
