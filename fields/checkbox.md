---
title: Checkbox
category: field-types
group: Choice
---

## Description
The Checkbox field creates a list of tick-able inputs.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-checkbox-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-checkbox-interface.png" alt="Checkbox field that allows you to create a list of options to check off" />
		</a>
		<figcaption>The Checkbox field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-checkbox-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-checkbox-settings.png" alt="List of checkbox field settings shown when setting up a Checkbox field" />
		</a>
		<figcaption>The Checkbox field settings</figcaption>
	</figure>
</div>

## Changelog
- Added `Return Format` setting in version 5.4.0
- Added `Toggle All` setting in version 5.2.7

## Settings
- **Choices**
  Each choice is entered on a new line (eg. 'Red'). For more control over the value and label, you may use a colon to specific both (eg. 'red : Red').

- **Default Value**
  Specify the default value(s) selected when first editing the field’s value. Enter only values, not labels.

- **Layout**
  Changes the layout style of inputs from Vertical to Horizontal.

- **Toggle**
  Adds an extra checkbox above choices to toggle on/off all inputs.

- **Return Format**
  Change the value format returned by the [get_field()](https://www.advancedcustomfields.com/resources/get_field/) and similar functions.

- **Allow Custom**
  Appends a button, which when clicked, adds a text input to the list. Multiple custom values may be added and removed.

- **Save Custom**
  Saves any custom values to the field’s choices. Please see notes section for more information on this setting.

## Notes

### Save Custom
If using the [local JSON](https://www.advancedcustomfields.com/resources/local-json/) feature, any custom values saved to the field’s choices will not appear on page reload. This is because the JSON file will not be updated and will override any field settings found in the DB.

## Template usage

The checkbox field will return an array of selected choices. Either use the [get_field()](https://www.advancedcustomfields.com/resources/get_field/) function to obtain this array, or use [the_field()](https://www.advancedcustomfields.com/resources/the_field/) to output the values, with each one separated by a comma.

### Basic
This example shows how to display a comma separated list of selected values.
```<p>Colors: <?php the_field( 'colors' ); ?></p>```

### Custom
This example shows how to load and display multiple selected values.

```<?php

// Get array of variables.
$colors = get_field( 'colors' );

// Check for variable.
if( $colors ): ?>
<ul>
	<?php foreach( $colors as $color ): ?>
		<li><?php echo $color; ?></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>```

### Display value and label
This example shows how to load a selected value and label without using the ‘Format value’ setting.

```<?php

// Get array of variables.
$field = get_field_object( 'colors' );
$colors = $field['value'];

// Check for variable.
if( $colors ): ?>
<ul>
	<?php foreach( $colors as $color ): ?>
		<li><?php echo $field['choices'][$color]; ?></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>```

### Format value setting
This example shows how to load a selected value and label using the ‘Format value’ setting (set to ‘Both’).

```<?php

// Get array of variables.
$colors = get_field( 'colors' );

// Check for variable.
if( $colors ): ?>
<ul>
	<?php foreach( $colors as $color ): ?>
		<li><span class="color-<?php echo $color['value']; ?>"><?php echo $color['label']; ?></span></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>```

### Conditional
This example shows how to use a selected value to conditionally perform a task.

```<?php

// Get array of variables.
$colors = get_field('colors');

// Check for variable and specific value.
if( $colors && in_array( 'red', $colors ) ): ?>
<p>Selected the Red choice!</p>
<?php endif; ?>```

### Query posts
This example shows how to query posts that have the value ‘red’ selected. The checkbox field saves its value as a serialized array, so it is important to use the meta_query LIKE compare.

```<?php

$posts = get_posts( array(
    'meta_query' => array(
        array(
            'key'     => 'colors', // Name of custom field.
            'value'   => '"red"', // Matches exactly "red".
            'compare' => 'LIKE'
        )
    )
) );

if( $posts ) {
    // ...
}

?>```

## Related
- Guides: [Creating a WP archive with custom field filter](https://www.advancedcustomfields.com/resources/creating-wp-archive-custom-field-filter/)
