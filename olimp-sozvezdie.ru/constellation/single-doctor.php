<?php
	get_header();
	the_post();
	global $post;
	$doctor_avatar=has_post_thumbnail() ? get_the_post_thumbnail_url($post,'medium') : NO_IMG_300x300;
?>

	<div id="content">
		<div class="wr text clr">
			<?php bread_crumbs(); ?>
			<div class="doctor_data">
				<div class="block_top">
					<div class="left_block">
						<div class="avatar">
							<img src="<?php echo $doctor_avatar; ?>" alt="<?php echo $tx_post->post_title; ?>" />
						</div>
						<div class="info">
							<?php post_title(); ?>
							<p class="position"><?php the_field('doctor_position'); ?></p>
							<p class="experience">Стаж работы: <?php echo date('Y')-get_field('doctor_experience'); ?> <?php echo declension(date('Y')-get_field('doctor_experience'),array('год','года','лет')); ?></p>
						</div>
					</div>
					<div class="right_block">
						<p>Вы можете записаться к врачу, позвонив в клинику по номеру ниже или через форму обратной связи</p>
						<div>
							<a href="tel:<?php echo clear_tel(get_acf_main('tel')); ?>" class="tel"><?php acf_main('tel'); ?></a>
							<a href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться (специалист)" class="more">Записаться на прием</a>
						</div>
					</div>
				</div>
				<div class="block_bottom">
					<div class="left_block"><?php the_content(); ?></div>
					<div class="right_block">
						<p>Врач принимает в клинике:</p>
						<?php view_clinics(get_field('doctor_clinics'),true,true); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>