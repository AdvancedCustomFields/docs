---
title: acf/input/admin_footer
description: Called during the admin_footer action when editing a post.
category: actions
status: draft
---

## Description
Used in the footer of all pages where fields are rendered. For example, the page/post edit screen, front end form, Options page, etc.

It is very similar to the WordPress action [admin_footer](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_footer).

## Changelog
- Added in version 5.0.0

## Basic Example
This example demonstrates how to call the action to add custom CSS or JavaScript to interact with your fields.
```
function my_acf_admin_footer() {
	?>
	<style type="text/css">

		/* Style something... */

	</style>

	<script type="text/javascript">
	(function( $ ){

		/* Do something... */

	})(jQuery);
	</script>
	<?php
}

add_action('acf/input/admin_footer', 'my_acf_admin_footer');

?>
```
