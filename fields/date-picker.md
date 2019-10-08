---
title: Date Picker
category: field-types
group: jQuery
status: draft
---

## Description
The date picker field creates a jQuery date selection popup. This field is useful for setting dates to use in your theme. (eg. An event’s start and end date.)

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-picker-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-picker-field-interface.png" alt="acf-user-field-interface" />
		</a>
		<figcaption>The date picker field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-picker-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-picker-field-settings.png" alt="acf-user-field-settings" />
		</a>
		<figcaption>The date picker field settings</figcaption>
	</figure>
</div>

## Settings
- **Display Format**  
  The date format that is displayed when selecting a date.

- **Return Format**  
  The date format that is returned when loading the value. Please note that the value is always saved as YYYYMMDD in the database.

- **Week Starts On**  
  Specifies the day to start the week on.

## Template usage
The date picker field will return a string containing your date value in the format provided in the field’s settings. Below are examples using a date picker field named 'date'.

### Display value
This example demonstrates how to display a date value.
```
<p>Event Date: <?php the_field('date'); ?></p>
```

### Converting and customizing value
This example demonstrates how to get the raw value (saved in format YYYYMMDD) and convert it to a numeric value to then modify it further.
```
<?php 

// Get raw date.
$date = get_field('date', false, false);


// Make date object.
$date = new DateTime( $date );

?>
<p>Event start date: <?php echo $date->format('j M Y'); ?></p>
<?php 

// Increase by 1 day.
$date->modify('+1 day');
	
?>
<p>Event end date: <?php echo $date->format('j M Y'); ?></p>
```

### Order posts
This example demonstrates how you can sort and order a WordPress posts query by a custom field.
```
<?php 

// Get posts.
$posts = get_posts(array(
	'post_type' => 'event',
	'meta_key'  => 'date',
	'orderby'   => 'meta_value_num',
	'order'     => 'ASC',
));


// Loop through results.
if( $posts ) {
	
	foreach( $posts as $post ) {
		
		setup_postdata( $post );

		// Do something.

	}

	wp_reset_postdata();
}

?>
```

### Query posts by date
This example demonstrates how you can use the `WP_Query` object to find posts where a ‘start_date’ and ‘end_date’ indicate that the post is ‘active’ (today is between the start and end dates).
```
<?php 

$today = date('Ymd');

$args = array (
    'post_type' => 'post',
    'meta_query' => array(
		array(
	        'key'     => 'start_date',
	        'compare' => '<=',
	        'value'   => $today,
	    ),
	     array(
	        'key'     => 'end_date',
	        'compare' => '>=',
	        'value'   => $today,
	    )
    ),
);

// Get posts.
$posts = get_posts( $args );
?>
```

## Notes

### Translations
If you require the date to be displayed in a non English language, WordPress contains a function called [date_i18n()](http://codex.wordpress.org/Function_Reference/date_i18n) which will perform the translation for you.
```
<?php

$dateformatstring = "l d F, Y";
$unixtimestamp = strtotime(get_field('date'));

echo date_i18n( $dateformatstring, $unixtimestamp );

?>
```
