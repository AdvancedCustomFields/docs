---
title: acf/input/form_data
description: Fires after ACF generates the hidden inputs required for each form.
category: actions
---

## Description
Used to output additional HTML within the hidden `<div id="acf-form-data">` element.

This element is output within each form, and includes hidden inputs used to process the form data.

## Parameters
```
do_action( 'acf/form_data', $data );
```
- `$data` *(array)* The current form data including "screen", "post_id" and "nonce".

## Changelog
- Added in version 5.0.0

## Example
This example demonstrates how to output a hidden input, and then later perform an action depending on that value.

#### functions.php
```
add_action('acf/input/form_data', 'my_acf_input_form_data');
function my_acf_input_form_data( $data ) {
	echo '<input type="hidden" name="_my_hidden_input" value="123" />';
}

add_action('acf/save_post', 'my_acf_save_post');
function my_acf_save_post( $post_id ) {
	if( isset($_POST['_my_hidden_input']) ) {
		// Do something.
	}
}
```