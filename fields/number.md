---
title: Number
category: field-types
group: Basic
---

## Description
The Number field creates a basic numerical input for storing numbers.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-number-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-number-field-interface.png" alt="A number field that allows you to enter a string" />
		</a>
		<figcaption>The Number field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-number-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-number-field-settings.png" alt="List of settings shown when creating a number field" />
		</a>
		<figcaption>The Number field settings</figcaption>
	</figure>
</div>

## Changelog
- Fixed bug causing blank values to save as 0 in version 4.3.6
- Added `prepend`, `append` and `placeholder` settings in version 4.2.0
- Fixed step size decimal bug in version 4.1.7
- Added `min`, `max` and `step` settings in version 4.1.6
- Added `default` setting in version 3.4.1
- Field added in version 3.3.8

## Settings
- **Default Value**  
  The default value shown when creating a new post.
  
- **Placeholder Text**  
  Appears within input when no value exists.
  
- **Prepend**  
  Adds a visual text element before the input.
  
- **Append**  
  Adds a visual text element after the input.
  
- **Minimum Value**  
  Sets the minimum number that can be entered into the input.
  
- **Maximum Value**  
  Sets the maximum number that can be entered into the input.
  
- **Step Size**  
  Sets the step size to increment or decrement the number when using the up/down arrows in the field or up/down arrows on the keyboard.

## Template usage

### Display value
This example demonstrates how to display a Number field named "total" within a `<p>` tag after some text.
```
<p>Total items: <?php the_field('total'); ?></p>
```

### Load value
This example demonstrates how to load the value of a Number field named "price" and format it as a two decimal price.
```
$price = get_field( 'price' );
if ( is_numeric( $price ) ) {
	echo '$' . number_format( $price, 2 );
}
```
