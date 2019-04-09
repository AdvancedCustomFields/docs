---
title: Including ACF within a plugin or theme
category: guides
group: Features
redirect: including-acf-in-a-plugin-theme
---

## Introduction
The Advanced Custom Fields plugin is a powerful tool for developing bespoke websites and web-apps. Although designed primarily for individual use, it may also be used as a framework by both plugin and theme authors to power their free and premium products.

We encourage authors to include ACF and have only a few simple rules to follow. This guide outlines the do's and don'ts when including ACF within you plugin or theme. 

## Product Types
When talking about a WordPress product, we can consider it as either a plugin, theme, premium plugin or premium theme.

Our rules differ only if your product is considered as free or premium, and not if it is a plugin or theme.

## Rules
Please see the following table of rules that govern the inclusion of our plugins.


|         | ACF           | ACF PRO  |
| ------------- |:-------------:|:-----:|
| Include in a free plugin | ✅ | ❌ |
| Include in a free theme | ✅ | ❌ |
| Include in a premium plugin | ✅ | ✅ |
| Include in a premium theme | ✅ | ✅ |
| Share license key information | ❌ | ❌ |
| Use as a selling point | ✅ | ❌ |

### Notes about marketing
Although we love idea of you empowering your customers with intuitive publishing controls, we don't love the idea of you advertising this to boost sales. 

When including ACF PRO within your premium theme or premium plugin, please do not advertise this in your marketing material. For example, stay away from messages like "This theme also includes ACF PRO - normally $$$ - for free!"

## How to include plugin files
To include ACF or ACF PRO within your plugin or theme, please download the appropriate ACF plugin files and copy them into your plugin or theme. We recommend using the folder "includes/acf" within your product files.

Next, use the following code as a starter to customize and include the ACF plugin into your plugin or theme.

#### Plugin / Theme PHP file
```

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/includes/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/includes/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}

```

## Including fields
Along with the plugin files itself, you will also need to include the field group definitions. We recommend either registering your field groups with PHP, or including a local JSON folder.

- [Local JSON](https://www.advancedcustomfields.com/resources/local-json/)
- [Register fields via PHP](https://www.advancedcustomfields.com/resources/register-fields-via-php/)