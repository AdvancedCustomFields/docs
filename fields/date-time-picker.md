---
title: Date Time Picker
category: field-types
group: jQuery
---

## Description
The Date Time Picker field creates a jQuery date & time selection popup.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-time-picker-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-time-picker-interface.png" alt="A time date field that allows you to choose a specific date and time" />
		</a>
		<figcaption>The Date Time Picker field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-time-picker-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-time-picker-settings.png" alt="List of field settings shown when setting up a date time picker field" />
		</a>
		<figcaption>The Date Time Picker field settings</figcaption>
	</figure>
</div>

## Changelog
- Added in version 5.3.9.

## Settings
- **Display Format**  
  The date format that is displayed when selecting a date.
  
- **Return Format**  
  The date format that is returned when loading the value. Please note that the value is always saved as `Y-m-d H:i:s` (YYYY-MM-DD HH:II:SS) in the database.
  
- **Week Starts On**  
  Specifies the day to start the week on.

## Template usage
The Date Time Picker field returns a date-time string using the _Return Format_ setting.

### Display value
This example demonstrates how to display a date-time value.
```
<p>Event starts: <?php the_field('start_date'); ?></p>
```

### Query posts sorted in order
This example demonstrates how you can query posts sorted in order of a custom field value.
```
<?php

$posts = get_posts( array(
    'posts_per_page' => -1,
	'post_type'      => 'event',
	'order'          => 'ASC',
	'orderby'        => 'meta_value',
	'meta_key'       => 'start_date',
	'meta_type'      => 'DATETIME',
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
$date_now = date('Y-m-d H:i:s');

// Query posts using a meta_query to compare two custom fields; start_date and end_date.
$posts = get_posts( array(
    'post_type' => 'event',
    'meta_query' => array(
		array(
	        'key'           => 'start_date',
	        'compare'       => '<=',
	        'value'         => $date_now,
	        'type'          => 'DATETIME',
	    ),
	    array(
	        'key'           => 'end_date',
	        'compare'       => '>=',
	        'value'         => $date_now,
	        'type'          => 'DATETIME',
	    )
    ),
));

if( $posts ) {
	foreach( $posts as $post ) {
		// Do something.
	}
}
```

### Query upcoming posts
This example demonstrates how to query and loop over upcoming events (in the next 7 days) ordered by a custom date time field value.
```
<?php

// Find current date time.
$date_now = date('Y-m-d H:i:s');
$time_now = strtotime($date_now);

// Find date time in 7 days.
$time_next_week = strtotime('+7 day', $time_now);
$date_next_week = date('Y-m-d H:i:s', $time_next_week);

// Query events.
$posts = get_posts(array(
	'posts_per_page' => -1,
	'post_type'      => 'event',
	'meta_query'     => array(
		array(
	        'key'         => 'start_date',
	        'compare'     => 'BETWEEN',
	        'value'       => array( $date_now, $date_next_week ),
	        'type'        => 'DATETIME'
	    )
    ),
	'order'          => 'ASC',
	'orderby'        => 'meta_value',
	'meta_key'       => 'start_date',
	'meta_type'      => 'DATETIME'
));

if( $posts ) {
	foreach( $posts as $post ) {
		// Do something.
	}
}
```

### Save as unix timestamp
This example demonstrates how to change the value saved from the standard ‘Y-m-d H:i:s’ string to a unix timestamp number. This may be necessary to maintain compatibility with third party date time picker fields.
```
<?php 

add_filter('acf/update_value/type=date_time_picker', 'my_update_value_date_time_picker', 10, 3);

function my_update_value_date_time_picker( $value, $post_id, $field ) {
	return strtotime( $value );
}
```

## Notes

### Database format
The value selected can be returned and displayed in different formats but will be saved to the database as ‘Y-m-d H:i:s’. This format is used throughout the WordPress database tables and will allow for straight-foward database querying.

### Date format strings
To customize the _Display Format_ and _Return Format_ settings further, refer to the full list of date format strings within the [PHP date() documentation](http://php.net/manual/en/function.date.php).

### Translations
If you require the date to be displayed in a non English language, WordPress contains a function called [date_i18n()](http://codex.wordpress.org/Function_Reference/date_i18n) which will perform the translation for you.
```
<?php

// Load field value and convert to numeric timestamp.
$unixtimestamp = strtotime( get_field('date') );

// Display date in the format "l d F, Y".
echo date_i18n( "l d F, Y", $unixtimestamp );
```
