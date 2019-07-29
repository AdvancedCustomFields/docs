---
title: update_field()
description: Updates a field value.
category: functions
group: Update
status: draft
---

## Description
Updates the value of a specific field.

## Parameters
```
update_field($selector, $value, [$post_id]);
```
- `$selector`		*(string)*	*(Required)*	The field name or field key.
- `$value`			*(mixed)*	*(Required)*	The new value.
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(bool)* True on successful update, false on failure.

## Examples

### Updating via field name
This example shows how to update the value of a field called 'views' on the current post being viewed.
```
// Get the current value.
$count = (int) get_field('views');

// Increase it.
$count++;

// Update with new value.
update_field('views', $count);
```

### Updating via field key
This example shows how to achieve the same result as above using the field's key instead of its name. The field's key should be used when saving a **new** value to a post (when no value exists). This helps ACF create the correct 'reference' between the value and the field's settings.

Each value saved in the database is given a 'reference' of the field's key. This allows ACF to connect a value with its field. ACF does this so it can format values when loaded based of the field type and settings. For example, the image field contains a setting to return an array of image data instead of the attachment ID.
```
// Get the current value.
$count = (int) get_field('field_123456');

// Increase it.
$count++;

// Update with new value.
update_field('field_123456', $count);
```

### Update a value from different objects
This example shows a variety of **$post_id** values to update a value from a post, user, term and option.
```
$post_id = false; // current post
$post_id = 1; // post ID = 1
$post_id = "user_2"; // user ID = 2
$post_id = "category_3"; // category term ID = 3
$post_id = "event_4"; // event (custom taxonomy) term ID = 4
$post_id = "option"; // options page
$post_id = "options"; // same as above

update_field( 'my_field', 'my_value', $post_id );
```

### Saving values to a new post.
This example will demonstrate how to create a new post, and save multiple field values to it.
```
// Create new post.
$post_data = array(
	'post_title'	=> 'My post',
	'post_type'		=> 'post',
	'post_status'	=> 'publish'
);
$post_id = wp_insert_post( $post_data );

// Save a basic text value.
$field_key = "field_123456";
$value = "some new string";
update_field( $field_key, $value, $post_id );

// Save a checkbox or select value.
$field_key = "field_1234567";
$value = array("red", "blue", "yellow");
update_field( $field_key, $value, $post_id );

// Save a repeater field value.
$field_key = "field_12345678";
$value = array(
	array(
		"sub_field_1"	=> "Foo",
		"sub_field_2"	=> "Bar"
	)
);
update_field( $field_key, $value, $post_id );

// Save a flexible content field value.
$field_key = "field_123456789";
$value = array(
	array( "sub_field_1" => "Foo1", "sub_field_2" => "Bar1", "acf_fc_layout" => "layout_1_name" ),
	array( "sub_field_x" => "Foo2", "sub_field_y" => "Bar2", "acf_fc_layout" => "layout_2_name" )
);
update_field( $field_key, $value, $post_id );
```

## Notes

### No change detected
If the value passed to this function is the same as the value that is already in the database, this function returns false.
