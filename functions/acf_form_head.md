---
title: acf_form_head()
description: Validates and saves data submitted from an acf_form().
category: functions
---

## Description
Used to process, validate and save the submitted form data created by the [acf_form()](https://www.advancedcustomfields.com/resources/acf_form/) function. It will also enqueue all ACF related scripts and styles for the form to display correctly.

This function must be placed before any HTML has been output, preferably above the `get_header()` function of your theme file.

## Parameters
```
acf_form_head();
```

## Example
This example demonstrates a basic `acf_form()` to edit the current post being viewed.
```
<?php acf_form_head(); ?>
<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php acf_form(); ?>
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
```

## Actions & Filters
The following actions and filters are provided to customize the submission process.

-	**acf/pre_submit_form**  
	This filter is run after a form has been submit, and before any data has been saved. 
	Use this filter to modify the `$form` array before `$_POST` data is saved.
	```
	add_filter('acf/pre_submit_form', 'my_acf_pre_submit_form', 10, 1);
	function my_acf_pre_submit_form( $form ) {
		// Create post using $form['new_post'].
		// Modify $form['redirect'].
		return $form;
	}
	```

-	**acf/pre_save_post**  
	This filter is run after the *acf/pre_submit_form* filter, and before any data has been saved.
	Use this filter to modify the `$post_id` value used to save the `$_POST` data.
	```
	add_filter('acf/pre_save_post', 'my_acf_pre_save_post', 10, 2);
	function my_acf_pre_save_post( $post_id, $form ) {
		// Create post using $form and update $post_id.
		return $post_id;
	}
	```

-	**acf/save_post**  
	This action runs when ACF saves the `$_POST` data.
	For more information, please refer to the [acf/save_post](https://www.advancedcustomfields.com/resources/acf-save_post) guide.
	```
	add_action('acf/save_post', 'my_acf_save_post', 20);
	function my_acf_save_post( $post_id ) {
	
		// Get new value.
		$value = get_field('my_field', $post_id);
	
		// Do something.
	}	
	```

-	**acf/submit_form**  
	This action runs after the `$_POST` data has been saved. 
	Use this action to perform custom logic before the *return* setting is used to redirect the browser.
	```
	add_action('acf/submit_form', 'my_acf_submit_form', 10, 2);
	function my_acf_submit_form( $form, $post_id ) {
	
		// Get new value.
		$value = get_field('my_field', $post_id);
	
		// Redirect.
		wp_redirect( 'http://www.website.com/' . $value );
		exit;
	}
	```

## Changelog
- `acf/pre_submit_form` added in version 5.5.10
- `acf/submit_form` added in version 5.5.10
- `acf/pre_save_post` added in version 4.1.6
