---
title: has_sub_field()
description: Used to loop through rows of a repeater or flexible content field
category: functions
status: draft
---

[blockquote] This function is outdated. Please use the [have_rows()](https://www.advancedcustomfields.com/resources/have_rows/) function instead.
[/blockquote]

## Description
This function is used in a “while loop” to loop through each row of a repeater field / flexible content field and instantiate it for use with these functions:
- [get_sub_field](https://www.advancedcustomfields.com/docs/functions/get_sub_field/)
- [the_sub_field](https://www.advancedcustomfields.com/docs/functions/the_sub_field/)

## Parameters
```
<?php has_sub_field( $field_name, $post_id ); ?>
```

### $field_name
*(String)* (Required) The name of the repeater or flexible content field to loop through. e.g. "gallery_images"

### $post_id
*(Integer)* Specific post ID where your value was entered. Defaults to current post ID. Can also be options/taxonomies/users/etc.
 
## Examples

### Loop through Repeater field
This example demonstrates looping through a Repeater field named 'repeater' and displaying the data for the sub fields.

```
if( get_field('repeater') ): ?>

	<?php while( has_sub_field('repeater') ): ?>

		<div>
			<img src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('alt'); ?>" />
		    <p><?php the_sub_field('content'); ?></p>
		</div>

	<?php endwhile; ?>

<?php endif;
```

### Loop through a Flexible Content field
This example demonstrates looping through a Flexible Content field called 'flexible_content' and retrieving different fields' data depending on the chosen layout.

```
if( get_field('flexible_content') ): ?>

	<?php while( has_sub_field("flexible_content") ): ?>

		<?php if(get_row_layout() == "paragraph"): // layout: Paragraph ?>

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
<?php endif; 
```

### Loop through nested Repeater fields
This example demonstrates how to loop through nested Repeater fields and display the sub fields' data.
```
if( get_field('parent_repeater') ): ?>
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
This example demonstrates how to loop through nested Repeater fields from a post with the id '123'.

_Note:_ You don't need to specify the $post_id for any sub field functions.
```
if( get_field('parent_repeater', 123) ): ?>
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
