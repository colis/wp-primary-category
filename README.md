# WP Primary Category #
A simple plugin to allow publishers to designate a primary category for posts and custom post types.

## Description
This plugin adds a select dropdown meta box in the admin post page. The dropdown will only contain the currently selected categories and will dynamically change on user's interactions with the categories meta box (category check/uncheck, category creation).

## Installation
1. Upload "wp-primary-category" folder into "/wp-content/plugins/" directory
2. Activate the plugin through the "Plugins" menu in WordPress

### How To Use ###
A post’s primary category is stored in the post meta under the key **wp_primary_category**.

### Support For Custom Post Types ###
Use **wp_primary_category_post_types** filter and add the Custom Post Type to the array.
