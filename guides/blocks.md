---
title: Blocks
description: 
category: guides
group: Features
---

## Introduction

Included in ACF PRO is a powerful PHP-based framework for developing custom block types.

ACF blocks are highly customisable and powerfully dynamic. They integrate deeply with custom fields allowing PHP developers to create bespoke solutions inline with WordPress theme development.

<figure>
  <img src="https://user-images.githubusercontent.com/2296425/55047773-0a546700-509a-11e9-9e45-aff00acb48e8.jpg" alt="acf-blocks-introduction"/>
  <figcaption>Simplified example of registering a custom testimonial block.</figcaption>
</figure>

## Features

### 🌎 PHP Environment
ACF blocks is a PHP framework and does not require any JavaScript. This differentiates itself from the WordPress block API which relies heavily on modern JavaScript techniques, syntax and build tools.

### 🎨 Simple Templating
Similar to WP theme development, ACF blocks are rendered using a PHP template file or callback function allowing full control over the output HTML.

### 🔌 Custom Fields Compatible
ACF blocks offer full compatibility with all field types including both the Repeater and Clone fields!

It's a similar story for template functions too. Whether you are loading a field value via `get_field()`, or looping over a Repeater field using `have_rows()`, the experience remains familiar and consistent to regular theme development.

### 👀 Live Previews
Content changes, and so do block previews! When editing an ACF block, the HTML will update in the backend giving you a real time preview of your content. 

### 🌈 Native Compatibility
Believe it or not, ACF blocks maintain native compatibility with WordPress core. This allows features such as "alignment", "anchor" and "re-usable blocks" to work!

### 🎉 Anywhere and everywhere
ACF blocks are not tied to metadata, meaning they can be used anywhere in Gutenberg, and multiple times per post.


## Requirements

ACF Blocks is a premium feature found in [ACF PRO](https://www.advancedcustomfields.com/pro) version 5.8.0 and above. If not already, please consider upgrading to take advantage of this premium feature!


## Key Concepts
Before reading any further, it's a good idea to familiarise yourself with some of the concepts introduced by the Gutenberg editor.

- Blocks are an abstract unit for organizing and composing content introduced in WordPress 5.0.
  If it helps, you can think of blocks as a more graceful shortcode, with rich formatting tools for users to compose content.
- Blocks can be static or dynamic. ACF Blocks are dynamic, meaning they are rendered server-side and allow for PHP logic.
- ACF Blocks are registered and customized within the `functions.php` file using PHP and do not require any knowledge of React or the WP blocks JavaScript API.
- ACF blocks differ from WP blocks in that the data is decoupled from the design. This allows for faster development of blocks by focusing only on the HTML output.
- Block data is saved within the "post_content" as an HTML comment. This makes them unique to metaboxes which save data to the "postmeta" table.


## Getting Started

The ACF Blocks framework performs a lot of "magic" behind the scenes to offer an intuitive development experience. We’ve simplified the process down to just three steps:

### 1. Register a Block

Similar to registering a post type, the [acf_register_block_type()](https://www.advancedcustomfields.com/resources/acf_register_block_type/) function allows you to register a custom block type from your functions.php file. This function accepts an array of settings that you can use to customize your block including a name, description and more.

💡 This example only uses a small handful of the available settings so please be sure to read the [acf_register_block_type()](https://www.advancedcustomfields.com/resources/acf_register_block_type/) docs for a full list.

```
function register_acf_block_types() {
	
	// register a testimonial block.
	acf_register_block_type(array(
		'name'				=> 'testimonial',
		'title'				=> __('Testimonial'),
		'description'		=> __('A custom testimonial block.'),
		'render_template'	=> 'template-parts/blocks/testimonial/testimonial.php',
		'category'			=> 'formatting',
		'icon'				=> 'admin-comments',
		'keywords'			=> array( 'testimonial', 'quote' ),
	));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
	add_action('acf/init', 'register_acf_block_types');
}
```

### 2. Create a Field Group

The next step is to create a field group for your block. Note that any and all ACF fields can be used within your block – there are no limitations!

That said, we don't recommend using complex or large amounts of fields. Keep your blocks as lightweight and simple as possible.

From the location rules, use the "Block" rule to select your newly registered block type.

<figure>
  <img src="https://user-images.githubusercontent.com/2296425/55047871-556e7a00-509a-11e9-8085-b92ff3b5a5cc.png" alt="acf-blocks-field-group"/>
  <figcaption>Screenshot of field group settings and block location rule.</figcaption>
</figure>

### 3. Render the Block

Lastly, you'll need to tell ACF how to render the block, which is essentially the same process you’re used to for displaying custom fields. 

This is done by creating a template file within your theme that matches the *render_template* setting used when registering the block. In this example, the template file will be called 'template-parts/blocks/testimonial/testimonial.php'.

💡 There are multiple ways to render a block. Please read the [acf_register_block_type()](https://www.advancedcustomfields.com/resources/acf_register_block_type/) docs for a full description on the *render_template* and *render_callback* settings.

One very exciting feature of ACF Blocks is that all the ACF API function such as `get_field()`, `the_field()` and `have_rows()` will work as expected!

#### template-parts/blocks/testimonial/testimonial.php
```
<?php

/**
 * Testimonial Block Template.
 *
 * @param	array $block The block settings and attributes.
 * @param	string $content The block inner HTML (empty).
 * @param	bool $is_preview True during AJAX preview.
 * @param	(int|string) $post_id The post ID this block is saved to.
 */
 
// Create id attribute allowing for custom "anchor" value.
$id = 'testimonial-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'testimonial';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$text = get_field('testimonial') ?: 'Your testimonial here...';
$author = get_field('author') ?: 'Author name';
$role = get_field('role') ?: 'Author role';
$image = get_field('image') ?: 295;
$background_color = get_field('background_color');
$text_color = get_field('text_color');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<blockquote class="testimonial-blockquote">
		<span class="testimonial-text"><?php echo $text; ?></span>
		<span class="testimonial-author"><?php echo $author; ?></span>
		<span class="testimonial-role"><?php echo $role; ?></span>
	</blockquote>
    <div class="testimonial-image">
	    <?php echo wp_get_attachment_image( $image, 'full' ); ?>
    </div>
    <style type="text/css">
    	#<?php echo $id; ?> {
			background: <?php echo $background_color; ?>;
			color: <?php echo $text_color; ?>;
		}
    </style>
</div>
```

The only thing we haven’t included is the enqueuing of styles/scripts which can easily be done via the enqueue_style, enqueue_script and enqueue_assets settings available in the [acf_register_block_type](https://www.advancedcustomfields.com/resources/acf_register_block_type/) documentation.

### Demonstration

That’s all there is to it! You can immediately start using your new block within Gutenberg and place it anywhere within your content 💯.

[recordit id="lMWmuunJMV"]

## FAQ

### Are blocks a replacement for metaboxes?
No. Metaboxes are still an important part of the content editing and theme development process. In fact, ACF will continue to utilize them as the primary tool for saving content.
^^^

### Can I make changes to the field group?
Yes. You can make changes to your field group and fields at any time. Making changes like this will not cause any damage to already existing blocks.
^^^

### Can I make changes to the template?
Yes. You can make changes to your block template or callback function at any time. ACF blocks are 100% dynamic meaning that they are rendered by the server each time they are loaded. This allows changes to block templates to be applied all existing block content.
^^^

### Can I register a block without fields?
Yes. There are many scenarios where a block does not require any fields, such as a "latest post" block.
^^^

### Is ACF Blocks included in the free version?
No. Contrary to our original post back in 2018, ACF blocks is only included in our professional version. This decision to go "Pro only" came after realising the amount of time and attention this feature will require over the coming years.
^^^

### Do I need to write any JavaScript?
No. The ACF blocks framework is 100% PHP. If your block requires some JS for added functionality (a carousel slider for example), you can add this also.
^^^

### Where is block data saved?
WordPress saves block data as HTML comments in the post_content. ACF blocks follow suit and save their data as a JSON object within that HTML comment.
^^^

### Can I load values from other blocks?
Yes and No. Unlike loading a value from a post or user, block values are saved in the block HTML comment found within the post_content. This prevents the `$post_id` parameter from working as expected in our template functions. You can, however, load the post_content of a given post, and then parse the blocks using the `parse_blocks()	` function.
^^^

### Do ACF blocks support native components?
Not yet. We are currently experimenting in this area and hope to roll out support for native block components in the future.
^^^

### What is Gutenberg and what are blocks?
Introduced in WordPress 5.0, the block-based editor "Gutenberg" has transformed the way content is created. Content is now created in the unit of blocks instead of freeform text. Blocks take various forms including Paragraphs, Headings, Media and Embeds.
^^^
