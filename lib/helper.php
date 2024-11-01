<?php
# Spinning function
function wp_article_spin($s){
	preg_match('#\{(.+?)\}#is',$s,$m);
	if(empty($m)) return $s;

	$t = $m[1];

	if(strpos($t,'{')!==false){
		$t = substr($t, strrpos($t,'{') + 1);
	}

	$parts = explode("|", $t);
	$s = preg_replace("+\{".preg_quote($t)."\}+is", $parts[array_rand($parts)], $s, 1);

	return wp_article_spin($s);
}

# Truncate function
function wpas_truncate($s){
	if (strlen($s) > 50) {
	    $s = substr($s, 0, 50) . "...";
	}
	
	return htmlentities($s, ENT_COMPAT);
}

function wpas_xmlrpc($title,$body,$rpcurl,$username,$password,$category,$keywords='',$encoding='UTF-8'){
	include_once(ABSPATH . WPINC . '/class-IXR.php');
	include_once(ABSPATH . WPINC . '/class-wp-http-ixr-client.php');

	$title2 = htmlentities(stripslashes($title),ENT_NOQUOTES,$encoding);
	$keywords2 = htmlentities($keywords,ENT_NOQUOTES,$encoding);	
	$content = array(
		'title' => $title2,
		'description' => stripslashes($body),
		'mt_allow_comments' => 0,  // 1 to allow comments
		'post_type' => 'post',
		'mt_keywords' => $keywords2,
		'categories' => array($category)
	);
		
	$rpcurl2 = $rpcurl."/xmlrpc.php";
	$client = new WP_HTTP_IXR_CLIENT($rpcurl2);
	$params = array(0,$username,$password,$content,true);
	$result = $client->query('metaWeblog.newPost',$params);
	return $result;
}

function wpas_get_categories($rpcurl,$username,$password){
	include_once(ABSPATH . WPINC . '/class-IXR.php');
	include_once(ABSPATH . WPINC . '/class-wp-http-ixr-client.php');	

	$rpcurl2 = $rpcurl."/xmlrpc.php";	
	$client = new WP_HTTP_IXR_CLIENT($rpcurl2);
	$params = array(0,$username,$password,true);
	$client->query('metaWeblog.getCategories',$params);
	$result = $client->getResponse();
	return $result;
}

function wpas_array_builder($items){
    $array = array();
    foreach ($items as $item){
	array_push($array, $item['description']);
    }
}

# Pagination function
function wpas_pagination($num, $url){
    $i = 1;
    if (isset($_GET["num"])) { $page = $_GET["num"]; } else { $page = 1; }

    if ($page > 1) {
	echo '<a class="wpas_pagination" href="' . $url . '&num=' . ($page - 1) . '"><<</a>';
    } else { echo '<span class="wpas_padding_right"><<</span>'; }

    while ($i<=$num){
	if ($i == $page){
	    echo $i;
	}
	else {
	    echo ' <a href="' . $url . '&num=' . $i . '">' . $i . '</a> ';
	}
	$i++;
    }

    if ($page < $num) {
	echo '<a class="wpas_pagination" href="' . $url . '&num=' . ($page + 1) . '">>></a>';
    } else { echo '<span class="wpas_padding_left">>></span>'; }
}

# Drop down select box for max images & videos
function wpas_select_maximum($number_selected){
    $i = 0;
    while ($i <= 10) {
	if ($number_selected == $i){
	    echo '<option value="' . $i . '" selected>' . $i . '</option>';
	}
	else {
	    echo '<option value="' . $i . '">' . $i . '</option>';
	}
	$i++;
    }
}

# YouTube URL to embed code
function wpas_youtube_embed($long_url){
    $step1 = explode('v=', $long_url);
    $step2 = explode('&', $step1[1]);
    $url = $step2[0];
    $embed = '<iframe width="640" height="360" src="http://www.youtube.com/embed/' . $url . '" frameborder="0" allowfullscreen></iframe>';
    return $embed;
}

# Turn image URL to src=""
function wpas_image_embed($image){
    $embed = '<img src="' . $image . '" />';
    return $embed;
}

# Insert random images & videos
function wpas_insert_random($text, $images, $max_images, $videos, $max_videos){
    $replace_newline = str_replace("\n", "\r", $text);
    $text_array = explode("\r", $replace_newline);

    if (!empty($images)){
 	$text_size = count($text_array) - 1;
	$images_cleaned = str_replace("\n", "\r", $images);
	$image_array = array_filter(explode("\r", $images_cleaned));
	shuffle($image_array);
	$image_size = count($image_array);
	$max_img = ($max_images > $image_size ? $image_size : $max_images);
	$rand_img_max = rand(0, $max_img);
	$i = 1;
	foreach ($image_array as $img){
	    if ($i <= $rand_img_max){
		$pos = rand(0, $text_size);
		$text_array[$pos] .= ("\r\r" . wpas_image_embed($img) . "\r\r");
	    }
	    $i++;
	}
    }

    if (!empty($videos)){
 	$text_size = count($text_array) - 1;
	$videos_cleaned = str_replace("\n", "\r", $videos);
	$video_array = array_filter(explode("\r", $videos_cleaned));
	shuffle($video_array);
	$video_size = count($video_array);
	$max_vid = ($max_videos > $video_size ? $video_size : $max_videos);
	$rand_vid_max = rand(0, $max_vid);
	$i = 1;
	foreach ($video_array as $vid){
	    if ($i <= $rand_vid_max){
		$pos = rand(0, $text_size);
		$text_array[$pos] .= ("\r\r" . wpas_youtube_embed($vid) . "\r\r");
	    }
	    $i++;
	}
    }

    $implode_text = implode("\r", $text_array);
    $text1 = str_replace("\r\r\r\r", "\r\r", $implode_text);
    $text2 = str_replace("\r\r\r", "\r\r", $text1);
    $final_text = str_replace("\r\r\r", "\r\r", $text2);
    return $final_text;
}

function starts_with($full_str, $str){
    return !strncmp($full_str, $str, strlen($str));
}

function ends_with($full_str, $str){
    $length = strlen($str);
    if ($length == 0) {
        return true;
    }

    return (substr($full_str, -$length) === $str);
}

function wpas_categories_to_string($array){
    $string = "";
    foreach ($array as $item){
	if (!empty($string)) { $string .= ","; }
	$string .= $item["description"];
    }
    return $string;
}

function wpas_categories_to_select($string){
    $array = explode(",", $string);
    echo '<select name="wpas_blog_category">';
    foreach ($array as $category){
	echo '<option value="' . $category . '">' . $category . '</option>';
    }
    echo '</select>';
}

function wpas_encrypt($string){
    $key = get_option("wpas_key");
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
    return $encrypted;
}

function wpas_decrypt($string){
    $key = get_option("wpas_key");
    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    return $decrypted;
}

function wpas_spin_anchor($keywords, $urls){
    $keywords_clean = str_replace("\n", "\r", $keywords);
    $keywords_array = array_filter(explode("\r", $keywords_clean));
    $urls_clean = str_replace("\n", "\r", $urls);
    $urls_array = array_filter(explode("\r", $urls_clean));

    $keywords_spintax = implode("|", $keywords_array);
    $keywords_final = "{" . $keywords_spintax . "}";
    $urls_spintax = implode("|", $urls_array);
    $urls_final = "{" . $urls_spintax . "}";

    $spun_anchor = '<a href="' . $urls_final . '">' . $keywords_final . '</a>';
    return stripslashes_deep($spun_anchor);
}

function wpas_commas($string){
  $str = str_replace("\r", ",", $string);
  return $str;
}
?>
