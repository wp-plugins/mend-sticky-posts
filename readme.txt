=== Mend Sticky Posts ===
Contributors: martinshopland
Donate Link: http://uk.virginmoneygiving.com/charity-web/charity/finalCharityHomepage.action?charityId=1000496
Tags: core
Requires at least: 3.0.1
Tested up to: 3.4.2
Stable tag: 1
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Wordpress's Sticky Posts behaviour is still incomprehensible, let's fix it.

== Description ==

Simply injects the sticky post IDs into the actual mySQL order by clause, 
causing posts to be ordered by sticky status then by what ever order is 
specified, usually post_date DESC, and not to repeat on subsequent pages. 
I can't actually figure out why it isn't done like this by WP, perhaps 
earlier versions of mySQL don't support this. WP's default sticky ordering 
craziness is turned off by returning an empty array for the next call to
get_option('sticky_posts') which happens in WP_Query->get_posts().

== Installation ==

1. Upload `mend-sticky-posts.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. That's it!

== Frequently Asked Questions ==

== Screenshots ==

== Changelog ==

== Upgrade Notice ==