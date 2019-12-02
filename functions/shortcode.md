---
title: Shortcode
description: Used within a content editor to display a custom field’s value.
category: functions
status: draft
---

## Description
Shortcodes can be used within a WYGIWYG to display another field’s value. To learn more about shortcodes, [click here](http://codex.wordpress.org/Shortcode_API).

## Usage
Place the shortcode marker with the desired field within your WYSIWYG content. This shortcode runs the same as [the_field()](https://www.advancedcustomfields.com/docs/functions/the_field/) function.
```
[acf field="field_name" post_id="123"]
```
 
## Examples

### Basic usage
This example demonstrates inserting two shortcodes for the ACF fields 'name' and 'age.'.

```
This is a story about a boy named [acf field="name"]. He is [acf field="age"] years old.
```

## Note
- Only works for simple text based values
