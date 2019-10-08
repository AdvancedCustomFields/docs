---
title: Date Time Picker
category: field-types
group: jQuery
status: draft
---

## Description
The date time picker field creates a jQuery date & time selection popup. This field is useful for setting specific dates & times to use in your theme. (eg. An event’s start and end date & time.)

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-time-picker-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-time-picker-interface.png" alt="A time date field that allows you to choose a specific date and time" />
		</a>
		<figcaption>The date time picker field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-time-picker-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-date-time-picker-settings.png" alt="List of field settings shown when setting up a date time picker field" />
		</a>
		<figcaption>The date time picker field settings</figcaption>
	</figure>
</div>

## Changelog
- Added in version 5.3.9.

## Settings
- **Display Format**  
  The date format that is displayed when selecting a date.

- **Return Format**  
  The date format that is returned when loading the value.

- **Week Starts On**  
  Specifies the day to start the week on.

## Template usage
The date time picker field will return a string containing your date-time value in the format chosen in the field’s settings.

### Display value
This example demonstrates how to display a date-time value.
```
<p>Event starts: <?php the_field('start_date'); ?></p>
```

### Query posts
This example demonstrates how to query and loop over events ordered by a custom date time field value.
```
<?php

// Query events order.
$posts = get_posts(array(
	'posts_per_page' => -1,
	'post_type'      => 'event',
	'order'          => 'ASC',
	'orderby'        => 'meta_value',
	'meta_key'       => 'start_date',
	'meta_type'      => 'DATETIME',
));

if( $posts ): ?>

	<h2>All Events</h2>
	<ul id="events">
		<?php foreach( $posts as $p ): ?>
			<li>
				<strong><?php echo $p->post_title; ?></strong>: <?php the_field('start_date', $p->ID); ?> -  <?php the_field('end_date', $p->ID); ?>
			</li>	
		<?php endforeach; ?>
	</ul>

<?php endif; ?>
```

### Query current posts
This example demonstrates how to query and loop over events which are currently running (they have started, but not yet ended) ordered by a custom date time field value.

When working with the [meta_query array](https://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters), remember that WordPress reads this as `$meta $compare $value` (eg. ‘start_date’ < $now and/or ‘end_date’ > $now).
```
<?php

// Find current date time.
$date_now = date('Y-m-d H:i:s');

// Query events.
$posts = get_posts(array(
	'posts_per_page'   => -1,
	'post_type'        => 'event',
	'meta_query'       => array(
		'relation'          => 'AND',
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
	'order'           => 'ASC',
	'orderby'         => 'meta_value',
	'meta_key'        => 'start_date',
	'meta_type'       => 'DATE',
));

if( $posts ): ?>

	<h2>Events on right now</h2>
	<ul id="events">
		<?php foreach( $posts as $p ): ?>
			<li>
				<strong><?php echo $p->post_title; ?></strong>: <?php the_field('start_date', $p->ID); ?> -  <?php the_field('end_date', $p->ID); ?>
			</li>	
		<?php endforeach; ?>
	</ul>

<?php endif; ?>
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

if( $posts ): ?>

	<h2>Upcoming events this week</h2>
	<ul id="events">
		<?php foreach( $posts as $p ): ?>
			<li>
				<strong><?php echo $p->post_title; ?></strong>: <?php the_field('start_date', $p->ID); ?> -  <?php the_field('end_date', $p->ID); ?>
			</li>	
		<?php endforeach; ?>
	</ul>

<?php endif; ?>
```

### Save as unix timestamp
This example demonstrates how to change the value saved from the standard ‘Y-m-d H:i:s’ string to a unix timestamp number. This may be necessary to maintain compatibility with 3rd party date time picker fields.
```
<?php 

add_filter('acf/update_value/type=date_time_picker', 'my_update_value_date_time_picker', 10, 3);

function my_update_value_date_time_picker( $value, $post_id, $field ) {
	
	return strtotime( $value );
	
}

?>
```

## Notes

### Database format
The value selected can be returned and displayed in different formats but will be saved to the database as ‘Y-m-d H:i:s’. This format is used throughout the WordPress database tables and will allow for straight-foward database querying.

### Date format strings
To customize the 'Display Format' and 'Return Format' settings further, refer to the full list of date format strings within the [PHP date() documentation](http://php.net/manual/en/function.date.php).
