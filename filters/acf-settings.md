---
title: acf/settings
description: Filters settings used throughout the plugin
category: filters
---

## Description
Filters the various settings that are used throughout the plugin.

## Changelog
- Added in version 5.0.0

## Parameters
```
apply_filters( "acf/settings/{$name}", $value );
```
- `$value` *(mixed)* The setting value.

## Settings
The following table lists the available settings which can be modified.

<table>
<tbody>
<tr>
<th>Name</th>
<th>Type</th>
<th>Added</th>
<th>Description</th>
</tr>
<tr>
<td>`path`</td>
<td>string</td>
<td>5.0.0</td>
<td>Absolute path to ACF plugin folder including trailing slash. Defaults to `plugin_dir_path()`</td>
</tr>
<tr>
<td>`url`</td>
<td>string</td>
<td>5.6.8</td>
<td>URL to ACF plugin folder including trailing slash. Defaults to `plugin_dir_url()`</td>
</tr>
<tr>
<td>`dir`</td>
<td>string</td>
<td>5.0.0</td>
<td>URL to ACF plugin folder including trailing slash. Defaults to `plugin_dir_url()`. Deprecated in version 5.6.8. Please use **url** instead</td>
</tr>
<tr>
<td>`show_admin`</td>
<td>boolean</td>
<td>5.0.0</td>
<td>Show/hide ACF menu item. Defaults to true</td>
</tr>
<tr>
<td>`stripslashes`</td>
<td>boolean</td>
<td>5.0.0</td>
<td>Runs the function `stripslashes()` on all $_POST data. Some servers / WP instals may require this extra functionality. Defaults to false</td>
</tr>
<tr>
<td>`local`</td>
<td>boolean</td>
<td>5.0.0</td>
<td>Enable/Disable local (PHP/json) fields. Defaults to true</td>
</tr>
<tr>
<td>`json`</td>
<td>boolean</td>
<td>5.0.0</td>
<td>Enable/Disable json fields. Defaults to true</td>
</tr>
<tr>
<td>`save_json`</td>
<td>string</td>
<td>5.0.0</td>
<td>Absolute path to folder where json files will be created when field groups are saved. Defaults to 'acf-json' folder within current theme</td>
</tr>
<tr>
<td>`load_json`</td>
<td>array</td>
<td>5.0.0</td>
<td>Array of absolutes paths to folders where field group json files can be read. Defaults to an array containing at index 0, the 'acf-json' folder within current theme</td>
</tr>
<tr>
<td>`default_language`</td>
<td>string</td>
<td>5.0.0</td>
<td>Language code of the default language. Defaults to ''. If WPML is active, ACF will default this to the WPML default language setting</td>
</tr>
<tr>
<td>`current_language`</td>
<td>string</td>
<td>5.0.0</td>
<td>Language code of the current post's language. Defaults to ''. If WPML is active, ACF will default this to the WPML current language</td>
</tr>
<tr>
<td>`capability`</td>
<td>string</td>
<td>5.1.9</td>
<td>Capability used for ACF post types and if the current user can see the ACF menu item. Defaults to 'manage_options'.</td>
</tr>
<tr>
<td>`show_updates`</td>
<td>boolean</td>
<td>5.2.2</td>
<td>Enable/Disable updates to appear in plugin list and show/hide the ACF updates admin page. Defaults to `true`.</td>
</tr>
<tr>
<td>`export_textdomain`</td>
<td>string</td>
<td>5.2.9</td>
<td>Used during the 'Export to PHP' feature to wrap strings within the `__()` function. Depreciated in v5.4.4 - please see **l10n_textdomain**</td>
</tr>
<tr>
<td>`export_translate`</td>
<td>array</td>
<td>5.3.2</td>
<td>Array of keys used during the 'Export to PHP' feature to wrap strings within the `__()` function. Defaults to `array('title', 'label', 'instructions')`. Depreciated in v5.3.4 - please see **l10n_field** and **l10n_field_group**</td>
</tr>
<tr>
<td>`autoload`</td>
<td>boolean</td>
<td>5.2.8</td>
<td>Sets the default "autoload" setting used in `add_option()`. This function is used when saving new rows to the wp_options table. Defaults to `false`</td>
</tr>
<tr>
<td>`l10n`</td>
<td>boolean</td>
<td>5.3.4</td>
<td>Allows ACF to translate field and field group settings using the `__()` function. Defaults to true. Useful to override translation without modifying the textdomain</td>
</tr>
<tr>
<td>`l10n_textdomain`</td>
<td>string</td>
<td>5.3.4</td>
<td>Sets the text domain used when translating field and field group settings. Defaults to ''. Strings will not be translated if this setting is empty</td>
</tr>
<tr>
<td>`l10n_field`</td>
<td>array</td>
<td>5.3.4</td>
<td>An array of settings to translate when loading and exporting a field. Defaults to `array('label', 'instructions')`. Depreciated in v5.3.6 - please see `acf/translate_field` filter</td>
</tr>
<tr>
<td>`l10n_field_group`</td>
<td>array</td>
<td>5.3.4</td>
<td>An array of settings to translate when loading and exporting a field group. Defaults to `array('title')`. Depreciated in v5.3.6 - please see `acf/translate_field_group` filter</td>
</tr>
<tr>
<td>`google_api_key`</td>
<td>string</td>
<td>5.4.0</td>
<td>Specify a Google Maps API <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">authentication key</a> to prevent usage limits. Defaults to ''</td>
</tr>
<tr>
<td>`google_api_client`</td>
<td>string</td>
<td>5.4.0</td>
<td>Specify a Google Maps API <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">Client ID</a> to prevent usage limits. Not needed if using `google_api_key`. Defaults to ''</td>
</tr>
<tr>
<td>`enqueue_google_maps`</td>
<td>boolean</td>
<td>5.5.0</td>
<td>Allows ACF to enqueue and load the Google Maps API JS library. Defaults to true</td>
</tr>
<tr>
<td>`enqueue_select2`</td>
<td>boolean</td>
<td>5.5.0</td>
<td>Allows ACF to enqueue and load the Select2 JS/CSS library. Defaults to true</td>
</tr>
<tr>
<td>`select2_version`</td>
<td>numeric</td>
<td>5.5.0</td>
<td>Defines which version of Select2 library to enqueue. Either 3 or 4. Defaults to 4 since ACF 5.6.0</td>
</tr>
<tr>
<td>`enqueue_datepicker`</td>
<td>boolean</td>
<td>5.5.0</td>
<td>Allows ACF to enqueue and load the WP datepicker JS/CSS library. Defaults to true</td>
</tr>
<tr>
<td>`enqueue_datetimepicker`</td>
<td>boolean</td>
<td>5.5.0</td>
<td>Allows ACF to enqueue and load the datetimepicker JS/CSS library. Defaults to true</td>
</tr>
<tr>
<td>`row_index_offset`</td>
<td>numeric</td>
<td>5.5.6</td>
<td>Defines the starting index used in all 'loop' and 'row' functions. Defaults to 1 (1 is the first row), can be changed to 0 (0 is the first row)</td>
</tr>
<tr>
<td>`remove_wp_meta_box`</td>
<td>boolean</td>
<td>5.6.0</td>
<td>Allows ACF to remove the default WP custom fields metabox. Defaults to <code>true</code></td>
</tr>
</tbody>
</table>

## Examples

### Filter
This example demonstrates how to modify a setting via the `"acf/settings/{$name}"` filter.

#### functions.php
```
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path( $path ) {
    return get_stylesheet_directory() . '/acf/';
}

```

### Function
This example demonstrates how to modify a setting via the function `acf_update_setting()`. This function is best used during the `acf/init` action.

#### functions.php
```
add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	acf_update_setting('show_admin', false);
	acf_update_setting('google_api_key', 'xxx');
}
```
