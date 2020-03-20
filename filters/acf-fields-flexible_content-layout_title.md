---
title: acf/fields/flexible_content/layout_title
description: Filters the $title HTML for each Flexible Content layout.
category: filters
---

## Description
Used to modify the `$title` HTML displayed at the top of each flexible content layout. 

Within the filter callback, it is possible to load sub field values via the `get_sub_field()`, `the_sub_field()` and `get_row()` functions and display them within the returned string. 

This filter is also run via an AJAX request each time the layout is toggled open or closed.

Here is a before/after visual example to demonstrate how this filter can improve UX.

<div class="gallery">
	<figure>
		<a href="https://www.advancedcustomfields.com/wp-content/uploads/2016/03/flexible-content-layout-title-before.png">
			<img src="https://www.advancedcustomfields.com/wp-content/uploads/2016/03/flexible-content-layout-title-before.png" alt="Screenshot of default Flexible Content layout titles." />
		</a>
		<figcaption>Default layout titles</figcaption>
	</figure>
	<figure>
		<a href="https://www.advancedcustomfields.com/wp-content/uploads/2016/03/flexible-content-layout-title-after.png">
			<img src="https://www.advancedcustomfields.com/wp-content/uploads/2016/03/flexible-content-layout-title-after.png" alt="Screenshot of customized Flexible Content layout titles." />
		</a>
		<figcaption>Customized layout titles</figcaption>
	</figure>
</div>

## Changelog
- Added in version 5.3.6

## Parameters
```
apply_filters( 'acf/fields/flexible_content/layout_title', $title, $field, $layout, $i );
```
- `$title`		*(string)*		The layout title text. Defaults to the layout name.
- `$field`		*(array)*		The field array containing all settings.
- `$layout`		*(array)*		The layout array containing all settings.
- `$i`			*(int)*			The layout index beginning at 0.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/fields/flexible_content/layout_title` 				Applies to all fields.
- `acf/fields/flexible_content/layout_title/name={$name}` 	Applies to all fields of a specific name.
- `acf/fields/flexible_content/layout_title/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to customize the title of each Flexible Content layout and display sub field values.

#### functions.php
```
<?php
add_filter('acf/fields/flexible_content/layout_title/name=my_flex_field', 'my_acf_fields_flexible_content_layout_title', 10, 4);
function my_acf_fields_flexible_content_layout_title( $title, $field, $layout, $i ) {
	
	// Remove layout name from title.
	$title = '';
	
	// Display thumbnail image.
	if( $image = get_sub_field('image') ) {
		$title .= '<div class="thumbnail"><img src="' . esc_url($image['sizes']['thumbnail']) . '" height="36px" /></div>';		
	}
	
	// load text sub field
	if( $text = get_sub_field('text') ) {
		$title .= '<b>' . esc_html($text) . '</b>';
	}
	return $title;
}
```
