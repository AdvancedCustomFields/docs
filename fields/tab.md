---
title: Tab
category: field-types
group: Layout
---

## Description
The Tab field is used to group together fields into tabbed sections.

When editing a field group, be aware that all fields following the Tab field (or until another Tab field is defined) will be grouped together using the Tab field label as the tab heading.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-tab-field-interface.png">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-tab-field-interface.png" alt="Custom fields grouped together by Tabs: Basic Info, Detailed Info, and Images" />
		</a>
		<figcaption>The Tab field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-tab-field-settings.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-tab-field-settings.jpg" alt="List of settings shown when creating a Tab field" />
		</a>
		<figcaption>The Tab field settings</figcaption>
	</figure>
</div>

## Changelog
- Added `Placement` setting in version 5.1.7.
- Added `Endpoint` setting in version 5.2.8.
- Added functionality within a Repeater or Flexible Content field in version 5.0.0.

## Settings
- **Placement**  
  Changes the tab style from a top aligned row to a left aligned sidebar. The _left aligned_ option will be ignored if the field group appears in a table element (editing a user, attachment, taxonomy or field group label setting on left).
  
- **Endpoint**  
  Defines an endpoint for the previous Tab group. When used in combination with an empty field label, this field can be used as a tab stopper.
