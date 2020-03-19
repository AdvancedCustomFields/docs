---
title: acf/fields/google_map/api
description: Filters the url parameters used to load the Google Maps JS API.
category: filters
---

## Description
Used to modify the url parameters used to load the Google Maps JS API. 

Primarily, this filter exists to set a Google API key, however, it may also be used to customize `other_params` used in the `google.load` function.

## Changelog
- Added in version 5.3.10

## Parameters
```
apply_filters( 'acf/fields/google_map/api', $args );
```

### $args
*(array)* Array of url parameters.
- **libraries**  
  (string) A comma separated list of [libraries](https://developers.google.com/maps/documentation/javascript/libraries) to load. Defaults to "places".
  ```
  'libraries' => 'places',
  ```
  
- **key**  
  (string) A Google Maps [API key](https://developers.google.com/maps/documentation/javascript/get-api-key). Defaults to an empty string.
  ```
  'key' => '',
  ```
  
- **client**  
  (string) Optional. A Google API client ID. Defaults to an empty string.
  ```
  'client' => '',
  ```

## Example
This example demonstrates how to register a [Google API key](https://developers.google.com/maps/documentation/javascript/get-api-key) to be used when loading the Google Maps JS library.

#### functions.php
```
<?php
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
function my_acf_google_map_api( $args ) {
	$args['key'] = 'xxx';
	return $args;
}
```
