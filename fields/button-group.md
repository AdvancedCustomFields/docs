---
title: Button Group
category: field-types
group: Choice
---

## Description
The Button Group field provides a neat UI for selecting a value.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-button-group-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-button-group-field-interface.png" alt="Three examples of button group field controlling alignment, and colors of buttons" />
		</a>
		<figcaption>The Button Group field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-button-group-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-button-group-field-settings.png" alt="List of field settings shown when setting up a Button Group field" />
		</a>
		<figcaption>The Button Group field settings</figcaption>
	</figure>
</div>

## Changelog
- Added in version 5.6.3.

## Settings
- **Choices**  
  The choices displayed when selecting a value. Enter each choice on a new line (eg. `Red`). For more control over the value and label, you may use a colon to specify both (eg. `red : Red`). You may also enter HTML as a choice as shown in the above screenshots.
  
- **Allow Null**  
  Allows no value to be selected.
  
- **Default Value**  
  The default values selected when first editing the field’s value. Enter only values, not labels.
  
- **Layout**  
  The layout orientation of the inputs. Select from "Vertical" or "Horizontal".
  
- **Return Format**  
  Specifies the value format returned by ACF functions. Select from "Value", "Label" or "Both".

## Template usage  

### Display value
This example demonstrates how to display the selected value using the _Return Format_ setting `Value`.
```
<p>Color: <?php the_field('color'); ?></p>
```

### Display value and label
This example demonstrates how to display the selected value and label using the _Return Format_ setting `Both`.

```
<?php
$color = get_field('color');
?>
<p>Color: <span class="color-<?php echo esc_attr($color['value']); ?>"><?php echo esc_html($color['label']); ?></span></p>
```

### Conditional
This example demonstrates how to use a selected value to conditionally perform a task.

```
<?php 

if( get_field('color') == 'red' ) {
	// Do something.
}
```

### Query Posts
This example demonstrates how to query posts that have a 'red' value for the field 'color'.

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
	foreach( $posts as $post ) {
		// Do something.
	}
}
```
