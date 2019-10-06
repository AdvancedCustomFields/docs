---
title: Wysiwyg Editor
category: field-types
group: Content
status: draft
---

## Description
The Wysiwyg field creates a WordPress content editor as seen in Posts and Pages. Wysiwyg is an acronym for "what you see is what you get".

This is one of the most useful fields for editing content as it allows for both text and multimedia to be edited and styled within a single area.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-wysiwyg-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-wysiwyg-field-interface.png" alt="acf-user-field-interface" />
		</a>
		<figcaption>The Wysiwyg editor field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-wysiwyg-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-wysiwyg-field-settings.png" alt="acf-user-field-settings" />
		</a>
		<figcaption>The Wysiwyg editor field settings</figcaption>
	</figure>
</div>

## Changelog
- Added Visual / Text options for 'Tabs' in version 5.0.0

## Settings
- **Tabs**  
  Selects which modes are shown to the user. Each Wysiwyg editor contains a visual and text mode. Choose from "Visual and Text", "Visual Only, or "Text Only".
  
- **Toolbar**  
  Specifies which toolbar to show. Choose from "Full" or "Basic. The “Full” toolbar reflects the typical WordPress editor toolbar with 2 rows of buttons. The “Basic” toolbar is a minified single row of buttons useful for a more trimmed experience.
  
- **Show Media Upload Buttons**  
  Provides the ability to upload inline media to the Wysiwyg field.
  
- **Delay initialization?**  
  Defers initialization of editor until editor is clicked instead of on page load. This is useful to speed up load times.

## Template usage
The Wysiwyg editor field will return your content formatted for HTML in the same manner that [the_content()](https://developer.wordpress.org/reference/functions/get_the_content/) does.

### Basic display
This example demonstrates how to display your Wysiwyg field's content.
```
<?php the_field('wysiwyg_test'); ?>
```

## Notes

### the_content filter
The Wysiwyg field uses the [the_content](https://codex.wordpress.org/Plugin_API/Filter_Reference/the_content) filter to format its value into HTML. ACF uses its own `acf_the_content` filter that closely mimics the one found in WP core. If you are using the `the_content` filter to modify content, please be sure to add your filter to `acf_the_content` as well. This will avoid recursion and asset loading issues caused by calling the `the_content` filter multiple times.
