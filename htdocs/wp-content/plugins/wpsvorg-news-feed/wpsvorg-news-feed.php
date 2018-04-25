<?php
/*
Plugin Name: Special news feed for sv.wordpress.org
Plugin URI: http://wordpress.org/extend/plugins/wp-piwik/
Version: 1.0
*/

add_action('init', function() {
	if(isset($_GET['wpsvorg_feed'])) {


		if(!$result = get_transient('wpsvorg_feed')) {

			$feedObject = simplexml_load_file('https://sv.wordpress.org/feed/');

			if(isset($feedObject->channel->item[0])) {
				unset($feedObject->channel->item[0]);
			}
			$result = $feedObject->asXML();
			set_transient('wpsvorg_feed', $result, 3600);
		}

		header('Content-Type: application/rss+xml; charset=UTF-8');
		echo $result;
		die();
	}
});
