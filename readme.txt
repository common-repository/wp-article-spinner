=== WP Article Spinner ===

Plugin Name: WP Article Spinner 
Plugin URI: http://www.danielwachtel.com/products/wp-article-spinner/
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7JN7YZ53YA2A4
Description: Spin your articles with random images & videos, save them, and post to your WordPress blogs in a click of a button! Anchor text spinner included.
Requires at least: 3.4
Tested up to: 3.5
Version: 1.2
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: wp, spin, spinner, article, free, post, xml-rpc, anchor, text, blogs, manage, backlinks
Author: Daniel Wachtel
Author URI: http://www.danielwachtel.com/
Contributors: daniel_wachtel

== Description ==

[WP Article Spinner](http://www.danielwachtel.com/products/wp-article-spinner/ "WP Article Spinner") is a free plugin that allows you to spin articles with random images and YouTube videos, save them to your WordPress database, and post the spun article to your WordPress blogs. An anchor text spinner is also included!

= Features =

* Easy install
* Spin any article that is in { | } format
* Works with nested spins
* Insert a random number of images and/or YouTube videos
* Spin anchor texts
* Ability to save any of the above to your WordPress database
* Post spun articles to WordPress blogs via XML-RPC

= How to Use the Article Spinner =

1. Type in a 'Project Name'.
2. Add your spun 'Title' and 'Content'. Spin format is { | } and nested spins are acceptable.
3. Paste the URLs for your images and YouTube videos in their respective text areas, one URL per line. Choose the maximum number you want inserted for each type (from 0 to 10). If you choose 3 above images for example, 0 to 3 images will be randomly inserted into your spun article.
4. Add your spun 'Keywords' comma separated.
5. Click 'Save Article' to save it to your WordPress database.
6. Click on 'Spin Article' to view spun result. If 'Copy Article' is selected output will appear in a text box so that you can easily copy the source code, if 'View Article' is selected videos and images will render like in a normal html page.
7. 'Post to Blog' - you can post a spun version of your article to a WordPress blog. Your blogs must be added to the plugin before they show up. To add blogs visit the 'Manage WP Blogs' section of the plugin.

= How to Add WordPress Blogs to Post to =

1. Click on 'Manage WP Blogs' under the 'WP Article Spinner' menu.
2. Fill in the details and click on 'Add Blog'.
3. WP Article Spinner will then make sure that the details are correct and that it can connect to the blog. It will also return all existing categories.

For video tutorials [click here](http://www.danielwachtel.com/products/wp-article-spinner/ "WP Article Spinner").

== Installation ==

You can use the built in installer and upgrader, or you can install the plugin manually.

= Installation via WordPress =

1. Go to the menu 'Plugins' -> 'Install' and search for 'WP Article Spinner'
2. Click 'install'

= Manual Installation =

1. Upload folder wp-article-spinner to the /wp-content/plugins/ directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= The plugin isn't posting to my WordPress blog =
XML-RPC must be enabled on the WordPress blog that you are trying to post to. To enable XML-RPC go to 'Settings' -> 'Writing' and and enable 'XML-RPC' under 'Remote Publishing' at the bottom of the page.

== Changelog ==

= 1.2 =
* (21/12/2012)
* Updated code not to use xmlrpc_encode_request()
* Now using WordPress's IXR library for XML-RPC

= 1.1 =
* (20/12/2012)
* Plugin now checks that XML-RPC is enabled

= 1.0 =
* (15/12/2012)
* Initial Release

== Upgrade Notice ==

= 1.2 =
Changed the XML-RPC library used for posting / adding blogs.

= 1.1 =
Added test to determine if XML-RPC is enabled.

= 1.0 =
First release, no upgrade required yet.

== Screenshots ==

1. Article spinner
2. Spun output
3. Adding WordPress blogs
