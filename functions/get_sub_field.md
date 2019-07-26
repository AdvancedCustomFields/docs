---
title: get_sub_field()
description: Returns the value of a specific sub field.
category: functions
group: Loop
---

## Description
Returns the value of a specific sub field value from a Repeater or Flexible Content field loop.

## Parameters
```
get_sub_field( $selector, [$format_value] );
```
- `$selector`		*(string)*	*(Required)*	The sub field name or field key.
- `$format_value`	*(bool)*	*(Optional)*	Whether to apply formatting logic. Defaults to true.

## Example

### Get a value from within a Repeater field.
This example shows how to loop through a Repeater field and load a sub field value.
```
if( have_rows('parent_field') ):
    while ( have_rows('parent_field') ) : the_row();
		$sub_value = get_sub_field('sub_field');
		// Do something...
    endwhile;
else :
    // no rows found
endif;
```

### Get a value from within a Flexible Content field.
This example shows how to loop through a Flexible Content field and load a sub field value.
```
if( have_rows('parent_field') ):
	while( have_rows('parent_field') ): the_row();
		
		// Layout 1.
		if( get_row_layout() == 'layout_1' ):
		
			// Layout 1 value.
			$value = get_sub_field('sub_field_1');
			
		// Layout 2.
		elseif( get_row_layout() == 'layout_2' ):
		
			// Layout 2 value.
			$value = get_sub_field('sub_field_2');
			
		endif;
		
	endwhile;
endif;
```

### Nested loops
This example shows how to loop through a nested Repeater field and load a sub field value.
```
/**
 * Field Structure:
 *
 * - parent_repeater (Repeater)
 *   - parent_title (Text)
 *   - child_repeater (Repeater)
 *     - child_title (Text)
 */
if( have_rows('parent_repeater') ):
    while( have_rows('parent_repeater') ) : the_row();
		
		// Get parent value.
		$parent_title = get_sub_field('parent_title');
		
		// Loop over sub repeater rows.
		if( have_rows('child_repeater') ):
		    while( have_rows('child_repeater') ) : the_row();
				
				// Get sub value.
				$child_title = get_sub_field('child_title');
				
			endwhile;
		endif;
    endwhile;
endif;
```
