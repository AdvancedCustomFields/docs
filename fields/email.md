---
title: Email
category: field-types
group: Basic
---

## Description
The Email field creates an email input for storing email addresses.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-email-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-email-field-interface.png" alt="A text field that allows you to enter an email address" />
		</a>
		<figcaption>The Email field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-email-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-email-field-settings.png" alt="List of settings shown when creating an Email field" />
		</a>
		<figcaption>The Email field settings</figcaption>
	</figure>
</div>

## Changelog
- Email validation added in 5.9.4

## Settings
- **Default Value**  
  The default value shown when creating a new post.
  
- **Placeholder Text**  
  Appears within input when no value exists.
  
- **Prepend**  
  Adds a visual text element before the input.
  
- **Append**  
  Adds a visual text element after the input.

## Template usage

### Display value
This example demonstrates how to display an Email field named "email" within an `<p>` tag.
```
<p><?php the_field( 'email' ); ?></p>
```

### Load value
This example demonstrates how to load the value of an Email field named "contact" and use it to create a link that 
starts a new email.
```
$email = get_field( 'contact' );
if ( $email ) {
    echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
}
```
