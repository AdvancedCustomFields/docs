---
title: acf/compatibility
description: Used to enable backwards compatibility support.
category: filters
---

## Description
Used to enable backwards compatibility support for changed functionality.

Support for each compatibility can be enabled by its own filter. Compatibilities are disabled by default and can be opted-in using the `__return_true()` function.

## Changelog
- Added in version 5.2.0

## Parameters
```
apply_filters( "acf/compatibility/{$name}", $enabled );
```
- `$enabled` *(bool)* Whether of not backwards compatibility support is enabled. Defaults to `false`.

## Compatibilities
The following table lists the available compatibilities which can be enabled.

<table>
<tbody>
<tr>
<th>Name</th>
<th>Added</th>
<th>Description</th>
</tr>
<tr>
<td>`field_wrapper_class`</td>
<td>5.2.0</td>
<td>Field class names changed in v5.2.0 from `field_type-{$type}` to `acf-field-{$type}`. This change was introduced to better optimise JS performance.</td>
</tr>
</tbody>
</table>

## Example
This example demonstrates how to enable backwards-compatibility for field class names.

#### functions.php
```
add_filter('acf/compatibility/field_wrapper_class', '__return_true');
```