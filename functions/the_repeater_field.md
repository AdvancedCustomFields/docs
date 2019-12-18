---
title: the_repeater_field()
description: Loops through rows of a Repeater field.
category: functions
status: draft
deprecated: true
---

## Description
[tip]
This function is deprecated. Please use the [have_rows()](https://www.advancedcustomfields.com/resources/have_rows/) function instead.
[/tip]

This function is used within a while-loop to loop through each row of a repeater field.

Unlike `have_rows()`, this function will step through each row by itself, causing undesired results when also used within an if-statment.

## Parameters
```
the_repeater_field( $field_name, $post_id );
```
- `$field_name`	*(string)*	*(Required)*	The name of the Repeater field to be retrieved. e.g. 'gallery_images'
- `$post_id`	*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(bool)* True if a row exists.

## Change Log
- Deprecated in version 3.3.4
- Added in version 2.0.3

## Requirements
- [Repeater field Add-on](https://www.advancedcustomfields.com/add-ons/repeater-field/) version 1.0.0 or later.

## Examples

### Loop through Repeater field
This example demonstrates how to loop through a repeater field called "gallery_images".
```
<?php if( get_field('gallery_images') ): ?>
    <?php while( the_repeater_field('gallery_images') ): ?>
        <img src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('alt'); ?>" />
    <?php endwhile; ?>
 <?php endif;
```

### Loop through Repeater field from another post
This example demonstrates looping through a Repeater field from a different post with the ID of 123.

_Note:_ You don't need to specify the `$post_id` for any sub field functions.
```
<?php
if( get_field('repeater_field_name', 123) ) {
    echo '<ul>';
    while( the_repeater_field('repeater_field_name', 123) ) {
        echo '<li>sub_field_1 = ' . get_sub_field('sub_field_1') . ', sub_field_2 = ' . get_sub_field('sub_field_2') .', etc</li>';
    }
    echo '</ul>';
}
```