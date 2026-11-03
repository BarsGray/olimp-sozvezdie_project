<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<title><?php echo wp_get_document_title(); ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="<?php echo THEME; ?>/img/favicon.png" type="image/png" />
	<link rel="shortcut icon" href="<?php echo THEME; ?>/img/favicon.png" type="image/png" />
	<meta property="og:image" content="<?php echo IMG_LOGO; ?>" />
	<link rel="manifest" href="<?php echo THEME; ?>/manifest.json">
	<meta name="theme-color" content="#aa2a36">
	<meta name="yandex-verification" content="1a0913a2ab610733" />
	<?php wp_head(); ?>
</head>
<body class="<?php echo is_front_page() ? 'main' : 'inner'; ?>">
	<div class="over"></div>
	<div class="mobile_menu">
		<a href="#" class="close">
			<span></span>
			<span></span>
		</a>
		<a class="bvi" href="#"></a>
		<a class="lk" href="https://lk.olimp03.ru/" target="_blank"></a>
		<?php wp_nav_menu('menu=main_menu&container=false&depth=1&menu_class=main_menu'); ?>
		<div class="info">
			<div class="item">
				<span>Контактный телефон:</span>
				<p><a href="tel:<?php echo clear_tel(get_acf_main('tel')); ?>"><?php acf_main('tel'); ?></a></p>
			</div>
		</div>
		<a href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться (мобильное меню)" class="feedback">Записаться на прием</a>
		<a href="https://olimp-medgroup.ru/" target="blank" class="logo gk">
			<img src="<?php echo THEME; ?>/img/logo_gk.svg" alt="logo" />
		</a>
	</div>
	
	<header>
		<div class="wr">
			<div class="header_data">
				<div class="left_block">
					<a href="/" class="logo">
						<img src="<?php echo IMG_LOGO; ?>" alt="logo" />
					</a>
					<a href="https://olimp-medgroup.ru/" target="blank" class="logo gk">
						<img src="<?php echo THEME; ?>/img/logo_gk.svg" alt="logo" />
					</a>
				</div>
				<div class="right_block">
					<?php wp_nav_menu('menu=main_menu&container=false&depth=1&menu_class=main_menu'); ?>
					<a class="bvi" href="#"></a>
					<a class="lk" href="https://lk.olimp03.ru/" target="_blank"></a>
					<a class="tel" href="tel:<?php echo clear_tel(get_acf_main('tel')); ?>"><?php acf_main('tel'); ?></a>
					<a href="#" class="btn_menu">
						<span></span>
						<span></span>
						<span></span>
					</a>
				</div>
			</div>
		</div>
	</header>