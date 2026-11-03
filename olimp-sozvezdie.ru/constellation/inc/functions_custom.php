<?php
	
	function get_acf_main($field){
		return get_field($field,MAIN_PAGE);
	}
	
	function acf_main($field){
		echo get_acf_main($field);
	}
	
	function fc($text){
		return apply_filters('the_content',$text);
	}
	
	function clear_tel($tel){
		if(substr($tel,0,1)=='8') $tel='+7'.substr($tel,1);
		return strip_tags(str_replace(array(' ','(',')','-'),'',$tel));
	}
	
	function social(){
		$soc_html='';
		$socials=array('tg' => 'Telegram','wa' => 'WhatsApp','vk' => 'VK');
		foreach($socials as $soc => $soc_name)
			if(!empty(get_acf_main($soc)))
				$soc_html.='<p class="'.$soc.'"><a rel="nofollow" target="_blank" href="'.get_acf_main($soc).'">'.$soc_name.'</a></p>';
		if(!empty($soc_html))
			echo '<div class="item social"><span>Социальные сети:</span>'.$soc_html.'</div>';
	}
	
	function post_title(){
		global $post;
		$post_title=get_field('alt_title',$post)!='' ? get_field('alt_title',$post) : get_the_title($post);
		echo '<h1>'.$post_title.'</h1>';
	}
	
	function cat_title(){
		$qo=get_queried_object();
		$cat_title=get_field('alt_title',$qo)!='' ? get_field('alt_title',$qo) : $qo->name;
		echo '<h1>'.$cat_title.'</h1>';
	}
	
	function exp_text($text_old,$max_char){
		$text_old=strip_shortcodes($text_old);
		$text_old=preg_replace('~\[[^\]]+\]~','',$text_old);
		$text_old=strip_tags($text_old);
		
		if(iconv_strlen($text_old,'utf-8') < $max_char)
			return $text_old;
		else {
			$text_new=iconv_substr($text_old,0,$max_char,'utf-8');
			$text_new=preg_replace('@(.*)\s[^\s]*$@s','\\1 ...',$text_new);
			return $text_new;
		}
	}
	
	function declension($digit,$expr,$onlyword=false){
        if(!is_array($expr)) $expr=array_filter(explode(' ', $expr));
        if(empty($expr[2])) $expr[2]=$expr[1];
        $i= preg_replace('/[^0-9]+/s','',$digit) % 100;
        if($onlyword) $digit='';
        if($i>=5 && $i<=20) $res=$expr[2];
        else {
            $i%=10;
            if($i==1) $res=$expr[0];
            elseif($i>=2 && $i<=4) $res=$expr[1];
            else $res=$expr[2];
        }
        return trim($res);
    }
	
	function cf7_modal($id=null,$name=null,$title=null){
		if(!empty($id) && !empty($name) && !empty($title)){
			echo '<div class="modal_form" id="'.$name.'"><p class="title">'.$title.'</p>'.do_shortcode('[contact-form-7 id="'.$id.'"]').'</div>';
		}
	}
	
	function cost_format($price){
		return number_format($price,0,'.',' ');
	}
	
?>