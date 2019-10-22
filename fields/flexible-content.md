---
title: Flexible Content
category: field-types
group: Layout
status: draft
---

## Description
The Flexible Content field provides a simple, structured, block-based editor.

Using layouts and sub fields to design the available blocks, this field type acts as a blank canvas to which you can define, create and manage content with total control.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-flexible-content-field-interface.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-flexible-content-field-interface.jpg" alt="A Flexible Content field that allows you to choose a layout" />
		</a>
		<figcaption>The Flexible Content field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-flexible-content-field-settings.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-flexible-content-field-settings.jpg" alt="List of field settings shown when setting up a Flexible Content field" />
		</a>
		<figcaption>The Flexible Content field settings</figcaption>
	</figure>
</div>

## Settings
- **Layouts**  
  Defines the layouts available when editing content. Each layout contains Label, Name, Limit, Display and Field settings.
  
- **Button Label**  
  The text shown in the 'Add Row' button.
  
- **Minimum Layouts**  
  Sets a limit on how many layouts are required.
  
- **Maximum Layouts**  
  Sets a limit on how many layouts are allowed.

## Template usage
The Flexible Content field returns a multi-dimensional array containing the layouts and their sub field values.

To loop over the layouts and access the sub field values, just use the [have_rows](https://www.advancedcustomfields.com/resources/functions/have_rows/), [the_row](https://www.advancedcustomfields.com/resources/functions/have_rows/), [get_sub_field](https://www.advancedcustomfields.com/resources/functions/get_sub_field/), and [the_sub_field](https://www.advancedcustomfields.com/resources/functions/the_sub_field/) functions.

### Loop example
This example demonstrates how to loop over a Flexible Content field value and access sub fields from different layouts.
```
<?php

// Check value exists.
if( have_rows('content') ):

	// Loop through rows.
    while ( have_rows('content') ) : the_row();
    	
    	// Case: Paragraph layout.
    	if( get_row_layout() == 'paragraph' ):
			$text = get_sub_field('text');
			// Do something...
		
		// Case: Download layout.
        elseif( get_row_layout() == 'download' ): 
        	$file = get_sub_field('file');
        	// Do something...

        endif;
    
    // End loop.
    endwhile;

// No value.
else :
	// Do something...
endif;
```

### Display layouts
This example demonstrates how to loop through a Flexible Content field and generate HTML for different layouts.
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
    <?php endwhile; ?>
<?php endif; ?>
```