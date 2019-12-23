---
title: the_flexible_field()
description: Loops through rows of a flexible content field
category: functions
group: Deprecated
deprecated: true
---

## Description
[tip]
This function is deprecated. Please use the [have_rows()](https://www.advancedcustomfields.com/resources/have_rows/) function instead.
[/tip]

This function is used within a while-loop to loop through each row of a Flexible Content field.

Unlike `have_rows()`, this function will take a step through the available rows each time it is called, causing undesired results when also used within an if-statment.

## Parameters
```
the_flexible_field( $field_name, $post_id );
```
- `$field_name`	*(string)*	*(Required)*	The name of the Flexible Content field to be retrieved. e.g. 'content'
- `$post_id`	*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(bool)* True if a row exists.

## Change Log
- Deprecated in version 3.3.4
- Added in version 3.1.0

## Requirements
- [Flexible Content field Add-on](https://www.advancedcustomfields.com/add-ons/flexible-content-field/) version 1.0.0 or later.

## Example
This example demonstrates how to loop through a Flexible Content field called "content" and display various layouts.
```
<?php while( the_flexible_field("content") ): ?>
	<?php if( get_row_layout() == "paragraph" ): ?>
		<div>
			<?php the_sub_field("content"); ?>
		</div>
	<?php elseif( get_row_layout() == "file" ): ?>
		<div>
			<a href="<?php the_sub_field("file"); ?>" ><?php the_sub_field("name"); ?></a>
		</div>
	<?php elseif( get_row_layout() == "featured_posts" ): ?>
		<div>
			<h2><?php the_sub_field("title"); ?></h2>
			<?php the_sub_field("content"); ?>
			<?php if( get_sub_field("posts") ): ?>
				<ul>
				<?php foreach( get_sub_field("posts") as $p ): ?>
					<li><a href="<?php echo get_permalink($p->ID); ?>"><?php echo get_the_title($p->ID); ?></a></li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	<?php endif; ?>
<?php endwhile; ?>
```
