---
title: has_sub_field()
description: Loops through rows of a repeater or flexible content field
category: functions
deprecated: true
---

## Description
[tip]
This function is deprecated. Please use the [have_rows()](https://www.advancedcustomfields.com/resources/have_rows/) function instead.
[/tip]

This function is used within a while-loop to loop through each row of a Repeater or Flexible Content field.

Unlike `have_rows()`, this function will take a step through the available rows each time it is called, causing undesired results when also used within an if-statment.

## Parameters
```
has_sub_field( $field_name, $post_id );
```
- `$field_name`	*(string)*	*(Required)*	The name of the Repeater or Flexible Content field to be retrieved. e.g. 'gallery_images'
- `$post_id`	*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(bool)* True if a row exists.

## Change Log
- Deprecated in version 4.3.0

## Examples

### Loop through Repeater field
This example demonstrates how to loop through a repeater field called "gallery_images".
```
<?php if( get_field('gallery_images') ): ?>
    <?php while( has_sub_field('gallery_images') ): ?>
        <img src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('alt'); ?>" />
    <?php endwhile; ?>
 <?php endif;
```

### Loop through a Flexible Content field
This example demonstrates how to loop through a Flexible Content field called "content" and display various layouts.
```
<?php while( has_sub_field("content") ): ?>
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

### Loop through nested Repeater fields
This example demonstrates how to loop through nested Repeater fields and display the sub field data.
```
<?php if( get_field('parent_repeater') ): ?>
	<?php while( has_sub_field('parent_repeater') ): ?>
		<div>
			<?php if( get_sub_field('child_repeater') ): ?>
				<ul>
				<?php while( has_sub_field('child_repeater') ): ?>
					<li><?php the_sub_field('item'); ?></li>
				<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		</div>	
	<?php endwhile; ?>
<?php endif; 
```

### Loop through nested Repeater fields (from another $post ID)
This example demonstrates how to loop through nested Repeater fields from a different post with the ID of 123.

_Note:_ You don't need to specify the `$post_id` for any sub field functions.
```
<?php if( get_field('parent_repeater', 123) ): ?>
	<?php while( has_sub_field('parent_repeater', 123) ): ?>
		<div>
			<?php 

			if( get_sub_field('child_repeater') ): ?>
				<ul>
				<?php while( has_sub_field('child_repeater') ): ?>
					<li><?php the_sub_field('item'); ?></li>
				<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		</div>	
	<?php endwhile; ?>
<?php endif;
```
