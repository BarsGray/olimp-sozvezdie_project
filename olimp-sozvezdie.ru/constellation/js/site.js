jQuery(document).ready(function($){

	//fancybox
	Fancybox.bind('[data-fancybox]',{
		Carousel:{
			Toolbar:{
				display:{
					left:['counter'],
					middle:['zoomIn','zoomOut','toggle1to1'],
					right:['autoplay','fullscreen','thumbs','close']
				},
			},
			transition:'slide'
		}
	});
	
	//fix a
	$('body').on('click','a',function(e){
		if($(this).attr('href')=='#') e.preventDefault();
	});
	
	//fix_table
	$('.text').find('table').each(function(){
		$(this).wrap('<div class="over_table"></div>');
	});
	
	//fix_tns
	$('.tns > *:not(.fix_tns)').each(function(){
		$(this).wrap('<div class="fix_tns"></div>');
	});

	//mask_tel
	$('input[type="tel"]').mask('+7 (000) 000-00-00',{clearIfNotMatch:true});
	
	//mobile_menu
	$('.over,.mobile_menu .close').click(function(){
		$('body').css('overflow','auto').find('.over').fadeOut().siblings('.mobile_menu').removeClass('active');
	});
	$('header .header_data .right_block a.btn_menu').click(function(){
		$('body').css('overflow','hidden').find('.over').fadeIn().siblings('.mobile_menu').addClass('active');
	});
	
	//header
	if($('body').hasClass('main')){
		$(window).scroll(function(){
			var scroll_scr=$('body').scrollTop();
			if(scroll_scr==0) scroll_scr=$('html').scrollTop();
			if(scroll_scr>0) $('body.main header').addClass('shadow');
			else $('body.main header').removeClass('shadow');
		});
		setTimeout(function(){$(window).scroll();},250);
	}

	//sec_1
	if($('#sec_1 .sec_slider.tns').is('div'))
		tns({
			container:'#sec_1 .sec_slider.tns',
			controls:false,
			nav:true,
			autoplay:true,
			autoplayTimeout:8000,
			items:1,
			gutter:16
		});

	//sec_2
	if($('#sec_2 .sec_data_bottom .block_slider.tns').is('div'))
		tns({
			container:'#sec_2 .sec_data_bottom .block_slider.tns',
			controls:false,
			nav:true,
			autoplay:true,
			gutter:16,
			responsive:{
				0:{items:1},
				601:{items:2},
				981:{items:3},
				1401:{items:4}
			}
		});
		
	//sec_3
	$('#sec_4 .sec_data .right_block .block_data .bd_item > p').click(function(){
		$(this).toggleClass('active').siblings('div').slideToggle();
	});
	
	//clinics
	if($('.clinics.tns').not('.mini').is('div'))
		tns({
			container:'.clinics.tns:not(.mini)',
			autoplay:true,
			controlsText:['',''],
			gutter:16,
			responsive:{
				0:{items:1,controls:false,nav:true},
				601:{items:2,controls:false,nav:true},
				981:{items:3,controls:true,nav:false},
				1401:{items:4,controls:true,nav:false}
			}
		});
	if($('.clinics.tns.mini').is('div'))
		tns({
			container:'.clinics.tns.mini',
			autoplay:true,
			gutter:16,
			controls:false,
			nav:true,
			responsive:{
				0:{items:1},
				601:{items:2},
				981:{items:1}
			}
		});
		
	//doctors
	if($('.doctors.tns').is('div'))
		tns({
			container:'.doctors.tns',
			autoplay:true,
			controlsText:['',''],
			gutter:16,
			responsive:{
				0:{items:1,controls:false,nav:true},
				601:{items:2,controls:false,nav:true},
				981:{items:3,controls:true,nav:false},
				1401:{items:4,controls:true,nav:false}
			}
		});
		
	//sales
	if($('.sales.tns').is('div'))
		tns({
			container:'.sales.tns',
			autoplay:true,
			controlsText:['',''],
			gutter:16,
			responsive:{
				0:{items:1,controls:false,nav:true},
				601:{items:2,controls:false,nav:true},
				981:{items:3,controls:true,nav:false},
				1401:{items:4,controls:true,nav:false}
			}
		});
		
	//services
	if($('.services.tns').is('div'))
		tns({
			container:'.services.tns',
			autoplay:true,
			controlsText:['',''],
			gutter:16,
			responsive:{
				0:{items:1,controls:false,nav:true},
				601:{items:2,controls:false,nav:true},
				981:{items:3,controls:true,nav:false},
				1401:{items:4,controls:true,nav:false}
			}
		});
		
	//sec_7
	$('#sec_7 .sec_data .block_contacts .bc_item > p').click(function(){
		$(this).toggleClass('active').siblings('div').slideToggle();
		$(this).parent().siblings('.bc_item').find('p').removeClass('active').closest('.bc_item').find('div').slideUp();
	});
	
	if($('#sec_7 #sec_7_map').is('div')) ymaps.ready(sec_7_map);
	function sec_7_map(){
		data_map=$('#sec_7 #sec_7_map').attr('data-map');
		data_map=JSON.parse(data_map);
		$('#sec_7 #sec_7_map').removeAttr('data-map');
		var map_objects=new ymaps.Map('sec_7_map',{
            center:[51.70042009606284,39.11697811705161],
            zoom:10,
			controls:['zoomControl']
        });
		map_objects.geoObjects.removeAll();
		clusterer=new ymaps.Clusterer({
			gridSize:80,
			preset:'islands#redClusterIcons',
			iconColor:'#aa2a36',
			hasBalloon:false,
			hasHint:true
		});
		for(var key in data_map){
			placemark=new ymaps.Placemark(data_map[key].coord.split(','),{
				balloonContentHeader:data_map[key].name,
				balloonContentBody:data_map[key].adr,
				balloonContentFooter:'<a href="'+data_map[key].link+'" target="_blank" style="color:#aa2a36">Подробнее</a>',
				hintContent:data_map[key].name
			},{
				iconLayout:'default#image',
				iconImageHref:'/wp-content/themes/constellation/img/placemark.png',
				iconImageSize:[30,48],
				iconImageOffset:[-15,-48]
			});
			clusterer.add(placemark);
		}
		map_objects.geoObjects.add(clusterer);
		map_objects.setBounds(clusterer.getBounds(),{zoomMargin:88,checkZoomRange:true}).then(function(){if(map_objects.getZoom()>17)map_objects.setZoom(17);});
	}
	
	//clinic_data_clinic_sales_imgs
	if($('#content .clinic_data .clinic_sales_imgs .block_slider.tns').is('div'))
		tns({
			container:'#content .clinic_data .clinic_sales_imgs .block_slider.tns',
			autoplay:true,
			controlsText:['',''],
			gutter:16,
			items:1,
			responsive:{
				0:{controls:false,nav:true},
				981:{controls:true,nav:false}
			}
		});
		
	//clinic_data_clinic_advantages
	if($('#content .clinic_data .clinic_advantages .block_slider.tns').is('div'))
		tns({
			container:'#content .clinic_data .clinic_advantages .block_slider.tns',
			controls:false,
			nav:true,
			autoplay:true,
			gutter:16,
			responsive:{
				0:{items:1},
				601:{items:2},
				981:{items:3},
				1401:{items:4}
			}
		});
	if($('#content .clinic_data .clinic_rules_no .block_slider.tns').is('div'))
		tns({
			container:'#content .clinic_data .clinic_rules_no .block_slider.tns',
			controls:false,
			nav:true,
			autoplay:true,
			gutter:16,
			responsive:{
				0:{items:1},
				601:{items:2},
				981:{items:3},
				1401:{items:4}
			}
		});
		
	//clinic_data_clinic_rules
	$('#content .clinic_data .clinic_rules .block_data .main_item .item > p').click(function(){
		$(this).toggleClass('active').siblings('div').slideToggle();
	});
		
	//clinic_data_clinic_videos
	if($('#content .clinic_data .clinic_videos .right_block .block_slider.tns').is('div'))
		tns({
			container:'#content .clinic_data .clinic_videos .right_block .block_slider.tns',
			loop:false,
			autoplay:false,
			controls:false,
			nav:true,
			gutter:16,
			responsive:{
				0:{items:1},
				360:{items:2},
				601:{items:3},
				981:{items:2},
				1201:{items:3},
				1401:{items:4},
				1601:{items:5}
			}
		});
	
	//clinic_map.single
	if($('#content .clinic_map.single #clinic_map').is('div')) ymaps.ready(clinic_map_single);
	function clinic_map_single(){
		data_map=$('#content .clinic_map.single #clinic_map').attr('data-map');
		data_map=JSON.parse(data_map);
		$('#content .clinic_map.single #clinic_map').removeAttr('data-map');
		var map_objects=new ymaps.Map('clinic_map',{
            center:[51.70042009606284,39.11697811705161],
            zoom:10,
			controls:['zoomControl']
        });
		map_objects.geoObjects.removeAll();
		placemark=new ymaps.Placemark(data_map.coord.split(','),{
			balloonContentHeader:data_map.name,
			balloonContentBody:data_map.adr,
			hintContent:data_map.name
		},{
			iconLayout:'default#image',
			iconImageHref:'/wp-content/themes/constellation/img/placemark.png',
			iconImageSize:[30,48],
			iconImageOffset:[-15,-48]
		});
		map_objects.geoObjects.add(placemark);
	}
	
	//clinic_map.all
	if($('#content .clinic_map.all #clinic_map').is('div')) ymaps.ready(clinic_map_all);
	function clinic_map_all(){
		data_map=$('#content .clinic_map.all #clinic_map').attr('data-map');
		data_map=JSON.parse(data_map);
		$('#content .clinic_map.all #clinic_map').removeAttr('data-map');
		var map_objects=new ymaps.Map('clinic_map',{
            center:[51.70042009606284,39.11697811705161],
            zoom:10,
			controls:['zoomControl']
        });
		map_objects.geoObjects.removeAll();
		map_objects.geoObjects.removeAll();
		clusterer=new ymaps.Clusterer({
			gridSize:80,
			preset:'islands#redClusterIcons',
			iconColor:'#aa2a36',
			hasBalloon:false,
			hasHint:true
		});
		for(var key in data_map){
			placemark=new ymaps.Placemark(data_map[key].coord.split(','),{
				balloonContentHeader:data_map[key].name,
				balloonContentBody:data_map[key].adr,
				balloonContentFooter:'<a href="'+data_map[key].link+'" target="_blank" style="color:#aa2a36">Подробнее</a>',
				hintContent:data_map[key].name
			},{
				iconLayout:'default#image',
				iconImageHref:'/wp-content/themes/constellation/img/placemark.png',
				iconImageSize:[30,48],
				iconImageOffset:[-15,-48]
			});
			clusterer.add(placemark);
		}
		map_objects.geoObjects.add(clusterer);
		map_objects.setBounds(clusterer.getBounds(),{zoomMargin:88,checkZoomRange:true}).then(function(){if(map_objects.getZoom()>17)map_objects.setZoom(17);});
	}
	
	//clinic_contacts.all_tabs
	$('#content .clinic_tabs > a').click(function(){
		$(this).addClass('active').siblings('a').removeClass('active');
		$(this).closest('#content').find('.clinic_map.all .block_data').eq($(this).index()).addClass('active').siblings('.block_data').removeClass('active');
	})
	
	//fix_feedback
	$('body').on('click','a[data-src="#feedback"]',function(){
		$('.modal_form#feedback p.title').text($(this).data('title'));
		$('.modal_form#feedback input[name="your-btn"]').val($(this).data('btn'));
	});
		
	//cookie
	$('.cookie_info > a').click(function(e){
		e.preventDefault();
		document.cookie="cookie_info=true; max-age=31536000; path=/";
		$('.cookie_info').remove();
	});
	
	//price_data
	if($('.price_data').is('table'))
		new DataTable('table.price_data',{
			scrollX:true,
			language:{url:'/wp-content/themes/constellation/js/datatables.lang.ru.json'},
			columns:[
				null,
				null,
				null,
				null,
				{orderSequence:['','']}
			]
		});
	
});