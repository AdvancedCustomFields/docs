---
title: acf/input/admin_footer
description: Fires during the "admin_footer" action when editing a post.
category: actions
---

## Description
Used to output additional `<body>` HTML to pages where ACF fields appear.

This action is similar to the WordPress [admin_footer](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_footer), except that it is only fired on pages where ACF fields appear - such as when editing posts, users, taxonomy terms, options pages and front-end forms.

## Changelog
- Added in version 5.0.0

## Example
This example demonstrates how to output additional inline style and script tags to customize fields.

#### functions.php
```
<?php
add_action('acf/input/admin_footer', 'my_acf_admin_footer');
function my_acf_admin_footer() {
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
