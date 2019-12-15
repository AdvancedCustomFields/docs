---
title: acf/save_post
description: Called when saving `$_POST` data.
category: actions
---

## Description
This action is called when saving the submitted `$_POST` data.

This action allows you to hook in **before** or **after** the data has been saved. Therefore, it is important to note that the `get_field()` function will return different values at these times.

## Parameters
```
do_action( 'acf/save_post', $post_id );
```
- `$post_id` *(int|string)* The ID of the item (post, user, term, etc) being saved.

## Changelog
- Data changed from `$_POST['fields']` to `$_POST['acf']` in version 5.0.0
- Introduced in version 4.0.0

## Examples

### Hooking in before data has been saved.
This example shows how to hook into the `acf/save_post` action before ACF has saved the `$_POST` data. This is possible by using a priority less than 10.

#### functions.php
```
function my_acf_save_post( $post_id ) {
    
    // Bail early if no data sent.
    if( empty($_POST['acf']) ) {
        return;
    }
    
    // Do something with all values.
    $values = $_POST['acf'];
    // ...
    
    // Check if a specific value was sent.
    if( isset($_POST['acf']['field_abc123']) ) {
	    // ...
	}
}

add_action('acf/save_post', 'my_acf_save_post', 5);
```

### Hooking in after data has been saved.
This example shows how to hook into the `acf/save_post` action after ACF has saved the `$_POST` data. This is possible by using a priority greater than 10.

#### functions.php
```
function my_acf_save_post( $post_id ) {

    // Do something with all values.
    $values = get_fields( $post_id );
    // ...
    
    // Check if a specific value was sent.
    if( get_field('hero_image', $post_id) ) {
	    // ...
	}
}

add_action('acf/save_post', 'my_acf_save_post', 15);
```

## Notes

### Parameters
Unlike the WP [save_post](https://codex.wordpress.org/Plugin_API/Action_Reference/save_post) action, this function does not contain the `$post` and `$updated` parameters. If you require access to these parameters, consider using the WP save_post action instead.
