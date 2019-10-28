---
title: Group
category: field-types
group: Layout
status: draft
---

## Description
The Group field provides a way to structure fields into groups. It assists in better organizing the edit screen UI as well as the data.

The Group field uses both the parent and child field names when saving and loading values. For example, a Group field named ‘hero’ with a sub field named ‘image’ will be saved to the database using the meta name ‘hero_image’.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-field-group-interface.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-field-group-interface.jpg" alt="Group field that displays multiple fields (image, link, caption, etc.) within" />
		</a>
		<figcaption>The Group field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-field-group-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-field-group-settings.png" alt="List of settings shown when creating a Group field" />
		</a>
		<figcaption>The Group field settings</figcaption>
	</figure>
</div>

## Changelog
- Added in version 5.6.0.

## Settings
- **Sub Fields**  
  Defines the sub fields which will appear within this group.
  
- **Layout**  
  Defines the layout style used to render the field interface. Available settings are:  
  **Block**: Sub fields are displayed in blocks, one after the other.  
  **Table**: Sub fields are displayed in a single row table. Labels will appear in the table header.  
  **Row**: Sub fields are displayed in a two column table. Labels will appear in the first column.  

## Template Usage
The Group field field returns an array containing each sub field's value in a `name => value` format.

### Display contents
This example demonstrates how to display the contents of a Group field.
```
<?php
$hero = get_field('hero');
if( $hero ): ?>
	<div id="hero">
		<img src="<?php echo esc_url( $hero['image']['url'] ); ?>" alt="<?php echo esc_attr( $hero['image']['alt'] ); ?>" />
		<div class="content">
			<?php echo $hero['caption']; ?>
			<a href="<?php echo esc_url( $hero['link']['url'] ); ?>"><?php echo esc_html( $hero['link']['title'] ); ?></a>
		</div>
	</div>
	<style type="text/css">
		#hero {
			background-color: <?php echo esc_attr( $hero['color'] ); ?>;
		}
	</style>
<?php endif; ?>
```

### Loop example
This example demonstrates how to display the same group using the [have_rows()](https://www.advancedcustomfields.com/resources/have_rows/) function. While similar to looping over a Repeater field value, there is only a single row in this value.
```
<?php if( have_rows('hero') ): ?>
	<?php while( have_rows('hero') ): the_row(); 
		
		// Get sub field values.
		$image = get_sub_field('image');
		$link = get_sub_field('link');
		
		?>
		<div id="hero">
			<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
			<div class="content">
				<?php the_sub_field('caption'); ?>
				<a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_attr( $link['title'] ); ?></a>
			</div>
		</div>
		<style type="text/css">
			#hero {
				background-color: <?php the_sub_field('color'); ?>;
			}
		</style>
	<?php endwhile; ?>
<?php endif; ?>
```
