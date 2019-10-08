---
title: oEmbed
category: field-types
group: Content
status: draft
---

## Description
The oEmbed field provides an intuitive interface for embedding videos, images, tweets, audio, and other content. This field makes use of the native [WordPress oEmbed functionality](https://codex.wordpress.org/Embeds).

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-oembed-field-interface.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-oembed-field-interface.jpg" alt="An oEmbed field with an example video from Vimeo in use" />
		</a>
		<figcaption>The oEmbed field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-oembed-field-settings.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-oembed-field-settings.jpg" alt="List of field settings shown when setting up a oEmbed field" />
		</a>
		<figcaption>The oEmbed field settings</figcaption>
	</figure>
</div>

## Changelog
- Added in version 5.0.0.

## Settings
- **Embed Size**  
  Defines the width and height settings for the embed element.

## Template usage  
The oEmbed field will return a string containing the embed HTML.

### Basic display
This example demonstrates how to display an oEmbed.
```
<div class="embed-container">
	<?php the_field('oembed'); ?>
</div>
```

### Advanced display
This example demonstrates how to add extra attributes to both the iframe src and HTML.
```
<?php

$iframe = get_field('oembed');

// Use preg_match to find iframe src.
preg_match('/src="(.+?)"/', $iframe, $matches);
$src = $matches[1];

// Add extra parameters to iframe src.
$params = array(
    'controls'  => 0,
    'hd'        => 1,
    'autohide'  => 1
);

$new_src = add_query_arg($params, $src);
$iframe = str_replace($src, $new_src, $iframe);

// Add extra attributes to iframe HTML.
$attributes = 'frameborder="0"';

$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

// Echo customized iframe.
echo $iframe;

?>
```

### Responsive embeds
Thanks to the work done by [embedresponsively.com](http://embedresponsively.com/), it is now possible to make embeds responsive. Please view the website to learn more as each provider may need different CSS settings.
```
<div class="embed-container">
	<?php the_field('oembed'); ?>
</div>
<style>
	.embed-container { 
		position: relative; 
		padding-bottom: 56.25%;
		overflow: hidden;
		max-width: 100%;
		height: auto;
	} 

	.embed-container iframe,
	.embed-container object,
	.embed-container embed { 
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
</style>
```

## Notes

## Customizing other embed features
Due to the large number of embed providers, no settings are available to customize embed features such as overlays and buttons. To customize these settings, you will need to perform a search / replace on the string to add additional arguments to the iframe src.
