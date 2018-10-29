---
title: acf_register_block()
description: Registers a custom block type in the Gutenberg editor.
category: functions
---

## Description
Registers a custom block type in the Gutenberg editor.

Blocks are the fundamental element of the Gutenberg editor. WordPress provides many default block types such as paragraph, heading and image. The **acf_register_block()** function can be used to add new block types via PHP.

Once registered, your block will appear in the "Block" location rules when editing a field group. This allows you to map fields to your block and define the content.
To render the block, create a PHP template (or callback function) to output the block HTML using PHP functions like [get_field()](https://www.advancedcustomfields.com/resources/get_field/) and [the_field()](https://www.advancedcustomfields.com/resources/the_field/).

Note: Block type registration should be done within the acf/init action. This is not required, but is a safe way to ensure that ACF is fully initialized.

Block types can support any number of built-in core features such as name, icon, description, category and more. See the $settings argument for a complete list of supported features.

## Parameters
```
acf_register_block( $settings );
```

### $settings
*(array)* *(Required)* Array of arguments for registering a block type. Any argument from the JavaScript [registerBlockType()](https://wordpress.org/gutenberg/handbook/block-api/) function may also be used.
- **name**  
  (String) A unique name that identifies the block (without namespace). For example 'testimonial'.
  ```
  'name' => 'testimonial',
  ```
  
- **title**  
  (String) The display title for your block. For example 'Testimonial'.
  ```
  'title' => __('Testimonial'),
  ```
  
- **description**  
  (String) (Optional) This is a short description for your block.
  ```
  'description' => __('My testimonial block.'),
  ```
  
- **category**  
  (String) Blocks are grouped into categories to help users browse and discover them. The core provided categories are  [ common | formatting | layout | widgets | embed ]. Plugins and Themes can also register [custom block categories](https://wordpress.org/gutenberg/handbook/extensibility/extending-blocks/#managing-block-categories).
  ```
  'category' => 'embed',
  ```

- **icon**  
  (String|Array) (Optional) An icon property can be specified to make it easier to identify a block. These can be any of [WordPress’ Dashicons](https://developer.wordpress.org/resource/dashicons/), or a custom svg element.
  ```
  // Specifying a dashicon for the block
  'icon' => 'book-alt',
  
  // Specifying a custom svg for the block
  'icon' => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0V0z" /><path d="M19 13H5v-2h14v2z" /></svg>',
  
  // Specifying colors
  'icon' => array(
  	// Specifying a background color to appear with the icon e.g.: in the inserter.
  	'background' => '#7e70af',
  	// Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
  	'foreground' => '#fff',
  	// Specifying a dashicon for the block
  	'src' => 'book-alt',
  ),
  ```
  
- **keywords**  
  (Array) (Optional) An array of search terms to help user discover the block while searching.
  ```
  'keywords' => array('quote', 'mention', 'cite'),
  ```
  
- **post_types**  
  (Array) (Optional) An array of post types to restrict this block type to.
  ```
  'post_types' => array('post', 'page'),
  ```
  
- **render_template**  
  (String) The path to a template file used to render the block HTML. This can either be a relative path to a file within the active theme or a full path to any file.
  ```
  // Specifying a relative path within the active theme
  'render_template' => 'template-parts/block/content-testimonial.php',
  
  // Specifying an absolute path
  'render_template' => plugin_dir_path( __FILE__ ) . 'template-parts/block/content-testimonial.php',
  ```
	
- **render_callback**  
  (Callable) (Optional) Instead of providing a render_template, a callback function name may be specified to output the block's HTML.
  ```
  // Specifying a function
  'render_callback' => 'my_acf_block_render_callback',
  
  // Specifying a class method
  'render_callback' => array($this, 'block_render_callback'),
  ```
  
- **supports**  
  (Array) (Optional) An array of features to support. All properties from the JavaScript [block supports](https://wordpress.org/gutenberg/handbook/block-api/) documentation may be used. The following options are supported:
  ```
  'supports' => array( /* ... */ ),
  ```
	
  - **align**  
    This property adds block controls which allow the user to change the block’s alignment. Defaults to `true`. Set to `false` to hide the alignment toolbar. Set to an array of specific alignment names to customize the toolbar.
    ```
    // disable alignment toolbar
    'align' => false,
    
    // customize alignment toolbar
    'align' => aray( 'left', 'right', 'full' ),
    ```

  - **mode**  
    This property allows the user to toggle between edit and preview modes via a button. Defaults to `true`.
    ```
    // disable preview/edit toggle
    'mode' => false,
    ```
	
  - **multiple**  
    This property allows the block to be added multiple times. Defaults to `true`.
     ```
    'multiple' => false,
    ```

## Examples

### Registering a block with template
This example shows how to register a block using the render_template setting.

#### functions.php
```
add_action('acf/init', 'my_register_blocks');
function my_register_blocks() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a testimonial block
		acf_register_block(array(
			'name'				=> 'testimonial',
			'title'				=> __('Testimonial'),
			'description'		=> __('A custom testimonial block.'),
			'render_template'	=> 'template-parts/block/content-testimonial.php',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'mode'				=> 'preview',
			'keywords'			=> array( 'testimonial', 'quote' ),
		));
	}
}
```

#### template-parts/block/content-testimonial.php
```
<?php

/**
 * This is the template that renders the testimonial block.
 *
 * @param	array $block The block settings and attributes.
 * @param	bool $is_preview True during AJAX preview.
 */

// get image field (array)
$avatar = get_field('avatar');

// create id attribute for specific styling
$id = 'testimonial-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<blockquote id="<?php echo $id; ?>" class="testimonial <?php echo $align_class; ?>">
    <p><?php the_field('testimonial'); ?></p>
    <cite>
    	<img src="<?php echo $avatar['url']; ?>" alt="<?php echo $avatar['alt']; ?>" />
    	<span><?php the_field('author'); ?></span>
    </cite>
</blockquote>

```

### Registering a block with callback
This example shows how to register a block using the render_callback setting.

#### functions.php
```
add_action('acf/init', 'my_register_blocks');
function my_register_blocks() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a testimonial block
		acf_register_block(array(
			'name'				=> 'testimonial',
			'title'				=> __('Testimonial'),
			'description'		=> __('A custom testimonial block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'mode'				=> 'preview',
			'keywords'			=> array( 'testimonial', 'quote' ),
		));
	}
}

/**
 *  This is the callback that displays the testimonial block.
 *
 * @param	array $block The block settings and attributes.
 * @param	string $content The block content (emtpy string).
 * @param	bool $is_preview True during AJAX preview.
 */
function my_acf_block_render_callback( $block, $content = '', $is_preview = false ) {
	
	// get image field (array)
	$avatar = get_field('avatar');
	
	// create id attribute for specific styling
	$id = 'testimonial-' . $block['id'];
	
	// create align class ("alignwide") from block setting ("wide")
	$align_class = $block['align'] ? 'align' . $block['align'] : '';
	
	?>
	<blockquote id="<?php echo $id; ?>" class="testimonial <?php echo $align_class; ?>">
	    <p><?php the_field('testimonial'); ?></p>
	    <cite>
	    	<img src="<?php echo $avatar['url']; ?>" alt="<?php echo $avatar['alt']; ?>" />
	    	<span><?php the_field('author'); ?></span>
	    </cite>
	</blockquote>
	<?php
}
```
