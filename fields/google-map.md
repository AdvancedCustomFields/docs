---
title: Google Map
category: field-types
group: jQuery
---

## Description
The Google Map field provides an interactive map interface for selecting a location. This field type uses the Google Maps JS API to provide autocomplete searching, reverse geocoding lookup and an interactive marker.

<b class="badge">Upcoming</b> The Google Map field saves more data in version 5.8.6!

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-google-map-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-google-map-field-interface.png" alt="a Google Map field displaying a sample map" />
		</a>
		<figcaption>The Google Map field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-google-map-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-google-map-field-settings.png" alt="List of field settings shown when setting up a Google Map field" />
		</a>
		<figcaption>The Google Map field settings</figcaption>
	</figure>
</div>

## Changelog
- Added more location data to the value in version 5.8.6.
- Added `acf/fields/google_map/api` filter in version 4.3.9

## Settings
- **Center**  
  Defines the initial map center point latitude and longitude.
  
- **Zoom**  
  Sets the initial zoom level of the map.
  
- **Height**  
  Sets the height of the map.

## Requirements
In order use of the Google Maps JavaScript API, you must first register a valid API key. To obtain an API key, please follow Google's [Get an API Key](https://developers.google.com/maps/documentation/javascript/get-api-key) instructions. The Google Maps field requires the following APIs; Maps JavaScript API, Geocoding API and Places API.

To register your Google API key, please use one of the following methods.
```
// Method 1: Filter.
function my_acf_google_map_api( $api ){
	$api['key'] = 'xxx';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// Method 2: Setting.
function my_acf_init() {
	acf_update_setting('google_api_key', 'xxx');
}
add_action('acf/init', 'my_acf_init');
```

## Template usage
The Google Map field returns an array of data for the selected location including address, lat and lng.

To display the saved location into a Google Map, please use the helper code.

### Google Maps helper code
The following code provides helper functionality to use in your project.

```
<style type="text/css">
.acf-map {
	width: 100%;
	height: 400px;
	border: #ccc solid 1px;
	margin: 20px 0;
}

// Fixes potential theme css conflict.
.acf-map img {
   max-width: inherit !important;
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
<script type="text/javascript">
(function( $ ) {

/**
 * initMap
 *
 * Renders a Google Map onto the selected jQuery element
 *
 * @date	22/10/19
 * @since	5.8.6
 *
 * @param	jQuery $el The jQuery element.
 * @return	object The map instance.
 */
function initMap( $el ) {
	
	// Find marker elements within map.
	var $markers = $el.find('.marker');
	
	// Create gerenic map.
	var mapArgs = {
		zoom		: $el.data('zoom') || 16,
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map( $el[0], mapArgs );
	
	// Add markers.
	map.markers = [];
	$markers.each(function(){
		initMarker( $(this), map );
	});
	
	// Center map based on markers.
	centerMap( map );
	
	// Return map instance.
	return map;
}

/**
 * initMarker
 *
 * Creates a marker for the given jQuery element and map.
 *
 * @date	22/10/19
 * @since	5.8.6
 *
 * @param	jQuery $el The jQuery element.
 * @param	object The map instance.
 * @return	object The marker instance.
 */
function initMarker( $marker, map ) {

	// Get position from marker.
	var lat = $marker.data('lat');
	var lng = $marker.data('lng');
	var latLng = {
		lat: parseFloat( lat ),
		lng: parseFloat( lng )
	};

	// Create marker instance.
	var marker = new google.maps.Marker({
		position : latlng,
		map: map
	});

	// Append to reference for later use.
	map.markers.push( marker );

	// If marker contains HTML, add it to an infoWindow.
	if( $marker.html() ){
		
		// Create info window.
		var infowindow = new google.maps.InfoWindow({
			content: $marker.html()
		});

		// Show info window when marker is clicked.
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open( map, marker );
		});
	}
}

/**
 * centerMap
 *
 * Centers the map showing all markers in view.
 *
 * @date	22/10/19
 * @since	5.8.6
 *
 * @param	object The map instance.
 * @return	void
 */
function centerMap( map ) {

	// Create map boundaries from all map markers.
	var bounds = new google.maps.LatLngBounds();
	map.markers.forEach(function(){
		bounds.extend({
			lat: marker.position.lat(),
			lng: marker.position.lng()
		});
	});

	// Case: Single marker.
	if( map.markers.length == 1 ){
	    map.setCenter( bounds.getCenter() );
	
	// Case: Multiple markers.
	} else{
		map.fitBounds( bounds );
	}
}

// Render maps on page load.
$(document).ready(function(){
	$('.acf-map').each(function(){
		var map = initMap( $(this) );
	});
});

})(jQuery);
</script>
```

### Render a single marker onto a map
This example demonstrates how to display a Google Map field value on a map. Note the aforementioned Helper code is required to convert the HTML into an interactive map.
```
<?php 
$location = get_field('location');
if( $location ): ?>
	<div class="acf-map" data-zoom="16">
		<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
	</div>
<?php endif; ?>
```

### Render multiple markers onto a map
This example demonstrates how to display multiple Google Map field values on the same map. In this example, a Repeater field is used to define a Title, Description and Location. Note the aforementioned Helper code is required to convert the HTML into an interactive map.
```
<?php if( have_rows('locations') ): ?>
	<div class="acf-map" data-zoom="16">
		<?php while ( have_rows('locations') ) : the_row(); 
			
			// Load sub field values.
			$location = get_sub_field('location');
			$title = get_sub_field('description');
			$description = get_sub_field('description');
			?>
			<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
				<h3><?php echo esc_html( $title ); ?></h3>
				<p><em><?php echo esc_html( $location['address'] ); ?></em></p>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
	<?php endwhile; ?>
	</div>
<?php endif; ?>
```

## Notes

## Rendering a hidden map
Initializing a Google Map on a hidden element can lead to unexpected results when shown. To solve this problem, trigger a "resize" event on the map variable after the map element is visible.
```
google.maps.event.trigger(map, 'resize');
```
