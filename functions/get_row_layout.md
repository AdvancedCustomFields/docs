---
title: get_row_layout()
description: Returns the current row layout name within a have_rows() loop
category: functions
group: Loop
status: draft
---

## Description
Returns the current row layout name within a `have_rows()` loop. 

This function becomes necessary when displaying values from a Flexible Content field as each row may be of a different layout type.

## Parameters
```
get_row_layout()
```

## Return
*(string)* The name of the layout as defined in the Flexible Content field settings.

## Example

### Basic usage.
This example shows how to loop through a Flexible Content field and load the row layout for each row.
```
if( have_rows('content') ) {
	while( have_rows('content') ) {
		the_row();
		
		// Get the row layout.
		$layout = get_row_layout();
		
		// Do something...
	}
}
```

### Display layouts.
This example shows how to loop through a Flexible Content field and generate HTML for different layouts.
```
<?php if( have_rows('content') ): ?>
	<?php while( have_rows('content') ): the_row(); ?>
		<?php 
		
		//Paragraph layout.
		if( get_row_layout() == 'paragraph' ): ?>
			<?php the_sub_field('paragraph'); ?>
		<?php 
		
		// Image layout.
		elseif( get_row_layout() == 'image' ): 
			$image = get_sub_field('image');
			?>
			<figure>
				<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
				<figcaption><?php echo $image['caption']; ?></figcaption>
			</figure>
		<?php 
		
		// Posts.
		elseif( get_row_layout() == 'posts' ): 
			$posts = get_sub_field('posts');
			?>
			<div class="featured-posts">
				<h2><?php the_sub_field('title'); ?></h2>
				<?php the_sub_field('content'); ?>
				<?php if( posts ): ?>
					<ul>
					<?php foreach( $posts as $post ):
						setup_postdata($post); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>
```
