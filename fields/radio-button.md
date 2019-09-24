---
title: Radio Button
category: field-types
group: Choice
status: draft
---

## Description
The Radio button field creates a list of select-able inputs.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-radio-button-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-radio-button-field-interface.png" alt="Radio button field that allows you to select option(s)" />
		</a>
		<figcaption>The Radio button field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-radio-button-field-settings.png.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-radio-button-field-settings.png" alt="List of settings shown when creating a Radio button field" />
		</a>
		<figcaption>The Radio button field settings</figcaption>
	</figure>
</div>

## Changelog
- Added 'Return Format' setting in version 5.4.0.
- Added 'Allow Null' setting in 5.3.8.
- Added 'Other' and 'Save Other' settings in 4.1.7.

## Settings
- **Choices**
  Each choice is entered on a new line (eg. ‘Red’). For more control over the value and label, you may use a ‘ : ‘ character to specify both (eg. ‘red : Red’).

- **Allow Null**
  By default it is not possible to ‘un-select’ an input. This setting allows you to do so using JavaScript.

- **Other**
  Adds a text input allowing for a custom value to be entered.

- **Save Other**
  Allows the custom value to be appended to the field’s choices.

- **Default Value**
  Specify the default value selected when first editing the field’s value. Enter only value (not label).

- **Layout**
  Changes the layout style of inputs from Vertical to Horizontal.

- **Return Format**
  Changes the value format returned by the [get_field()](https://www.advancedcustomfields.com/resources/get_field/) and similar functions.

## Template usage

### Display a single selected value
This example demonstrates how to load and display a single selected value.

```<p>Color: <?php the_field( 'color' ); ?></p>```

### Display value and label
This example demonstrates how to load a selected value and label without using the ‘Format value’ setting.

```<?php

// Load field settings and values.
$field = get_field_object('color');
$value = $field['value'];
$label = $field['choices'][ $value ];

?>
<p>Color: <span class="color-<?php echo $value; ?>"><?php echo $label; ?></span></p>```

### Format value setting
This example demonstrates how to load a selected value and label using the ‘Format value’ setting (set to ‘Both’).

```
<?php

// Load field settings and value.
$color = get_field('color');

?>
<p>Color: <span class="color-<?php echo $color['value']; ?>"><?php echo $color['label']; ?></span></p>
```

### Conditional
This example demonstrates how to use a selected value to conditionally perform a task.

```
<?php if( get_field('color') == 'red' ): ?>
	<p>Selected the Red choice!</p>
<?php endif; ?>
```

### Query posts
This example demonstrates how to query posts that have the value ‘red’ selected.

```
<?php

$posts = get_posts( array(
    'meta_query' => array(
        array(
            'key'   => 'color', // name of custom field
            'value' => 'red',
        )
    )
) );

if( $posts ) {
    //...
}

?>
```

## Notes

### Save custom
If using the [local JSON](https://www.advancedcustomfields.com/resources/local-json/) feature, any custom values saved to the field’s choices will not appear on page reload. This is because the JSON file will not be updated and will override any field settings found in the DB.
