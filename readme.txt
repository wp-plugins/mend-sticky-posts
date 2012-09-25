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

* Sticky posts are ordered the same way as non-sticky posts.
* Sticky posts do not reappear on subsequent pages.
* The first page of home will contain exactly the requested number of posts, rather than the requested number of posts plus the number of sticky posts.
* Allows more than one page of sticky posts.

Simply injects the sticky post IDs into the actual mySQL order by clause, 
causing posts to be ordered by sticky status then by what ever order is 
specified, usually post_date DESC, and not to repeat on subsequent pages. 
I can't actually figure out why it isn't done like this by WP, perhaps 
earlier versions of mySQL don't support this. WP's default sticky ordering 
craziness is turned off by returning an empty array for the next call to
get_option('sticky_posts') which happens in WP_Query->get_posts().

There is currently a ticket awaiting review on the Wordpress trac system to roll this functionality into the Wordpress core: http://core.trac.wordpress.org/ticket/21986

== Installation ==

1. Upload `mend-sticky-posts.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. That's it!

== Frequently Asked Questions ==

== Screenshots ==

== Changelog ==

= 1.1 =
* Functionally closer to core code.
* Now only run on "home" queries.
* Only run if ignore_sticky_posts isn't passed to WP_Query.
* **Bugfix:** Doesn't add comma when order by clause is already empty.

== Upgrade Notice ==

= 1.1 =
This version fixes a bug that could mess up unordered queries. Upgrade immediately.
