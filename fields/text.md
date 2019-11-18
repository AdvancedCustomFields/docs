---
title: Text
category: field-types
group: Basic
---

## Description
The Text field creates a basic text input, useful for storing single string values.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-text-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-text-field-interface.png" alt="A text field that allows you to enter a string" />
		</a>
		<figcaption>The Text field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-text-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-text-field-settings.png" alt="List of settings shown when creating a text field" />
		</a>
		<figcaption>The Text field settings</figcaption>
	</figure>
</div>

## Changelog
- Formatting setting removed in version 5.0.0.

## Settings
- **Default Value**  
  The default value shown when creating a new post.
  
- **Placeholder Text**  
  Appears within input when no value exists.
  
- **Prepend**  
  Adds a visual text element before the input.
  
- **Append**  
  Adds a visual text element after the input.
  
- **Character Limit**  
  Limits the number of characters allowed.

## Template usage

### Display value
This example demonstrates how to display a Text field named "heading" within a `<h2>` tag.
```
<h2><?php the_field('heading'); ?></h2>
```

### Load value
This example demonstrates how to load the value of a Text field named "confirm" and perform an action based on its value.
```
$confirm = get_field('confirm');
if( $confirm === 'SEND_EMAIL' ) {
	// Do something.
}
```
