---
title: get_field()
description: Returns the value of a specific field.
parameters: get_field($selector, [$post_id], [$format_value]);
category: functions
group: Basic
---

## Description
Returns the value of a specific field.

Intuitive and powerful (much like ACF itself ?), this function can be used to load the value of any field from any location. Please note that each field type returns different forms of data (string, int, array, etc).

## Parameters
```
get_field($selector, [$post_id], [$format_value]);
```
- `$selector`		*(string)*	*(Required)*	The field name or field key.
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.
- `$format_value`	*(bool)*	*(Optional)*	Whether to apply formatting logic. Defaults to true.

## Example

### Get a value from the current post
This example shows how to load the value of field ‘text_field’ from the current post.
```
$value = get_field( "text_field" );
```

### Get a value from a specific post
This example shows how to load the value of field ‘text_field’ from the post with ID = 123.
```
$value = get_field( "text_field", 123 );
```

### Check if value exists
This example shows how to check if a value exists for a field.
```
$value = get_field( "text_field" );

if( $value ) {
    echo $value;
} else {
    echo 'empty';
}
```

### Get a value from different objects
This example shows a variety of **$post_id** values to get a value from a post, user, term and option.
```
$post_id = false; // current post
$post_id = 1; // post ID = 1
$post_id = "user_2"; // user ID = 2
$post_id = "category_3"; // category term ID = 3
$post_id = "event_4"; // event (custom taxonomy) term ID = 4
$post_id = "option"; // options page
$post_id = "options"; // same as above

$value = get_field( 'my_field', $post_id );
```

### Get a value without formatting
In this example, the field "image" is an image field which would normally return an Image object.
However, by passing false as a 3rd parameter to the get_field function, the value is never formatted and returned as is from the Database.

Please note the second parameter is set to **false** to target the current post.
```
$image = get_field('image', false, false);
```

## Related
- Functions: [the_field()](https://www.advancedcustomfields.com/resources/the_field/)
- Getting Started: [Displaying values in your theme](https://www.advancedcustomfields.com/resources/displaying-custom-field-values-in-your-theme/)
- Guides: [Get values from another post](https://www.advancedcustomfields.com/resources/how-to-get-values-from-another-post/)
- Guides: [How to get values from a comment](https://www.advancedcustomfields.com/resources/get-values-comment/)
- Guides: [Adding fields to Media Attachments](https://www.advancedcustomfields.com/resources/adding-fields-media-attachments/)
- Guides: [Adding fields to a taxonomy term](https://www.advancedcustomfields.com/resources/adding-fields-taxonomy-term/)
- Guides: [Get values from a user](https://www.advancedcustomfields.com/resources/how-to-get-values-from-a-user/)
- Guides: [Get values from a widget](https://www.advancedcustomfields.com/resources/get-values-widget/)
- Guides: [Get values from an options page](https://www.advancedcustomfields.com/resources/get-values-from-an-options-page/)
