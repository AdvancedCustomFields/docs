---
title: Color Picker
category: field-types
group: jQuery
status: draft
---

## Description
The color picker field allows a color to be selected via a JavaScript popup.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-color-picker-interface.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-color-picker-interface.jpg" alt="acf-user-field-interface" />
		</a>
		<figcaption>The Wysiwyg editor field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-color-picker-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-color-picker-settings.png" alt="acf-user-field-settings" />
		</a>
		<figcaption>The Wysiwyg editor field settings</figcaption>
	</figure>
</div>

## Settings
- **Default Value**  
  The default value initially loaded into the color picker when first editing the field’s value.

## Template usage
The color picker field will return a string value containing the HEX color value including the prefix ‘#’. Below are examples using a color picker field named "color".

### Display value within inline styles
This example demonstrates how to use a selected color to change the background of an element using the style attribute inline.
```
<div style="background-color:<?php the_field('color'); ?>">Something here...</div>
```

### Display value within style tags
This example demonstrates how to use a selected color to change the background of an element using a style tag.
```
<style type="text/css">
.special-color {
    background-color: <?php the_field('color'); ?>;
}
</style>

<div class="special-color">Something here...</div>
```

## Notes

### Customization
The color picker field contains a JavaScript filter allowing you to modify the `wpColorPicker` arguments. Please see the [Adding custom javascript to fields](https://www.advancedcustomfields.com/resources/adding-custom-javascript-fields/) documentation for more info.
