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
				if(is_singular('sale'))
					if(!empty($acf_fields['sale_end']))
						echo '<span class="block_sale_help">до '.wp_date('j F',strtotime($acf_fields['sale_end'])).'</span>';
					if($acf_fields['sale_status']==false)
						foreach($acf_fields['sale_clinics'] as $item)
							echo '<span class="block_sale_help">'.$item->post_title.'</span>';
				the_content();
			?>
		</div>
	</div>

<?php get_footer(); ?>