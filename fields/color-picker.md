---
title: Color Picker
category: field-types
group: jQuery
---

## Description
The color picker field provides an interactive way to select a hex color string using [Iris](https://automattic.github.io/Iris/).

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-color-picker-interface.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-color-picker-interface.jpg" alt="acf-user-field-interface" />
		</a>
		<figcaption>The color picker editor field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-color-picker-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-color-picker-settings.png" alt="acf-user-field-settings" />
		</a>
		<figcaption>The color picker editor field settings</figcaption>
	</figure>
</div>

## Settings
- **Default Value**  
  The default value initially loaded into the color picker when first editing the field’s value.

## Template usage
The color picker field will return a string value containing the HEX color value including the prefix ‘#’. Below are examples using a color picker field named "color".

### Display value within inline styles
This example demonstrates how to generate an inline style using a Color picker value.
```
<div style="background-color:<?php the_field('color'); ?>">

</div>
```

### Display value within style tags
This example demonstrates how to generate a CSS class using a Color picker value.
```
<style type="text/css">
.primary-background {
    background-color: <?php the_field('primary_background_color'); ?>;
}
</style>

<div class="primary-background">

</div>
```

## Notes

### Customization
The Color picker field modal can be customized via the JS filter [color_picker_args](https://www.advancedcustomfields.com/resources/javascript-api/#filters-color_picker_args).
