---
title: User
category: field-types
group: Relational
status: draft
---

## Description

The User field allows the selection of one or more users. 

This field type is useful for creating relationships between data objects. It stores its value as the WP_User ID, and can return the full WP_User data on retrieval.

## Screenshots

<figure>
	<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-user-field-interface.png" alt="acf-user-field-interface" />
	<figcaption>The User field interface</figcaption>
</figure>

<figure>
	<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-user-field-settings.png" alt="acf-user-field-settings" />
	<figcaption>The User field settings</figcaption>
</figure>

## Changelog
- Test

## Settings
- **Filter by role**  
  (String|Array) Filters the available users by one or more user roles. Defaults to an empty string.
  ```
  'role' => '',
  ```
  
- **Select Multiple**  
  (bool) Allows multiple values to be selected. Defaults to false.
  ```
  'multiple' => false,
  ```
  
- **Allow Null**  
  (bool) Allows an empty value to be saved. Defaults to false.
  ```
  'allow_null' => false,
  ```
  
- **Return Format**  
  (string) Specifies the returned value format. Defaults to 'array'.
  **User Array** will return an array of user data.
  **User Object** will return the WP_User object.
  **User ID** will return the user ID.
  ```
  'return_format' => 'array',
  ```

## Template usage

### Display a single selected user.
This example demonstrates how to display a selected user ('multiple' = false, return_format = 'array').
```
<?php
$user = get_field("user_field");
if( $user ): ?>
<div class="author-box">
	<img src="<?php echo esc_attr($user['user_avatar']); ?>" alt="author-avatar" />
	<h3><?php echo $user['display_name']; ?></h3>
	<?php if( $user['user_description'] ): ?>
		<p><?php echo $user['user_description']; ?></p>
	<?php endif; ?>
</div>
<?php endif; ?>
```

### Display multiple selected users.
This example demonstrates how to display multiple selected users in a list. ('multiple' = true, return_format = 'object').
```
<?php
$users = get_field("volunteers");
if( $users ): ?>
<ul class="volunteers-list">
	<?php foreach( $users as $user ): ?>
		<li>
			<img src="<?php echo esc_attr( get_avatar($user->ID) ); ?>" alt="author-avatar" />
			<a href="<?php echo esc_attr($user->user_url); ?>"><?php echo $user->display_name; ?></a>
		</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
```