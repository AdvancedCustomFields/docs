---
title: Page Link
category: field-types
group: Relational
---

## Description
The Page Link field creates a drop-down list to select one or more posts, pages, CPTs or archive URLs from.

This field type returns only a URL string as the value making it convenient for links. To get more data from a selected post, please use the [post object](https://www.advancedcustomfields.com/resources/post-object/) field instead.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-page-link-field-interface.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-page-link-field-interface.jpg" alt="A Page Link field that allows you to choose an existing post, page or CPT from a list" />
		</a>
		<figcaption>The Page Link field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-page-link-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-page-link-field-settings.png" alt="List of field settings shown when setting up a Page Link field" />
		</a>
		<figcaption>The Page Link field settings</figcaption>
	</figure>
</div>

## Changelog
- Added `Allow Archives` in version 5.4.0.
- Added Select2 UI in version 5.0.0.

## Settings
- **Filter by Post Type**  
  Filters available posts via 1 or more post type.
  
- **Filter by Taxonomy**  
  Filters available posts via 1 or more taxonomies.
  
- **Allow Null**  
  Allows the current selection to be cleared and an empty value to be saved.
  
- **Allow Archives**  
  Includes post type archive URLs within the select list of options.
  
- **Multiple**  
  Allows you to select more than one choice.

## Template usage  

### Basic Display
This example demonstrates how to display a selected page link value.
```
<a href="<?php the_field('page_link'); ?>">Read this!</a>
```

### Display multiple values
This example demonstrates how to load and display multiple selected page link values.
```
<?php 
$urls = get_field('urls');
if( $urls ): ?>
<h3>Further reading</h3>
<ul>
	<?php foreach( $urls as $url ): ?>
	<li>
		<a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $url ); ?></a>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
```