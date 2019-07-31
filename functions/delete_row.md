---
title: delete_row()
description: Deletes a row of data from an existing Repeater or Flexible Content field value.
category: functions
group: Update
---

Deletes a row of data from an existing Repeater or Flexible Content field value.

## Parameters
```
delete_row($selector, $row, [$post_id])
```
- `$selector`		*(string)*	*(Required)*	The field name or field key.
- `$row`			*(int)*		*(Required)*	The row number to update.
- `$post_id`		*(mixed)*	*(Optional)*	The post ID where the value is saved. Defaults to the current post.

## Return
*(bool)* True on successful update, false on failure.

## Change Log
- Added in version 5.3.2

## Examples

### Delete via field name
This example shows how to delete a row of data from a field called 'images' on the current post being viewed.
```
// Delete the first row of data.
delete_row('images', 1);
```

### Delete via field key
This example shows how to achieve the same as above using the field's key instead of its name.
```
// Delete the first row of data.
delete_row('field_123456', 1);
```

## Notes

### Index offset
When targeting a specific row number, please note that row numbers begin from 1 and not 0. This means that the first row has an index of 1, the second row has an index of 2, and so on.
To begin indexes from 0, please use the [row_index_offset](https://www.advancedcustomfields.com/resources/acf-settings/) setting like so.
#### functions.php
```
add_filter('acf/settings/row_index_offset', '__return_zero');
```
