---
title: Select
category: field-types
group: Choice
status: draft
---

## Description
The Select field creates a drop down select or multiple select input.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-select-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-select-field-interface.png" alt="Select field that allows you to select a color from a list" />
		</a>
		<figcaption>The Select field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-select-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-select-field-settings.png" alt="List of settings shown when creating a Select field" />
		</a>
		<figcaption>The Select field settings</figcaption>
	</figure>
</div>

## Changelog
- Added 'Return Format' setting in version 5.4.0.
- Added 'Stylized UI' (Select2) setting in version 5.0.0.

## Settings
- **Choices**
  Each choice is entered on a new line (eg. ‘Red’). For more control over the value and label, you may use a ‘ : ‘ character to specify both (eg. ‘red : Red’).

- **Default Value**
  Specify the default value(s) selected when first editing the field’s value. Enter only values (not labels).

- **Allow Null**
  If selected, the select list will begin with an empty choice labelled “- Select -“. If using the ‘Stylized UI’ setting, this empty choice will be replaced by a ‘x’ icon allowing you to remove the selected value(s).

- **Multiple**
  Allows you to select more than one choice. If using the ‘Stylized UI’ setting, you may also drag/drop reorder the selected choices.

- **Stylized UI**
  This setting will use the Select2 JavaScript library to enhance your select field with more functionality (search, ajax, reorder).

- **AJAX**
  This setting appears if using the ‘Stylized UI’ and will use AJAX to populate the select field’s choices. Very useful if using the [acf/load_value](https://www.advancedcustomfields.com/resources/acfload_value/) filter to populate choices as it can help speed up page load times.

- **Return Format**
  Change the value format returned by the [get_field()](https://www.advancedcustomfields.com/resources/get_field/) and similar functions.

## Template usage

### Display single selected value
This example demonstrates how to load and display a single selected value.

```<p>Color: <?php the_field('color'); ?></p>```

### Display multiple values
This example demonstrates how to load and display multiple selected values.

```
<?php

// Load field settings and value.
$colors = get_field( 'color' );

// Create a comma-separated list from selected values.
if( $colors ): ?>
<p>Color: <?php echo implode( ', ', $colors ); ?></p>
<?php endif; ?>
```

### Display value and label
This example demonstrates how to load a selected value and label without using the ‘Format value’ setting.

```
<?php

$field = get_field_object( 'color' );
$value = $field['value'];
$label = $field['choices'][ $value ];

?>

<p>Color: <span class="color-<?php echo $value; ?>"><?php echo $label; ?></span></p>
```

### Format value setting
This example demonstrates how to load a selected value and label using the ‘Format value’ setting (set to ‘Both’).

```
<?php

$color = get_field( 'color' );

?>

<p>Color: <span class="color-<?php echo $color['value']; ?>"><?php echo $color['label']; ?></span></p>
```

### Conditional
This example demonstrates how to use a selected value to conditionally perform a task. In this case, the conditional is checking to see if 'red' matches the selected option.

```
<?php if( get_field( 'color' ) == 'red' ): ?>
	<p>Selected the Red choice!</p>
<?php endif; ?>
```
