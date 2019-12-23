---
title: acf/acf_head-fields
description: Called in the head of the edit field group page.
category: actions
deprecated: true
status: draft
---

## Description
[tip]
This action works on version 3.5.8.2 and below. If using version 4 and above, please use [acf/field_group/admin_head](https://www.advancedcustomfields.com/resources/acf-field_group-admin_head/).
[/tip]

This action is called in the head of the 'Edit Field Group' page.

## Basic Usage
This example demonstrates how to use this action to add custom CSS and/or JavaScript to interact with your fields, location rules, options, etc.
```
function my_head_fields() {
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
add_action('acf_head-fields', 'my_head_fields');

?>
```
