---
title: delete_field()
description: Deletes the value of a specific field.
category: functions
group: Update
status: draft
---

## Description
Deletes the value of a specific field.

## Parameters
```
delete_field($selector, [$post_id]);
```
- `$selector`		*(string)*	*(Required)*	The field name or field key.
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(bool)* True on successful delete, false on failure.

## Examples

### Delete via field name
This example shows how to delete the value of a field called 'test' on the current post being viewed.

```
// Delete value.
delete_field('test');
```

### Delete via field key
This example shows how to achieve the same as above using the field's key instead of its name.
```
// Delete value.
delete_field('field_123456');
```

### Delete a value from different objects
This example shows a variety of **$post_id** values to delete a value from a post, user, term and option.
```
$post_id = false; // current post
$post_id = 1; // post ID = 1
$post_id = "user_2"; // user ID = 2
$post_id = "category_3"; // category term ID = 3
$post_id = "event_4"; // event (custom taxonomy) term ID = 4
$post_id = "option"; // options page
$post_id = "options"; // same as above

delete_field( 'my_field', $post_id );
```

### Delete from multiple posts
This example shows how load all posts that contain a custom field (called 'color') and then delete those values from each post. Note that the foreach loop uses a variable called $p instead of $post to avoid any collisions with the global $post object.
```
// Query posts.
$posts = get_posts(array(
	'post_type'			=> 'post',
	'posts_per_page'	=> -1,
	'meta_key' 			=> 'color'
));

// Loop over results and delete.
if( $posts ) {
	foreach( $posts as $p ) {
		delete_field('color', $p->ID);
	}
}
```
