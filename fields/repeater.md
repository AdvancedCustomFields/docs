---
title: Repeater
category: field-types
group: Layout
---

## Description
The Repeater field provides a neat solution for repeating content - think slides, team members, CTA tiles and alike. 

This field type acts as a parent to a set of sub fields which can be repeated again and again. What makes this field type so special is its versatility. Any kind of field can be used within a Repeater, and there are no limits to the number of repeats either (👨‍💻 unless defined in the field settings).

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-repeater-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-repeater-field-interface.png" alt="A table-like layout displaying 3 rows of data each containing Image, Name, Specialities and Website fields." />
		</a>
		<figcaption>The Repeater field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-repeater-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-repeater-field-settings.png" alt="List of field settings shown when setting up a Repeater field." />
		</a>
		<figcaption>The Repeater field settings</figcaption>
	</figure>
</div>

## Settings
- **Sub Fields**  
  Defines the set of repeatable sub fields.

- **Collapsed**  
  Enables each row to be collapsed by specifying a single sub field to display.
  
- **Minimum Rows**  
  Sets a limit on how many rows of data are required.
  
- **Maximum Rows**  
  Sets a limit on how many rows of data are allowed.
  
- **Layout**  
  Defines the layout style of the appearance of the sub fields.  
  _Table_: Sub fields are displayed in a table. Labels will appear in the table header.  
  _Block_: Sub fields are displayed in blocks, one after the other.  
  _Row_: Sub fields are displayed in a two column table. Labels will appear in the first column.  
  
- **Button Label**  
  The text shown in the 'Add Row' button.

## Template usage
The Repeater field will return an array of rows, where each row is an array containing sub field values.

For the best developer experience, we created some extra functions specifically for looping over rows and accessing sub field values. These are the [have_rows](https://www.advancedcustomfields.com/resources/functions/have_rows/), [the_row](https://www.advancedcustomfields.com/resources/functions/have_rows/), [get_sub_field](https://www.advancedcustomfields.com/resources/functions/get_sub_field/), and [the_sub_field](https://www.advancedcustomfields.com/resources/functions/the_sub_field/) functions.

### Basic loop
This example demonstrates how to loop through a Repeater field and load a sub field value.
```
<?php

// Check rows exists.
if( have_rows('repeater_field_name') ):

    // Loop through rows.
    while( have_rows('repeater_field_name') ) : the_row();

        // Load sub field value.
        $sub_value = get_sub_field('sub_field');
		// Do something...

    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;
```

### Display a slider
This example demonstrates how to loop through a Repeater field and generate the HTML for a basic image slider.
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

### Foreach Loop
This example demonstrates how you can manually loop over a Repeater field value using a foreach loop.
```
<?php 
$rows = get_field('repeater_field_name');
if( $rows ) {
    echo '<ul class="slides">';
    foreach( $rows as $row ) {
		$image = $row['image'];
        echo '<li>';
			echo wp_get_attachment_image( $image, 'full' );
			echo wpautop( $row['caption'] );
		echo '</li>';
    }
    echo '</ul>';
}
```

### Nested loops
This example demonstrates how to loop through a nested Repeater field and load a sub-sub field value.
```
<?php
/**
 * Field Structure:
 *
 * - parent_repeater (Repeater)
 *   - parent_title (Text)
 *   - child_repeater (Repeater)
 *     - child_title (Text)
 */
if( have_rows('parent_repeater') ):
    while( have_rows('parent_repeater') ) : the_row();
		
		// Get parent value.
		$parent_title = get_sub_field('parent_title');
		
		// Loop over sub repeater rows.
		if( have_rows('child_repeater') ):
		    while( have_rows('child_repeater') ) : the_row();
				
				// Get sub value.
				$child_title = get_sub_field('child_title');
				
			endwhile;
		endif;
    endwhile;
endif;
```

### Accesing first row values
This example demonstrates how to load a sub field value from the first row of a Repeater field.
```
<?php
$rows = get_field('repeater_field_name' );
if( $rows ) {
	$first_row = $rows[0];
	$first_row_title = $first_row['title'];
	// Do something...
}
```

You may also use the [break](https://www.php.net/manual/en/control-structures.break.php) statement within a `have_rows()` loop to step out at any time.
```
<?php 
if( have_rows('repeater_field_name') ) {
	while( have_rows('repeater_field_name') ) {
		the_row();
		$first_row_title = get_sub_field('title');
		// Do something...
		break;
	}
}
```

### Accesing random row values
This example demonstrates how to load a sub field value from a random row of a Repeater field.
```
<?php
$rows = get_field('repeater_field_name' );
if( $rows ) {
	$index = array_rand( $rows );
	$rand_row = $rows[ $index ];
	$rand_row_title = $rand_row['title'];
	// Do something...
}
```