---
title: acf/validate_attachment
description: Used to perform validation on an attachment before it is uploaded or selected.
category: filters
---

## Description
Used to perform custom validation on an attachment and prevent it being uploaded or selected for a specific field.

Similar to the [acf/upload_prefilter](https://www.advancedcustomfields.com/resources/acf-upload_prefilter/) filter, this filter can be used to prevent an upload, however, it can also be used to prevent an attachment being selected from a WP media modal.

## Changelog
- Added in version 5.2.8
- Added `context` parameter in version 5.6.3

## Parameters
```
apply_filters( 'acf/validate_attachment', $errors, $file, $attachment, $field, $context );
```
- `$errors`		*(array)*	An array of error messages (strings) for the given attachment. Appending to this array will result in the attachment failing to upload, and the error message displayed to the client.
- `$file`		*(array)*	An array of generic file data including type, width, height and size
- `$attachment`	*(array)*	The attachment being uploaded/displayed. This data changes depending on context
- `$field`		*(array)*	The field array containing all settings.
- `$context`	*(string)*	Description of the current context: *upload*, *basic_upload* (when uploading) or *prepare* (when viewing). Added in 5.6.3

## Modifers
This filter provides modifiers to target specific fields. The following filter names are available:
- `acf/validate_attachment` 				Applies to all fields.
- `acf/validate_attachment/type={$type}` 	Applies to all fields of a specific type.
- `acf/validate_attachment/name={$name}` 	Applies to all fields of a specific name.
- `acf/validate_attachment/key={$key}` 		Applies to all fields of a specific key.

## Example
This example demonstrates how to validate the file name of all attachments. If the attachment’s file name does not begin with the string "acf-", an error message will be displayed causing the upload/selection to fail.

#### functions.php
```
<?php
add_filter('acf/validate_attachment', 'my_acf_validate_attachment', 10, 5);
function my_acf_validate_attachment( $errors, $file, $attachment, $field, $context ){
	
	// Check first 4 characters of the attachment name.
	if( substr($attachment['name'], 0, 4) !== 'acf-' ) {
		$errors[] = __( 'File name must begin with "acf-"' );
	}
	return $errors;	
}
```
<figure>
	<a href="https://www.advancedcustomfields.com/wp-content/uploads/2017/08/acf-validate-attachment-screenshot.png">
		<img src="https://www.advancedcustomfields.com/wp-content/uploads/2017/08/acf-validate-attachment-screenshot.png" alt="An error message displayed in the WP media modal preventing an attachment from being selected." />
	</a>
	<figcaption>An error message displayed in the WP media modal preventing an attachment from being selected.</figcaption>
</figure>