---
title: Password
category: field-types
group: Basic
---

## Description
The Password field creates a text field that renders placeholder characters instead of the actual password for privacy.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-password-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-password-field-interface.png" alt="A text field that allows you to enter a password privately" />
		</a>
		<figcaption>The Password field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-password-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-password-field-settings.png" alt="List of settings shown when creating a Password field" />
		</a>
		<figcaption>The Password field settings</figcaption>
	</figure>
</div>

## Changelog

## Settings  
- **Placeholder Text**  
  Appears within input when no value exists.
  
- **Prepend**  
  Adds a visual text element before the input.
  
- **Append**  
  Adds a visual text element after the input.

## Template usage

### Display value
This example demonstrates how to display a Password field named "password" within an `<p>` tag.
```
<p><?php the_field( 'password' ); ?></p>
```

### Load value
This example demonstrates how to load the value of a Password field named "password" and perform an action based on its value.
```
$password = get_field( 'password' );
if( strlen( $password ) > 12 ) {
	// Do something.
}
```
