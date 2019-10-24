---
title: Post Object
category: field-types
group: Relational
status: draft
---

## Description
The Post Object field creates a select field with the chioces of pages, posts, and custom post types.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-post-object-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-post-object-interface.png" alt="A Post Object field that allows you to select from post, pages, etc." />
		</a>
		<figcaption>The Post Object field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-post-object-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-post-object-settings.png" alt="List of field settings shown when setting up a Post Object field" />
		</a>
		<figcaption>The Post Object field settings</figcaption>
	</figure>
</div>

## Settings
- **Post Type**  
  Filters available posts via 1 or more post type.
  
- **Filter from Taxonomy**  
  Filters available posts via 1 or more taxonomy.
  
- **Allow Null?**  
  Allows the current selection to be cleared and an empty value to be saved.

- **Multiple**  
  Allows you to select more than one choice.

## Template usage  
The Post Object field will return either a single post object (using [get_post](https://codex.wordpress.org/Function_Reference/get_post)) or an array of post objects (using [get_posts](https://codex.wordpress.org/Function_Reference/get_posts).

### Display data (single post object)
This example demonstrates how to display the Post Object's data using built-in WordPress functions.
```
<?php

$post_object = get_field('post_object');

if( $post_object ): 

	// Override $post
	$post = $post_object;
	setup_postdata( $post ); 

	?>
    <div>
    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    	<span>Post Object Custom Field: <?php the_field('field_name'); ?></span>
    </div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so rest of page works correctly ?>
<?php endif; ?>
```

### Display data (multiple post objects) using `setup_postdata`
This example demonstrates how to loop through post objects (assuming this is a multi-select field). With this method, you can use all the normal WordPress functions as the $post object is [temporarily initialized](http://codex.wordpress.org/Template_Tags/get_posts#Reset_after_Postlists_with_offset) within the Loop.
```
<?php

$post_objects = get_field('post_objects');

if( $post_objects ): ?>
    <ul>
    <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <span>Post Object Custom Field: <?php the_field('field_name'); ?></span>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>
```

### Display data (multiple post objects) without using `setup_postdata`
This example demonstrates how to display data by looping through post objects (assuming this is a multi-select field). With this method, the $post obect is never changed, so all functions need a second parameter of the post ID in question.
```
<?php

$post_objects = get_field('post_objects');

if( $post_objects ): ?>
    <ul>
    <?php foreach( $post_objects as $post_object ): ?>
        <li>
            <a href="<?php echo get_permalink( $post_object->ID ); ?>"><?php echo get_the_title( $post_object->ID ); ?></a>
            <span>Post Object Custom Field: <?php the_field('field_name', $post_object->ID); ?></span>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
```

### View data for debugging
This example demonstrates how to print the contents of the field to the page for debugging purposes.
```
echo '<pre>';
    print_r( get_field('post_objects')  );
echo '</pre>';
die;
```

## Notes

### Customization
The Post Object field contains filters to allow for customization of the [posts displayed](https://www.advancedcustomfields.com/resources/acf-fields-post_object-query/), and the [text displayed](https://www.advancedcustomfields.com/resources/acf-fields-post_object-result/) for each post.
