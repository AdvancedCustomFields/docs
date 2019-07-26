---
title: have_rows()
description: Used to loop through a parent field's value.
category: functions
group: Loop
---

## Description
This function checks to see if a parent field (such as Repeater or Flexible Content) has any rows of data to loop over. This is a boolean function, meaning it returns either `true` or `false`.

This function is intended to be used in conjunction with `the_row()` to step through available values.

Using `have_rows()` together with `the_row()` is intended to feel native much like the [have_posts()](https://codex.wordpress.org/Function_Reference/have_posts) and [the_post()](https://developer.wordpress.org/reference/functions/the_post/) WordPress functions.

## Change Log
- Added in version 4.3.0

## Parameters
```
have_rows( $selector, [$post_id = false] );
```
- `$selector`		*(string)*	*(Required)*	The field name or field key.
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(bool)* True if a row exists.

## Example

### Basic loop
This example shows how to loop through a repeater field called "parent_field" and load a sub field value.
```
if( have_rows('parent_field') ):
    while ( have_rows('parent_field') ) : the_row();
		$sub_value = get_sub_field('sub_field');
		// Do something...
    endwhile;
else :
    // no rows found
endif;
```

### Display a slider.
This example shows how to loop through a repeater field and generate HTML for a basic image slider.

```
<?php if( have_rows('slides') ): ?>
	<ul class="slides">
	<?php while( have_rows('slides') ): the_row(); 
		$image = get_sub_field('image');
		?>
		<li>
			<?php echo wp_get_attachment_image( $image, 'full' ); ?>
		    <p><?php the_sub_field('caption'); ?></p>
		</li>
	<?php endwhile; ?>
	</ul>
<?php endif; ?>
```

### Display layouts.
This example shows how to loop through a Flexible Content field and generate HTML for different layouts.
```
<?php if( have_rows('content') ): ?>
	<?php while( have_rows('content') ): the_row(); ?>
		<?php if( get_row_layout() == 'paragraph' ): ?>
			<?php the_sub_field('paragraph'); ?>
		<?php elseif( get_row_layout() == 'image' ): 
			$image = get_sub_field('image');
			?>
			<figure>
				<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
				<figcaption><?php echo $image['caption']; ?></figcaption>
			</figure>
			<?php endif; ?>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>
```

### Nested loops
This example shows how to loop through a nested Repeater field.
```
<?php 

/**
 * Field Structure:
 *
 * - locations (Repeater)
 *   - title (Text)
 *   - description (Textarea)
 *   - staff_members (Repeater)
 *     - image (Image)
 *     - name (Text)
 */
if( have_rows('locations') ): ?>
	<div class="locations">
	<?php while( have_rows('locations') ): the_row(); ?>
		<div class="location">
			<h3><?php the_sub_field('title'); ?></h3>
			<p><?php the_sub_field('description'); ?></p>
			<?php if( have_rows('staff_members') ): ?>
				<ul class="staff-members">
				<?php while( have_rows('staff_members') ): the_row();
					$image = get_sub_field('image');
					?>
					<li>
						<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
						<h4><?php the_sub_field('name'); ?></h4>
					</li>
				<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		</div>
	<?php endwhile; ?>
	</div>
<?php endif; ?>

```

## Notes

### Infinite Loops
Because the `have_rows()` function does not step through each row by itself, using this function without `the_row()` will create an infinite loop resulting in a white screen.

### Scope
The scope of a `have_rows()` loop is limited to the current row. This means that any sub field function such as `get_sub_field()` or `the_sub_field()` will only find data from the current row, not from parent or child rows.
