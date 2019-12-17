---
title: the_repeater_field()
description: Loop through rows of a Repeater field
category: functions
status: draft
deprecated: true
---

## Description
[tip]
This function is outdated. Please use the [have_rows()](https://www.advancedcustomfields.com/resources/have_rows/) function instead.
[/tip]

This function is used in a “while loop” to loop through each row of  a repeater field.  This function requires the [Repeater field](https://www.advancedcustomfields.com/add-ons/repeater-field/).

This function will return either: the current row (continue loop) or false (end of loop).

Within the “while loop”, you can use these functions:
- [get_sub_field](https://www.advancedcustomfields.com/docs/functions/get_sub_field/)
- [the_sub_field](https://www.advancedcustomfields.com/docs/functions/the_sub_field/)

## Change Log
- Deprecated in version 3.3.4
- Added in version 2.0.3

## Parameters
```
the_repeater_field( $field_name, $post_id );
```
- $field_name *(string)* (Required) The name of the Repeater field to be retrieved. e.g. 'gallery_images'
- $post_id *(integer)* Specific post ID where your value was entered. Defaults to current post ID. Can also be options/taxonomies/users/etc.
 
## Examples

### Loop through Repeater field
```
if(get_field('gallery_images')): ?>

    <?php while(the_repeater_field('gallery_images')): ?>
        <img src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('alt'); ?>" />
    <?php endwhile; ?>

 <?php endif;
```

### Loop through Repeater field from another post
This example demonstrates looping through a Repeater field from a different post with the ID of 123.

_Note:_ You don't need to specify the $post_id for any sub field functions.
```
$post_id = 123;
if( get_field('repeater_field_name', $post_id) )
{
    echo '<ul>';

    while( the_repeater_field('repeater_field_name', 5) )
    {
        echo '<li>sub_field_1 = ' . get_sub_field('sub_field_1') . ', sub_field_2 = ' . get_sub_field('sub_field_2') .', etc</li>';
    }

    echo '</ul>';
}
```

### `post_id` examples
The following are examples of different post ID values to apply as the second variable within `the_repeater_field` function.
```
$post_id = null; // current post
$post_id = 1;
$post_id = "option";
$post_id = "options"; // same as above
$post_id = "category_2"; // save to a specific category
$post_id = "event_3"; // save to a specific taxonomy (this tax is called "event")
$post_id = "user_1"; // save to user (user id = 1)
```
