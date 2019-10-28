---
title: Taxonomy
category: field-types
group: Relational
---

## Description
The Taxonomy field allows the selection of one or more taxonomy terms.

## Screenshots
<div class="gallery">
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-taxonomy-field-interface.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-taxonomy-field-interface.jpg" alt="A Taxonomy field that allows you to select from a list of options" />
		</a>
		<figcaption>The Taxonomy field interface</figcaption>
	</figure>
	<figure>
		<a href="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-taxonomy-field-settings.jpg">
			<img src="https://raw.githubusercontent.com/AdvancedCustomFields/docs/master/assets/acf-taxonomy-field-settings.jpg" alt="List of field settings shown when setting up a Taxonomy field" />
		</a>
		<figcaption>The Taxonomy field settings</figcaption>
	</figure>
</div>

## Changelog
- Split setting `load_save_terms` into `load_terms` and `save_terms` in version 5.2.7.
- `Create Terms` added in version 5.2.3

## Settings
- **Taxonomy**  
  Selects the taxonomy you wish to select term(s) from.
  
- **Appearance**  
  Selects the type of interface displayed (checkbox, multi-select, radio buttons, select).
  
- **Allow Null**  
  Allows the current selection to be cleared and an empty value to be saved.
  
- **Create Terms**  
  Allows new terms to be created whilst editing.
  
- **Save Terms**  
  Connects selected terms to the post object.
  
- **Load Terms**  
  Loads selected terms from the post object.
  
- **Return Value**  
  Specifies the format of the returned data. Choose from Term Object (WP_Term) or Term ID (int).

## Template usage  
The Taxonomy field will return one or more values (objects or IDs) depending on the _Return Value_ setting. Below are some examples of how you can use this data.

### Display single value
This example demonstrates how to get and display a single term object. This would imply that your field type setting is radio button or select.
```
<?php 
$term = get_field('taxonomy_field_name');
if( $term ): ?>
    <h2><?php echo esc_html( $term->name ); ?></h2>
    <p><?php echo esc_html( $term->description ); ?></p>
<?php endif; ?>
```

### Display multiple values
This example demonstrates how to get and loop over multiple selected term objects. This would imply that your field type setting is checkbox or multi-select.
```
<?php 
$terms = get_field('taxonomy_field_name');
if( $terms ): ?>
    <ul>
    <?php foreach( $terms as $term ): ?>
        <h2><?php echo esc_html( $term->name ); ?></h2>
        <p><?php echo esc_html( $term->description ); ?></p>
        <a href="<?php echo esc_url( get_term_link( $term ) ); ?>">View all '<?php echo esc_html( $term->name ); ?>' posts</a>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
```

### Display values from a selected term
The Advanced Custom Fields plugin can be used to [add custom fields to taxonomy terms](https://www.advancedcustomfields.com/resources/adding-fields-taxonomy-term/). Building on this, the following examples demonstrates how to load a custom field value from a selected term value.
```
<?php 
$term = get_field('taxonomy_field_name');
if( $term ): ?>
    <h2>Term name: <?php echo esc_html( $term->name ); ?></h2>
    <p>Term color: <?php the_field('color', $term); ?></p>
<?php endif; ?>
```

## Notes

### Customizing query args
The query arguments used to find and display taxonomy terms can be customized via one of the following filters depending on the *Appearance* setting of your Taxonomy field.
  
For settings *Select* and *Multi Select*, use the [acf/fields/taxonomy/query](https://www.advancedcustomfields.com/resources/acf-fields-taxonomy-query/) filter.  
For settings *Checkbox* and *Radio*, use the [acf/fields/taxonomy/wp_list_categories](https://www.advancedcustomfields.com/resources/acf-fields-taxonomy-wp_list_categories/) filter.

### Customization of Text
The text displayed for each taxonomy term can be customized via the [acf/fields/taxonomy/result](https://www.advancedcustomfields.com/resources/acf-fields-taxonomy-result/) filter.
