---
title: acf/input/admin_head
description: Called during the admin_head action when editing a post.
category: actions
status: draft
---

## Description
This action is used in the head of all pages where fields are rendered. For example, the page / post edit screen, front end form, Options page, etc.

It is very similar to the WordPress action [admin_head](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_head).

## Changelog
- Added in version 4.0.0
- In version 3.0.0, this action was known as [acf_head-input](https://www.advancedcustomfields.com/resources/actions/acf_head-input/)

## Example
This example demonstrates how to call the action to add custom CSS or JavaScript to interact with your fields.
```
function my_acf_admin_head() {
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

add_action('acf/input/admin_head', 'my_acf_admin_head');

?>
```
