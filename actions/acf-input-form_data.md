---
title: acf/input/form_data
description: Called during the form element when editing a post.
category: actions
status: draft
---

## Description
This action is called on the ‘input’ page within the `form` element. It is helpful in storing hidden inputs, inline scripts and templates. It will always be called if ACF fields appear within the form.

## Changelog
- Added in version 5.0.0

## Example
This example demonstrates how you would use add a hidden input with a specific value to a form. This function accepts 1 parameter.
- `$args` *(array)* The current screen data including `post_id` and nonce.

_Note:_ In the below code, 'action_function_name' needs to be a unique function name.
```
function action_function_name( $args ) {

	echo '<input type="hidden" name="_my_hidden_input" value="TEST_IF_THIS_EXISTS_IN_SAVE_POST"';

}
add_action( 'acf/input/form_data', 'action_function_name', 10, 1 );
```

## Notes
The WYSIWYG field uses this action to append a hidden tinyMCE editor on the form.
