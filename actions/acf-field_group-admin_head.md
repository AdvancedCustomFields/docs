---
title: acf/field_group/admin_head
description: Fires during the "admin_head" action when editing a field group.
category: actions
---

## Description
Used to output additional `<head>` HTML to the field group admin edit page.

This action is similar to the WordPress [admin_head](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_head), except that it is only fired on the field group admin edit page.

## Changelog
- Added in version 4.0.0

## Example
This example demonstrates how to output additional inline style and script tags to customize field group settings.

#### functions.php
```
<?php
add_action('acf/field_group/admin_head', 'my_acf_field_group_admin_head');
function my_acf_field_group_admin_head() {
	?>
	<style type="text/css">
		/* CSS here. */
	</style>
	<script type="text/javascript">
	(function( $ ){
		// Javascript here.
	})(jQuery);
	</script>
	<?php
}
```