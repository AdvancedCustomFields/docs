---
title: acf_register_form()
description: Registers a front end form.
category: functions
status: draft
---

## Description
Registers a form to later be used by the [acf_form()](https://www.advancedcustomfields.com/resources/acf_form/) function. There are many settings available to customize a form which are set by adding to the `$settings` array (see below).

## Parameters
```
<?php acf_register_form( $settings ); ?>
```

### $settings
*(Array)* Array of arguments for registering a form.
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
  A special placeholder '%post_url%' will be converted to post's permalink (helpful if creating a new post).
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

### Basic form registration and use

#### functions.php
```
<?php

acf_register_form(array(
  'id'       => 'new-event',
  'post_id'  => 'new_post',
  'new_post' => array(
    'post_type'   => 'event',
    'post_status' => 'publish'
  ),
  'post_title'  => true,
  'post_content'=> true,
));

?>
```

#### single-new-event.php
```
<?php acf_form_head(); ?>
<?php get_header(); ?>

  <div id="primary" class="content-area">
    <div id="content">

      <?php acf_form('new-event'); ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
```

## Changelog
- `kses` added in version 5.6.5.
- `uploader` added in version 5.2.4.
- `honeypot` added in version 5.3.4
- `html_updated_message`, `html_submit_button`, and `html_submit_spinner` added in version 5.5.10
