---
title: acf_register_block()
description: Registers a custom block type in the Gutenberg editor.
category: functions
group: Other
---

## Description
Registers a custom block type in the Gutenberg editor.

Blocks are the fundamental element of the Gutenberg editor. WordPress provides many default block types such as paragraph, heading and image. The `acf_register_block()` function can be used to add new block types using ACF fields to power the content and provide an abstraction layer to handle the PHP templates.

Note: Block type registration should be done within the acf/init action. This is not required, but is a safe way to ensure that ACF is fully initialized.

Block types can support any number of built-in core features such as name, icon, description, category and more. See the $settings argument for a complete list of supported features.

## Parameters
```
acf_register_block( $settings );
```

### $settings
*(array)*	*(Required)* Array of arguments for registering a block type. Any argument from the JavaScript [registerBlockType()](https://wordpress.org/gutenberg/handbook/block-api/) function may also be used.
- **name** \
  (String) A unique name that identifies the block (without namespace). For example 'testimonial'.
- **title** \
  (String) The display title for your block. For example 'Testimonial'.
- **description** \
  (String) (Optional) This is a short description for your block.
- **category** \
  (String) Blocks are grouped into categories to help users browse and discover them. The core provided categories are  [ common | formatting | layout | widgets | embed ]. Plugins and Themes can also register [custom block categories](https://wordpress.org/gutenberg/handbook/extensibility/extending-blocks/#managing-block-categories).
- **icon** \
  (String|Array) (Optional) An icon property can be specified to make it easier to identify a block. These can be any of [WordPress’ Dashicons](https://developer.wordpress.org/resource/dashicons/), or a custom svg element.
- **keywords** \
  (Array) (Optional) An array of search terms to help user discover the block while searching.
- **post_types** \
  (Array) (Optional) An array of post types to restrict this block type to.
- **render_template** \
  (String) The path to a template file used to render the block HTML. This can either be a relative path to a file within the active theme or a full path to any file.
- **render_callback** \
  (Callable) (Optional) Instead of providing a render_template, a callback function name may be specified to output the block's HTML.
- **supports** \
  (Array) (Optional) An array of features to suport. All properties from the JavaScript [block supports](https://wordpress.org/gutenberg/handbook/block-api/) documentation may be used. The following options are supported:
    - **align** \
    This property adds block controls which allow the user to change the block’s alignment. Defaults to `true`. Set to `false` to hide the alignment toolbar. Set to an array of specific alignment names to customize the toolbar.
    - **mode** \
    This property allows the user to toggle between edit and preview modes via a button. Defaults to `true`.
    - **multiple** \
    This property allows the block to be added multiple times. Defaults to `true`.
  
  
  
  
  
