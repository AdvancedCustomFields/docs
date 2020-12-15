---
title: Message
category: field-types
group: Layout
---

## Description
The Message field provides a means of displaying information within a field group.

The field supports the use of HTML as a means of both showing example code (escaped HTML) and displaying formatted 
output such as links, lists, heading, etc. 

Be mindful that `<script>` tags will be escaped at all times so any JavaScript placed in the field will not execute. 

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-message-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-message-field-interface.png" alt="A Message field showing additional helpful information" />
		</a>
		<figcaption>The Message field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-message-field-settings.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-message-field-settings.jpg" alt="List of settings shown when creating a Message field" />
		</a>
		<figcaption>The Message field settings</figcaption>
	</figure>
</div>

## Changelog
- Added `new_lines` setting in version 5.3.1
- Added `esc_html` setting to show HTML as plain text in version 5.1.9
- Added `wrapper` settings in version 5.1.8

## Settings
- **Message**  
  Provides a text area for text and/or HTML that will be shown in the field interface.
  
- **New Lines**  
  Changes the way new lines are formatted. Selecting “Automatically add paragraphs” will add paragraph tags around the value. Selecting “Automatically add `<br>`” will convert any new lines to HTML line breaks. Selecting “No formatting” will not convert _any_ tags and you will see any HTML displayed as normal text similar to regular content.
  
- **Escape HTML**
  If enabled, any HTML tags within the message will be escaped. This will result in the HTML displayed as text in the field interface which is useful when needing to display example code. 
