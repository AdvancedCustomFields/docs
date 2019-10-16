---
title: Accordion
category: field-types
group: Layout
status: draft
---

## Description
The Accordion field is used to organize fields into collapsible panels. This helps tidy up the UI by reducing the need to scroll.

There are two elements in each Accordion:
1. A clickable title consisting of the field’s label and instructions.
2. A collapsible content panel where neighboring fields will be moved to/within.

When editing a field group, please be aware that all fields following an Accordion field (or until another Accordion field is defined) will be added to the Accordion’s content panel. The exception to this rule is when using the Endpoint setting.

Conditional logic settings can be applied to an Accordion field. The Accordion field will also hide/show the fields which it visually controls.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-accordion-field-interface.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-accordion-field-interface.jpg" alt="Accordion field that displays an image and content within" />
		</a>
		<figcaption>The Accordion field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-accordion-field-settings.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-accordion-field-settings.png" alt="List of settings shown when creating an Accordion field" />
		</a>
		<figcaption>The Accordion field settings</figcaption>
	</figure>
</div>

## Changelog
- Added in version 5.6.6.

## Settings
- **Open**  
  Shows the Accordion content panel as open on initial page load. Defaults to false.
  
- **Multi-expand**  
  Prevents default behavior of closing sibling Accordions when one is open. Defaults to false.
  
- **Endpoint**  
  Defines an endpoint for the previous Accordion field. All fields that follow will not be appended to the Accordion's content panel.

## Template usage
This field does not save any data and is not used with template code.
