---
title: Google Map
category: field-types
group: jQuery
status: draft
---

## Description
The Google Map field creates an interactive map with the ability to place a marker. It features a search input, location finder button and click/drag events to place the marker. The data saved and returned is an array containing the markers lat, lng, and address.

The Google Maps API has a daily limit on the number of sites able to use this free service. To lift this restriction, please register a Google API key following the steps documented later in this article.

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
- Added `acf/fields/google_map/api` filter in version 4.3.9 (ACF) and 5.3.10 (ACF PRO)

## Settings
- **Center**  
  Centers the map initially when no marker has been saved.
  
- **Zoom**  
  Sets the zoom level for the map.
  
- **Height**  
  Sets a custom height for the map.

## Google Map API
It may be necessary to register a Google API key in order to allow the Google API to load correctly. Please follow this link to get a [Google API key](https://developers.google.com/maps/documentation/javascript/get-api-key).

To register your Google API key, please use the `acf/fields/google_map/api` filter:

```
function my_acf_google_map_api( $api ){
	
	$api['key'] = 'xxx';
	
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
```

If using ACF PRO, you may find it easier to update the ‘google_api_key’ setting instead:

```
function my_acf_init() {
	
	acf_update_setting('google_api_key', 'xxx');
}

add_action('acf/init', 'my_acf_init');
```

## Template usage  
The following code examples show how to display saved values onto a map.

Please note that the Google API is required for this to work and is included in the required JS below.

### Helpers
The examples provided below require the following CSS and JS to be available to the page template. Please note that both the CSS and JS can be modified to your use case.

```
<style type="text/css">

.acf-map {
	width: 100%;
	height: 400px;
	border: #ccc solid 1px;
	margin: 20px 0;
}

/* Fixes potential theme css conflict */
.acf-map img {
   max-width: inherit !important;
}

</style>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
<script type="text/javascript">
(function( $ ) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {
	
	// var
	var $markers = $el.find('.marker');
	
	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};
	
	// Create map.
	var map = new google.maps.Map( $el[0], args);
	
	// Add a markers reference.
	map.markers = [];
	
	// Add markers.
	$markers.each(function(){
		
    	add_marker( $(this), map );
		
	});
	
	center_map( map );

	return map;
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});

	// Add to array.
	map.markers.push( marker );

	// If marker contains HTML, add it to an infoWindow.
	if( $marker.html() )
	{
		// Create info window.
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// Show info window when marker is clicked.
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}
}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// Create map boundaries.
	var bounds = new google.maps.LatLngBounds();

	// Loop through all markers and add boundaries
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// If only 1 marker?
	if( map.markers.length == 1 )
	{
		// Set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// Fit to boundaries.
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready / page has loaded.
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// Global variable.
var map = null;

$(document).ready(function(){

	$('.acf-map').each(function(){

		// Create map.
		map = new_map( $(this) );

	});

});

})(jQuery);
</script>
```

## Render a single marker onto a map
This example demonstrates how to use a single Google Map field to render out a map and marker onto the page. Each marker contains no inner HTML, so no infoWindow will be created (using the above JavaScript).

```
<?php 

$location = get_field('location');

if( !empty( $location ) ):
?>
<div class="acf-map">
	<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
</div>
<?php endif; ?>
```

## Render multiple markers onto a map
This example demonstrates a repeater field (called ‘locations’) with 3 sub fields: title (text), description (textarea) and location (Google Map).

Each marker does contain inner HTML, so an infoWindow will be created (using the above JavaScript).

```
<?php if( have_rows('locations') ): ?>
	<div class="acf-map">
		<?php while ( have_rows('locations') ) : the_row(); 

			$location = get_sub_field('location');

			?>
			<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
				<h4><?php the_sub_field('title'); ?></h4>
				<p class="address"><?php echo $location['address']; ?></p>
				<p><?php the_sub_field('description'); ?></p>
			</div>
	<?php endwhile; ?>
	</div>
<?php endif; ?>
```

## Solving the hidden map issue
The Google map API will not work as expected if initialized on a hidden element. When the element is shown, the map will not display. This scenario is most likely when using a popup modal.

To solve this problem, simply trigger the 'resize’ event on the map variable after the map element is visible.

```
// Popup is shown and map is not visible.
google.maps.event.trigger(map, 'resize');
```
