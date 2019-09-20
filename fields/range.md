---
title: Range
category: field-types
group: Basic
---

## Description
The Range field provides an interactive experience for selecting a numerical value between specific endpoints.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-range-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-range-field-interface.png" alt="Range field that allows you to select a numerical value between two points" />
		</a>
		<figcaption>The Range field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-range-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-range-field-settings.png" alt="List of settings shown when creating a Range field" />
		</a>
		<figcaption>The Range field settings</figcaption>
	</figure>
</div>

## Changelog
- Added in version 5.6.2.

## Settings
- **Default Value**
  The default value loaded when editing a new post (when no value exists).

- **Minimum Value**
  The minimum (numeric) value allowed. This value must not be greater than its maximum value. Defaults to 0.

- **Maximum Value**
  The maximum (numeric) value allowed. This value must not be less than its minimum value. Defaults to 100.

- **Step Size**
  The increment at which a numeric value can be set. Defaults to 1.

- **Prepend**
  HTML displayed before (to the left) of the range input.

- **Append**
  HTML displayed after (to the right) of the range input.

## Template usage

The *Range* field will return a numeric value.

_Note:_ If you are working with a sub field, remember to replace any `get_field()` and `the_field()` functions from the following examples with the relative `get_sub_field` and `the_sub_field()` functions.

### Basic Use within Styles
This example shows how to use the value associated with the 'font_size' Range field as a style for all `<h2>` elements.

```
<?php

// Get variable.
$font_size = get_field( 'font_size' );

?>
<style type="text/css">
<?php if( $font_size ): ?>
	h2 {
		font-size: <?php echo $font_size; ?>px;
	}
<?php endif; ?>
</style>
```
