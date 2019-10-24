---
title: Taxonomy
category: field-types
group: Relational
status: draft
---

## Description
The Taxonomy field allows the selection of one or more taxonomy terms. Not only will this field save its selection as meta data, but you can also select an option to save the ‘post to term’ relationship data for `WP_Query` taxonomy queries.

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
  Selects the type of interface (checkbox, multi-select, radio buttons, select).
  
- **Allow Null**  
  Allows no value to be selected.

- **Create Terms**  
  Allows new terms to be created whilst editing.
  
- **Save Terms**  
  Connects selected terms to the post.
  
- **Load Terms**  
  Loads value from post's terms.

- **Return Value**  
  Specifies the format of the returned data. Choose from Term Object or Term ID.

## Template usage  
The Taxonomy field will return one or more values (objects or IDs) depending on the `Return Value` setting. Below are some examples of how you can use this data.

### Display data (single value)
This example demonstrates how to get and display a single term object. This would imply that your field type setting is radio button or select.
```
<?php 

$term = get_field('taxonomy_field_name');

if( $term ): ?>

    <h2><?php echo esc_html( $term->name ); ?></h2>
    <p><?php echo esc_html( $term->description ); ?></p>

<?php endif; ?>
```

### Display data (multiple values)
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

### Get field from selected term
This example demonstrates how to load a custom field value from the `$term` object. Passing the `$term` object as the `$post_id` parameter was introduced in version 4.3.3. Prior to this, you must construct a `post_id` value as described in [this tutorial](https://www.advancedcustomfields.com/resources/get-values-from-a-taxonomy-term/).
```
<?php 

$term = get_field('taxonomy_field_name');

if( $term ): ?>

    <h2><?php echo esc_html( $term->name ); ?></h2>
    <p><?php echo esc_html( $term->description ); ?></p>
    <p>Color: <?php the_field('color', $term); ?></p>

<?php endif; ?>
```

## Notes

### Customization of Query
The Taxonomy field contains filters that allow for further customization by modifying the `$args` variable used to query the database. The filter needed will shift depending on the _Appearance_ setting of your Taxonomy field.

For settings Select and Multi Select, please use the [acf/fields/taxonomy/query](https://www.advancedcustomfields.com/resources/acf-fields-taxonomy-query/) filter.
For settings Checkbox and Radio, please use the [acf/fields/taxonomy/wp_list_categories](https://www.advancedcustomfields.com/resources/acf-fields-taxonomy-wp_list_categories/) filter.

### Customization of Text
To customize the text displayed for each taxonomy term item, please use the [acf/fields/taxonomy/result](https://www.advancedcustomfields.com/resources/acf-fields-taxonomy-result/).
