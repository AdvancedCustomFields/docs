---
title: acf/register_block_type_args
description: Filters the arguments for registering a block type.
category: filters
---

## Description
Filters the arguments for registering a block type.

This filter is applied during the [acf_register_block_type()](https://www.advancedcustomfields.com/resources/acf_register_block_type/) function, after defaults have been merged, and before the block type has been registered.

## Changelog
- Added in version 5.8.9

## Parameters
```
apply_filters( 'acf/register_block_type_args', $args );
```
- `$args` *(array)* The array of arguments for registering a block type.

## Example
This example demonstrates how to apply a custom render callback for all block types.

#### functions.php
```
<?php
add_filter('acf/register_block_type_args', 'my_acf_register_block_type_args');
function my_acf_register_block_type_args( $args ){
	$args['render_template'] = '';
	$args['render_callback'] = 'my_render_callback';
    return $args;
}
```
