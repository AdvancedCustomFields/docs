---
title: get_fields()
description: Returns an array of field values (name => value) for a specific post.
category: functions
group: Basic
---

## Description
Returns an array of field values (name => value) for a specific post.

## Parameters
```
get_fields([$post_id], [$format_value]);
```
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.
- `$format_value`	*(bool)*	*(Optional)*	Whether to apply formatting logic. Defaults to true.

## Examples

### Get values from the current post
This example shows how to display all fields (name and value) in a list from the current post.
```
<?php 

$fields = get_fields();

if( $fields ): ?>
	<ul>
		<?php foreach( $fields as $name => $value ): ?>
			<li><b><?php echo $name; ?></b> <?php echo $value; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
```

### Get values from a specific post
This example shows how to load all fields (name and value) from different data objects.
```
// Get values from the current post.
$fields = get_fields();

// Get values from post ID = 1.
$post_fields = get_fields( 1 );

// Get values from user ID = 2.
$user_fields = get_fields( 'user_2' );

// Get values from category ID = 3.
$term_fields = get_fields( 'term_3' );

// ... or using taxonomy name.
$term_fields = get_fields( 'category_3' );

// Get values from comment ID = 4.
$comment_fields = get_fields( 'comment_4' );

// Get values from ACF Options page.
$option_fields = get_fields( 'options' );

// ... or using 'option'.
$option_fields = get_fields( 'option' );
```

### Get values without formatting
This example shows how to load all fields (name and value) without any formatting applied.

Formatting refers to how the values are modified after being loaded from the database. For example, an image field value is saved into the database as just the attachment ID but can be returned as a URL depending on the field's settings.

In some cases it may be useful to ensure only the raw value is returned regardless of field settings. To do this, we use the `$format_value` parameter.
```
$fields = get_fields( 123, false );
```