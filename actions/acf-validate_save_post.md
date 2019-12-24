---
title: acf/validate_save_post
description: Called when validating `$_POST` data.
category: actions
status: draft
---

## Description
Used to review `$_POST` data and add validation errors.

This action is fired during the validation process (triggered when publishing a post).

If you are looking for a filter to validate a _specific_ field, please use [acf/validate_value](https://www.advancedcustomfields.com/resources/acf-validate_value/).

## Changelog
- Added in version 5.0.0

## Example
This example demonstrates how the action could be used to bypass validation for an administrator.

Adding a validation error is done via the `acf_add_validation_error( $input, $message = '')` function. It accepts two parameters: the input's name attribute (used by JavaScript to match the message to the correct HTML element) and the message string.

Removing validation errors is done via the `acf_reset_validation_errors()` function.

#### functions.php
```
add_action('acf/validate_save_post', 'my_acf_validate_save_post', 10, 0);
function my_acf_validate_save_post() {

	// Check if user is an administrator.
	if( current_user_can('manage_options') ) {

		// Clear all errors.
		acf_reset_validation_errors();
	}

	// Check custom $_POST data.
	if( empty($_POST['my_input']) ) {
		acf_add_validation_error( 'my_input', 'Please check this input to proceed' );
	}
}
```
