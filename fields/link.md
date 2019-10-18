---
title: Link
category: field-types
group: Relational
status: draft
---

## Description
The Link field allows a link to be selected or defined (url, title, target) by using the native WordPress link popup.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-link-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-link-field-interface.png" alt="A Link field that allows you to enter a new URL or choose an existing link from a list" />
		</a>
		<figcaption>The Link field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-link-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-link-field-settings.png" alt="List of checkbox field settings shown when setting up a Link field" />
		</a>
		<figcaption>The Link field settings</figcaption>
	</figure>
</div>

## Changelog
- Added in version 5.6.0.

## Settings
- **Return value**  
  Specifies the format of the returned data. Choose from Link Array (array or data) or Link URL (string).

## Template usage  
The Link field will return either an array or string depending on the _return value_ setting. Below are some examples of how you can use this data.

### Basic Display (array)
This example demonstrates how to display the selected link when using the `Link Array` return type.
```
<?php 

$link = get_field('link');

if( $link ): 
	$link_url = $link['url'];
	$link_title = $link['title'];
	$link_target = $link['target'] ? $link['target'] : '_self';
	?>
	<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
<?php endif; ?>
```

### Basic display (string)
This example demonstrates how to display the selected link when using the `Link URL` return type.
```
<?php 

$link = get_field('link');

if( $link ): ?>
	
	<a class="button" href="<?php echo esc_url( $link ); ?>">Continue Reading</a>

<?php endif; ?>
```
