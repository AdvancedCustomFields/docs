---
title: Text Area
category: field-types
group: Basic
---

## Description
The Textarea field creates a basic textarea. This field is useful to store simple (unstyled) paragraphs of text to use in your theme.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-textarea-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-textarea-interface.png" alt="Textarea field that allows you to enter a string" />
		</a>
		<figcaption>The textarea field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-textarea-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-textarea-settings.png" alt="List of textarea field settings to set up a textarea field" />
		</a>
		<figcaption>The textarea field settings</figcaption>
	</figure>
</div>

## Changelog
- Formatting setting removed in version 5.0.0.
- Rows setting added in 4.3.5.

## Settings
- **Default Value**
  Set a default value for this field when creating a new post.

- **Rows**
  Sets the height of this field.

- **New Lines**
  This option will determine how to render the value. Selecting “Automatically add paragraphs” will add paragraph tags around the value. Selecting “Automatically add `<br>`” will convert any new lines to HTML line breaks. Selecting “No formatting” will not convert _any_ tags and you will see any HTML displayed as normal text similar to regular content.

## Template usage

### Display value with paragraphs automatically added.
This example displays how to use the value when you've chosen to "Automatically add paragraphs" via the 'New Lines' setting.
```
<?php the_field( 'textarea' ); ?>
```

### Display value with no formatting inherently added.
This example displays how to use the value when you've chosen the setting "No Formatting". This leaves the customization of the surrounding markup to you.
```
<p><?php the_field( 'textarea' ); ?></p>
```
