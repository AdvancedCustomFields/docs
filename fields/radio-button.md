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
  The choices displayed when selecting a value. Enter each choice on a new line (eg. `Red`). For more control over the value and label, you may use a colon to specify both (eg. `red : Red`).
  
- **Allow Null**  
  Allows you to 'un-select' an input by using JavaScript. Otherwise by default this is not possible.
  
- **Other**  
  Adds a text input allowing for a custom value to be entered.
  
- **Save Other**  
  Allows custom values to be appended to the field’s choices. See Notes for more information.
  
- **Default Value**  
  Specifies the default value selected when first editing the field’s value. Enter only value (not label).
  
- **Layout**  
  The layout orientation of radio inputs. Select from "Vertical" to "Horizontal".
  
- **Return Format**  
  Specifies the value format returned by ACF functions. Select from "Value", "Label" or "Both(Array)".

## Template usage

### Display a single selected value
This example demonstrates how to load and display a single selected value.

```
<p>Color: <?php the_field('color'); ?></p>
```

### Display value and label
This example demonstrates how to load a selected value and label without using the ‘Format value’ setting.

```<?php
$field = get_field_object('color');
$value = $field['value'];
$label = $field['choices'][ $value ];

?>
<p>Color: <span class="color-<?php echo $value; ?>"><?php echo $label; ?></span></p>
```

### Format value setting
This example demonstrates how to load a selected value and label using the ‘Format value’ setting (set to ‘Both’).

```
<?php
$color = get_field('color');

?>
<p>Color: <span class="color-<?php echo $color['value']; ?>"><?php echo $color['label']; ?></span></p>
```

### Conditional
This example demonstrates how to use a selected value to conditionally perform a task.

```
<?php if( get_field('color') == 'red' ): ?>
  <style type="text/css">
    img {
      border: 10px solid red;
    }
  </style>
<?php endif; ?>
```

### Query posts
This example demonstrates how to query posts that have the value ‘red’ selected for a radio button field named 'color'.

```
<?php

$posts = get_posts( array(
    'meta_query' => array(
        array(
            'key'   => 'color',
            'value' => 'red',
        )
    )
) );

if( $posts ) {
    // Do something.
}

?>
```

## Notes

### Save other
If using the [local JSON](https://www.advancedcustomfields.com/resources/local-json/) feature, any custom values saved to the field’s choices will not appear on page reload. This is because the JSON file will not be updated and will override any field settings found in the DB.
