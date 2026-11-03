	<footer>
		<div class="wr">
			<div class="footer_top">
				<div class="left_block">
					<a href="/" class="logo">
						<img src="<?php echo IMG_LOGO_WHITE; ?>" alt="logo" />
					</a>
					<p class="block_link tel"><a href="tel:<?php echo clear_tel(get_acf_main('tel')); ?>"><?php acf_main('tel'); ?></a></p>
					<?php
					if(!empty(get_acf_main('vk')))
						echo '<p class="block_link vk"><a href="'.get_acf_main('vk').'" target="_blank" rel="nofollow">Мы в VK</a></p>';
					if(!empty(get_acf_main('tg')))
						echo '<p class="block_link tg"><a href="'.get_acf_main('tg').'" target="_blank" rel="nofollow">Мы в Telegram</a></p>';
					?>
					<a href="javascript:;" data-fancybox="" data-src="#feedback" data-title="Записаться" data-btn="Записаться (подвал)" class="feedback">Записаться</a>
				</div>
				<div class="center_block">
					<p class="block_title">Меню</p>
					<?php wp_nav_menu('menu=main_menu&container=false&depth=1&menu_class=main_menu'); ?>
				</div>
				<div class="right_block">
					<p>Необходима консультация специалиста. Имеются противопоказания.</p>
					<p>Представленная на сайте информация не может быть использована для постановки диагноза, назначения лечения и не заменяет прием врача.</p>
					<p>Не является публичной офертой. 18+</p>
				</div>
			</div>
			<div class="footer_bottom">
				<div class="left_block">
					<p>&copy; OOO «ОлимпЛаб», <?php echo date('Y'); ?></p>
					<p>ОГРН: <?php acf_main('ogrn'); ?>, ИНН: <?php acf_main('inn'); ?></p>
					<p>Лицензия: <?php acf_main('license'); ?></p>
				</div>
				<div class="center_block">
					<p><a href="<?php echo get_privacy_policy_url(); ?>">Политика конфиденциальности</a></p>
					<p><a href="<?php the_permalink(11); ?>">Политика в отношении обработки персональных данных</a></p>
				</div>
				<div class="right_block">
					<p><a href="https://vzh.ru/?from=<?php echo $_SERVER['HTTP_HOST']; ?>" target="_blank" title="Создание web-сайта - веб-студия Аспект, город Воронеж">Сайт сделан в веб-студии «Аспект»</a></p>
				</div>
			</div>
		</div>
		<?php
		if(!isset($_COOKIE['cookie_info']))
			// echo '<div class="cookie_info"><p>Продолжая использовать наш веб-сайт, вы соглашаетесь на использование файлов cookie в соответствии с нашей <a href="'.get_privacy_policy_url().'" target="_blank">политикой конфиденциальности</a>.</p><a href="#">Хорошо</a></div>';
			echo '<div class="cookie_info"><p>Используя сайт, вы даете <a href="/consent-personal-data/">согласие на обработку персональных данных</a> с использованием cookie-файлов и сервисов веб-аналитики. Подробнее в <a href="'.get_privacy_policy_url().'" target="_blank">Политике в отношении обработки персональных данных</a>. Отказаться от обработки cookie-файлов, а также отключить сервисы веб-аналитики вы можете с помощью соответствующих настроек вашего браузера.</p><a href="#">Хорошо</a></div>';
		?>
		<!-- <script>
			document.cookie.trim().split(';').forEach(elem => {
				if(elem.trim().split('=')[0] === 'cookie_info' && elem.trim().split('=')[1] === 'true') {
					function initYyMetrika() {
						(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
						m[i].l=1*new Date();for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) return;}
						k=e.createElement(t);a=e.getElementsByTagName(t)[0];k.async=1;k.src=r;a.parentNode.insertBefore(k,a);})
						(window, document, "script","https://mc.yandex.ru/metrika/tag.js", "ym");
						ym(XXXXXXXX, "init", {clickmap:true,trackLinks:true,accurateTrackBounce:true,webvisor:true});
					}
				}
			});
		</script> -->
	</footer>
	<?php
		wp_footer();
		cf7_modal('d086b01','feedback','Записаться');
	?>
</body>
</html>