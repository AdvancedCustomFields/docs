---
title: acf_form()
description: Creates a front end form.
category: functions
status: draft
---

## Description
Creates a `<form>` to add or edit a post. There are many settings available to customize the form and these are set by adding to the `$options` array as explained below. You may also register a form using the [acf_register_form()](https://www.advancedcustomfields.com/resources/acf_register_form/) function.

## Parameters
```
<?php acf_form( $settings ); ?>
```

### $settings
*(String | Array)* Array of settings or 'id' of a registered form.
- **id**
  (String) A unique identifier for the form. Defaults to 'acf-form'.
  ```
  'id' => 'acf-form',
  ```
 
- **post_id**
  (Integer | String) The post ID to load data from and save data to. Defaults to current post ID. Can also be sent to 'new_post' to create a new post on submit.
  ```
  'post_id' => false,
  ```
 
- **new_post**
  (Array) An array of post data used to create a post. See [wp_insert_post](https://developer.wordpress.org/reference/functions/wp_insert_post/) for available parameters.
  The above `post_id` setting must contain a value of 'new_post'.
  ```
  'new_post' => false,
  ```
 
- **field_groups**
  (Array) An array of field group IDs/keys to override the fields displayed in this form.
  ```
  'field_groups' => false,
  ```
 
- **fields**
  (Array) An array of field IDs/keys to override the fields displayed in this form.
  ```
  'fields' => false,
  ```
 
- **post_title**
  (Boolean) Whether or not to show the post title text field. Defaults to false.
  ```
  'post_title' => false,
  ```
 
- **post_content**
  (Boolean) Whether or not to show the post content editor field. Defaults to false.
  ```
  'post_content' => false,
  ```
 
- **form**
  (Boolean) Whether or not to create a `form` element. Useful when adding to an existing form. Defaults to true.
  ```
  'form' => true,
  ```
 
- **form_attributes**
  (Array) An array or HTML attributes for the form element.
  ```
  'form_attributes' => array(),
  ```
 
- **return**
  (String) The URL to be redirected to after the form is submitted. Defaults to the current URL with a GET parameter '?updated=true'.
  A special placeholder '%post_url%' will be converted to post's permalink.
  A special placeholder '%post_id%' will be converted to post's ID.
  ```
  'return' => '',
  ```
 
- **html_before_fields**
  (String) Extra HTML to add before the fields.
  ```
  'html_before_fields' => '',
  ```
 
- **html_after_fields**
  (String) Extra HTML to add after the fields.
  ```
  'html_after_fields' => '',
  ```
 
- **submit_value**
  (String) The text displayed on the submit button.
  ```
  'submit_value' => __("Update", 'acf'),
  ```
 
- **updated_message**
  (String) The message displayed above the form after being redirected. Can also be set to false for no message.
  ```
  'updated_message' => __("Post updated", 'acf'),
  ```
 
- **label_placement**
  (String) Determines where field labels are places in relation to fields. Defaults to 'top'.
  Choices of 'top' (above fields) or 'left' (beside fields).
  ```
  'label_placement' => 'top',
  ```
 
- **instruction_placement**
  (String) Determines where field instructions are placed in relation to fields. Defaults to 'label'.
  Choice of 'label' (below labels) or 'field' (below fields).
  ```
  'instruction_placement' => 'label',
  ```
 
- **field_el**
  (String) Determines element used to wrap a field. Defaults to 'div'.
  Choices of 'div', 'tr', 'td', 'ul', 'ol', 'dl'.
  ```
  'field_el' => 'div',
  ```
 
- **uploader**
  (String) Whether to use the WP uploader or a basic input for image and file fields. Defaults to 'wp' .
  Choices of 'wp' or 'basic'.
  ```
  'uploader' => 'wp',
  ```
 
- **honeypot**
  (Boolean) Whether to include a hidden input field to capture non-human form submission. Defaults to true.
  ```
  'honeypot' => true,
  ```
 
- **html_updated_message**
  (String) The HTML used to render the updated message.
  ```
  'html_updated_message'  => '<div id="message" class="updated"><p>%s</p></div>',
  ```
 
- **html_submit_button**
  (String) The HTML used to render the submit button.
  ```
  'html_submit_button'  => '<input type="submit" class="acf-button button button-primary button-large" value="%s" />',
  ```
 
- **html_submit_spinner**
  (String) The HTML used to render the submit button loading spinner.
  ```
  'html_submit_spinner' => '<span class="acf-spinner"></span>',
  ```
 
- **kses**
  (Boolean) Whether or not to sanitize all `$_POST` data with the `wp_kses_post()` function. Defaults to true.
  ```
  'kses' => true
  ```
 
## Examples

### Editing current post
This example demonstrates a basic `acf_form` to edit the current post.
```
<?php acf_form_head(); ?>
<?php get_header(); ?>

  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

      <?php /* The loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>

        <?php acf_form(); ?>

      <?php endwhile; ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
```

### Editing a specific post
This example demonstates how to target a specific post, customize the button label and hide the post title input.
```
<?php acf_form_head(); ?>
<?php get_header(); ?>

  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

      <?php /* The loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>

        <?php acf_form(array(
          'post_id'      => 123,
          'post_title'   => false,
          'submit_value' => 'Update the post!'
        )); ?>

      <?php endwhile; ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
```

### Create a specific post
This example demonstrates how to create a new post when submitting the form.
```
<?php acf_form_head(); ?>
<?php get_header(); ?>

  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

      <?php /* The loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>

        <?php acf_form(array(
          'post_id'   => 'new_post',
          'new_post'    => array(
            'post_type'   => 'event',
            'post_status'   => 'publish'
          ),
          'submit_value'    => 'Create a new event'
        )); ?>

      <?php endwhile; ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
```

## AJAX
When using AJAX to display the `acf_form` HTML, please note that some extra PHP/JavaScript must also be run to let ACF know there are new fields on the page which may require some JS initializing.

### PHP
Please add the following code to the page within the `<body>` tags and before the wp_footer action. This will create a hidden WYSIWYG field and enqueue the required JS templates for the WP media popups.
```
acf_enqueue_uploader();
```

### JavaScript
Either place the following inline JavaScript in the appended HTML, or run the JS on complete of your AJAX append. This will allow ACF to initialize the fields within the newly added HTML.
```
<script type="text/javascript">
(function( $ ) {
  
  // Setup fields.
  acf.do_action('append', $('#popup-id'));
  
})(jQuery); 
</script>
```

## Notes

### acf_form_head()
It is important to note that whilst the `acf_form()` function will create a form allowing you to input data, it will not perform the logic needed to save the data. This logic is handled by another function called `acf_form_head()`. To allow the form to save data, you will need to place the `acf_form_head()` function at the top of your page template before any HTML is rendered.

## <tr>
If using the `field_el` setting to render fields as a `<tr>` (table row) element, please be aware that the `acf_form()` function will not create the wrapping `<table>` or `<tbody>` elements. You may add these elements outside of the `acf_form()` function or use the `html_before_fields` and `html_after_fields` settings.

## Security
Since version 5.6.5, ACF uses the [wp_kses_post()](https://codex.wordpress.org/Function_Reference/wp_kses_post) function to sanitize content and strip out evil scripts. This sanitization can be disabled if needed by changing the form’s `kses` setting to false.

If you are using an older version of ACF, we advise that you add the following filter to your functions.php file.
####functions.php
```
function my_kses_post( $value ) {
  
  if( is_array( $value ) ) {
  
    return array_map('my_kses_post', $value);
  }
  
  // return
  return wp_kses_post( $value );

}

add_filter('acf/update_value', 'my_kses_post', 10, 1);
```

## Changelog
- `kses` added in version 5.6.5.
- `uploader` added in version 5.2.4.
- `honeypot` added in version 5.3.4
- `html_updated_message`, `html_submit_button`, and `html_submit_spinner` added in version 5.5.10
