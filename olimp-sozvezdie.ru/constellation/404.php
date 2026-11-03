<?php get_header(); ?>

	<div id="content">
		<div class="wr text clr">
			<?php bread_crumbs(); ?>
			<h1>Страница не найдена</h1>
			<p>Ищете что-то интересное на нашем сайте? К сожалению, страница, которую Вы запрашиваете, не существует...</p>
			<h2>Наши клиники всегда готовы помочь Вам:</h2>
			<?php
				$tx_posts=get_posts(array(
					'post_type' => 'clinic',
					'nopaging' => true
				));
				view_clinics($tx_posts);
			?>
		</div>
	</div>

<?php get_footer(); ?>