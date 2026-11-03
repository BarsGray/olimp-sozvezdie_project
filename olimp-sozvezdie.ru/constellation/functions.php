<?php

	require_once('inc/svg.php');
	require_once('inc/settings.php');
	require_once('inc/breadcrumbs.php');
	require_once('inc/functions_base.php');
	require_once('inc/functions_custom.php');
	
	function view_clinics($tx_posts,$slider=false,$mini=false){
		if(!empty($tx_posts)){
			$slider=$slider==true ? ' tns' : '';
			$mini=$mini==true ? ' mini' : '';
			echo '<div class="clinics'.$slider.$mini.'">';
				foreach($tx_posts as $tx_post){
					$clinic_img=get_field('clinic_img',$tx_post);
					$clinic_img_src=!empty($clinic_img) ? $clinic_img['sizes']['img_clinic'] : NO_IMG_CLINIC;
					$clinic_adr=get_field('clinic_adr',$tx_post);
					?>
					<div class="item" style="background-image:url('<?php echo $clinic_img_src; ?>')">
						<div class="item_data">
							<p class="item_name"><a href="<?php the_permalink($tx_post); ?>"><?php echo $tx_post->post_title; ?></a></p>
							<?php
							if(!empty($clinic_adr))
								echo '<p class="item_adr">'.$clinic_adr.'</p>';
							?>
							<a href="<?php the_permalink($tx_post); ?>" class="more"></a>
						</div>
					</div>
					<?php
				}
			echo '</div>';
		}
	}
	
	function view_doctors($tx_posts,$slider=false){
		if(!empty($tx_posts)){
			$slider=$slider==true ? ' tns' : '';
			echo '<div class="doctors'.$slider.'">';
				foreach($tx_posts as $tx_post){
					$doctor_avatar=has_post_thumbnail($tx_post) ? get_the_post_thumbnail_url($tx_post,'medium') : NO_IMG_300x300;
					?>
					<div class="item">
						<a href="<?php the_permalink($tx_post); ?>" class="item_avatar">
							<img src="<?php echo $doctor_avatar; ?>" alt="<?php echo $tx_post->post_title; ?>" />
						</a>
						<a href="<?php the_permalink($tx_post); ?>" class="item_name"><?php echo $tx_post->post_title; ?></a>
						<p class="item_position"><?php the_field('doctor_position',$tx_post); ?></p>
						<a href="<?php the_permalink($tx_post); ?>" class="more">Подробнее</a>
					</div>
					<?php
				}
			echo '</div>';
		}
	}
	
	function view_sales($tx_posts,$slider=false){
		if(!empty($tx_posts)){
			$slider=$slider==true ? ' tns' : '';
			echo '<div class="sales'.$slider.'">';
				foreach($tx_posts as $tx_post){
					$sale_img=get_field('sale_img',$tx_post);
					$sale_img_src=!empty($sale_img) ? $sale_img['sizes']['img_clinic'] : NO_IMG_SALE;
					$sale_end=get_field('sale_end',$tx_post);
					?>
					<div class="item">
						<a href="<?php the_permalink($tx_post); ?>" class="item_img">
							<img src="<?php echo $sale_img_src; ?>" alt="" />
						</a>
						<a href="<?php the_permalink($tx_post); ?>" class="item_name"><?php echo $tx_post->post_title; ?></a>
						<?php
						if(!empty($sale_end))
							echo '<span>до '.wp_date('j F',strtotime($sale_end)).'</span>';
						?>
					</div>
					<?php
				}
			echo '</div>';
		}
	}
	
	function view_services($tx_posts,$slider=false,$class=''){
		if(!empty($tx_posts)){
			global $post;
			$slider=$slider==true ? ' tns' : '';
			$class=!empty($class) ? ' '.$class : '';
			echo '<div class="services'.$slider.$class.'">';
				foreach($tx_posts as $tx_post){
					$service_img=get_field('service_img',$tx_post);
					$service_img_src=!empty($service_img) ? $service_img['sizes']['img_clinic'] : NO_IMG_CLINIC;
					$service_help=get_field('service_help',$tx_post);
					$service_price=get_field('service_price',$tx_post);
					?>
					<div class="item" style="background-image:url('<?php echo $service_img_src; ?>')">
						<div class="item_data">
							<p class="item_name"><a href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться - <?php echo $post->post_title; ?> - <?php echo $tx_post->post_title; ?>"><?php echo $tx_post->post_title; ?></a></p>
							<?php
								if(!empty($service_help))
									echo '<p class="item_help">'.$service_help.'</p>';
							?>
							<a class="more" href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться - <?php echo $post->post_title; ?> - <?php echo $tx_post->post_title; ?>">Записаться</a>
						</div>
						<?php
							if(!empty($service_price))
								echo '<p class="item_price">'.$service_price.'</p>';
							if(!empty($tx_post->post_content))
								echo '<a href="javascript:;" data-fancybox="" data-src="#service_description_'.$tx_post->ID.'" class="item_description">i</a><div class="service_description text" id="service_description_'.$tx_post->ID.'"><div class="fix">'.fc($tx_post->post_content).'</div></div>';
						?>
					</div>
					<?php
				}
			echo '</div>';
		}
	}
	
	function view_services_list($tx_posts){
		if(!empty($tx_posts)){
			global $post;
			echo '<div class="services_list">';
				foreach($tx_posts as $tx_post){
					$service_help=get_field('service_help',$tx_post);
					$service_price=get_field('service_price',$tx_post);
					?>
					<div class="item">
						<div class="item_data">
							<p class="item_name"><?php echo $tx_post->post_title; ?></p>
							<?php
								if(!empty($service_help))
									echo '<p class="item_help">'.$service_help.'</p>';
							?>
						</div>
						<div class="item_info">
							<?php
								if(!empty($service_price))
									echo '<p class="item_price">'.$service_price.'</p>';
							?>
							<a class="more" href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться - <?php echo $post->post_title; ?> - <?php echo $tx_post->post_title; ?>">Записаться</a>
						</div>
					</div>
					<?php
				}
			echo '</div>';
		}
	}
	
	function view_services_list_all($tx_posts){
		if(!empty($tx_posts)){
			global $post;
			echo '<div class="services_list_all">';
				foreach($tx_posts as $tx_post){
					$service_img=get_field('service_img',$tx_post);
					$service_img_src=!empty($service_img) ? $service_img['sizes']['thumbnail'] : NO_IMG_300x300;
					$service_help=get_field('service_help',$tx_post);
					$service_price=get_field('service_price',$tx_post);
					?>
					<div class="item">
						<div class="item_data">
							<div class="item_img">
								<img src="<?php echo $service_img_src; ?>" alt="" />
							</div>
							<div class="item_fix">
								<p class="item_name"><?php echo $tx_post->post_title; ?></p>
								<?php
									if(!empty($service_help))
										echo '<p class="item_help">'.$service_help.'</p>';
									if(!empty($tx_post->post_content))
										echo '<div class="item_description text">'.fc($tx_post->post_content).'</div>';
								?>
							</div>
						</div>
						<div class="item_info">
							<?php
								if(!empty($service_price))
									echo '<p class="item_price">'.$service_price.'</p>';
							?>
							<a class="more" href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться - <?php echo $post->post_title; ?> - <?php echo $tx_post->post_title; ?>">Записаться</a>
						</div>
					</div>
					<?php
				}
			echo '</div>';
		}
	}
	
	function view_contacts(){
		$data_clinics=get_posts(array(
			'post_type' => 'clinic',
			'nopaging' => true,
			'meta_query' => array(
				array('key' => 'clinic_coord','value' => '','compare' => '!='),
				array('key' => 'clinic_adr','value' => '','compare' => '!=')
			)
		));
		if(!empty($data_clinics)){
			$data_coords=array();
			?>
				<div class="clinic_tabs">
					<?php
					foreach($data_clinics as $key => $data_clinic){
						$active=$key==0 ? ' class="active"' : '';
						echo '<a href="#"'.$active.'>'.$data_clinic->post_title.'</a>';
					}
					?>
				</div>
			</div>
				<div class="clinic_map all">
					<?php
					foreach($data_clinics as $key => $data_clinic){
						$active=$key==0 ? ' active' : '';
						?>
						<div class="block_data<?php echo $active; ?>">
							<p class="block_title"><?php echo $data_clinic->post_title; ?></p>
							<div class="block_contacts">
								<?php
								if(!empty(get_field('clinic_adr',$data_clinic)))
									echo '<p class="icon adr">'.get_field('clinic_adr',$data_clinic).'</p>';
								echo '<p class="icon tel"><a href="tel:'.clear_tel(get_field('clinic_tel',$data_clinic)).'">'.get_field('clinic_tel',$data_clinic).'</a></p>';
								if(!empty(get_field('clinic_email',$data_clinic)))
									echo '<p class="icon email"><a href="mailto:'.get_field('clinic_email',$data_clinic).'">'.get_field('clinic_email',$data_clinic).'</a></p>';
								if(!empty(get_field('clinic_wt',$data_clinic)))
									echo '<div class="c_item"><span>Время работы:</span><p>'.get_field('clinic_wt',$data_clinic).'</p></div>';
								if(!empty(get_field('clinic_blood',$data_clinic)))
									echo '<div class="c_item"><span>Забор крови:</span><p>'.get_field('clinic_blood',$data_clinic).'</p></div>';
								?>
								<a href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться - <?php echo $data_clinic->post_title; ?>" class="block_more">Записаться</a>
							</div>
						</div>
						<?php
						$data_coords[]=array(
							'name' => $data_clinic->post_title,
							'adr' => get_field('clinic_adr',$data_clinic),
							'coord' => get_field('clinic_coord',$data_clinic),
							'link' => get_permalink($data_clinic)
						);
					}
					?>
					<div class="clinic_map_data" id="clinic_map" data-map="<?php echo htmlspecialchars(json_encode($data_coords)); ?>"></div>
				</div>
			<div class="wr">
			<?php
		}
	}
	
	function view_price(){
		global $wpdb;
		$price_data=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'price WHERE status=1');
		if(!empty($price_data)){
			echo '<table class="price_data"><thead><tr><th>Код</th><th>Наименование</th><th>Длительность</th><th style="text-wrap:nowrap">Стоимость от</th><th></th></tr></thead><tbody>';
			foreach($price_data as $price_item){
				if($price_item->price_4078!=0 && $price_item->price_4078!=1){
					$duration=empty($price_item->duration) || $price_item->duration==1 ? '—' : $price_item->duration.' мин.';
					echo '<tr><td>'.$price_item->print_code.'</td><td>'.$price_item->print_text.'</td><td>'.$duration.'</td><td>'.cost_format($price_item->price_4078).' руб.</td><td><a class="more" href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться - Прайс - '.$price_item->print_text.'">Записаться</a></td></tr>';
				}
			}
			echo '</tbody></table>';
		}
	}
	
?>