---
title: Custom location rules
description: 
category: guides
group: Tutorials
---

## Introduction

Location rules are used to determine which field groups appear on which admin screen. They are defined when editing a Field Group and consist of a location type, a comparison operator, and a value. 

One example of a location rule would be "Post Type == Post".

<figure style="margin: 2em 0;">
	<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-location-rule-example.png">
		<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-location-rule-example.png" alt="The Field Group Locations metabox" />
	</a>
	<figcaption>The Field Group Locations metabox</figcaption>
</figure>

A diverse set of location types are included within the Advanced Custom Fields plugin to satisfy the needs of most websites. In addition to these, extra location types may be defined to provide bespoke logic for the location of a Field Group.

This guide will walk through the process of creating and registering a custom location type.

## Requirements
The `ACF_Location` class mentioned in this guide requires version 5.9.0 or above. If not already, please consider updating to take advantage of this great feature!

For those using a previous version, please checkout [this guide](https://www.advancedcustomfields.com/resources/custom-location-rules--v5-8/) instead.

## Getting Started
To create a custom location type, simply extend the `ACF_Location` class and some of its methods. Then register it with the `acf_register_location_type()` function.

The following is a simplified example demonstrating a custom location type that when selected would randomly show the Field Group 50% of the time.

```php
class My_Location extends ACF_Location {
	function initialize() {
		$this->name = '50_50';
		$this->label = __( 'Fifty Fifty' );
    }
	function match() {
		return rand( 0, 1 );
	}
}
acf_register_location_type( 'My_Location' );
```

## ACF_Location
The `ACF_Location` class contains multiple properties and methods, not all of which need to be customized. Before jumping into the working example, please familiarize yourself with the available properties and methods listed below.

### Properties
- **name**  
  (String) A unique name that identifies the location type. For example 'post_author'.  
  A location type name may only contain lowercase alphanumeric characters and underscores.
  ```
  $this->name = 'post_author';
  ```
  
- **label**  
  (String) The display label for your location type shown when editing a Field Group. For example 'Post Author'.
  ```
  $this->label = __('Post Author');
  ```
  
- **category**  
  (String) (Optional) The group where this location type appears in the location type dropdown.  
  Accepts "post", "page", "user", "forms" or a custom label. Defaults to "post".
  ```
  $this->category = 'post';
  ```
  
- **public**  
  (Bool) (Optional) Whether or not the location rule is publicly selectable. Defaults to true.
  ```
  $this->public = true;
  ```
  
- **object_type**  
  (String) (Optional) The object type related to this location.  
  Accepts an object type discoverable by `acf_get_object_type()` such as "post", "user", "block", etc. Defining this property allows ACF to display an icon in the Field Groups admin table column. Defaults to an empty string that represents "Various".
  ```
  $this->object_type = 'post';
  ```

### Methods
-	**initialize**  
	Called during registration to initialize properties.
	```
	public function initialize() {
		$this->name = 'post_author';
		// Define all other properties here.
	}
	```

-	**match**  
	Compares the provided location rule against the current screen args and returns true for a positive match.
	Returning true will allow the Field Group to appear on the current screen. Returning false will prevent the Field Group from appearing on the current screen.
	```
	public function match( $rule, $screen, $field_group ) {
		return false;
	}
	```

-	**get_operators**  
	(Optional) Returns an array of operators to choose from when editing a rule.  
	If omitted, the default "is equal to" and "is not equal to" operators will be used.
	```
	public function get_operators( $rule ) {
		return array(
			'==' => __( "is equal to" ),
			'!=' => __( "is not equal to" )
		);
	}
	```

-	**get_values**  
	(Optional) Returns an array of possible values to choose from when editing a rule.
	```
	public function get_values( $rule ) {
		return array(
			'foo' => 'Foo',
			'bar' => 'Bar'
		);
	}
	```

-	**get_object_subtype**  
	(Optional) Similar the the object_type property, this method allows ACF to display a more accurate icon in the Field Groups admin table column.  
	Returns one or more subtypes that are related to this location.  
	Valid object subtypes include post types and taxonomies. Defaults to an empty string.
	```
	public function get_object_subtype( $rule ) {
		return 'category';
	}
	```

## Example

Let's put some of these properties and methods to good use and create a custom location type called "Post Author". This location type will allow a Field Group to appear when editing a Post based on the Post's Author attribute.

### 1. Setup
Our first task is to define a new `ACF_Location` class, using the `initialize()` method to setup the location type's properties. In this example, we will work within the theme file **includes/class-my-acf-location-post-author.php**.

#### includes/class-my-acf-location-post-author.php
```php
<?php 

if( ! defined( 'ABSPATH' ) ) exit;

class My_ACF_Location_Post_Author extends ACF_Location {
	
	public function initialize() {
		$this->name = 'post_author';
		$this->label = __( "Post Author", 'acf' );
		$this->category = 'post';
    	$this->object_type = 'post';
	}
}
```

Next, let's include and register this location type from the `functions.php` file.

#### functions.php
```php
add_action('acf/init', 'my_acf_init_location_types');
function my_acf_init_location_types() {

    // Check function exists, then include and register the custom location type class.
    if( function_exists('acf_register_location_type') ) {
		include_once( 'includes/class-my-acf-location-post-author.php' );
		acf_register_location_type( 'My_ACF_Location_Post_Author' );
    }
}
```

Presto 🎉. We can edit a Field Group and select the new location type.

<figure style="margin: 2em 0;">
	<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-location-rule-type.png">
		<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-location-rule-type.png" alt="Screenshot of selecting the Post Author location rule type" />
	</a>
	<figcaption>Selecting the "Post Author" location rule type</figcaption>
</figure>

### 2. Customizing drop-downs
With our custom location type registered, we can now turn our focus to customizing the *operator* and *value* drop-downs - the two settings that appear next to the selected location type. 

In this example, we will leave the *operator* drop-down as-is which will show the default "is equal to" (==) and "is not equal to" (!=) choices. We will, however, customize the *value* drop-down to display a list of all possible users.

WordPress' [get_users()](#) function makes this task quite simple. The following snippet will populate an array of choices using the user's ID as the option value, and the user's Display Name as the option label.

#### includes/class-my-acf-location-post-author.php
```php
public function get_values( $rule ) {
	$choices = array();

	// Load all users, loop over them and append to chcoices.
	$users = get_users();
	if( $users ) {
		foreach( $users as $user ) {
			$choices[ $user->ID ] = $user->display_name;
		}
	}
	return $choices;
}
```

Our custom location type is starting to take shape! It is now possible to create a Location Rule that reads "Post Author == Elliot" 🙌. 

<figure style="margin: 2em 0;">
	<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-location-rule-value.png">
		<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-location-rule-value.png" alt="Screenshot of selecting the Post Author location rule value" />
	</a>
	<figcaption>Selecting the "Post Author" location rule value</figcaption>
</figure>

Lastly, we need to define the logic that compares a rule (such as "Post Author == Elliot") to the current screen.

### 3. Calculating a match

When viewing a WordPress edit screen, Advanced Custom Fields will calculate which Field Groups appear based on their location rules. Each location rule's type is consulted to determine whether or not the rule matches the current screen args. 

The logic for this "matching" is defined in the `match()` method. This method accepts 3 parameters including the rule conditions, the current screen arguments and also the Field Group who's visibility is being calculated. All that is required from this method is to return a boolean value reflecting the matching result.

In this example, we will compare the selected rule value (a user ID) to the Post's author attribute. We also need to remember that this location type is only relevant when editing a Post, and not a User, Term, Widget, etc.

#### includes/class-my-acf-location-post-author.php
```php
public function match( $rule, $screen, $field_group ) {

	// Check screen args for "post_id" which will exist when editing a post.
	// Return false for all other edit screens.
	if( isset($screen['post_id']) ) {
		$post_id = $screen['post_id'];
	} else {
		return false;
	}

	// Load the post object for this edit screen.
	$post = get_post( $post_id );
	if( !$post ) {
		return false;
	}

	// Compare the Post's author attribute to rule value.
	$result = ( $post->post_author == $rule['value'] );

	// Return result taking into account the operator type.
	if( $rule['operator'] == '!=' ) {
		return !$result;
	}
	return $result;
}
```

Congratulations 🎉 The Post Author location type is now complete! A Field Group using this location type will display only when editing a Post where the Post's Author is "Eliot".

<figure style="margin: 2em 0;">
	<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-location-rule-complete.png">
		<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-location-rule-complete.png" alt="The 'Post Author' location type matching correctly for the rule 'Post Author == Elliot'" />
	</a>
	<figcaption>The "Post Author" location type matching correctly for the rule "Post Author == Elliot"</figcaption>
</figure>

### Complete code

For reference, here is the complete code written for the custom "Post Author" location type.

#### includes/class-my-acf-location-post-author.php
```php
<?php 

if( ! defined( 'ABSPATH' ) ) exit;

class My_ACF_Location_Post_Author extends ACF_Location {
	
	public function initialize() {
		$this->name = 'post_author';
		$this->label = __( "Post Author", 'acf' );
		$this->category = 'post';
    	$this->object_type = 'post';
	}

	public function get_values( $rule ) {
		$choices = array();

		// Load all users, loop over them and append to chcoices.
		$users = get_users();
		if( $users ) {
			foreach( $users as $user ) {
				$choices[ $user->ID ] = $user->display_name;
			}
		}
		return $choices;
	}

	public function match( $rule, $screen, $field_group ) {

		// Check screen args for "post_id" which will exist when editing a post.
		// Return false for all other edit screens.
		if( isset($screen['post_id']) ) {
			$post_id = $screen['post_id'];
		} else {
			return false;
		}

		// Load the post object for this edit screen.
		$post = get_post( $post_id );
		if( !$post ) {
			return false;
		}

		// Compare the Post's author attribute to rule value.
		$result = ( $post->post_author == $rule['value'] );

		// Return result taking into account the operator type.
		if( $rule['operator'] == '!=' ) {
			return !$result;
		}
		return $result;
	}
}
```
#### functions.php
```php
add_action('acf/init', 'my_acf_init_location_types');
function my_acf_init_location_types() {

    // Check function exists, then include and register the custom location type class.
    if( function_exists('acf_register_location_type') ) {
		include_once( 'includes/class-my-acf-location-post-author.php' );
		acf_register_location_type( 'My_ACF_Location_Post_Author' );
    }
}
```

## Wrapping Up

The `ACF_Location` class makes light work of creating custom location rules. In only a few lines of code we have been able to:
- Register a new location type that can be selected within a Field Group's location rules.
- Customize the values displayed in the location rule *value* dropdown.
- Calculate whether or not a rule matches the current edit screen.
