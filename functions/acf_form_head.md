---
title: acf_form_head()
description: Validates and saves data submitted from an acf_form().
category: functions
status: draft
---

## Description
Used to process, validate and save the submitted form data created by the [acf_form()](https://www.advancedcustomfields.com/resources/acf_form/) function. It will also enqueue all ACF related scripts and styles for the ACF form to render correctly.

This function must be placed before any HTML has been created, preferably above the `get_header();` function in your theme file.

## Parameters
```
<?php acf_form_head(); ?>
```

## Examples

### Edit current post
This example demonstrates a basic `acf_form()` to edit the current post.
```
<?php acf_form_head(); ?>
<?php get_header(); ?>

  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

      <?php acf_form(); ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
```

## Actions & Filters
The following are ways to customize the saving process.

### acf/pre_submit_form
This filter is run when a form has been submitted and is valid. Use this filter to modify or use the `$form` before $_POST data is processed.
```
function my_acf_pre_submit_form( $form ) {

  // Create post using $form['new_post']

  // Modify $form['redirect']

  // Return form after modifications.
  return $form;
}

add_filter('acf/pre_submit_form', 'my_acf_pre_submit_form', 10, 1);
```

### acf/pre_save_post
This filter is run when a form has been submitted and has a value. This filter is run after 'acf/pre_submit_form'. Use this filter to modify or use the `$post_id` and `$form` before $_POST data is processed.
```
function my_acf_pre_save_post( $post_id, $form ) {

  // Create post using $form and update $post_id

  // Return
  return $post_id;
}

add_filter('acf/pre_save_post', 'my_acf_pre_save_post', 10, 2);
```

## Changelog
- `acf/pre_submit_form` added in version 5.5.10
- `acf/pre_save_post` added in version 4.1.6
