---
title: Page Link
category: field-types
group: Relational
status: draft
---

## Description
The Page Link field allows the selection of 1 or more posts, pages or custom post types.

This field is useful for easily linking to another post because it will return the post’s permalink. To get more data from the selected post, please use the [post object](https://www.advancedcustomfields.com/resources/post-object/) field.

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
  Allows no value to be selected. If selected, the select list will begin with an empty choice labelled “- Select -“.
  
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
		<a href="<?php echo esc_url( $url ); ?>"><?php echo esc_attr( $url ); ?></a>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
```

### Display additional link data
This example demonstrates how to load the selected page link value in its raw form (`post_id`) and use this to load extra data about the post.
```
<?php 

// Get value without formatting.
$post_id = get_field('url', false, false);

if( $post_id ): ?>
<a href="<?php echo get_the_permalink( $post_id ); ?>"><?php echo get_the_title( $post_id ); ?></a>
<?php endif; ?>
```
