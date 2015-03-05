<?php
/**
 * @package TopicB
 * @version 0.1
 */
/*
Plugin Name: TopicB
Plugin URI: http://wordpress.org/plugins/topicb-chat/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Description: TopicB Beta provides live conversations around your posts connecting people to your posts to have live discussions about your topics. This is from the php file.
Author: Bolinas Frank
Version: 0.6.5.8
Author URI: http://topicb.com/
*/

function topicbTapid() {

	$GLOBALS['strTapId'] = "1234567890";
	$GLOBALS['strTopic'] = 'test_3';
	$GLOBALS['tempTopic'] = 'test_4';
	$GLOBALS['intTitle'] = 0;

	//echo $GLOBALS['strTapId'];
	//echo $GLOBALS['strTopic'];
	//echo $GLOBALS['intTitle'];

}

add_action('wp_head','topicbTapid');

add_filter('the_content', 'topicbChat');

function topicbChat($content) {
	
	$content .= "<script>
	
	var strTopic='';
	var strImage='http://topicb.com/images/blank.jpg';

	if(document.getElementsByClassName('entry-title')[".$GLOBALS['intTitle']."].childNodes[0].innerHTML){
		console.log('condition 1');
		strTopic=document.getElementsByClassName('entry-title')[".$GLOBALS['intTitle']."].childNodes[0].innerHTML;

		//find image
		if(document.getElementsByClassName('entry-content')[".$GLOBALS['intTitle']."].childNodes[1].childNodes[0]){
			if(document.getElementsByClassName('entry-content')[".$GLOBALS['intTitle']."].childNodes[1].childNodes[0].innerHTML){
				console.log('condition 11');
				if(document.getElementsByClassName('entry-content')[".$GLOBALS['intTitle']."].childNodes[1].childNodes[0].getElementsByTagName('img').length>0){
					strImage=document.getElementsByClassName('entry-content')[".$GLOBALS['intTitle']."].childNodes[1].childNodes[0].getElementsByTagName('img')[0].src;
				}
			}else if(document.getElementsByClassName('entry-content')[".$GLOBALS['intTitle']."].childNodes[1].childNodes[1].innerHTML){
				console.log('condition 12');
				if(document.getElementsByClassName('entry-content')[".$GLOBALS['intTitle']."].childNodes[1].childNodes[1].getElementsByTagName('iframe').length>0){
					strImage=document.getElementsByClassName('entry-content')[".$GLOBALS['intTitle']."].childNodes[1].childNodes[1].getElementsByTagName('iframe')[0].src;
				}
			}
		} else {
			document.getElementsByTagName('img')[".$GLOBALS['intTitle']."].src;
		}

		document.write('<div style=\"width:100%;margin-left:auto;margin-right:auto;background:#fff;\"><iframe style=\"border:none;height:150px;margin-top:10px;overflow:hidden;width:103%;\" src=\"http://topicb.com/index_chat.php?chatter=0000000000&amp;chatee=1111111111&amp;topicinit='+strTopic+'\" id=\"chatBox\"></iframe></div>');

		xmlhttp = new XMLHttpRequest();
	  xmlhttp.open(\"GET\", \"http://topicb.com/submitTopic.php?topic=\"+strTopic+\"&tapid=".$GLOBALS['strTapId']."&ip=".$_SERVER['SERVER_NAME']."&score=0&image=\"+strImage, true);
	  xmlhttp.send();

	}else if(document.getElementsByClassName('entry-title')[".$GLOBALS['intTitle']."].childNodes[1]){
		console.log('condition 2');
		strTopic=document.getElementsByClassName('entry-title')[".$GLOBALS['intTitle']."].childNodes[1].innerHTML;

		if(document.getElementsByClassName('entry-content')[".$GLOBALS['intTitle']."].childNodes[1].childNodes[0]){
			if(document.getElementsByClassName('entry-content')[".$GLOBALS['intTitle']."].childNodes[1].childNodes[0].innerHTML){
				console.log('condition 21');
				strImage=document.getElementsByClassName('entry-content')[".$GLOBALS['intTitle']."].childNodes[1].childNodes[0].href;
			}else{
				console.log('condition 22');
				strImage=document.getElementsByClassName('entry-content')[".$GLOBALS['intTitle']."].childNodes[1].childNodes[0].src;
			}
		} else {
			document.getElementsByTagName('img')[".$GLOBALS['intTitle']."].src;
		}


		document.write('<div style=\"width:100%;margin-left:auto;margin-right:auto;background:#fff;\"><iframe style=\"border:none;height:150px;margin-top:10px;overflow:hidden;width:103%;\" src=\"http://topicb.com/index_chat.php?chatter=0000000000&amp;chatee=1111111111&amp;topicinit='+strTopic+'\" id=\"chatBox\"></iframe></div>');

		xmlhttp = new XMLHttpRequest();
	  xmlhttp.open(\"GET\", \"http://topicb.com/submitTopic.php?topic=\"+strTopic+\"&tapid=".$GLOBALS['strTapId']."&ip=".$_SERVER['SERVER_NAME']."&score=0&image=\"+strImage, true);
  	xmlhttp.send();

	}

	


	</script>";


	$GLOBALS['intTitle']++;

	return $content;
}

?>
