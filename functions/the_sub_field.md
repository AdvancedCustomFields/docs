---
title: the_sub_field()
description: Displays the value of a specific sub field.
category: functions
group: Loop
---

## Description
Displays the value of a specific sub field value from a Repeater or Flexible Content field loop.

This function is essentially the same as `<?php echo get_sub_field('name'); ?>`.

## Parameters
```
the_sub_field( $selector, [$format_value] );
```
- `$selector`		*(string)*	*(Required)*	The sub field name or field key.
- `$format_value`	*(bool)*	*(Optional)*	Whether to apply formatting logic. Defaults to true.

## Example

### Display a value from within a Repeater field.
This example shows how to loop through a Repeater field and display a sub field value.
```
<?php if( have_rows('todo') ): ?>
	<ul>
    <?php while ( have_rows('todo') ) : the_row(); ?>
    	<li><?php the_sub_field('item'); ?></li>
    <?php endwhile; ?>
    </ul>
<?php else : ?>
    <p>No todos found.</p>
<?php endif; ?>
```

### Display a value from within a Flexible Content field.
This example shows how to loop through a Flexible Content field and generate HTML for different layouts.
```
<?php if( have_rows('content') ): ?>
	<?php while( have_rows('content') ): the_row(); ?>
		<?php if( get_row_layout() == 'paragraph' ): ?>
			<?php the_sub_field('paragraph'); ?>
		<?php elseif( get_row_layout() == 'quote' ): ?>
			<blockquote>
			    <p><?php the_sub_field('quote'); ?></p>
			    <footer>—<?php the_sub_field('author'); ?></footer>
			</blockquote>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>
```

### Nested loops
This example shows how to loop through a nested Repeater field and display sub field values.
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
