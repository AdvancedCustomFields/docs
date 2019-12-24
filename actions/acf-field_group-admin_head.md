---
title: acf/field_group/admin_head
description: Called during the admin_head action when editing a field group
category: actions
status: draft
---

## Description
Used to add custom code to interact with your fields.

This action is called in the head of the edit Field Group page.

This action is very similar to the WordPress action [admin_head](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_head).

## Changelog
- Added in version 4.0.0
- Originally introduced as [acf_head-fields](https://www.advancedcustomfields.com/resources/actions/acf_head-fields/) in version 3.0.0

## Example

### Add custom code to interact with fields
This example demonstrates how to add custom code to interact with your fields, location rules and options.

#### functions.php
```
function my_acf_field_group_admin_head() {
	?>
	<style type="text/css">

		/* Style something... */

	</style>

	<script type="text/javascript">
	(function($){

		/* Do something... */

	})(jQuery);
	</script>
	<?php
}

add_action('acf/field_group/admin_head', 'my_acf_field_group_admin_head');
```
