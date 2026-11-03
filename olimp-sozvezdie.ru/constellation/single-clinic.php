<?php
	get_header();
	the_post();
	$acf_fields=get_fields();
	global $post;
?>

	<div id="content">
		<div class="wr text clr">
			<?php
				bread_crumbs();
				post_title();
				the_content();
			?>
		</div>
		<div class="clinic_data">
			<div class="wr clr">
				<?php
					if(!empty($acf_fields['clinic_banner'])){
						echo '<div class="clinic_sales_imgs"><div class="block_slider tns">';
							foreach($acf_fields['clinic_banner'] as $item)
								printf(
									'<div class="item"><a href="%s"><img src="%s" alt="" /><img src="%s" alt="" /></a></div>',
									!empty($item['clinic_banner_link']) ? get_permalink($item['clinic_banner_link']) : '#',
									$item['clinic_banner_pc']['url'],
									$item['clinic_banner_mobile']['url']
								);
						echo '</div></div>';
					}
				?>
				
				<?php
				if($acf_fields['clinic_text_status']==true){
					?>
					<div class="clinic_text">	
						<div class="left_block">
							<p class="clinic_title"><?php echo $acf_fields['clinic_text_title']; ?></p>
						</div>
						<div class="right_block">
							<div class="block_text text"><?php echo fc($acf_fields['clinic_text_data']); ?></div>
							<a href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться (клиника)"><?php echo is_single(96) ? 'Вызвать врача' : 'Записаться'; ?></a>
						</div>
					</div>
					<?php
				}
				?>
				
				<?php
				if(is_single(96)){
					?>
					<div class="clinic_map single">
						<div class="block_data">
							<p class="block_title"><?php echo $post->post_title; ?></p>
							<div class="block_contacts">
								<?php
								if(!empty($acf_fields['clinic_adr']))
									echo '<p class="icon adr">'.$acf_fields['clinic_adr'].'</p>';
								echo '<p class="icon tel"><a href="tel:'.clear_tel($acf_fields['clinic_tel']).'">'.$acf_fields['clinic_tel'].'</a></p>';
								if(!empty($acf_fields['clinic_email']))
									echo '<p class="icon email"><a href="mailto:'.$acf_fields['clinic_email'].'">'.$acf_fields['clinic_email'].'</a></p>';
								if(!empty($acf_fields['clinic_wt']))
									echo '<div class="c_item"><span>Время работы:</span><p>'.$acf_fields['clinic_wt'].'</p></div>';
								if(!empty($acf_fields['clinic_blood']))
									echo '<div class="c_item"><span>Забор крови:</span><p>'.$acf_fields['clinic_blood'].'</p></div>';
								?>
								<a href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться - <?php echo $post->post_title; ?>" class="block_more">Записаться</a>
							</div>
						</div>
						<?php
						if(!empty($acf_fields['clinic_coord'])){
							$data_coords=array(
								'name' => $post->post_title,
								'adr' => $acf_fields['clinic_adr'],
								'coord' => $acf_fields['clinic_coord']
							);
							echo '<div class="clinic_map_data" id="clinic_map" data-map="'.htmlspecialchars(json_encode($data_coords)).'"></div>';
						}
						?>
					</div>
					<?php
				}
				?>
				
				<?php
					$clinic_services=array();
					$all_services=get_posts(array(
						'post_type' => 'service',
						'nopaging' => true,
						'meta_query' => array(
							'relation' => 'OR',
							array('key' => 'service_visible_clinic','value' => 0),
							array('key' => 'service_visible_clinic','compare' => 'NOT EXISTS')
						)
					));
					foreach($all_services as $all_service)
						foreach(get_field('service_clinics',$all_service) as $item_s)
							if($item_s->ID==$post->ID) $clinic_services[]=$all_service;
					if(!empty($clinic_services)){
						$clinic_services_title=!empty($acf_fields['clinic_services_title']) ? $acf_fields['clinic_services_title'] : 'Услуги';
						echo '<div class="clinic_services"><p class="clinic_title">'.$clinic_services_title.'</p>';
							if($acf_fields['clinic_services_style']=='list') view_services_list($clinic_services);
							elseif($acf_fields['clinic_services_style']=='list_all') view_services_list_all($clinic_services);
							else view_services($clinic_services,false,'col_5');
						if(!empty($acf_fields['clinic_services_description']))
							echo '<div class="block_description text">'.fc($acf_fields['clinic_services_description']).'</div>';
						echo '</div>';
					}
				?>
				
				<?php
					if(is_single(96)){
						echo '<div class="clinic_result"><p class="clinic_title">Возможность получения <span>исследований</span></p><div class="block_data">';
							echo '<div class="item"><img src="'.THEME.'/img/clinic_result_1.svg" alt="" /><p><a href="https://lk.olimp03.ru/" target="_blank">Личный кабинет</a> пациента</p></div>';
							echo '<div class="item"><img src="'.THEME.'/img/clinic_result_2.svg" alt="" /><p>При посещении клиники «Созвездие Олимпа»</p></div>';
						echo '</div></div>';
					}
				?>
				
				<?php
					if(!empty($acf_fields['clinic_advantage_title'])){
						echo '<div class="clinic_advantages"><p class="clinic_title">'.$acf_fields['clinic_advantage_title'].'</p><div class="block_slider">';
						foreach($acf_fields['clinic_advantages'] as $key => $item)
							printf(
								'<div class="item"><span>%s</span><p>%s</p></div>',
								// $key>8 ? $key+1 : '0'.$key+1,
								'&#10004;',
								$item['clinic_advantage_data']
							);
						echo '</div></div>';
					}
				?>
				
				<?php
					if(!empty($acf_fields['clinic_rules_title'])){
						echo '<div class="clinic_rules"><p class="clinic_title">'.$acf_fields['clinic_rules_title'].'</p><div class="block_data">';
							foreach($acf_fields['clinic_rules_data'] as $main_item){
								echo '<div class="main_item"><p class="main_title">'.$main_item['clinic_rules_data_cat'].'</p>';
									foreach($main_item['clinic_rules_data_items'] as $item)
										printf(
											'<div class="item"><p>%s</p><div class="text">%s</div></div>',
											$item['clinic_rules_data_item_title'],fc($item['clinic_rules_data_item_text'])
										);
								echo '</div>';
							}
						echo '</div>';
						if(!empty($acf_fields['clinic_rules_note']))
							echo '<div class="block_description text">'.fc($acf_fields['clinic_rules_note']).'</div>';
						echo '</div>';
					}
				?>
				
				<?php
					if(!empty($acf_fields['clinic_rules_no_title'])){
						echo '<div class="clinic_rules_no"><p class="clinic_title">'.$acf_fields['clinic_rules_no_title'].'</p><div class="block_slider">';
						foreach($acf_fields['clinic_rules_no_data'] as $key => $item)
							printf(
								'<div class="item"><span>%s</span><p>%s</p></div>',
								// $key>8 ? $key+1 : '0'.$key+1,
								'&#10006;',
								$item['clinic_rules_no_item']
							);
						echo '</div>';
						if(!empty($acf_fields['clinic_rules_no_note']))
							echo '<div class="block_description text">'.fc($acf_fields['clinic_rules_no_note']).'</div>';
						echo '</div>';
					}
				?>

				<?php
					$clinic_doctors=array();
					$all_doctors=get_posts(array(
						'post_type' => 'doctor',
						'nopaging' => true,
						'orderby' => 'post_title',
						'order' => 'ASC'
					));
					foreach($all_doctors as $all_doctor)
						foreach(get_field('doctor_clinics',$all_doctor) as $item_c)
							if($item_c->ID==$post->ID) $clinic_doctors[]=$all_doctor;
					if(!empty($clinic_doctors)){
						echo '<div class="clinic_doctors"><p class="clinic_title">Познакомьтесь с <span>нашей командой</span></p>';
						view_doctors($clinic_doctors,true);
						echo '</div>';
					}
				?>
				
				<?php
					if(!empty($acf_fields['clinic_videos'])){
						?>
						<div class="clinic_videos">
							<div class="left_block">
								<p class="clinic_title">Видео <span>о клинике</span></p>
								<p class="clinic_description">Мы подготовили ознакомительные видео для наших пациентов, в которых освещаем важные темы, которые касаются здоровья, медицины и многих других тем.</p>
							</div>
							<div class="right_block">
								<div class="block_slider tns">
									<?php
										foreach($acf_fields['clinic_videos'] as $item)
											printf(
												'<a href="%s" data-fancybox="clinic_video" data-type="html5video" data-aspect-ratio="%s" class="item"><img src="%s" alt="" /></a>',
												$item['clinic_video_file']['url'],
												$item['clinic_video_file']['width'].' / '.$item['clinic_video_file']['height'],
												!empty($item['clinic_video_preview']) ? $item['clinic_video_preview']['sizes']['large'] : NO_IMG_VIDEO
											);
									?>
								</div>
							</div>
						</div>
						<?php
					}
				?>
				
				<?php
					$clinic_sales=array();
					$all_sales=get_posts(array(
						'post_type' => 'sale',
						'nopaging' => true
					));
					foreach($all_sales as $all_sale)
						if(get_field('sale_status',$all_sale)==false){
							foreach(get_field('sale_clinics',$all_sale) as $item_s)
								if($item_s->ID==$post->ID) $clinic_sales[]=$all_sale;
						} else $clinic_sales[]=$all_sale;
					if(!empty($clinic_sales)){
						echo '<div class="clinic_sales"><p class="clinic_title">Акции</p>';
						view_sales($clinic_sales,true);
						echo '</div>';
					}
				?>
			</div>
			<div class="clinic_documents">
				<div class="left_block">
					<p class="clinic_title">Наша деятельность <span>подтверждена лицензией</span></p>
				</div>
				<div class="right_block">
					<p>Наши клиники осуществляют свою деятельность на основании Лицензии <?php acf_main('license'); ?>. Со всеми документами вы можете ознакомиться в разделе «Пациентам».</p>
					<a href="<?php the_permalink(26); ?>">Посмотреть документы</a>
				</div>
			</div>
			
			<?php
			if(!is_single(96)){
				?>
				<div class="clinic_map single">
					<div class="block_data">
						<p class="block_title"><?php echo $post->post_title; ?></p>
						<div class="block_contacts">
							<?php
							if(!empty($acf_fields['clinic_adr']))
								echo '<p class="icon adr">'.$acf_fields['clinic_adr'].'</p>';
							echo '<p class="icon tel"><a href="tel:'.clear_tel($acf_fields['clinic_tel']).'">'.$acf_fields['clinic_tel'].'</a></p>';
							if(!empty($acf_fields['clinic_email']))
								echo '<p class="icon email"><a href="mailto:'.$acf_fields['clinic_email'].'">'.$acf_fields['clinic_email'].'</a></p>';
							if(!empty($acf_fields['clinic_wt']))
								echo '<div class="c_item"><span>Время работы:</span><p>'.$acf_fields['clinic_wt'].'</p></div>';
							if(!empty($acf_fields['clinic_blood']))
								echo '<div class="c_item"><span>Забор крови:</span><p>'.$acf_fields['clinic_blood'].'</p></div>';
							?>
							<a href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться - <?php echo $post->post_title; ?>" class="block_more">Записаться</a>
						</div>
					</div>
					<?php
					if(!empty($acf_fields['clinic_coord'])){
						$data_coords=array(
							'name' => $post->post_title,
							'adr' => $acf_fields['clinic_adr'],
							'coord' => $acf_fields['clinic_coord']
						);
						echo '<div class="clinic_map_data" id="clinic_map" data-map="'.htmlspecialchars(json_encode($data_coords)).'"></div>';
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>

<?php get_footer(); ?>