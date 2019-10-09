---
title: Gallery
category: field-types
group: Content
status: draft
---

## Description
The gallery field provides an intuitive interface for managing a collection of images, including adding, editing and sorting.

## Screenshots
<div class="gallery">
    <figure>
        <a href="#">
            <img src="#" alt="A gallery field that allows you to select multiple images" />
        </a>
        <figcaption>The Gallery field interface</figcaption>
    </figure>
    <figure>
        <a href="#">
            <img src="#" alt="List of field settings shown when setting up a Gallery field" />
        </a>
        <figcaption>The Gallery field settings</figcaption>
    </figure>
</div>

## Changelog
- Added `Minimum` setting in version 5.1.9.
- Added `Maximum` setting in version 5.1.9.
- Added `Allowed File Types` setting in version 5.1.9.

## Settings
- **Minimum Selection**  
  The minimum number of images required for field validation. Defaults to 0.
  
- **Maximum Selection**  
  The maximum number of images required for field validation. Defaults to 0.
  
- **Preview Size**  
  The WordPress image size which is displayed when editing the images. Defaults to Thumbnail.
  
- **Library**  
  Limits file selection to only those that have been uploaded to this post, or the entire library.
  
- **Minimum**  
  Adds upload validation for minimum width in pixels (integer), height in pixels (integer) and filesize in MB (integer). The filesize may also be entered as a string containing the unit. eg. `’400 KB’`.
  
- **Maxiumum**  
  Adds upload validation for maximum width, height and filesize.
  
- **Allowed File Types**  
  Adds upload validation for specific file types. Enter a comma separated list to specify which file types are allowed or leave blank to accept all types.

## Template usage  
The gallery field will return an array of image data. Each image is itself an array containing information such as title, alt text, description, URL and more.

For each image in the array, you can expect to see an array like this.
```
Array (
    [ID] => 2822
    [alt] => 
    [title] => Hot-Air-Balloons-2560x1600
    [caption] => 
    [description] => 
    [mime_type] => image/jpeg
    [type] => image
    [url] => http://acf5/wp-content/uploads/2014/06/Hot-Air-Balloons-2560x1600.jpg
    [width] => 2560
    [height] => 1600
    [sizes] => Array (
        [thumbnail] => http://acf5/wp-content/uploads/2014/06/Hot-Air-Balloons-2560x1600-150x150.jpg
        [thumbnail-width] => 150
        [thumbnail-height] => 150
        [medium] => http://acf5/wp-content/uploads/2014/06/Hot-Air-Balloons-2560x1600-300x187.jpg
        [medium-width] => 300
        [medium-height] => 187
        [large] => http://acf5/wp-content/uploads/2014/06/Hot-Air-Balloons-2560x1600-1024x640.jpg
        [large-width] => 604
        [large-height] => 377
        [post-thumbnail] => http://acf5/wp-content/uploads/2014/06/Hot-Air-Balloons-2560x1600-604x270.jpg
        [post-thumbnail-width] => 604
        [post-thumbnail-height] => 270
    )
)
```

### Display list of images
This example demonstrates how to loop over the gallery field values and display a list of images. It uses the [wp_get_attachment_image()](https://developer.wordpress.org/reference/functions/wp_get_attachment_image/) function to generate the image HTML.

[tip]
This function also generates the srcset attribute allowing for [responsive images](https://make.wordpress.org/core/2015/11/10/responsive-images-in-wordpress-4-4/)!
[/tip]

```
<?php 

$images = get_field('gallery');
$size = 'full'; // (thumbnail, medium, large, full or custom size)

if( $images ): ?>
    <ul>
        <?php foreach( $images as $image ): ?>
            <li>
            	<?php echo wp_get_attachment_image( $image['ID'], $size ); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
```

### Display list of images with `<img>` HTML
This example generates the `<img>` HTML using the data available in the `$image` array.
```
<?php 

$images = get_field('gallery');

if( $images ): ?>
    <ul>
        <?php foreach( $images as $image ): ?>
            <li>
                <a href="<?php echo $image['url']; ?>">
                     <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
                </a>
                <p><?php echo $image['caption']; ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
```

### Create a slider
This example shows how to display the images in the markup required for a WooThemes [Flexslider](http://www.woothemes.com/flexslider/) to work.
```
<?php 

$images = get_field('gallery');

if( $images ): ?>
    <div id="slider" class="flexslider">
        <ul class="slides">
            <?php foreach( $images as $image ): ?>
                <li>
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                    <p><?php echo $image['caption']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="carousel" class="flexslider">
        <ul class="slides">
            <?php foreach( $images as $image ): ?>
                <li>
                    <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
```

### Create a WordPress Gallery
This example uses a few extra parameters in the `get_field` function to find the raw value. The raw value is un-formatted and will be returned as an array of images. You can then use this array to create and run a gallery shortcode.

_Note:_ The `$shortcode` string contains a break after the 1st character only to prevent formatting issues with this online documentation. This is not required.

```
<?php 

$image_ids = get_field('gallery', false, false);
$shortcode = '[' . 'gallery ids="' . implode(',', $image_ids) . '"]';

echo do_shortcode( $shortcode );

?>
```
