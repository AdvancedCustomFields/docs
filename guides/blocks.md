---
title: Blocks
description: 
category: guides
group: Features
status: draft
---

## Introduction

Included in ACF PRO is a powerful PHP-based framework for developing custom blocks.

ACF blocks are highly customisable and powerfully dynamic. They integrate deeply with custom fields allowing PHP developers to create bespoke solutions inline with WordPress theme development.

<figure>
  <img src="https://user-images.githubusercontent.com/2296425/54964175-a52c4300-4fbf-11e9-903c-b617576c0ce4.jpg" alt="acf-blocks-introduction"/>
  <figcaption>Simplified example of registering a testimonial block.</figcaption>
</figure>

## Features

### 🌎 PHP Environment
ACF blocks is a PHP framework and does not require any JavaScript. This differentiates itself from the WordPress block API which relies deeply on modern JavaScript techniques, syntax and build tools.

### 🎨 Simple Templating
Similar to WP theme development, ACF blocks are rendered using a template file or callback function allowing for full control over the HTML.

### 🔌 Custom Fields Compatible
ACF blocks boast full compatibility with all field types including even the Repeater and Clone fields!

It's a similar story with out template functions too. Whether you are loading a field value via `get_field()`, or looping over a Repeater field using `have_rows()`, the experience remains familiar and consistent to regular theme development.

### 👀 Live Previews
Content changes, and so do block previews! When editing, ACF blocks will update in the backend giving you a real time preview of your content. 

### 🌈 Native Compatibility
Believe it or not, ACF blocks maintain native compatibility with WordPress core allowing core features such as "alignment", "anchor" and "re-usable blocks" to work!

### 🎉 Anywhere and everywhere
ACF blocks are not tied to metadata, meaning they can be used anywhere in Gutenberg, and multiple times per post.


## Requirements

ACF Blocks is a premium feature found in [ACF PRO](https://www.advancedcustomfields.com/pro). If not already, please consider upgrading to take advantage of this premium feature!


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

Similar to registering a post type in WP, the [acf_register_block()](https://www.advancedcustomfields.com/resources/acf_register_block/) function allows you to register a custom block type from your functions.php file. This function accepts an array of settings that you can use to customize your block including a name, description and more.

💡 This example only uses a small handful of the available settings so please be sure to read the [acf_register_block()](https://www.advancedcustomfields.com/resources/acf_register_block/) docs for a full list.

```
function register_acf_blocks() {
	
	// register a testimonial block
	acf_register_block(array(
		'name'				=> 'testimonial',
		'title'				=> __('Testimonial'),
		'description'		=> __('A custom testimonial block.'),
		'render_template'	=> 'content-block-testimonial.php',
		'category'			=> 'formatting',
		'icon'				=> 'admin-comments',
		'keywords'			=> array( 'testimonial', 'quote' ),
	));
}

// Check function exists and hook into setup.
if( function_exists('acf_register_block') ) {
	add_action('acf/init', 'register_acf_blocks');
}
```

### 2. Create a Field Group

The next step is to create a field group as usual. Note that any and all ACF fields can be used within your block – there are no limitations!
That said, we don't recommend using complex or large amounts of fields. Keep your blocks as lightweight and simple as possible.

From the location rules, use the "Block" rule to select your newly registered block type.


### 3. Render the Block

Lastly, you'll need to tell ACF how to render the block, which is essentially the same process you’re used to for displaying custom fields. 

This is done by creating a template file within your theme that matches the *render_template* setting used when registering the block. In this example, the template file will be called 'content-block-testimonial.php'.

💡 There are multiple ways to render a block. Please read the [acf_register_block()](https://www.advancedcustomfields.com/resources/acf_register_block/) docs for a full description on the *render_template* and *render_callback* settings.

One very exciting feature of ACF Blocks is that all the ACF API function such as `get_field()`, `the_field()` and `have_rows()` will work as expected, loading values from the current `$block`!

#### template-parts/block/content-testimonial.php
```
<?php

// create id attribute for specific styling
$id = 'testimonial-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<blockquote id="<?php echo $id; ?>" class="testimonial <?php echo $align_class; ?>">
    <p><?php the_field('testimonial'); ?></p>
    <cite>
	    <?php if( $avatar = get_field('avatar') ): ?>
	    	<img src="<?php echo $avatar['url']; ?>" alt="<?php echo $avatar['alt']; ?>" />
	    <?php endif; ?>
    	<span><?php the_field('author'); ?></span>
    </cite>
</blockquote>
```


The only thing we haven’t included is the enqueuing of styles which can easily be done via the [admin_enqueue_scripts](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts) and [wp_enqueue_scripts](https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts) actions.

That’s all there is to it! You can immediately start using your new block within Gutenberg and place it anywhere within your content 💯.

[screenshot / video]

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
No. The ACF blocks framework is 100% PHP. If your bock requires some JS for added functionality (a carousel slider for example), you can add this also.
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



## End

We believe that ACF Blocks is one of the more important features ever added to our plugin. It levels the playing field for block type development and allows more developers to take advantage of Gutenberg’s key feature.

You don’t need to be a JavaScript expert in order to create custom blocks. And you won’t have to radically alter your workflow. ACF Blocks will help you accomplish more, while doing less.








Remember that render_callback setting mentioned earlier? This is the PHP function that renders your block’s HTML and is where you can write your custom code. We recommend taking a “modular” approach by using a generic callback function to include a “template part” for your block. This is possible by making use of the $block parameter.









If it helps, you can think of blocks as a more graceful shortcode. To this point, there is a new Block Grammar. Distilled, the block grammar is an HTML comment which is saved throughout the content. Here is an example of how a WordPress block is saved into the database.

```
<!-- wp:paragraph {"key": "value"} -->
<p>Welcome to the world of blocks.</p>
<!-- /wp:paragraph -->
```

Blocks can be static or dynamic. ACF Blocks are dynamic, meaning they are rendered server-side and allow for PHP logic.

We highly recommend reading the [Gutenberg Handbook Key Concepts](https://wordpress.org/gutenberg/handbook/designers-developers/key-concepts/) if you are interested in learning more about the internals of blocks.




## Getting Started







## Key Concepts

Introduced in WordPress 5.0, the block-based editor "Gutenberg" has transformed the way content is created. 
Content is now created in the unit of blocks instead of freeform text. Blocks take various forms including Paragraphs, Headings, Media and Embeds.

Whilst WordPress provide a wide range of blocks to work with, we understand that bespoke websites require custom solutions, and custom blocks!
That's why we built ACF Blocks, a PHP-based framework to register custom block types using custom fields to power dynamic content.

One powerful feature of ACF Blocks is that you can register, customize and render your block without writing a single line of JavaScript.
Another is that your blocks custom field data remains uncoupled from the design, allowing you to render complex block types without considering the potential UI or UX issues.

This guide will explore the exciting features offered in ACF Blocks and the step by step instructions to start developing blocks in PHP.


## Working with Blocks



 a single line of JavaScript.







They utilise custom fields to  They don't require any JavaScript, JSX or React knowledge, and 

Blocks are the new way to think about publishing content in WordPress, and ACF blocks allow PHP developers to access this new and exciting experience.




 provide the functionality needed for PHP developers to better develop bespoke content.



It takes out the heavy lifting of block development by utilising the power of custom fields to power dynamic content.

These block types are registered using PHP and take advantage of custom fields to power dynamic content. This means that no Javascript is required to develop stunning bespoke block types for the Gutenberg editor.