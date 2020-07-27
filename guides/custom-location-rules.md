---
title: Custom location rules
description: 
category: guides
status: draft
---

## Introduction

Location rules are used to determine which field groups appear on which admin screen. They are defined when editing a Field Group and consist of a location type, a comparison operator, and a value. One example of a typical location rule would be "Post Type == Page".

[Screenshot]

A diverse set of Location Types are included within the Advanced Custom Fields plugin to satisfy the needs of most websites. In addition to these, extra Location Types may be defined to provide bespoke logic for the appearance of a Field Group.

This guide will walk through the process of creating and registering a custom Location Type.

## Requirements
The `ACF_Location` class mentioned in this guide is found in ACF version 5.9.0 and above. If not already, please consider updating to take advantage of this great feature!

## Getting Started
To create a custom location type, simply extend the `ACF_Location` class and some of its methods. Then register it with the `acf_register_location_type()` function.

The following is a simplified example demonstrating a custom Location Type that when selected would randomly show the Field Group 50% of the time.

```php
class My_Location extends ACF_Location {
    function initialize() {
        $this->name = '50_50';
        $this->label = __( 'Fifty Fifty' );
    }
    function match_rule() {
        return rand( 0, 1 );
    }
}
acf_register_location_type( 'My_Location' );
```

## ACF_Location
The `ACF_Location` class contains multiple properties and methods, not all of which need to be customized. Before jumping into a working example, please familiarize yourself with the available properties and methods listed below.

### Properties
- **name**  
  (String) A unique name that identifies the location type. For example 'post_author'.  
  Note: A location type name may only contain lowercase alphanumeric characters and underscores.
  ```
  $this->name = 'post_author';
  ```
  
- **label**  
  (String) The display label for your location type shown when editing a Field Group. For example 'Post Author'.
  ```
  $this->label = __('Post Author');
  ```
  
- **category**  
  (String) (Optional) The group where this location type appears in the location rule dropdown.  
  Accepts "post", "page", "user", "forms" or a custom label. Defaults to "post".
  ```
  $this->category = 'post';
  ```
  
- **public**  
  (bool) (Optional) Whether or not the location rule is publicly selectable. Defaults to true.
  ```
  $this->public = true;
  ```
  
- **object_type**  
  (string) (Optional) The object type related to this location.  
  Accepts an object type discoverable by `acf_get_object_type()` such as "post", "user", "block", etc. Defining this property allows ACF to display an icon in the Field Groups admin table column.
  ```
  $this->object_type = 'post';
  ```

### Methods
- **initialize**  
  Called during registration to initialize properties.
  ```
  public function initialize() {
    $this->name = 'post_author';
    // Define all properies here.
  }
  ```

- **match_rule**  
  Matches the provided location rule against the screen args returning a bool result.
  Returning false will prevent the Field Group from appearing on the current screen.
  ```
  public function match_rule( $rule, $screen, $field_group )
    return false;
  }
  ```

- **get_rule_operators**  
  (Optional) Returns an array of operators to choose from when editing a rule.  
  If omitted, the default "is equal to" and "is not equal to" operators will be used.
  ```
  public function get_rule_operators( $rule ) {
    return array();
  }
  ```

- **get_rule_values**  
  (Optional) Returns an array of values to choose from when editing a rule.
  ```
  public function get_rule_operators( $rule ) {
    return array();
  }
  ```

- **get_object_subtype**  
  (Optional) Similar the the object_type property, this method allows ACF to display a more accurate icon in the Field Groups admin table column. Returns one or more subtypes that are related to this location.  
  Valid object subtypes include post types and taxonomies.
  ```
  public function get_object_subtype( $rule ) {
    return 'category';
  }
  ```

## Example

Let's put these properties and methods to use and create a custom Location Type called "Post Author". This Location Type will allow a Field Group to appear when editing a Post based on the Post's Author attribute.

### 1. Setup
Our first task is to define a new `ACF_Location` extended class with a custom `initialize()` method to setup the Location Types properties. In this example, we will work within a theme file `includes/class-my-acf-post-author-location.php`.

#### includes/class-my-acf-location-post-author.php
``` php
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

Next, let's include and register this Location Type from the `functions.php` file.

#### functions.php
``` php
add_action('acf/init', 'my_acf_init_location_types');
function my_acf_init_location_types() {

    // Check function exists, then include and register the custom Location Type class.
    if( function_exists('acf_register_location_type') ) {
		include_once( 'includes/class-my-acf-location-post-author.php' );
		acf_register_location_type( 'My_ACF_Location_Post_Author' );
    }
}
```

At this point, we can edit a Field Group and select the new Location Type - yay 🙌!

<figure>
  <img src="https://www.advancedcustomfields.com/wp-content/uploads/2013/01/location-types1.png" alt="acf-blocks-introduction"/>
  <figcaption>The location rule type drop-down showing a custom Location Type.</figcaption>
</figure>

### 2. Customizing the values drop-down
With our custom Location Type registered, we can now customize the "Rule Values" dropdown. The selected choice from this drop-down will be used later when calculating if the Field Group should be displayed or not.

As this Location Type compares a Post's author attribute, it makes sense to display a list of authors in this drop-down. WordPress makes this task extremely simple with the [get_users()](#) function. The following snippet will populate an array of choices using the user's ID as the option value, and the user's Display Name as the option label.

#### includes/class-my-acf-location-post-author.php
``` php
	public function get_rule_values( $rule ) {

		// get all users.
		$users = get_users( $args );

		// Populate a list of users.
		$choices = array();
		if( $users ) {
			foreach( $users as $user ) {
				$choices[ $user->ID ] = $user->display_name;
			}
		}
		return $choices;
	}
```

Our custom Location Type is starting to take shape! It is now possible to create a Location Rule that reads "Post Author == David". 

<figure>
  <img src="https://www.advancedcustomfields.com/wp-content/uploads/2013/01/location-value.png" alt="acf-blocks-introduction"/>
  <figcaption>The location rule value drop-down showing a user selected.</figcaption>
</figure>

Next, we need to define the logic that calculates if the rule ("Post Author == David") is a match when editing a Post.

### 3. Customizing the match logic

When matching a rule of this Location Type, we need to compare the selected value (a user ID) to the Post's author attribute. We also need to remember that this Location Type is only relevant when editing a Post, and not a User, Term, Widget, etc.

The logic for this matching occurs within the `match_rule()` method. This method accepts 3 parameters including the rule conditions, the current screen arguments and also the Field Group who's visibility is being calculated. All that is required from this method is to return a boolean value reflecting the matching result.


#### includes/class-my-acf-location-post-author.php
``` php
	public function match_rule( $rule, $screen, $field_group ) {

		// Check screen args for "post_id" which will exist when editing a post.
		// Return false for all other edit screens.
		if( isset($screen['post_id']) ) {
			$post_id = $screen['post_id'];
		} else {
			return false;
		}

		// Load the post author.
		$post = get_post( $post_id );
		if( !$post ) {
			return false;
		}

		// Compare post author to rule value.
		// The method compare_rule() takes into account the operator value ("==" or "!=").
		return $this->compare_rule( $rule, $post->post_author );
	}
```

Congratulations 🎉! The Post Author Location Type is now complete. 

With only a few lines of code we have been able to:
- Register a new Location Type that can be selected within a Field Group's location rules.
- Customize the values displayed in the location rule dropdown.
- Compare that value to a Post's author when editing a Post.
- Control a Field Group's visibility which makes use of this rule.

## Special Considerations

The above example uses a Post attribute (author) which can be modified by the user when editing a post...