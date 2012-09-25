<?php
/*
Plugin Name: Mend Sticky Posts
Plugin URI: http://www.redbrickstudios.co.uk
Description: Wordpress's Sticky Posts behaviour is still incomprehensible, let's fix it.
Author: Martin Shopland
Version: 1.1
*/

/*
Copyright 2012 Redbrick Studios Limited.

This program is free software: you can redistribute it and/or modify it under 
the terms of the GNU General Public License as published by the Free Software 
Foundation, either version 3 of the License, or (at your option) any later 
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY 
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program. If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Simply injects the sticky post IDs into the actual mySQL order by clause, 
 * causing posts to be ordered by sticky status then by what ever order is 
 * specified, usually post_date DESC, and not to repeat on subsequent pages. 
 * I can't actually figure out why it isn't done like this by WP, perhaps 
 * earlier versions of mySQL don't support this. WP's default sticky ordering 
 * craziness is turned off by returning an empty array for the next call to
 * get_option('sticky_posts') which happens in WP_Query->get_posts().
 */
class MendStickyPosts
{
    public function __construct()
    {
        add_filter('posts_orderby', array($this, '_hookPostsOrderBy'), 11, 2);
    }
    
    public function _hookPostsOrderBy($orderBy, $query)
    {
        global $wpdb;       
        
        if($query->is_home && !$query->query_vars['ignore_sticky_posts'])
        {
        	$stickyPosts = get_option('sticky_posts');
			if(is_array($stickyPosts) && !empty($stickyPosts))
			{
				$sticky = '(' . $wpdb->posts . '.ID IN (' . 
                	implode(',', $stickyPosts) . ')) DESC';
					
				$orderBy = empty($orderBy) ? $sticky : $sticky . ',' . $orderBy;
					           
	            add_filter(
	                'pre_option_sticky_posts',
	                array($this, '_hookOptionStickyPosts')
	            );
			}
        }
        return $orderBy;
    }
    
    public function _hookOptionStickyPosts($option)
    {
        remove_filter(
            'pre_option_sticky_posts', 
            array($this, '_hookOptionStickyPosts')
        );
        return array();
    }
}

$mendStickyPosts = new MendStickyPosts();