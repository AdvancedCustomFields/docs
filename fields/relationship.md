---
title: Relationship
category: field-types
group: Relational
status: draft
---

## Description
The Relationship field creates a more stylized version of the Post Object field. Similarly, you can select from pages, posts, and custom post types.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-relationship-field-interface.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-relationship-field-interface.jpg" alt="A Relationship field that allows you to select 3 Featured Posts" />
		</a>
		<figcaption>The Relationship field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-relationship-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-relationship-field-settings.png" alt="List of field settings shown when setting up a Relatinship field" />
		</a>
		<figcaption>The Relationship field settings</figcaption>
	</figure>
</div>

## Settings
- **Post Type**  
  Filters available posts via 1 or more post type.
  
- **Filter from Taxonomy**  
  Filters available posts via 1 or more taxonomy.
  
- **Maximum Posts**  
  Sets a limit on how many posts are allowed. Leave field blank or set to `-1` for infinite selections.

## Template usage  
The Relationship field will return an array of post objects in the same way that the [get_posts](http://codex.wordpress.org/Template_Tags/get_posts) function would.

### Display data in Loop (with setup_postdata)
This example demonstrates how to load the selected posts from a Relationship field and display them in a list. It utilizes `setup_postdata` which overrides the global $post object to allow functions such as the_title to target the selected post. When using this function, it is important to [reset the post](http://codex.wordpress.org/Template_Tags/get_posts#Reset_after_Postlists_with_offset) after your loop.
```
<?php 

$posts = get_field('relationship_field_name');

if( $posts ): ?>
    <ul>
    <?php foreach( $posts as $post ): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata( $post ); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <span>Custom field from $post: <?php the_field('author'); ?></span>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>
```

### Display data in Loop (without setup_postdata)
This example demonstrates how to load the selected posts from a Relationship field and display them in a list. As it does not use the above mentioned `setup_postdata` function, it utilizes the `$post->ID` as the second parameter to target the selected post.

Please note that some of the function names change to allow for the $post_id parameter such as `the_title() => get_the_title()`.
```
<?php 

$posts = get_field('relationship_field_name');

if( $posts ): ?>
    <ul>
    <?php foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) ?>
        <li>
            <a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
            <span>Custom field from $post: <?php the_field('author', $p->ID); ?></span>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
```

### Using WP_Query arguments
This example demonstrates how to use the selected post ID's (instead of the post objects) for use within a `WP_Query`. This lets you specify arguments such as `posts_per_age`, `order`, and `orderby`. For more about this, please read the [`WP_Query` documentation](http://codex.wordpress.org/Class_Reference/WP_Query#Parameters).

_Note:_ The `get_field` function has two false parameters: the first for $post_id and the second to have ACF return only what is in the database.
```
<?php 

// Get only first 3 results
$ids = get_field('conference_talks', false, false);

$query = new WP_Query(array(
    'post_type'         => 'conferences',
    'posts_per_page'    => 3,
    'post__in'          => $ids,
    'post_status'       => 'any',
    'orderby'           => 'post__in',
));

?>
```

## Notes

### Customization
The Relationship field contains filters to allow for customization of the [posts displayed](https://www.advancedcustomfields.com/resources/acf-fields-relationship-query/), and the [text displayed](https://www.advancedcustomfields.com/resources/acf-fields-relationship-result/) for each post.

### Reverse Query
It is possible to perform a reverse query on a post (post A) to find all the posts (post B, post C) which have selected it (post A). To learn more about a reverse query, please read [this in-depth tutorial](https://www.advancedcustomfields.com/resources/tutorials/querying-relationship-fields/).
