---
title: Flexible Content
category: field-types
group: Layout
status: draft
---

## Description
The Flexible Content field acts as a blank canvas to which you can add an unlimited number of layouts with full control over the order. Each layout can contain 1 or more sub fields allowing you to create simple or complex flexible content layouts.

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
  Creates a list of sub field groups (called layouts). With layouts predefined, you are able to add them into your field whenever and where ever you want.  
  
- **Button Label**  
  Creates custom text to appear in the 'Add Row' button.
  
- **Minimum Layouts**  
  Sets a limit on how many layouts are required.
  
- **Maximum Layouts**  
  Sets a limit on how many layouts are allowed.

## Template usage
The Flexible Content field is essential a wrapper for a group of layouts, so to loop through the layouts and target the sub field values, you must make use of a few extra functions. These are described below.

### Basic Loop
This example demonstrates how to loop through and display data with the [have_rows](https://www.advancedcustomfields.com/resources/functions/have_rows/), [the_row](https://www.advancedcustomfields.com/resources/functions/have_rows/), and [the_sub_field](https://www.advancedcustomfields.com/resources/functions/the_sub_field/) functions.
```
<?php

// Check if the flexible content field has rows of data
if( have_rows('flexible_content_field_name') ):

     // Loop through data
    while ( have_rows('flexible_content_field_name') ) : the_row();

        if( get_row_layout() == 'paragraph' ):

        	the_sub_field('text');

        elseif( get_row_layout() == 'download' ): 

        	$file = get_sub_field('file');

        endif;

    endwhile;

else :

    // No layouts found.

endif;

?>
```

### Nested Loop
This example demonstrates how to loop through a nested repeater field named 'images'. The setup of this field can be viewed in the screenshots above.
```
<?php

// check if the flexible content field has rows of data
if( have_rows('flexible_content_field_name') ):

 	// loop through the rows of data
    while ( have_rows('flexible_content_field_name') ) : the_row();

		// check current row layout
        if( get_row_layout() == 'gallery' ):

        	// check if the nested repeater field has rows of data
        	if( have_rows('images') ):

			 	echo '<ul>';

			 	// loop through the rows of data
			    while ( have_rows('images') ) : the_row();

					$image = get_sub_field('image');

					echo '<li><img src="' . $image['url'] . '" alt="' . $image['alt'] . '" /></li>';

				endwhile;

				echo '</ul>';

			endif;

        endif;

    endwhile;

else :

    // no layouts found

endif;

?>
```

### Basic Loop (before version 4.3.0)
The functions `have_rows` and `the_row` were added in version 4.3.0. Prior to this, a function called `has_sub_field` was available (and still is) to loop through the rows of data. There is 1 key difference to this function and that is you cannot use it within an `if` statement.
```
<?php

// Check if the flexible content field has rows of data
if( get_field('flexible_content_field_name') ):

 	// Loop through the rows of data
    while ( has_sub_field('flexible_content_field_name') ) :

		 if( get_row_layout() == 'paragraph' ):

        	the_sub_field('text');

        elseif( get_row_layout() == 'download' ): 

        	$file = get_sub_field('file');

        endif;

    endwhile;

else :

    // No layouts found.

endif;

?>
```
