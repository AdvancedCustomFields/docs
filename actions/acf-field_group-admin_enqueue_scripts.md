---
title: acf/field_group/admin_enqueue_scripts
description: Called during the 'enqueue_scripts' action when editing a field group.
category: actions
status: draft
---

## Description
This action is called on all pages where field groups are edited.

This function is similar to admin_enqueue_scripts except it is _only_ for the ACF field group page.

## Example

### Editing styles
This example demonstrates how to use this action to enqueue styles.

_Note:_ You can also use this action to register / deregister / dequeue styles.
```
function my_acf_field_group_admin_enqueue_scripts() {
	wp_enqueue_style( 'myStylesheet' );
}

add_action('acf/field_group/admin_enqueue_scripts', 'my_acf_field_group_admin_enqueue_scripts');
```
