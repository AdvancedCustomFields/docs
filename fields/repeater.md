---
title: Repeater
category: field-types
group: Layout
status: draft
---

## Description
The Repeater field provides a way to create a set of sub fields which can be repeated again and again when adding content.

## Screenshots
<div class="gallery">
	<figure>
		<a href="#">
			<img src="#" alt="" />
		</a>
		<figcaption>The Repeater field interface</figcaption>
	</figure>
	<figure>
		<a href="#">
			<img src="#" />
		</a>
		<figcaption>The Repeater field settings</figcaption>
	</figure>
</div>

## Settings
- **Sub Fields**  
  Defines the sub fields which will appear as cells in the Repeater table
  
- **Minimum Rows**  
  Sets a limit on how many rows of data are required.
  
- **Maximum Rows**  
  Sets a limit on how many rows of data are allowed.
  
- **Layout**  
  Changes the layout style of the appearance of the sub fields.
  
- **Button Label**  
  The text shown in the 'Add Row' button.

## Template usage
The Repeater field is a wrapper containing a group of sub field values.

Accessing the values is done via the [have_rows](https://www.advancedcustomfields.com/resources/functions/have_rows/), [the_row](https://www.advancedcustomfields.com/resources/functions/have_rows/), [get_sub_field](https://www.advancedcustomfields.com/resources/functions/get_sub_field/), and [the_sub_field](https://www.advancedcustomfields.com/resources/functions/the_sub_field/) functions.

### Loop example
This example demonstrates how to loop through a Repeater field value and display sub fields.
```
<?php

// Check value exists.
if( have_rows('repeater_field_name') ):

    // Loop through rows.
    while ( have_rows('repeater_field_name') ) : the_row();

        // Display a sub field value.
        the_sub_field('sub_field_name');

    // End loop.
    endwhile;

else :
    // Do something...
endif;
?>
```

### Store variables within Loop
This example demonstrates how to use the [get_sub_field](https://www.advancedcustomfields.com/resources/functions/get_sub_field/) function to store variables within the Loop.
```
<?php if( have_rows('repeater_field_name') ): ?>

    <ul class="slides">

    <?php while( have_rows('repeater_field_name') ): the_row(); 

        // Retrieve fields as variables.
        $image = get_sub_field('image');
        $content = get_sub_field('content');
        $link = get_sub_field('link');

        ?>

        <li class="slide">

            <?php if( $link ): ?>
                <a href="<?php echo esc_url( $link ); ?>">
            <?php endif; ?>

                <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_html( $image['alt'] ); ?>" />

            <?php if( $link ): ?>
                </a>
            <?php endif; ?>

            <?php echo wp_kses_post( $content ); ?>

        </li>

    <?php endwhile; ?>

    </ul>

<?php endif; ?>
```

### Foreach Loop
This example demonstrates how you can use [get_field](https://www.advancedcustomfields.com/resources/functions/get_field/) function to return all the row data for a repeater field. This is useful for querying the data for a specific row.
```
<?php 

$rows = get_field('repeater_field_name');
if($rows)
{
    echo '<ul>';

    foreach($rows as $row)
    {
        echo '<li>sub_field_1 = ' . $row['sub_field_1'] . ', sub_field_2 = ' . $row['sub_field_2'] .', etc</li>';
    }

    echo '</ul>';
}
```

### Get first row from a Repeater
This example demonstrates how to find the first row from a Repeater and display an image from that row.
```
<?php

$rows = get_field('repeater_field_name' ); // get all the rows
$first_row = $rows[0]; // get the first row
$first_row_image = $first_row['sub_field_name' ]; // get the sub field value 

// Note
// $first_row_image = 123 (image ID)

$image = wp_get_attachment_image_src( $first_row_image, 'full' );
// url = $image[0];
// width = $image[1];
// height = $image[2];
?>
<img src="<?php echo esc_url( $image[0] ); ?>" />
```

### Get random row from a Repeater
This example demonstrates how to find a random row from a Repeater field and display an image from that row.
```
<?php 

$rows = get_field('repeater_field_name' ); // get all the rows
$rand_row = $rows[ array_rand( $rows ) ]; // get a random row
$rand_row_image = $rand_row['sub_field_name' ]; // get the sub field value 

// Note
// $first_row_image = 123 (image ID)

$image = wp_get_attachment_image_src( $rand_row_image, 'full' );
// url = $image[0];
// width = $image[1];
// height = $image[2];
?>
<img src="<?php echo esc_url( $image[0] ); ?>" />
```

## Notes

### Activating Repeater field
The Repeater field is a feature now included in [ACF Pro](https://www.advancedcustomfields.com/pro/).

### Format of data
The Repeater field saves all its data in the `wp_postmeta` table. If your Repeater field is called 'gallery' and contains two sub fields called 'image' and 'description', this would be the database structure of two rows of data:
```
// meta_key                  meta_value
gallery                      2                 // number of rows
gallery_0_image              6                 // sub field value
gallery_0_description        "some text"       // sub field value
gallery_1_image              7                 // sub field value
gallery_1_description        "some text"       // sub field value
```
