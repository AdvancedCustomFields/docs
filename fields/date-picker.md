---
title: Date Picker
category: field-types
group: jQuery
---

## Description
The date picker field provides a jQuery date selection popup.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-picker-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-picker-field-interface.png" alt="A date picker field that allows you to choose a specific date" />
		</a>
		<figcaption>The date picker field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-picker-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-picker-field-settings.png" alt="List of field settings shown when setting up a date picker field" />
		</a>
		<figcaption>The date picker field settings</figcaption>
	</figure>
</div>

## Settings
- **Display Format**  
  The date format that is displayed when selecting a date.

- **Return Format**  
  The date format that is returned when loading the value. Please note that the value is always saved as `Ymd` (YYYYMMDD) in the database.

- **Week Starts On**  
  Specifies the day to start the week on.

## Template usage
The date picker field returns a date string using the *Return Format* Setting.

### Display value
This example demonstrates how to display a date value.
```
<p>Event Date: <?php the_field('date'); ?></p>
```

### Modify value
This example demonstrates how to convert a string date value into a DateTime object.
```
<?php 

// Load field value.
$date_string = get_field('date');

// Create DateTime object from value (formats must match).
$date = DateTime::createFromFormat('Ymd', date_string);

// Output current date in custom format.
?>
<p>Event start date: <?php echo $date->format('j M Y'); ?></p>
<?php 

// Increase by 1 day and output again.
$date->modify('+1 day');	
?>
<p>Event end date: <?php echo $date->format('j M Y'); ?></p>
```

### Query posts sorted in order
This example demonstrates how you can query posts sorted in order of a custom field value.
```
<?php

$posts = get_posts( array(
    'post_type' => 'event',
	'meta_key'  => 'date',
	'orderby'   => 'meta_value_num',
	'order'     => 'ASC',
));

if( $posts ) {
	foreach( $posts as $post ) {
		// Do something.
	}
}
```

### Query posts within date range
This example demonstrates how you can query posts to find events that are currently happening today.
```
<?php 

// Find todays date in Ymd format.
$today = date('Ymd');

// Query posts using a meta_query to compare two custom fields; start_date and end_date.
$posts = get_posts( array(
    'post_type' => 'event',
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
));

if( $posts ) {
	foreach( $posts as $post ) {
		// Do something.
	}
}
```

## Notes

### Database format
The value selected can be returned and displayed in different formats but will be saved to the database as ‘Ymd’. This format is used throughout the WordPress database tables and will allow for straight-foward database querying.

### Date format strings
To customize the 'Display Format' and 'Return Format' settings further, refer to the full list of date format strings within the [PHP date() documentation](http://php.net/manual/en/function.date.php).

### Translations
If you require the date to be displayed in a non English language, WordPress contains a function called [date_i18n()](http://codex.wordpress.org/Function_Reference/date_i18n) which will perform the translation for you.
```
<?php

// Load field value and convert to numeric timestamp.
$unixtimestamp = strtotime( get_field('date') );

// Display date in the format "l d F, Y".
echo date_i18n( "l d F, Y", $unixtimestamp );
```
