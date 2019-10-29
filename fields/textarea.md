---
title: Text Area
category: field-types
group: Basic
---

## Description
The Textarea field creates a basic textarea input, useful to store simple (unstyled) paragraphs of text to use in your theme.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-textarea-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-textarea-interface.png" alt="Textarea field that allows you to enter a string" />
		</a>
		<figcaption>The Textarea field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-textarea-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-textarea-settings.png" alt="List of textarea field settings to set up a textarea field" />
		</a>
		<figcaption>The Textarea field settings</figcaption>
	</figure>
</div>

## Changelog
- Formatting setting removed in version 5.0.0.
- Rows setting added in 4.3.5.

## Settings
- **Default Value**  
  The default value shown when creating a new post.

- **Placeholder Text**  
  Appears within input when no value exists.

- **Character Limit**  
  Limits the number of characters allowed.
  
- **Rows**  
  Sets the height of this field.
  
- **New Lines**  
  Changes the way new lines are formatted. Selecting “Automatically add paragraphs” will add paragraph tags around the value. Selecting “Automatically add `<br>`” will convert any new lines to HTML line breaks. Selecting “No formatting” will not convert _any_ tags and you will see any HTML displayed as normal text similar to regular content.

## Template usage

### Display value with paragraphs automatically added.
This example demonstrates how to display a Textarea field named "product_description" when the `Automatically add paragraphs` setting is enabled.
```
<h3>Product Description</h3>
<?php the_field('product_description'); ?>
```

### Display value without formatting.
This example demonstrates how to display a Textarea field named "product_description" when `No formatting` setting is enabled.
```
<h3>Product Description</h3>
<p><?php the_field('product_description'); ?></p>
```
