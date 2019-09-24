---
title: True-False
category: field-types
group: Choice
status: draft
---

## Description
The True / False field allows you to select a value that is either 1 or 0.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-true-false-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-true-false-field-interface.png" alt="True/false field that allows you to check a box or toggle a switch" />
		</a>
		<figcaption>The True false field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-true-false-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-true-false-field-settings.png" alt="List of settings shown when creating a True/false field" />
		</a>
		<figcaption>The True false field settings</figcaption>
	</figure>
</div>

## Changelog
- Added 'UI' setting in version 5.5.0.
- Added 'On Text' setting in version 5.5.0.
- Added 'Off Text' setting in version 5.5.0.

## Settings
- **Message**
  This text is displayed alongside the input.

- **Default Value**
  Sets the default state (on / off) when adding a new post.

- **Stylized UI**
  Changes the default checkbox input into a stylized toggle switch.

- **On Text**
  Text displayed within the stylized toggle switch. Defaults to ‘Yes’. HTML may be entered for icons or custom markup.

- **Off Text**
  Text displayed within the stylized toggle switch. Defaults to ‘No’. HTML may be entered for icons or custom markup.

## Template usage
The True / False field will return a Boolean value of either `true` or `false`. The value is saved to the database as ‘1’ or ‘0’.

### Conditional
This example demonstrates how to use the value 'enable_sidebar' to conditionally do a task.

```
<?php if( get_field( 'enable_sidebar' ) ): ?>

	<?php // Do something. ?>

<?php endif; ?>
```

### Query Posts
This example demonstrates how to query posts that have a `true` value for the field 'enable_sidebar'.

```
<?php

$posts = get_posts( array(
	'meta_query' => array(
		array(
			'key'     => 'enable_sidebar',
			'compare' => '=',
			'value'   => '1'
		)
	)
) );

if( $posts ): ?>

	<ul>

	<?php foreach( $posts as $post ):

		setup_postdata( $post );

		?>
		<li>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</li>

	<?php endforeach; ?>

	</ul>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>
```
