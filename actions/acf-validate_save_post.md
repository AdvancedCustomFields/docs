---
title: acf/validate_save_post
description: Fires when validating `$_POST` data.
category: actions
---

## Description
Fires when validating the `$_POST` data of a submitted form.

Used to add or remove validation errors controlling whether or not the submitted data will be saved.

Please note this is a generic action. If you are looking to validate a *specific* field value, please use [acf/validate_value](https://www.advancedcustomfields.com/resources/acf-validate_value/) filter instead.

## Changelog
- Added in version 5.0.0

## Example
This example demonstrates how to bypass validation for an administrator, and also to require a custom input value. See the notes section below for additional information on the functions used.

#### functions.php
```
add_action('acf/validate_save_post', 'my_acf_validate_save_post');
function my_acf_validate_save_post() {

	// Remove all errors if user is an administrator.
	if( current_user_can('manage_options') ) {
		acf_reset_validation_errors();
	}

	// Require custom input value.
	if( empty($_POST['my_input']) ) {
		acf_add_validation_error( 'my_input', 'Please check this input to proceed' );
	}
}
```
	
## Notes

### Additional Functions
The following additional functions are made available during this action.

-	**acf_add_validation_error()**  
	Adds a validation error and prevents the submitted data from being saved.
	```
	acf_add_validation_error($input, [$message])
	```
	- `$input`		*(string)*	*(Required)*	The input's name attribute, used by JavaScript to target an element.
	- `$message`	*(string)*	*(Optional)*	The error message to display.

-	**acf_reset_validation_errors()**  
	Removes all validation errors and allows the submitted data to be saved.
	```
	acf_reset_validation_errors()
	```