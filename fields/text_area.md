---
title: Text Area
category: field-types
group: Basic
---

## Description
The Textarea field creates a basic textarea. This field is useful to store simple paragraphs of text to use in your theme.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-textarea-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-textarea-interface.png" alt="Text field interface that allows you to enter a string" />
		</a>
		<figcaption>The text field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-textarea-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-textarea-settings.png" alt="List of text field settings to set up text field interface" />
		</a>
		<figcaption>The text field settings</figcaption>
	</figure>
</div>

## Changelog
- Formatting setting removed in version 5.0.0.

## Settings
- **Default Value**
  Set a default value for this field when creating a new post.

- **Formatting**
  This option will determine how to render the value. Selecting “HTML” will convert any tags in the value to html tags. Selecting “auto <br />” will convert any new lines to html line breaks. Selecting “None” will not convert any tags and you will see any html displayed as normal text.

## Template usage

The API will return a string.
```
<p><?php the_field( 'textarea' ); ?></p>
```
