<?php

	add_action('wp_enqueue_scripts','assets_data');
	function assets_data(){
		wp_deregister_style('wp-block-library');
		wp_deregister_style('wp-block-library-theme');
		wp_deregister_style('global-styles');
		wp_deregister_style('classic-theme-styles');
		wp_deregister_style('wc-block-editor');
		wp_deregister_style('wc-block-style');
		
		wp_deregister_script('wp-embed');
		wp_deregister_script('jquery');
		wp_deregister_script('comment-reply');
		
		wp_enqueue_script('jquery',THEME.'/js/jquery.min.js',false,'3.7.1',true);
		if(is_page(563)) wp_enqueue_script('datatables',THEME.'/js/datatables.min.js',array('jquery'),'2.3.7',true);
		wp_enqueue_script('tiny',THEME.'/js/tiny-slider.min.js',array('jquery'),'2.9.4',true);
		wp_enqueue_script('fancybox',THEME.'/js/jquery.fancybox.min.js',array('jquery'),'6.1.9',true);
		wp_enqueue_script('mask',THEME.'/js/jquery.mask.min.js',array('jquery'),'1.14.16',true);
		if(is_singular('clinic') || is_front_page() || is_page(28))
			wp_enqueue_script('yandex_maps','https://api-maps.yandex.ru/2.1/?apikey=bd3895f9-fb64-4b39-aadf-0536989b6183&lang=ru_RU',array('jquery'),null,true);
		wp_enqueue_script('site',THEME.'/js/site.js',array('jquery'),'2.1',true);
		
		if(is_page(563)) wp_enqueue_style('datatables',THEME.'/css/datatables.min.css',array(),'2.3.7','all');
		wp_enqueue_style('tiny',THEME.'/css/tiny-slider.min.css',array(),'2.9.4','all');
		wp_enqueue_style('fancybox',THEME.'/css/jquery.fancybox.min.css',array(),'6.1.9','all');
		wp_enqueue_style('site',THEME.'/style.css',array(),VERSION,'all');
	}

	add_filter('site_transient_update_plugins','filter_plugin_updates');
	function filter_plugin_updates($value){
		unset($value->response['all-in-one-seo-pack/all_in_one_seo_pack.php']);
		return $value;
	}
	
	add_filter('the_content','fancybox_activate');
	function fancybox_activate($content){
		$pattern="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
		$replacement='<a$1href=$2$3.$4$5 data-fancybox="content" $6>';
		$content=preg_replace($pattern,$replacement,$content);
		return $content;
	}
	
	add_filter('document_title_parts','document_title_parts');
	function document_title_parts($parts){
		if(isset($parts['site'])) unset($parts['site']);
		return $parts;
	}
	
	add_action('login_head','admin_logo');
	function admin_logo(){
		echo '<style type="text/css">body #login h1 a{background-image:url("'.IMG_LOGO.'");height:40px;width:100%;background-size:auto 40px}</style>';
	};
	
	add_action('admin_head','admin_head');
	function admin_head(){
		echo '<style type="text/css">#edittag{max-width:100%;}#edittag .form-field.term-description-wrap,.aioseop-preview-wrapper,#aiosp_snippet_wrapper,#aiosp_upgrade_wrapper,#aiosp_sitemap_priority_wrapper,#aiosp_sitemap_frequency_wrapper,#aiosp_custom_link_wrapper,#aiosp_description_wrapper .aioseop_count_chars_past_treshold,#aiosp_title_wrapper .aioseop_count_chars_below_treshold,#aiosp_title_wrapper .aioseop_count_chars_past_treshold,#aiosp_description_wrapper .aioseop_count_chars_near_treshold,#aiosp_description_wrapper .aioseop_count_chars_below_treshold{display:none!important}#aiosp_description_wrapper .aioseop_option_div,#aiosp_title_wrapper .aioseop_option_div{font-size:0}.acf-field.acf-field-message{font-size:20px;border-bottom:1px solid #3c434a!important;padding-bottom:0}.acf-fields>.acf-tab-wrap .acf-tab-group{margin-bottom:0px}</style>';
	}
	
	add_action('template_redirect','template_redirect');
	function template_redirect(){
		if((is_post_type_archive() || is_category(1) || is_attachment())){
			wp_redirect('/',301); exit;
		}
	}
	
	add_action('init','reg_post_clinic');
	function reg_post_clinic(){
		$labels=array(
			'name'=>'Клиники','singular_name'=>'Клиника','add_new'=>'Добавить клинику','add_new_item'=>'Добавить новую клинику','edit_item'=>'Редактировать клинику','new_item'=>'Новая клиника','view_item'=>'Посмотреть клинику','search_items'=>'Найти клинику','not_found'=>'Клиники не найдены','not_found_in_trash'=>'В корзине клиники не найдены','parent_item_colon'=>'','menu_name'=>'Клиники'
		);
		$args=array(
			'labels'=>$labels,'public'=>true,'publicly_queryable'=>true,'show_ui'=>true,'show_in_menu'=>true,'query_var'=>true,'rewrite'=>true,'capability_type'=>'post','has_archive'=>true,'hierarchical'=>false,'menu_position'=>20,'supports'=>array('title','editor','revisions'),'menu_icon'=>'dashicons-location-alt'
		);
		register_post_type('clinic',$args);
	}
	
	add_action('init','reg_post_doctor');
	function reg_post_doctor(){
		$labels=array(
			'name'=>'Специалисты','singular_name'=>'Специалист','add_new'=>'Добавить специалиста','add_new_item'=>'Добавить нового специалиста','edit_item'=>'Редактировать специалиста','new_item'=>'Новый специалист','view_item'=>'Посмотреть специалиста','search_items'=>'Найти специалиста','not_found'=>'Специалисты не найдены','not_found_in_trash'=>'В корзине специалисты не найдены','parent_item_colon'=>'','menu_name'=>'Специалисты'
		);
		$args=array(
			'labels'=>$labels,'public'=>true,'publicly_queryable'=>true,'show_ui'=>true,'show_in_menu'=>true,'query_var'=>true,'rewrite'=>true,'capability_type'=>'post','has_archive'=>true,'hierarchical'=>false,'menu_position'=>20,'supports'=>array('title','editor','thumbnail','revisions'),'menu_icon'=>'dashicons-groups'
		);
		register_post_type('doctor',$args);
	}
	
	add_filter('manage_doctor_posts_columns','add_views_column_doctor',4);
	function add_views_column_doctor($columns){
		$out=array();
		foreach($columns as $col => $name){
			$out[$col]=$name;
			if('title'===$col)
				$out['doctor_clinics']='Работает в клинике';
		}
		return $out;
	}
	
	add_action('manage_doctor_posts_custom_column','fill_views_column_doctor',5,2);
	function fill_views_column_doctor($colname,$post_id){
		if($colname==='doctor_clinics'){
			$data_field='';
			foreach(get_field('doctor_clinics',$post_id) as $sc_item)
				$data_field.=$sc_item->post_title.'<br />';
			if(!empty($data_field)) echo mb_substr($data_field,0,-6);
		}
	}
	
	add_action('init','reg_post_service');
	function reg_post_service(){
		$labels=array(
			'name'=>'Услуги','singular_name'=>'Услуга','add_new'=>'Добавить услугу','add_new_item'=>'Добавить новую услугу','edit_item'=>'Редактировать услугу','new_item'=>'Новая услуга','view_item'=>'Посмотреть услугу','search_items'=>'Найти услугу','not_found'=>'Услуги не найдены','not_found_in_trash'=>'В корзине услуги не найдены','parent_item_colon'=>'','menu_name'=>'Услуги'
		);
		$args=array(
			'labels'=>$labels,'public'=>false,'publicly_queryable'=>true,'show_ui'=>true,'show_in_menu'=>true,'query_var'=>true,'rewrite'=>true,'capability_type'=>'post','has_archive'=>true,'hierarchical'=>false,'menu_position'=>20,'supports'=>array('title','editor','revisions'),'menu_icon'=>'dashicons-cart'
		);
		register_post_type('service',$args);
	}
	
	add_filter('manage_service_posts_columns','add_views_column_service',4);
	function add_views_column_service($columns){
		$out=array();
		foreach($columns as $col => $name){
			$out[$col]=$name;
			if('title'===$col){
				$out['service_price']='Стоимость услуги';
				$out['service_clinics']='Клиники';
			}
		}
		return $out;
	}
	
	add_action('manage_service_posts_custom_column','fill_views_column_service',5,2);
	function fill_views_column_service($colname,$post_id){
		if($colname==='service_price') echo get_field('service_price',$post_id);
		if($colname==='service_clinics'){
			$data_field='';
			foreach(get_field('service_clinics',$post_id) as $sc_item)
				$data_field.=$sc_item->post_title.'<br />';
			if(!empty($data_field)) echo mb_substr($data_field,0,-6);
		}
	}
	
	add_action('init','reg_post_sale');
	function reg_post_sale(){
		$labels=array(
			'name'=>'Акции','singular_name'=>'Акция','add_new'=>'Добавить акцию','add_new_item'=>'Добавить новую акцию','edit_item'=>'Редактировать акцию','new_item'=>'Новая акция','view_item'=>'Посмотреть акцию','search_items'=>'Найти акцию','not_found'=>'Акции не найдены','not_found_in_trash'=>'В корзине акции не найдены','parent_item_colon'=>'','menu_name'=>'Акции'
		);
		$args=array(
			'labels'=>$labels,'public'=>true,'publicly_queryable'=>true,'show_ui'=>true,'show_in_menu'=>true,'query_var'=>true,'rewrite'=>true,'capability_type'=>'post','has_archive'=>true,'hierarchical'=>false,'menu_position'=>20,'supports'=>array('title','editor','revisions'),'menu_icon'=>'dashicons-megaphone'
		);
		register_post_type('sale',$args);
	}
	
	add_filter('manage_sale_posts_columns','add_views_column_sale',4);
	function add_views_column_sale($columns){
		$out=array();
		foreach($columns as $col => $name){
			$out[$col]=$name;
			if('title'===$col){
				$out['sale_end']='Действует до';
				$out['sale_clinics']='Действует в клиниках';
			}
		}
		return $out;
	}
	
	add_action('manage_sale_posts_custom_column','fill_views_column_sale',5,2);
	function fill_views_column_sale($colname,$post_id){
		if($colname==='sale_end') echo date('d.m.Y',strtotime(get_field('sale_end',$post_id)));
		if($colname==='sale_clinics'){
			if(get_field('sale_status',$post_id)==false){
				$data_field='';
				foreach(get_field('sale_clinics',$post_id) as $sc_item)
					$data_field.=$sc_item->post_title.'<br />';
				if(!empty($data_field)) echo mb_substr($data_field,0,-6);
			} else echo 'Для всех';
		}
	}
	
	add_action('init','disabled_sale_end');
	function disabled_sale_end(){
		if(get_option('disabled_sale')!=date('j')){
			$tx_posts=get_posts(array(
				'post_type' => 'sale',
				'nopaging' => true,
				'meta_query' => array(
					array('key' => 'sale_end'),
					array('key' => 'sale_end','value' => date('Ymd'),'compare' => '<','type' => 'DATE')
				)
			));
			if(!empty($tx_posts))
				foreach($tx_posts as $tx_post)
					wp_update_post(array('ID' => $tx_post->ID,'post_status' => 'draft'));
			update_option('disabled_sale',date('j'));
		}
	}
	
	add_action('kama_breadcrumbs_home_after','add_tax_custom',10,5);
	function add_tax_custom($false,$linkpatt,$sep,$ptype,$q_obj){
		if(!is_search()){
			$data_taxs=array(
				'clinic' => 22,
				'doctor' => 24,
				'sale' => 67
			);
			foreach($data_taxs as $post_type => $id_page){
				if(isset($ptype->name) && $ptype->name==$post_type){
					$page=get_post($id_page);
					if($q_obj->name==$post_type)
						return $home_after=sprintf($linkpatt,get_permalink($page),$page->post_title); 
					else
						return $home_after=sprintf($linkpatt,get_permalink($page),$page->post_title).$sep;
				}
			}
		}
	}
	
	add_shortcode('acf_gal','gallery_post');
	function gallery_post($atts){
	$acf_gal=get_field('acf_gal',get_queried_object());
		if(!empty($acf_gal))
			foreach($acf_gal as $item)
				if($item['name_gal']==$atts['name']){
				$ret_gal='';
					foreach($item['img_gal'] as $foto_single)
						$ret_gal.='<a href="'.$foto_single['url'].'" data-fancybox="gallery_'.$item['name_gal'].'" data-caption="'.$foto_single['alt'].'"><img src="'.$foto_single['sizes'][$item['view_gal']].'" alt="'.$foto_single['alt'].'" /></a>';
				return '<div class="acf_gal clr">'.$ret_gal.'</div>';
		}
	}
	
	add_action('phpmailer_init', 'custom_wp_mailer_dkim_setup');
	function custom_wp_mailer_dkim_setup($phpmailer) {
		$phpmailer->Sender = 'wordpress@olimp-sozvezdie.ru';
		$phpmailer->DKIM_domain = parse_url(site_url(), PHP_URL_HOST);
		$phpmailer->DKIM_selector = '1787130069.sozvezdie';
		$phpmailer->DKIM_private = get_stylesheet_directory() . '/dkim.php';
		$phpmailer->DKIM_passphrase = '';
		$phpmailer->DKIM_identity = $phpmailer->From;
	}
?>