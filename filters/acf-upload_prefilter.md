---
title: acf/upload_prefilter
description: Used to perform validation on an attachment before it is uploaded.
category: filters
---

## Description
Used to perform custom validation on an attachment and prevent it being uploaded.

Similar to the [acf/validate_attachment](https://www.advancedcustomfields.com/resources/acf-validate_attachment/) filter, this hook can be used to prevent a file being uploaded via the WP media modal.

## Changelog
- Added in version 5.1.9

## Parameters
```
apply_filters( 'acf/upload_prefilter', $errors, $file, $field );
```
- `$errors`		*(array)*	An array of error messages (strings) for the given attachment. Appending to this array will result in the attachment failing to upload, and the error message displayed to the client.
- `$file`		*(array)*	An array containing the `$_FILE` data for the attachment about to be uploaded
- `$field`		*(array)*	The field array containing all settings.

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/upload_prefilter` 				Applies to all fields.
- `acf/upload_prefilter/type={$type}` 	Applies to all fields of a specific type.
- `acf/upload_prefilter/name={$name}` 	Applies to all fields of a specific name.
- `acf/upload_prefilter/key={$key}` 	Applies to all fields of a specific key.

## Example
This example demonstrates how to restrict all uploads from ACF fields (Image, File, Gallery) to admin users only.

#### functions.php
```
<?php
add_filter('acf/upload_prefilter', 'my_acf_upload_prefilter', 10, 3);
function my_acf_upload_prefilter( $errors, $file, $field ){
	
	// Check if not admin.
	if( !current_user_can('manage_options') ) {
		$errors[] = __( 'Only administrators may upload attachments' );
	}
	return $errors;	
}
```