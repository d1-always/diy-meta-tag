=== DIY Meta Tag ===
Contributors: sandy, lshfyy
Donate link: https://github.com/d1-always/diy-meta-tag 
Tags: meta tags, SEO, custom meta, meta manager, head tags
Requires at least: 5.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A simple and powerful plugin to manage custom meta tags for posts and pages. Perfect for SEO optimization and adding custom metadata.

== Description ==

DIY Meta Tag is a lightweight WordPress plugin that allows you to easily add and manage custom meta tags for your posts and pages. Whether you need to add SEO-related meta tags, social media tags, or any other custom metadata, this plugin provides a simple interface to do so.

= Key Features =

* **Easy to Use**: Simple interface in the post/page editor
* **Multiple Tag Types**: Support for both `name` and `property` meta tags
* **SEO Friendly**: Perfect for adding SEO-related meta tags
* **Social Media Ready**: Add Open Graph and Twitter Card tags
* **Clean Output**: Properly formatted meta tags in your site's head section
* **No Database Bloat**: Efficient storage using WordPress post meta
* **Translation Ready**: Fully translatable with included language files

= Perfect for: =

* SEO optimization
* Open Graph tags for social media sharing
* Twitter Card tags
* Custom analytics tags
* Schema.org markup
* Any custom meta tag requirements

= Free Forever =

This plugin is completely free and will always remain free. No premium versions, no hidden costs, no limitations.

== Installation ==

1. Upload the `diy-meta-tag` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to any post or page edit screen to start adding custom meta tags

== Usage ==

1. **Edit a Post or Page**: Navigate to the edit screen of any post or page
2. **Find the Meta Tag Manager**: Look for the "Meta Tag Manager" box in the sidebar
3. **Add Meta Tags**: 
   - Select the tag type (name or property)
   - Enter the meta tag key (e.g., "description", "og:title")
   - Enter the value for the meta tag
4. **Add More Tags**: Click "Add Meta Tag" to add additional tags
5. **Remove Tags**: Click "Remove" next to any tag you want to delete
6. **Save**: Update or publish your post/page to save the meta tags

The meta tags will automatically appear in your site's `<head>` section for the respective posts and pages.

== Frequently Asked Questions ==

= How do I add a meta tag? =

Go to the post or page edit screen, find the "Meta Tag Manager" box, select the tag type, enter the key and value, then save your post.

= What's the difference between "name" and "property" tag types? =

- Use "name" for standard HTML meta tags (e.g., `<meta name="description" content="...">`)
- Use "property" for Open Graph and similar tags (e.g., `<meta property="og:title" content="...">`)

= Can I use this plugin for SEO? =

Absolutely! This plugin is perfect for adding SEO-related meta tags like descriptions, keywords, and Open Graph tags for social media.

= Will this plugin slow down my site? =

No, the plugin is very lightweight and only adds the necessary meta tags to your pages without any performance impact.

= Is this plugin compatible with other SEO plugins? =

Yes, this plugin works alongside other SEO plugins. It simply adds the meta tags you specify without interfering with other plugins.

= Can I use this on custom post types? =

Currently, the plugin works with posts and pages. Support for custom post types may be added in future versions.

== Screenshots ==

1. Meta Tag Manager interface on the post edit screen showing how to add and manage meta tags
2. Example of meta tags output in the page source
3. Adding Open Graph tags for social media sharing

== Changelog ==

= 1.0.1 =
* Added proper uninstall script to clean up data when plugin is removed
* Added translation support with Chinese (zh_CN) translations
* Improved code structure and documentation
* Added plugin assets for WordPress.org submission
* Enhanced security with proper data sanitization
* Fixed minor bugs and improved stability

= 1.0 =
* Initial release
* Basic meta tag management functionality
* Support for posts and pages
* Simple admin interface

== Upgrade Notice ==

= 1.0.1 =
This update adds translation support, improves security, and includes proper cleanup functionality. Recommended for all users.

= 1.0 =
Initial release of DIY Meta Tag plugin.

== Developer Notes ==

This plugin is open source and welcomes contributions. The code is clean, well-documented, and follows WordPress coding standards.

= Hooks and Filters =

* `diymt_head_meta_tags_pre` - Filter meta tags before processing
* `diymt_head_meta_tags` - Filter final meta tags before output
* `diymt_loaded` - Action hook fired when plugin is loaded
* `diymt_head` - Action hook fired after meta tags are output

= Technical Requirements =

* WordPress 5.0 or higher
* PHP 7.4 or higher
* No additional server requirements

== Privacy Policy ==

This plugin does not collect, store, or transmit any personal data. All meta tag data is stored locally in your WordPress database as post metadata.