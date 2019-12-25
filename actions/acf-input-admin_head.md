---
title: acf/input/admin_head
description: Fires during the "admin_head" action when editing a post.
category: actions
---

## Description
Used to output additional `<head>` HTML to pages where ACF fields appear.

This action is similar to the WordPress [admin_head](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_head), except that it is only fired on pages where ACF fields appear - such as when editing posts, users, taxonomy terms, options pages and front-end forms.

## Changelog
- Added in version 4.0.0

## Example
This example demonstrates how to output additional inline style and script tags to customize fields.

#### functions.php
```
<?php
add_action('acf/input/admin_head', 'my_acf_admin_head');
function my_acf_admin_head() {
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