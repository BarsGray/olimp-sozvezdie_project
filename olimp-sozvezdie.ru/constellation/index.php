<?php
	/* Template Name:Главная */
	get_header();
	the_post();
?>
	
	<div id="sec_1">
		<div class="wr">
			<div class="sec_data">
				<div class="sec_slider tns">
					<?php
					foreach(get_acf_main('s1_data') as $item){
						?>
						<div class="item">
							<div class="block_data">
								<p class="sec_title"><?php echo $item['s1_data_title']; ?></p>
								<p class="sec_description"><?php echo $item['s1_data_description']; ?></p>
								<div class="sec_btns">
									<a href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться (шапка)">Записаться на прием</a>
									<?php /* <a href="<?php the_permalink(96); ?>">Вызвать врача на дом</a> */ ?>
									<script defer src="https://booking.olimp-medgroup.ru//b.js?animate=true&button=0&text=%D0%97%D0%B0%D0%BF%D0%B8%D1%81%D0%B0%D1%82%D1%8C%D1%81%D1%8F+%D0%BE%D0%BD%D0%BB%D0%B0%D0%B9%D0%BD&position=br&verticalPadding=32&horizontalPadding=32&url=%2F%3Fclinics%255B%255D%3D25904%26city%3D368"></script>
								</div>
							</div>
							<div class="sec_back">
								<img src="<?php echo $item['s1_data_img']['url']; ?>" alt="" />
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	
	<div id="sec_2">
		<div class="wr">
			<div class="sec_data_top">
				<div class="left_block">
					<p class="sec_subtitle"><?php acf_main('s2_company'); ?></p>
				</div>
				<div class="right_block">
					<p class="sec_title"><?php acf_main('s2_title'); ?></p>
					<div class="sec_description">
						<p><?php acf_main('s2_description_left'); ?></p>
						<p><?php acf_main('s2_description_right'); ?></p>
					</div>
				</div>
			</div>
			<div class="sec_data_bottom">
				<div class="block_slider tns">
					<?php
					foreach(get_acf_main('s2_data') as $item)
						printf(
							'<div class="bs_item"><span>%s</span><p>%s</p></div>',
							$item['s2_data_number'],$item['s2_data_name']
						);
					?>
				</div>
				<a href="<?php the_permalink(22); ?>" class="more_block">Подробнее о клиниках</a>
			</div>
		</div>
	</div>
	
	<div id="sec_3">
		<div class="wr">
			<p class="sec_subtitle">Созвездие Олимпа</p>
			<p class="sec_title">Наши клиники</p>
			<?php
				$tx_posts=get_posts(array(
					'post_type' => 'clinic',
					'nopaging' => true
				));
				view_clinics($tx_posts,true);
			?>
		</div>
	</div>
	
	<div id="sec_4">
		<div class="wr">
			<div class="sec_data">
				<div class="left_block">
					<p class="sec_subtitle">Услуги</p>
					<p class="sec_title"><?php acf_main('s4_title'); ?></p>
					<p class="sec_description"><?php acf_main('s4_description'); ?></p>
					<a href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться (услуги)" class="feedback">Записаться</a>
				</div>
				<div class="right_block">
					<div class="block_data">
						<?php
						$final_services=array();
						$all_clinics=get_posts(array(
							'post_type' => 'clinic',
							'nopaging' => true
						));
						foreach($all_clinics as $all_clinic)
							$final_services[$all_clinic->ID]=array(
								'name' => $all_clinic->post_title,
								'adr' => get_field('clinic_adr',$all_clinic),
								'services' => array()
							);
						$all_services=get_posts(array(
							'post_type' => 'service',
							'nopaging' => true
						));
						foreach($all_services as $all_service)
							foreach(get_field('service_clinics',$all_service) as $item_c)
								$final_services[$item_c->ID]['services'][]=array(
									'name' => $all_service->post_title,
									'help' => get_field('service_help',$all_service),
									'price' => get_field('service_price',$all_service)
								);
						foreach($final_services as $final_service){
							if(!empty($final_service['services'])){
								?>
								<div class="bd_item">
									<p>
										<?php
											echo $final_service['name'];
											if(!empty($final_service['adr'])) echo '<span>'.$final_service['adr'].'</span>';
										?>
									</p>
									<div class="bd_item_data">
										<?php
										foreach($final_service['services'] as $item_f)
											printf(
												'<div class="bd_item_price"><p class="bd_item_left">%s%s</p><p class="bd_item_right">%s</p></div>',
												$item_f['name'],
												!empty($item_f['help']) ? '<span>'.$item_f['help'].'</span>' : '',
												$item_f['price']
											);
										?>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
					<?php
					if(!empty(get_field('patients_documents',26)))
						echo '<a href="'.get_field('patients_documents',26)[0]['patients_document_file']['url'].'" target="_blank" class="block_more">Ознакомиться с полным прайсом на услуги</a>';
					?>
				</div>
			</div>
		</div>
	</div>
	
	<div id="sec_5">
		<div class="wr">
			<p class="sec_subtitle">Специалисты</p>
			<p class="sec_title">Познакомьтесь с <span>нашей командой</span></p>
			<?php
				$tx_posts=query_posts(array(
					'post_type' => 'doctor',
					'orderby' => 'rand',
					'numberposts' => 12
				));
				view_doctors($tx_posts,true);
			?>
			<a href="<?php the_permalink(24); ?>" class="more_block">Все специалисты</a>
		</div>
	</div>
	
	<div id="sec_6">
		<div class="wr">
			<div class="sec_data">
				<div class="left_block">
					<div class="block_avatar">
						<img src="<?php echo get_acf_main('s6_avatar')['sizes']['medium']; ?>" alt="" />
					</div>
					<p class="block_name"><?php acf_main('s6_name'); ?></p>
					<p class="block_position"><?php acf_main('s6_position'); ?></p>
				</div>
				<div class="right_block">
					<p class="sec_subtitle">Обратная связь</p>
					<p class="sec_title">У вас есть <span>вопросы или пожелания?</span></p>
					<p class="sec_description"><?php acf_main('s6_description'); ?></p>
					<a href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Написать" data-btn="Написать директору" class="block_more">Написать</a>
				</div>
			</div>
		</div>
	</div>
	
	<?php
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
		<div id="sec_7">
			<div class="wr">
				<div class="sec_data">
					<p class="sec_title">Контакты</p>
					<p class="sec_hint"><a href="<?php the_permalink(22); ?>">Все филиалы</a></p>
					<div class="block_contacts">
						<?php
						foreach($data_clinics as $data_clinic){
							?>
							<div class="bc_item">
								<p><?php echo $data_clinic->post_title; ?></p>
								<div>
									<p class="bc_item_adr"><?php the_field('clinic_adr',$data_clinic); ?></p>
									<p class="bc_item_tel"><a href="tel:<?php echo clear_tel(get_field('clinic_tel',$data_clinic)); ?>"><?php the_field('clinic_tel',$data_clinic); ?></a></p>
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
					</div>
				</div>
			</div>
			<div class="sec_map" id="sec_7_map" data-map="<?php echo htmlspecialchars(json_encode($data_coords)); ?>"></div>
		</div>
		<?php
	}
	?>
	
	<?php
		if(!empty(get_the_content())){
			?>
			<div id="sec_8">
				<div class="wr text clr">
					<?php the_content(); ?>
				</div>
			</div>
			<?php
		}
	?>

<?php get_footer(); ?>