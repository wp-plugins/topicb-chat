<?php
/**
 * @package TopicB
 * @version 0.1
 */
/*
Plugin Name: TopicB
Plugin URI: http://wordpress.org/plugins/topicb/
Description: TopicB provides live conversations around your posts. TopicB is simple to install:<br/>1. Upload 'topicb.php' to the '/wp-content/plugins/' directory<br/>2. Activate the plugin through the 'Plugins' menu in WordPress<br/><br/>TopicB Chat provides live conversations by automatically creating chat rooms for each post in your WordPress site.<br/>The chat is not recorded anywhere.<br/>The chat does not require a profile, login, handle and is anonymous although the option for a handle is provided.<br/>The chat room is only defined by the title of a post.<br/><br/><span style="font-weight:bold;">Upcoming Features</span><br/>TopicB will automatically include your posts in the TopicB network including our app and website giving you a bigger audience without sacrificing exit traffic.

Author: Bolinas Frank
Version: 0.4.7
Author URI: http://topicb.com/
*/

function topicbTapid() {

	$GLOBALS['strTapId'] = "1234567890";
	$GLOBALS['strTopic'] = 'test_3';
	$GLOBALS['tempTopic'] = 'test_4';
	$GLOBALS['intTitle'] = 0;

	echo $GLOBALS['strTapId'];
	echo $GLOBALS['strTopic'];
	echo $GLOBALS['intTitle'];

}

add_action('wp_head','topicbTapid');

add_filter('the_content', 'topicbChat');

function topicbChat($content) {
	
	$content .= "<script>
	
	if(document.getElementsByClassName('entry-title')[".$GLOBALS['intTitle']."].childNodes[0].innerHTML){
		strTopic=document.getElementsByClassName('entry-title')[".$GLOBALS['intTitle']."].childNodes[0].innerHTML;

		document.write('<div style=\"width:340px;margin-left:auto;margin-right:auto;padding-left:15px;padding-right:15px;background:#efefef;\"><iframe style=\"border:none;height:200px;margin-top:10px;overflow:hidden;width:103%;\" src=\"http://topicb.com/index_chat.php?chatter=0000000000&amp;chatee=1111111111&amp;topicinit='+strTopic+'\" id=\"chatBox\"></iframe></div>');

	}else if(document.getElementsByClassName('entry-title')[".$GLOBALS['intTitle']."].childNodes[1]){
		strTopic=document.getElementsByClassName('entry-title')[".$GLOBALS['intTitle']."].childNodes[1].innerHTML;

		document.write('<div style=\"width:340px;margin-left:auto;margin-right:auto;padding-left:15px;padding-right:15px;background:#efefef;\"><iframe style=\"border:none;height:200px;margin-top:10px;overflow:hidden;width:103%;\" src=\"http://topicb.com/index_chat.php?chatter=0000000000&amp;chatee=1111111111&amp;topicinit='+strTopic+'\" id=\"chatBox\"></iframe></div>');

	}else{
		strTopic='';
	}

	</script>";

	$GLOBALS['intTitle']++;

	return $content;
}

?>
