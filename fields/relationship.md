---
title: Relationship
category: field-types
group: Relational
---

## Description
The Relationship field provides a duel-column component to select one or more posts, pages or custom post type items. This field type provides search, post type and taxonomy filtering controls to help find results.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-relationship-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-relationship-field-interface.png" alt="A duel-column components displaying available and selected results." />
		</a>
		<figcaption>The Relationship field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-relationship-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-relationship-field-settings.png" alt="List of field settings shown when setting up a Relatinship field." />
		</a>
		<figcaption>The Relationship field settings</figcaption>
	</figure>
</div>

## Settings
- **Filter by Post Type**  
  Filters the selectable results via one or more post type. When left empty, all post types will be shown. As results are grouped by their post type, the selected post types here may be positioned into a specific order.
  
- **Filter by Taxonomy**  
  Filters the selectable results via one or more taxonomy term.
  
- **Filters**  
  Specifies which filters are displayed in the component. Select from "Search", "Post Type" and "Taxonomy".
  
- **Elements**  
  Specifies which elements are displayed in each result. Select from "Featured Image".
  
- **Minimum Posts**  
  Sets a limit on how many posts are required.
  
- **Maximum Posts**  
  Sets a limit on how many posts are allowed.
  
- **Return Format**
  Specifies the returned value format. Choose from Post Object (WP_Post) or Post ID (integer).

## Template usage  
The Relationship field will return an array of items where each items is either a *WP_Post* object or an *integer* value depending on the Return Format set.

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
The Relationship field contains filters to customize the [posts displayed](https://www.advancedcustomfields.com/resources/acf-fields-relationship-query/), and the [text displayed](https://www.advancedcustomfields.com/resources/acf-fields-relationship-result/) for each post.

### Reverse Query
It is possible to perform a reverse query on a post (post A) to find all the posts (post B, post C) which have selected it (post A). To learn more about a reverse query, please read [this in-depth tutorial](https://www.advancedcustomfields.com/resources/tutorials/querying-relationship-fields/).
