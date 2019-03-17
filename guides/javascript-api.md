---
title: JavaScript API
description: Learn how to use ACF's JavaScript library including functions, actions and filters and models.
category: guides
group: Tutorials
---

## Introduction

Welcome to the Advanced Custom Fields JavaScript API. Here you will find documentation for our JavaScript library including functions, actions and filters and models.

Our library makes extensive use of jQuery and follows a similar style to [Backbone.js](http://backbonejs.org/#Getting-started). Before reading any further, make sure you are confident with [JavaScript basics](https://developer.mozilla.org/en-US/docs/Learn/Getting_started_with_the_web/JavaScript_basics), [jQuery events](https://learn.jquery.com/events/event-basics/) and [WP hooks](https://www.smashingmagazine.com/2016/01/get-started-with-hooks-wordpress/).

Similar to other JS libraries, we place all of our JS goodies in a global object called **acf**. This makes it super easy to interact with ACF functionality, take a look for yourself.
```
// get localized data
var postID = acf.get('post_id');

// add an action
acf.addAction('prepare', function(){
	// ...
});
```

## Functions
The **acf** object contains many helpful functions some of which are documented below. For a full list of available functions, please inspect the **acf** object in your console log.

### get `acf.get(name)`
Returns localized data for a given name. Localized data is registered in PHP and passed to JS through an inline script in the footer. You can register PHP data for localization by using the `acf_localize_data(array( 'foo' => 'bar' ));` function.
```
var postID = acf.get('post_id');
var acfVersion = acf.get('acf_version');
var foo = acf.get('bar');

```

### set `acf.set(name, value)`
Sets a value for later use with `acf.get()`. Returns the **acf** object for chaining.
```
var value = 'bar';
acf.set('foo', value);

```

### has `acf.has(name)`
Returns true if data exists for the given name.
```
if( acf.has('foo') ) {
	// do something
}

```

### parseArgs `acf.parseArgs(args, defaults)`
Similar to the WP function [wp_parse_args()](https://codex.wordpress.org/Function_Reference/wp_parse_args), this is a generic utility for merging together an object of arguments and an object of default values.
```
// var maybeArgs = { ... }
var args = acf.parseArgs(maybeArgs, {
	foo:	'bar',
	html:	'',
});
// console.log( args.foo );

```

### \_\_ `acf.__(text)`
Returns the translation of text. If there is no translation, the original text is returned. Translation data is registered in PHP and passed to JS through an inline script in the head. You can register translations in PHP by using the `acf_localize_text()` function.
```php
acf_localize_text(array(
	'Select thing' => __('Select thing', 'my-textdomain')
));
```
```js
var text = acf.__('Select thing');

```

### addAction `acf.addAction(action, callback, priority, context)`
Similar to the WP function [add_action()](https://codex.wordpress.org/ko:Function_Reference/add_action), this is used to listen for a specific action and register a callback function.
```js
acf.addAction('new_field', function( field ){
	field.$el.addClass('i-was-here');
});

```

### addFilter `acf.addFilter(filter, callback, priority, context)`
Similar to the WP function [add_filter()](https://codex.wordpress.org/ko:Function_Reference/add_filter), this is used to listen for a specific filter and register a callback function to modify the first argument.
```js
acf.addFilter('select2_args', function( options, $select ){
	options.foo = 'bar';
	return options;
});

```

### doAction `acf.doAction(action, [arg1, arg2, arg3, ...])`
Similar to the WP function [do_action()](https://codex.wordpress.org/ko:Function_Reference/do_action), this is used to trigger an action. Any callbacks registered for this action will be triggered.
```js
acf.doAction('my_action', dataObject, someOtherVariable);

```

### applyFilters `acf.applyFilters(filter, [arg1, arg2, arg3, ...])`
Similar to the WP function [apply_filters()](https://codex.wordpress.org/ko:Function_Reference/apply_filters), this is used to apply a filter. Any callbacks registered for this filter will be called to modify the first argument.
```js
var foo = acf.applyFilters('my_filter', 'bar');

```

### findField `acf.findField( key )`
Returns a field jQuery object for a given field key.
```js
var $field = acf.findField('field_123');
$field.addClass('my-class')

```

### getField `acf.getField( key )`
Returns a field instance for a given field key or jQuery element.
```js
var field = acf.getField('field_123');
field.$el.addClass('my-class')

```

### findFields `acf.findFields( args )`
Returns a collection of jQuery objects for the given args.
```js
// available args
var args = {
	key: '',					// The field key (field_123)
	name: '',					// The field name (my_field)
	type: '',					// The field type (image, text)
	is: '',						// jQuery selector (:visible)
	parent: false,				// jQuery element to search within
	sibling: false,				// jQuery element to search alongside
	limit: false,				// limit the number of jQuery elements returned
};

// example
var $fields = acf.findFields({
	type: 'image'
});

```

### getFields `acf.getFields( args )`
Returns an array of field instances for the given args (see acf.findFields for list of args) or a collection of jQuery elements.
```js
var fields = acf.getFields({
	type: 'image'
});

```







## Actions
Actions are called at specific times during a page to allow for customisation. Below is a list of available JS actions somewhat in order of execution that you can hook into using the `acf.addAction()` function.

> ✋ If using the "pre 5.7" function **acf.add_action()**, please be aware that any **field instance** parameter documented bellow will appear as a **jQuery element** for compatibility. This change is discussed in more detail later in the [Compatibility](#compatibility) section.

### prepare
Triggered from an inline script in the footer allowing you to perform customisation to the page as early as possible (before the `$(document).ready` event).
```js
acf.addAction('prepare', function(){
	$('#my-element').hide();
});
```

### ready
Triggered during the `$(document).ready()` event.
```js
acf.addAction('ready', function(){
	$('#my-element').hide();
});
```

### load
Triggered during the `$(window).load()` event.
```js
acf.addAction('load', function(){
	$('#my-element').hide();
});
```

### resize
Triggered during the `$(window).resize()` event.
```js
acf.addAction('resize', function(){
	$('#my-element').resizeWidth();
});
```

### unload
Triggered during the `$(window).unload()` event.
```js
acf.addAction('unload', function(){
	$('#my-element').remove();
});
```

### append
Triggered when new HTML is added to the page such as within a media modal popup. The jQuery element being appended is passed as a parameter.
```js
acf.addAction('append', function( $el ){
	$el.find('.my-element').hide();
});
```

### remove
Triggered when HTML is removed from the page. For example, when removing a repeater row. The jQuery element being removed is passed as a parameter.
```js
acf.addAction('remove', function( $el ){
	$el.find('.my-element').doThing();
});
```

### new_field
Triggered when a field is first initialised (either during "prepare" or "append"). This action is recommended over other 'field' actions if you wish to customize a field. This field action can also be targeted using a specific type, name or key.
```js
var myCallback = function( field ){
	
	// add class to this field
	field.$el.addClass('my-class');
	
	// add click event to this field's button
	field.on('click', 'button', function( e ){
		e.preventDefault();
		alert('Special event');
	});
};

acf.addAction('new_field', myCallback);
```
```js
acf.addAction('new_field/type=image', myCallback);			// image fields
acf.addAction('new_field/name=hero_image', myCallback);		// fields named "hero_image"
acf.addAction('new_field/key=field_123456', myCallback);	// field with key "field_123456"

```

### prepare_field
Triggered during the "prepare" action for each field. This field action can also be targeted using a specific type, name or key.
```js
acf.addAction('prepare_field', myCallback);						// all fields
acf.addAction('prepare_field/type=image', myCallback);			// image fields
acf.addAction('prepare_field/name=hero_image', myCallback);		// fields named "hero_image"
acf.addAction('prepare_field/key=field_123456', myCallback);	// field with key "field_123456"

```

### ready_field
Triggered during the "ready" action for each field. This field action can also be targeted using a specific type, name or key.
```js
acf.addAction('ready_field', myCallback);					// all fields
acf.addAction('ready_field/type=image', myCallback);		// image fields
acf.addAction('ready_field/name=hero_image', myCallback);	// fields named "hero_image"
acf.addAction('ready_field/key=field_123456', myCallback);	// field with key "field_123456"

```

### load_field
Triggered during the "load" action for each field. This field action can also be targeted using a specific type, name or key.
```js
acf.addAction('load_field', myCallback);					// all fields
acf.addAction('load_field/type=image', myCallback);			// image fields
acf.addAction('load_field/name=hero_image', myCallback);	// fields named "hero_image"
acf.addAction('load_field/key=field_123456', myCallback);	// field with key "field_123456"

```

### append_field
Triggered during the "append" action for each field. This field action can also be targeted using a specific type, name or key.
```js
acf.addAction('append_field', myCallback);					// all fields
acf.addAction('append_field/type=image', myCallback);		// image fields
acf.addAction('append_field/name=hero_image', myCallback);	// fields named "hero_image"
acf.addAction('append_field/key=field_123456', myCallback);	// field with key "field_123456"

```

### remove_field
Triggered when a field is removed. This field action can also be targeted using a specific type, name or key.
```js
acf.addAction('remove_field', myCallback);					// all fields
acf.addAction('remove_field/type=image', myCallback);		// image fields
acf.addAction('remove_field/name=hero_image', myCallback);	// fields named "hero_image"
acf.addAction('remove_field/key=field_123456', myCallback);	// field with key "field_123456"

```

### hide_field
Triggered when a field is hidden. This field action can also be targeted using a specific type, name or key.
```js
acf.addAction('hide_field', myCallback);					// all fields
acf.addAction('hide_field/type=image', myCallback);			// image fields
acf.addAction('hide_field/name=hero_image', myCallback);	// fields named "hero_image"
acf.addAction('hide_field/key=field_123456', myCallback);	// field with key "field_123456"

```

### show_field
Triggered when a hidden field is shown. This field action can also be targeted using a specific type, name or key.
```js
acf.addAction('show_field', myCallback);					// all fields
acf.addAction('show_field/type=image', myCallback);			// image fields
acf.addAction('show_field/name=hero_image', myCallback);	// fields named "hero_image"
acf.addAction('show_field/key=field_123456', myCallback);	// field with key "field_123456"

```

### disable_field
Triggered when a field is disabled (conditional logic). This field action can also be targeted using a specific type, name or key.
```js
acf.addAction('disable_field', myCallback);						// all fields
acf.addAction('disable_field/type=image', myCallback);			// image fields
acf.addAction('disable_field/name=hero_image', myCallback);		// fields named "hero_image"
acf.addAction('disable_field/key=field_123456', myCallback);	// field with key "field_123456"

```

### enable_field
Triggered when a disabled field is enabled (conditional logic). This field action can also be targeted using a specific type, name or key.
```js
acf.addAction('enable_field', myCallback);						// all fields
acf.addAction('enable_field/type=image', myCallback);			// image fields
acf.addAction('enable_field/name=hero_image', myCallback);		// fields named "hero_image"
acf.addAction('enable_field/key=field_123456', myCallback);	// field with key "field_123456"

```

### invalid_field
Triggered when a field value fails validation. This field action can also be targeted using a specific type, name or key.
```js
acf.addAction('invalid_field', myCallback);						// all fields
acf.addAction('invalid_field/type=image', myCallback);			// image fields
acf.addAction('invalid_field/name=hero_image', myCallback);		// fields named "hero_image"
acf.addAction('invalid_field/key=field_123456', myCallback);	// field with key "field_123456"

```

### valid_field
Triggered when an invalid field value passes validation. This field action can also be targeted using a specific type, name or key.
```js
acf.addAction('valid_field', myCallback);						// all fields
acf.addAction('valid_field/type=image', myCallback);			// image fields
acf.addAction('valid_field/name=hero_image', myCallback);		// fields named "hero_image"
acf.addAction('valid_field/key=field_123456', myCallback);	// field with key "field_123456"

```

### date_picker_init
Called when a date picker has been initialized. Added in v5.5.8
```js
acf.add_action('date_picker_init', function( $input, args, field ){
	// $input (jQuery) text input element
	// args (object) args given to the datepicker function
	// field (object) field instance 
});
```

### date_time_picker_init
Called when a date time picker has been initialized. Added in v5.5.8
```js
acf.add_action('date_time_picker_init', function( $input, args, field ){
	// $input (jQuery) text input element
	// args (object) args given to the datepicker function
	// field (object) field instance 
});
```

### time_picker_init
Called when a time picker has been initialized. Added in v5.5.8
```js
acf.add_action('time_picker_init', function( $input, args, field ){
	// $input (jQuery) text input element
	// args (object) args given to the datepicker function
	// field (object) field instance 
});
```

### select2_init
Called when a Select2 element has been initialized. Added in v5.5.8
```js
acf.add_action('select2_init', function( $select, args, settings, field ){
	// $select (jQuery) select element
	// args (object) args given to the select2 function
	// settings (object) settings given to the acf.select2 function
	// field (object) field instance 
});
```

### wysiwyg_tinymce_init
Called when a WYSIWYG tinymce element has been initialized. Added in v5.5.8
```js
acf.add_action('wysiwyg_tinymce_init', function( ed, id, mceInit, field ){
	// ed (object) tinymce object returned by the init function
	// id (string) identifier for the tinymce instance
	// mceInit (object) args given to the tinymce function
	// field (object) field instance 
});
```

### wysiwyg_quicktags_init
Called when a WYSIWYG quickktags element has been initialized. Each tinymce instance can also contain a ‘text’ edit mode that shows basic ‘quicktag’ buttons. Added in v5.5.8
```js
acf.add_action('wysiwyg_quicktags_init', function( qtag, id, qtInit, field ){
	// qtag (object) quick tag object returned by the init function
	// id (string) identifier for the qtag instance
	// qtInit (object) args given to the quick tag function
	// field (object) field instance 
});
```

### google_map_init
Called when a Google Map element has been initialized. Added in v5.5.11
```js
acf.add_action('google_map_init', function( map, marker, field ){
	// map (object) google map object returned by the google.maps.Map() function
	// marker (object) marker object returned by the google.maps.Marker() function
	// field (object) field instance 
});
```

## Filters
Filters are called at specific times to allow for customisation. Below is a list of available JS filters that you can hook into using the `acf.addFilter()` function.

> ✋ If using the "pre 5.7" function **acf.add_filter()**, please be aware that any **field instance** parameter documented bellow will appear as a **jQuery element** for compatibility. This change is discussed in more detail later in the [Compatibility](#compatibility) section.

### validation_complete
This filter allows the validation JSON response to be customized. Called after AJAX validation is complete but before errors are shown or the form is submitted.
```js
acf.add_filter('validation_complete', function( json, $form ){
	
	// check errors
	if( json.errors ) {
		// do something
	}
	
	// return
	return json;		
});
```

### wysiwyg_tinymce_settings
This filter allows the tinyMCE settings to be customized for each WYSIWYG field. Called before the tinyMCE instance is created.
```js
acf.add_filter('wysiwyg_tinymce_settings', function( mceInit, id, field ){
	
	// do something to mceInit
	
	// return
	return mceInit;
			
});
```

### wysiwyg_quicktags_settings
This filter allows the quicktags settings to be customized for each WYSIWYG field. Called before the text instance is created.
```js
acf.add_filter('wysiwyg_quicktags_settings', function( qtInit, id, field ){
	
	// do something to qtInit
	
	
	// return
	return qtInit;
			
});
```

### date_picker_args
This filter allows the date picker settings to be customized for each date picker field. Called before the date picker instance is created. A full list of settings can be found here: https://api.jqueryui.com/datepicker/
```js
acf.add_filter('date_picker_args', function( args, field ){
	
	// do something to args
	
	
	// return
	return args;
			
});
```

### date_time_picker_args
This filter allows the date time picker settings to be customized for each date time picker field. Called before the date time picker instance is created. A full list of settings can be found here: http://trentrichardson.com/examples/timepicker/
```js
acf.add_filter('date_time_picker_args', function( args, field ){
	
	// do something to args
	
	
	// return
	return args;
			
});
```

### time_picker_args
This filter allows the time picker settings to be customized for each time picker field. Called before the time picker instance is created. A full list of settings can be found here: http://trentrichardson.com/examples/timepicker/
```js
acf.add_filter('time_picker_args', function( args, field ){
	
	// do something to args
	
	
	// return
	return args;
			
});
```

### google_map_args
This filter allows the google maps settings to be customized for each google maps field. Called before the map instance is created.
```js
acf.add_filter('google_map_args', function( args, field ){
	
	// do something to args
	
	
	// return
	return args;
			
});
```

### google_map_marker_args
This filter allows the google maps marker settings to be customized for each google maps field. Called before the map instance is created.
```js
acf.add_filter('google_map_marker_args', function( args, field ){
	
	// do something to args
	
	
	// return
	return args;
			
});
```

### select2_args
This filter allows the select2 settings to be customized for each select field before the select2 instance is created.
```js
acf.add_filter('select2_args', function( args, $select, settings, field, instance ){
	
	// do something to args
	
	
	// return
	return args;
			
});
```

### select2_ajax_data
This filter allows the data sent in an ajax request to be customized for each select field.
```js
acf.add_filter('select2_ajax_data', function( data, args, $input, field, instance ){
	
	// do something to data
	
	
	// return
	return data;
			
});
```

### select2_ajax_results
This filter allows the data returned from an ajax request to be customized for each select field.
```js
acf.add_filter('select2_ajax_results', function( json, params, instance ){
	
	// do something to json
	
	
	// return
	return json;
			
});
```

### color_picker_args
This filter allows the color picker (wpColorPicker) settings to be customized for each color picker field. This filter is called before the wpColorPicker instance is created. Added in v 5.3.6
```js
acf.add_filter('color_picker_args', function( args, field ){
	
	// do something to args
	args.palettes = ['#5ee8bf', '#2f353e', '#f55e4f']
	
	
	// return
	return args;
			
});
```

## Models

Models are the heart of ACF functionality. The **acf.Model** function provides convenient scaffolding for creating new instances to store data, add event listeners, and perform logic. A model can be created as a "once off" instance, or extended into a "class" for repeated use (such as the **acf.Field** class discussed later).

The following is a contrived example, but it demonstrates defining a model with a custom method, setting an attribute, and firing an event keyed to changes in that specific attribute.

```js
var sidebar = new acf.Model({
	wait: 'ready',
	data: {
		color: '#ffffff'
	},
	events: {
		'click .select-color':	'onClick'
	},
	initialize: function(){
		this.$el = $('#sidebar');
	}
	onClick: function( e, $el ){
		
		// get color from data attribute on '.select-color' element
		this.set('color', $el.data('color'));
		
		// render
		this.render();
	},
	render: function(){
		this.$el.css('background-color', this.get('color'));
	}
});

// interact directly with the sidebar variable
var color = sidebar.get('color');
```

All models and those that extend the base model have access to the following properties and functions.

### cid `model.cid`
A special property of models, the cid or "client id" is a unique identifier automatically assigned to all models when they're first created.
```js
var instance = new acf.Model();
var id = instance.cid; // acf-123
```

### data `model.data`
The data object used by get(), set() and has() to store data on the instance.
```js
var instance = new acf.Model({
	data: {
		color: '#ffffff',
		active: false
	}
});
```

### events `model.events`
A list of "jQuery events" that will be bound to methods in the format {"event selector" : "callback"}.
The callback is scoped to the instance and the jQuery element is passed through as a second parameter.
```js
var instance = new acf.Model({
	events: {
		'change': 'onChange',
		'change input[type="text"]': 'onChangeText',
	},
	onChange: function(e, $el){
		e.preventDefault();
		var val = $el.val();
		// do something
	},
	onChangeText: function(e, $el){
		// do something for just text inputs and then call the normal change callback
		this.onChange(e, $el);
	}
});
```

### actions `model.actions`
A list of actions that will be bound to methods in the format {"name" : "callback"}.
```js
var instance = new acf.Model({
	actions: {
		'append': 'onAppend',
	},
	onAppend: function($el){
		// $el has been added to the DOM.
	}
});
```

### filters `model.filters`
A list of filters that will be bound to methods in the format {"name" : "callback"}.
```js
var instance = new acf.Model({
	filters: {
		'things': 'filterThings',
	},
	filterThings: function( things ){
		things.push('zar');
		return things;
	}
});
var things = acf.applyFilters('things', ['foo', 'bar']);
```

### priority `model.priority`
The priority used for the above actions and filters. Defaults to 10.
```js
var instance = new acf.Model({
	actions: {
		'ready': 'onReady',
	},
	priority: 99,
	onReady: function(){
		// runs after other 'ready' callbacks
	}
});
```

### wait `model.wait`
Delays initialization until a specific action such as 'ready' or 'load'.
```js
var instance = new acf.Model({
	wait: 'ready',
	initialize: function(){
		// runs during the 'ready' action when all elements have been rendered
		this.$el = $('#some-element');
	}
});
```

### initialize `model.initialize()`
The "constructor" function which is called when creating an instance of a model.
```js
var instance = new acf.Model({
	initialize: function(){
		this.doSomething();
	}
});
```

### get `model.get(name)`
Returns a value from the instance data.
```js
var foo = instance.get('foo');

```

### set `model.set(name, value)`
Stores a value in the instance data.
```js
var value = 'bar';
instance.set('foo', value);

```

### has `model.has(name)`
Returns true if data exists for the given name.
```js
if( instance.has('foo') ) {
	// do something
}

```

### on `model.on(event, selector, callback) or model.on(event, callback)`
Adds an event listener to the instance.
```js
instance.on('change', 'input[type="text"]', function( e ){
	// similar to jQuery, "this" is scoped to the DOM element.
	// get input val
	var val = $(this).val();
	instance.doSomething( val );
});

```

### $ `model.$(selector)`
Runs the jQuery.$ function scoped to model.$el
```js
var $button = instance.$('.my-button');

```

### $el `model.$el`
The jQuery element for this instance used for adding events.
```js
instance.$el.addClass('new-class');

```

### extend `model.extend(args)`
The **acf.Model** class can be extended to create your own class. Take the following example.
```js
var Person = acf.Model.extend({
	data: {
		firstName: '',
		lastName: ''
	},
	// the 'changed' and 'changed:name' events trigger when changing data
	events: {
		'changed':	'render'	
	},
	setup: function( props ){
		
		// store data
		$.extend(this.data, props);
		
		// create element
		this.$el = $('<div class="person"></div>');
	},
	initialize: function(){
		this.show();
		this.render();
	},
	show: function(){
		$('body').append( this.$el );
	},
	hide: function(){
		this.$el.remove();
	},
	render: function(){
		this.$el.html( this.get('firstName') + ' ' + this.get('lastName') );
	}
});

var person1 = new Person({ firstName: 'John', lastName: 'Smith' });
var person2 = new Person({ firstName: 'Jane', lastName: 'West' });

person2.set('lastName', 'Smith');
```

## acf.Field

We use models to bring our fields to life. Each field is given an instance of the **acf.Field** model allowing a uniform way to interact with fields.

The **acf.Field** model extends from the **acf.Model** model meaning that it inherits all the properties and functions mentioned above.

The following is a contrived example, but it demonstrates how to interact with a field instance.

```js

// get the field instance
var field = acf.getField('field_123456');

// show error if no value
if( !field.val() ) {
	field.showError('Please add a value');
}

// add an event
field.on('click', '.disable-button', function( e ){
	field.disable();
});

// add class
field.$el.addClass('my-field');
```

### type `field.type`
The field type name ("image", "text", etc).

### val `field.val([value])`
Returns the field's value or sets a new value if one is given.
```js
if( !field.val() ) {
	field.val('Default value');
}

```

### $control `field.$control()`
Some fields (such as the image field) use a "control" element to wrap the "input" and pass data attributes. This function returns this "control" jQuery element. 
```js
field.$control().addClass('customized');

```

### $input `field.$input()`
Most fields (such as the text field) use an "input" element to collect and send values. This function returns this "input" jQuery element. 
```js
field.$input().focus();

```

### disable `field.disable()`
Disables the field's input elements.
```js
field.disable();

```

### enable `field.enable()`
Enables the field's input elements.
```js
field.enable();

```

### hide `field.hide()`
Hides the field element.
```js
field.hide();

```

### show `field.show()`
Shows the field element.
```js
field.show();

```

### remove `field.remove()`
Removes the field from the DOM and unregisters all assigned events, actions and filters.
```js
field.remove();

```

### parent `field.parent()`
Returns the field's parent instance or false if no parent.
```js
var parent = field.parent();
if( parent ) {
	parent.doSomething();
}

```

### showNotice `field.showNotice( args )`
Displays a text notice within the field.
```js
field.showNotice({
	text: "Please select at least one of these items",
	type: '',		// warning, error, success
	dismiss: true,	// allow notice to be dismissed
});
```

### removeNotice `field.removeNotice()`
Removes the field's current notice.

### Events 
The **acf.Field** model triggers custom events which can be listened to just like a jQuery change event. These events are similar to the [Field Actions](#actions-field-actions) but allow you to listen directly to a specific field instance.

Name | Description
--- |  ---
`removeField` | Triggered when a field is removed.
`hideField` | Triggered when a field is hidden.
`showField` | Triggered when a hidden field is shown.
`disableField` | Triggered when a field is disabled.
`enableField` | Triggered when a disabled field is enabled.
`invalidField` | Triggered when a field value fails validation.
`validField` | Triggered when an invalid field value passes validation.
`sortstartField` | Triggered when a field is being moved in the DOM.
`sortstopField` | Triggered when a field has finished being moved in the DOM.

The following example shows how to listen to a field event.
```js

// get the field instance
var field = acf.getField('field_123456');

// do something on show
field.on('showField', function(){
	field.doSomething();
});
```

### extend `field.extend( props )`
The **acf.Field** model can be extended to create your own field type "class". This makes developing custom field type easier than ever before. 

Here is an example of the **URL Field** class taken from the ACF source code. Please note that the class is "registered" using the `acf.registerFieldType( Field )` function which is needed for ACF to correctly select this "class" during initialization.

```js
(function($){
	
	var Field = acf.Field.extend({
		type: 'url',
		events: {
			'keyup input[type="url"]': 'onkeyup'
		},
		$control: function(){
			return this.$('.acf-input-wrap');
		},
		$input: function(){
			return this.$('input[type="url"]');
		},
		initialize: function(){
			this.render();
		},
		isValid: function(){
			
			// vars
			var val = this.val();
			
			// url
			if( val.indexOf('://') !== -1 ) {
				return true;
			}
			
			// protocol relative url
			if( val.indexOf('//') === 0 ) {
				return true;
			}
			
			// return
			return false;
		},
		render: function(){
			
			// add class
			if( this.isValid() ) {
				this.$control().addClass('-valid');
			} else {
				this.$control().removeClass('-valid');
			}
		},
		onkeyup: function( e, $el ){
			this.render();
		}
	});
	
	acf.registerFieldType( Field );
	
})(jQuery);
```

## acf.Condition

The **acf.Condition** model is used to define the different types of conditional logic available for use between fields. Similar to **acf.Field**, this model can be extended to create new condition types.

### type `condition.type`
The condition's private ID used for storage/lookup. Must be unique like "hasValue", "hasNoValue", etc.

### operator `condition.operator`
The condition's public ID used in HTML attributes. Should best match a programatic operator like "==", "!=", etc.

### label `condition.label`
The condition's label visible in the dropdown when selecting a conditional rule.

### fieldTypes `condition.fieldTypes`
An array of field types that this condition applies to. Example ['text', 'textarea'].

### match `condition.match(rule, field)`
This function is called to determine if the condition is true or false. Must return a boolean value. See the following example taken from the "Has any value" rule.
```js
// taken from the "Has any value" rule
{
	match: function( rule, field ){
		// return true if field has any value
		return (field.val() ? true : false);
	}
}
```

### choices `condition.choices(fieldObject)`
This function is called to return the available choices for this condition. The selected "field object" is passed through as a parameter which can be used to lookup settings (the selectEqualTo model looks up the field's "choices" textarea setting). The function can return either an array of choices (which will result in a dropdown being created) or custom HTML.
```js
// taken from the "EqualTo" rule
{
	choices: function( fieldObject ){
		return '<input type="text" />';
	}
}
```
```js
// taken from the "trueFalseEqualTo" rule
{
	choices: function( fieldObject ){
		return [
			{
				id:		1,
				text:	'Checked'
			}
		];
	}
}
```

### extend `condition.extend( props )`
The **acf.Condition** model can be extended to create your own condition type "class". This makes developing custom conditions super easy. 

Here is an example of the **lessThan** class taken from the ACF source code. Please note that the class is "registered" using the `acf.registerConditionType( Condition )` function which is needed for ACF to correctly select this "class" during initialization.

```js
(function($){
	
	var LessThan = GreaterThan.extend({
		type: 'lessThan',
		operator: '<',
		label: __('Value is less than'),
		match: function( rule, field ){
			var val = field.val();
			if( val instanceof Array ) {
				val = val.length;
			}
			return isLessThan( val, rule.value );
		},
		choices: function( fieldObject ){
			return '<input type="number" />';
		}
	});
	
	acf.registerConditionType( LessThan );
	
})(jQuery);
```

### registerConditionForFieldType `acf.registerConditionForFieldType(conditionType, fieldType)`

Connects an registered condition type to a registered field type. This can be used to add basic condition types to your own custom field type.

```js
(function($){
	
	var Field = acf.Field.extend({
		type: 'my_custom_field',
		// ...
	});
	
	acf.registerFieldType( Field );
	
	acf.registerConditionForFieldType('hasValue', 'my_custom_field');
	acf.registerConditionForFieldType('hasNoValue', 'my_custom_field');
	
})(jQuery);

```


## Compatibility
The **acf** object extends a "compatibility layer" where we keep any deprecated or changed functions and properties. This allows our library to stay organised as well as provide compatibility with existing code. The biggest changes to our library that requires backwards compatibility are those to the "hook" functions `acf.add_action()` and `acf.add_filter()`.

Prior to version 5.7, all callbacks for Field Actions or Field Filters would receive a jQuery element parameter. This has changed in version 5.7 as these same actions now receive a field instance.

To provide backwards compatibility, we didn't change the hook names, but we did change the function names. This allows us to apply a "compatibility layer" to the parameters depending on which function you use. To better illustrate, please look at the following backwards compatible functions.

### add_action `acf.add_action(action, callback, priority, context)`
An alias of `acf.AddAction()` with a twist. Any action that would normally receive a field instance will receive a jQuery element.
```js
// old: acf.add_action
acf.add_action('ready_field', function( $field ){
	$field.addClass('old-way');
});

// new: acf.addAction
acf.addAction('ready_field', function( field ){
	field.$el.addClass('new-way');
});

```

### add_filter `acf.add_filter(filter, callback, priority, context)`
An alias of `acf.addFilter()` with a twist. Any filter that would normally receive a field instance will receive a jQuery element.
```js
// old: acf.add_filter
acf.add_filter('color_picker_args', function( args, $field ){

    // do something to the field
	$field.addClass('old-way');
	
    // return
    return args;

});

// new: acf.addAction
acf.addFilter('color_picker_args', function( args, field ){

    // do something to the field
	field.$el.addClass('new-way');
	
    // return
    return args;

});

```

## Changelog

### 5.7.0
* Rebuilt JS library

## Further Reading
Believe it or not, this documentation only scrapes the surface of the ACF JavaScript API! If you are interested in learning more about a specific function, finding the full list of models or are in need of more code examples, please take a look at the `acf-input.js` source code located in the plugin folder **assets/js/acf-input.js**.

Happy coding,
The ACF team.
