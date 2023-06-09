<?php

function HTML_Compression($str){
	$str = preg_replace('/<!--.*?-->/', '', $str);
	$str = str_replace(' />', '/>', $str);
	$str = preg_replace("((<pre.*?>|<code>).*?(</pre>|</code>)(*SKIP)(*FAIL)"."|\r|\n|\t)is", "", $str);
	$str = preg_replace("((<pre.*?>|<code>).*?(</pre>|</code>)(*SKIP)(*FAIL)"."|\s+)is", " ", $str);
	$str = preg_replace("/>\s+</m", "><", $str);
	return $str;
}
function HTML_Compression_finish($html){
    return HTML_Compression($html);
}
add_action('get_header', function(){
	if(!is_user_logged_in()) : 
		ob_start('HTML_Compression_finish');
	endif; 
});