<?php

/**
 * @package r47Twitter
 */
/*
  Plugin Name: r47Twitter
  Plugin URI: http://github.com/robo47/r47Twitter
  Description: A simple Plugin
  Version: 0.1.0
  Author: Benjamin Steininger
  Author URI: http://www.benjamin-steininger.de
  License: GPLv2 or later
 */

/*
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

define('R47TWITTER_VERSION', '0.1.0');
define('R47TWITTER_PLUGIN_URL', plugin_dir_url(__FILE__));
// include version to be able to change what form of data is actually saved
define('R47TWITTER_TRANSIENT_PREFIX', 'r47twitter_' . R47TWITTER_VERSION . '_');

require_once 'autoload.php';

/**
 *
 * @param string $username
 * @param string $cachetime
 * @return array  
 */
function r47_get_tweets($username, $cachetime = 60)
{
    try {
        $tweets = get_transient(R47TWITTER_TRANSIENT_PREFIX . $username);
        if (!$tweets) {
            $twitter = new Robo47_Wordpress_Twitter($username);
            $tweets = $twitter->fetchTweets();
            set_transient(R47TWITTER_TRANSIENT_PREFIX . $username, $tweets,
                $cachetime);
        }
    } catch (Exception $e) {
        // ignore anything - just return empty string - we are doing frontend stuff! :)
        return '';
    }
    return $tweets;
}

/**
 * 
 * @param string $username
 * @param integer $count max is 20
 * @param string $cachetime 
 */
function r47_show_tweets($username, $count, $cachetime = 60)
{
    $tweets = r47_get_tweets($username, $cachetime);

    if ($tweets) {
        echo '<div class="rfourseven-tweets">';
        echo '<ul class="rfourseven-tweets-list>';
        $i = 1;
        foreach ($tweets as $tweet) {
            echo '<li class="rfourseven-tweets-tweet">';
            echo $tweet['text'];
            echo '<a href="https://twitter.com/#!/'. $username .'/status/'.$tweet['id'].'"><br />';
            echo date('d.m.y H:i:s', strtotime($tweet['created_at']));
            echo '</a>';
            if ($i >= $count) {
                break;
            }
            $i++;
        }
        echo '<ul>';
        echo '</div>';
    }
}