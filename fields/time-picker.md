---
title: Time Picker
category: field-types
group: jQuery
status: draft
---

## Description
The Time Picker field creates a jQuery time selection popup.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-time-picker-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-time-picker-field-interface.png" alt="A time picker field that allows you to choose a specific time" />
		</a>
		<figcaption>The Time Picker field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-time-picker-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-time-picker-field-settings.png" alt="List of field settings shown when setting up a time picker field" />
		</a>
		<figcaption>The Time Picker field settings</figcaption>
	</figure>
</div>

## Changelog
- Added in version 5.3.9.

## Settings
- **Display Format**  
  The time format that is displayed when selecting a date.
  
- **Return Format**  
  The time format that is returned when loading the value.

## Template usage
The Time Picker field returns a string value using the _Return Format_ setting.

### Display value
This example demonstrates how to display a time value.
```
<p>Monday: <?php the_field('monday_open_time'); ?> - <?php the_field('monday_close_time'); ?></p>
```

### Query posts within time range 
This example demonstrates how to query posts for all stores that are open.

It assumes a custom post type called 'store' exists with a custom field for each day's open and close time in the following naming convention: 'monday_open_time', 'monday_close_time', 'tuesday_open_time', etc.

When working with the [meta_query array](https://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters), remember that WordPress reads this as `$meta $compare $value` (‘monday_open_time’ < $time)
```
<?php

// Find today's day of the week.
$today = date('l');
$today = strtolower( $today );

// Find current time.
$time = date('H:i:s'); 

// Query events using custom fields in meta_query.
$posts = get_posts(array(
	'posts_per_page'	=> -1,
	'post_type'			=> 'store',
	'meta_query' 		=> array(
		'relation' 			=> 'AND',
		array(
	        'key'			=> $today.'_open_time',
	        'compare'		=> '<=',
	        'value'			=> $time,
	        'type'			=> 'TIME'
	    ),
	    array(
	        'key'			=> $today.'_close_time',
	        'compare'		=> '>=',
	        'value'			=> $time,
	        'type'			=> 'TIME'
	    )
    )
));

if( $posts ): ?>

	<h2>Stores open now</h2>
	<ul id="events">
		<?php foreach( $posts as $p ): ?>
			<li>
				<strong><?php echo $p->post_title; ?></strong>: 
				<?php echo $today; ?> <?php the_field( $today.'_open_time', $p->ID ); ?> -  <?php the_field( $today.'_close_time', $p->ID ); ?>
			</li>	
		<?php endforeach; ?>
	</ul>

<?php endif; ?>
```

## Notes

### Database format
The value selected can be returned and displayed in different formats but will be saved to the database as ‘H:i:s’. This format is used throughout the WordPress database tables and will allow for straight-foward database querying.

### Time format strings
To customize the _Display Format_ and _Return Format_ settings further, refer to the full list of time format strings within the [PHP date() documentation](http://php.net/manual/en/function.date.php).
