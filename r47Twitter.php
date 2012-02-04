<?php

/**
 * @package r47Twitter
 */
/*
  Plugin Name: r47Twitter
  Plugin URI: http://github.com/robo47/r47Twitter
  Description: A simple Plugin for showing tweets via a widget
  Version: 0.2.0
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

define('R47TWITTER_VERSION', '0.2.0');
define('R47TWITTER_PLUGIN_URL', plugin_dir_url(__FILE__));
// include version to be able to change what form of data is actually saved
define('R47TWITTER_TRANSIENT_PREFIX', 'r47twitter_' . R47TWITTER_VERSION . '_');

require_once 'autoload.php';

function r47Twitter_register_widgets() {
    register_widget( 'Robo47_Widget_TwitterWidget' );
}

add_action( 'widgets_init', 'r47Twitter_register_widgets' );