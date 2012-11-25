=== Plugin Name ===
Plugin Name: Image Slideshows & Galleries
Description: Full Screen Image Slideshow is a cool slideshow that uses jQuery and PHP to display large images from a directory automatically and using the entire browser window as its canvas! Thumbnails of every image is shown at the bottom of the slideshow for easy viewing on demand.
Version: 1.0
Author: objects
Author URI: http://objects.ws

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin to `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php echo getGalleryUrl(postID); ?>` in your templates

e.g.
<a href="<?php echo getGalleryUrl(PostID); ?>">
   <img src="imageSrc" width="100" height="100"/>
</a>
