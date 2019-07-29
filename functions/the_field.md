---
title: the_field()
description: Displays the value of a specific field.
parameters: the_field($selector, [$post_id], [$format_value]);
category: functions
group: Basic
---

## Description
Displays the value of a specific field.

Intuitive and powerful, this function can be used to output the value of any field from any location. Please note this function is the same as `echo get_field()`.

## Parameters
```
the_field($selector, [$post_id], [$format_value]);
```
- `$selector`		*(string)*	*(Required)*	The field name or field key.
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.
- `$format_value`	*(bool)*	*(Optional)*	Whether to apply formatting logic. Defaults to true.

## Examples

### Display a value from the current post
This example shows how to display the value of field "text_field" from the current post.
```
<h2><?php the_field('text_field'); ?></h2>
```

### Display a value from a specific post
This example shows how to display the value of field "text_field" from the post with ID = 123.
```
<h2><?php the_field('text_field', 123); ?></h2>
```

### Check if value exists
This example shows how to check if a value exists before displaying it.
```
<?php if( get_field('text_field') ): ?>
	<h2><?php the_field('text_field'); ?></h2>
<?php endif; ?>
```

### Get a value from different objects
This example shows a variety of valid **$post_id** values that specify where the value is saved.
```
$post_id = false;			// current post
$post_id = 123;				// post ID = 123
$post_id = "user_123";		// user ID = 123
$post_id = "term_123";		// term ID = 123
$post_id = "category_123";	// same as above
$post_id = "option";		// options page
$post_id = "options";		// same as above

the_field( 'my_field', $post_id );
```
