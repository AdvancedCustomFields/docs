---
title: Post Object
category: field-types
group: Relational
---

## Description
The Post Object field creates an interactive drop-down to select one or more posts, pages or custom post type items. This field type uses the Select2 library to enable search and AJAX functionality.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-post-object-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-post-object-field-interface.png" alt="A Post Object field that allows you to select from post, pages, etc." />
		</a>
		<figcaption>The Post Object field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-post-object-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-post-object-field-settings.png" alt="List of field settings shown when setting up a Post Object field" />
		</a>
		<figcaption>The Post Object field settings</figcaption>
	</figure>
</div>

## Settings
- **Filter by Post Type**  
  Filters the selectable results via one or more post type. When left empty, all post types will be shown. As results are grouped by their post type, the selected post types here may be positioned into a specific order.
  
- **Filter by Taxonomy**  
  Filters the selectable results via one or more taxonomy term.
  
- **Allow Null**  
  Allows the current selection to be cleared and an empty value to be saved.
  
- **Multiple**  
  Allows you to select more than one choice. When enabled, you may also drag/drop to reorder the selected choices.
  
- **Return Format**
  Specifies the returned value format. Choose from Post Object (WP_Post) or Post ID (integer).
  
## Template usage
Depending on the chosen field settings, the Post Object field will return either a single value or array of values, where each value is either a WP_Post object or an integer value.

### Display selected post
This example demonstrates how to display basic data (such as the post_title) from a Post Object value. The field in this example uses *Post Object* as the *Return Format* and is a single value.
```
<?php
$featured_post = get_field('featured_post');
if( $featured_post ): ?>
	<h3><?php echo esc_html( $featured_post->post_title ); ?></h3>
<?php endif; ?>
```

### Display list of posts *(with setup_postdata)*
This example demonstrates how to loop over a Post Object value and display a list of clickable links. Here, we use a special function named `setup_postdata()` to enable the use of WordPress template functions. The field in this example uses *Post Object* as the *Return Format* and is a multiple value.
```
<?php
$featured_posts = get_field('featured_posts');
if( $featured_posts ): ?>
    <ul>
    <?php foreach( $featured_posts as $post ): 
    
        // Setup this post for WP functions (variable must be named $post).
		setup_postdata($post); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <span>A custom field from this post: <?php the_field( 'field_name' ); ?></span>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php 
	// Reset the global post object so that the rest of the page works correctly.
	wp_reset_postdata(); ?>
<?php endif; ?>
```

### Display list of posts *(without setup_postdata)*
This example demonstrates how to loop over a Post Object value and display a list of clickable links. Here, the global post variable is never changed, so all "post" related functions need a second parameter to specify which object. The field in this example uses *Post Object* as the *Return Format* and is a multiple value.
```
<?php
$featured_posts = get_field('featured_posts');
if( $featured_posts ): ?>
    <ul>
    <?php foreach( $featured_posts as $featured_post ): 
		$permalink = get_permalink( $featured_post->ID );
		$title = get_the_title( $featured_post->ID );
		$custom_field = get_field( 'field_name', $featured_post->ID );
		?>
        <li>
            <a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
            <span>A custom field from this post: <?php echo esc_html( $custom_field ); ?></span>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
```

## Notes

### Customization
The Post Object field contains PHP filters to customize the [posts displayed](https://www.advancedcustomfields.com/resources/acf-fields-post_object-query/), and the [text displayed](https://www.advancedcustomfields.com/resources/acf-fields-post_object-result/) for each post.
