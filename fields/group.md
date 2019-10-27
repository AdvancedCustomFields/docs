---
title: Group
category: field-types
group: Layout
status: draft
---

## Description
The Group field provides a way to create a group of fields. It assists in better organizing the edit screen UI as well as the data.

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
  Changes the layout styles of the appearance of the sub fields
    - Block (default): Labels will appear above fields.
    - Table: Displays each sub field alongside each other in a single row table.
    - Row: Displays each sub field below each other with left aligned labels.

## Template Usage
The Group field is a wrapper containing a group of sub fields. It will return an array containing each sub field's value in a `name => value` format.

### Display contents
This example demonstrates how to display the contents of a Group field.
```
<?php
		
// Define variable.
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
<?php if( have_rows('hero') ): 

	while( have_rows('hero') ): the_row(); 
		
		// Define variables.
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
