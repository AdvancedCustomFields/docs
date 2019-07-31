---
title: update_row()
description: Updates a row of data for an existing Repeater or Flexible Content field value.
category: functions
group: Update
---

Updates a row of data for an existing Repeater or Flexible Content field value.

## Parameters
```
update_row($selector, $row, $value, [$post_id])
```
- `$selector`		*(string)*	*(Required)*	The field name or field key.
- `$row`			*(int)*		*(Required)*	The row number to update.
- `$value`			*(array)*	*(Required)*	The new row data.
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(bool)* True on successful update, false on failure.

## Change Log
- Added in version 5.3.2

## Examples

### Add a new row using field names
This example shows how to update the first row of data of an existing repeater field called 'images'. This repeater field contains 3 sub fields ('image', 'alt', 'link').
```
$row = array(
	'image'	=> 123,
	'alt'	=> 'Another great sunset',
	'link'	=> 'http://website.com'
);

update_row('images', 1, $row);
```

## Notes

### Index offset
When targeting a specific row number, please note that row numbers begin from 1 and not 0. This means that the first row has an index of 1, the second row has an index of 2, and so on.
To begin indexes from 0, please use the [row_index_offset](https://www.advancedcustomfields.com/resources/acf-settings/) setting like so.
#### functions.php
```
add_filter('acf/settings/row_index_offset', '__return_zero');
```
