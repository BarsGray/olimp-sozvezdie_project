<?php
	get_header();
	the_post();
	$acf_fields=get_fields();
?>

	<div id="content">
		<div class="wr text clr">
			<?php
				bread_crumbs();
				post_title();
				the_content();

				//clinics
				if(is_page(22)){
					$tx_posts=get_posts(array(
						'post_type' => 'clinic',
						'nopaging' => true
					));
					view_clinics($tx_posts);
				}
				
				//doctors
				if(is_page(24)){
					$tx_posts=query_posts(array(
						'post_type' => 'doctor',
						'paged' => get_query_var('paged') ? get_query_var('paged') : 0,
						'orderby' => 'post_title',
						'order' => 'ASC'
					));
					view_doctors($tx_posts);
					wp_pagenavi();
					wp_reset_query();
				}
				
				//patients
				if(is_page(26) && !empty($acf_fields['patients_documents'])){
					echo '<div class="documents">';
						foreach($acf_fields['patients_documents'] as $item)
							printf(
								'<a href="%s" class="item" target="_blank"%s><span class="item_name">%s</span><span class="item_type">%s</span></a>',
								$item['patients_document_file']['url'],
								pathinfo($item['patients_document_file']['filename'],PATHINFO_EXTENSION)!='pdf' ? ' download' : '',
								$item['patients_document_name'],
								pathinfo($item['patients_document_file']['filename'],PATHINFO_EXTENSION).', '.round($item['patients_document_file']['filesize']/1024/1024,2).' мб'
							);
					echo '</div>';
				}
				
				//contacts
				if(is_page(28)) view_contacts();
				
				//sales
				if(is_page(67)){
					$tx_posts=query_posts(array(
						'post_type' => 'sale',
						'paged' => get_query_var('paged') ? get_query_var('paged') : 0
					));
					view_sales($tx_posts);
					wp_pagenavi();
					wp_reset_query();
				}
				
				//price
				if(is_page(563)) view_price();
				
				if(isset($acf_fields['text_after']) && !empty($acf_fields['text_after']))
					echo fc($acf_fields['text_after']);
			?>
		</div>
	</div>

<?php get_footer(); ?>