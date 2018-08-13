---
title: the_field()
description: Displays the value of a specific field.
parameters: the_field($selector, [$post_id], [$format_value]);
category: functions
group: Basic
---

## Description
Displays the value of a specific field.

Intuitive and powerful, this function can be used to output the value of any field from any location. Please note this function is the same as `echo get_field();`.

## Parameters
```
the_field($selector, [$post_id], [$format_value]);
```
- `$selector`		*(string)*	*(Required)*	The field name or field key.
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.
- `$format_value`	*(bool)*	*(Optional)*	Whether to apply formatting logic. Defaults to true.

## Example

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

## Related
- Functions: [get_field()](https://www.advancedcustomfields.com/resources/get_field/)
- Getting Started: [Displaying values in your theme](https://www.advancedcustomfields.com/resources/displaying-custom-field-values-in-your-theme/)
- Guides: [Get values from another post](https://www.advancedcustomfields.com/resources/how-to-get-values-from-another-post/)
- Guides: [How to get values from a comment](https://www.advancedcustomfields.com/resources/get-values-comment/)
- Guides: [Adding fields to Media Attachments](https://www.advancedcustomfields.com/resources/adding-fields-media-attachments/)
- Guides: [Adding fields to a taxonomy term](https://www.advancedcustomfields.com/resources/adding-fields-taxonomy-term/)
- Guides: [Get values from a user](https://www.advancedcustomfields.com/resources/how-to-get-values-from-a-user/)
- Guides: [Get values from a widget](https://www.advancedcustomfields.com/resources/get-values-widget/)
- Guides: [Get values from an options page](https://www.advancedcustomfields.com/resources/get-values-from-an-options-page/)
