<?php
include("config.php"); 
$please=1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $nameEN ?> - لعبة الانترنت - الرومان، الاغريق، الجرمان</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <meta content="description" content="Master the art of ancient tactics as Roman, Gaul or Teuton!" />
    <link rel="stylesheet" type="text/css" href="gpack/travian_homepage/lang/en/compact.css@929t"/>
	<meta name="content-language" content="en"/>
	<meta http-equiv="imagetoolbar" content="no"/>
	<script type="text/javascript" src="crypt.js@1323348692"></script>
	<style type="text/css">
	<![CDATA[*/
		div.c1 {left: 274px; top: 100px; display: block; visibility: visible}
    /*]]>
    </style>
</head>
<body class=" LTR">
    <div id="backgroundLeft"></div>
    <div id="backgroundRight"></div>
	<div id="background">
		<div id="navigation-wrapper">
	    	<div id="navigation-container">
	        	<div id="country_select">
					<div id="flags"></div>
                    <script src="flags.js" type="text/javascript"></script>
				</div>
	            <div id="top-nav">
                    <div id="top-nav-menu">
                        <div id="logo">
                            <a href="index.php"><img src="img/x.gif" class="logo" alt="" /></a>
                        </div>
                        <ul id="top-navigation">
						<li><a href="<?php echo $shoplink ?>" class="popcon"><font color="FF00D8">TatarMi</a></li>
                                <li><a href="/">المنتدى</a></li>
				<li><a href="#serverLogin" class="popcon" id="register">تسجيل الدخول</a></li>	
                            <li><a href="#serverRegister" class="popcon" id="register">التسجيل</a></li>
                        </ul>
                    </div>
                    <div id="top-nav-login">
                        <div id="login">
                            <div class="btn-green">
                                <div class="btn-green-l"></div>
                                <div class="btn-green-c"><a class="npage popcon" href="#serverLogin">تسجيل الدخول</a></div>
                                <div class="btn-green-r"></div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	    <div id="content-container">
	    	<div id="content-menu">
				<div id="statistics">
                   	<div id="stat-top"></div>
                    <div id="stat_bottom"></div>
                	</div>
					<div id="news">
    <div id="news-head"></div>
    <div id="news-content">
        <h3 class="news bold">جديد الموقع</h3>
        <div class="news-items"><div class="news">
		<?php echo $news1 ?>
		<br /><br /><center>
		<br /><br /></center>
		<?php echo $news2 ?>
		<br /><br /><center>
		<br /><br /></center>
		<?php echo $news3 ?>
		<br /><br />
		</div></div></div>
    <div id="news-bottom"></div>
</div>
                    <div id="shop"><a href="<?php echo $shoplink ?>" class="popcon">
	                	<div class="article">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $nameFA ?></div>
	                	<div class="link">
							<img class="ticker-btn" alt="" src="img/x.gif">
						</div></a>
	                </div>
                   
				</div>
	            <div id="content-main">
	            	<div id="wit">
                    	<div id="wit-top"></div>
                        <div id="wit-content" class="with-button">
                        	<div id="hero"></div>
                            <h1 class="wit bold">ترافيان - لعبة الاستراتيجيات الأشهر في الانترنت </h1>
                            <div class="wit-info">ترافيان واحدة من أنجح ألعاب المتصفحات في العالم. في ترافيان، تؤسس امبراطوريتك، توسّعها وتدّرب جيشاً لحمايتها، في النهاية، تتساعد مع لاعبين آخرين لتنافسوا على بناء معجزة العالم. .                            	<div class="playnow playnow-button">
                                	<div class="playnow-start">
                                    	<h1 class="play white bold">
                                        <a class="popcon play" href="#serverRegister" title=" التسجيل !">التسجيل في السيرفر !</a>
                                        </h1>
									</div>
                                    <div class="playnow-end"></div>
                                    <div class="clear"></div>
								</div>
							</div>
                            <div id="stage_space"></div>
                            <div id="stage">
                            	<div id="frame">
									<div class="stage-content stage-content0 shown" style="background-image: url(img/big1.png)">
                                    	<div style="position:absolute; right:10px; top:170px;">
                                        	<img alt="" class="bbArrow" src="img/x.gif" />
                                            <span style="color:black;"><span style="font-weight:bold;">سجل عضويتك الآن </span></span>
										</div>
                                        <div style="position:absolute; right:15px; top:12px;">
                                            <h3>هذه من أشهر آلألعآب  </h3>
                                            <br />
                                            <span style="font-weight:bold;"> <br /></span>
                                        </div>
                                        <div class="stage-arrow stage-arrow-0"></div>
									</div>
                                    <div class="stage-content stage-content1" style="background-image: url(img/big2.png)">
                                    	<div style="position:absolute; right:15px; top:170px;">
                                        	<img alt="" class="bbArrow" src="img/x.gif" />
                                            <span style="color:black;"><span style="font-weight:bold;">نسعد بإنضمآمكم </span></span>
                                        </div>
                                        <div style="position:absolute; right:15px; top:12px;">
                                        	<h3> نآفس أصدقآءك</h3>
                                            <br />
                                            <span style="font-weight:bold;">الرومآن وآلجرمآن وآلإغريق<br /><br /> <br /><br /> </span>
										</div>
										<div class="stage-arrow stage-arrow-1"></div>
									</div>
									<div class="stage-content stage-content2" style="background-image: url(img/big3.png)">
                                    	<div style="position:absolute; right:15px; top:170px;">
                                        	<img alt="" class="bbArrow" src="img/x.gif" />
                                            <span style="color:black;"><span style="font-weight:bold;">يآ هلآ وآلله وغلآ </span></span>
										</div>
                                        <div style="position:absolute; right:15px; top:12px;">
                                            <h3>توآصل</h3>
                                            <br />
                                            <span style="font-weight:bold;">تعاون مع أصدقآءك <br />أنشي آلتحالف<br />التعاون مهم<br />الفوز في اللعبه يحتاج للصبر </span>
                                        </div>
										<div class="stage-arrow stage-arrow-2"></div>
									</div>
                                    <div id="stage-nav">
                                        <ul id="buttons">
                                            <li class="b0 act0" style="background-image: url(img/small1.png)">&nbsp;</li>
                                            <li class="b1" style="background-image: url(img/small2.png)">&nbsp;</li>
                                            <li class="b2" style="background-image: url(img/small3.png)">&nbsp;</li>
                                        </ul>
                                    </div>
								</div>
								<div id="stage-bg"></div>
								<div id="stage-fg">
                                	<div class="stage-links">
                                    	<a class="stage-link stage-link1 shown" href="#serverRegister"></a>
                                        <a class="stage-link stage-link2" href="#serverRegister"></a>
                                        <a class="stage-link stage-link3" href="#serverRegister"></a>
									</div>
                                    <div id="stage-nav-click">
                                    	<ul id="buttons-click">
											<li class="b0 act0">&nbsp;</li>
											<li class="b1">&nbsp;</li>
											<li class="b2">&nbsp;</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div id="wit-bottom"></div>
					</div>
					<div id="moreabttravian">
						<div id="find-out-more">
							<div id="strip-head">
                            	<div>معرفه آلمزيد </div>
                            </div>
							<div id="strip">
								<ul id="strips">
					                <li class="stip0">&nbsp;</li>
                					<li class="stip1">&nbsp;</li>
                					<li class="stip2">&nbsp;</li>
                					<li class="stip3">&nbsp;</li>
                					<li class="stip4">&nbsp;</li>
                					<li class="stip5">&nbsp;</li>
            					</ul>
    					    </div>
                            <div id="strip-details">
                                <div class="details">
                                    <div class="details-top"></div>
                                    <div class="details-l-top"></div>
                                    <div class="details-r-top"></div>
                                    <div class="details-body">
                                        <div class="details-body-l" id="strip-c1"></div>
                                        <div class="details-body-r">الرجاء الترقية حقول الموارد لزيادة الإنتاج الخاص من الموارد. لبناء أو تطوير المباني وتدريب قوات الموارد التي ستحتاج إليها<br /><br />
                                            <div class="btn-green">
                                                <div class="btn-green-l"></div>
                                                <div class="btn-green-c"><a class="npage popcon" href="#tutorial">دوره</a></div>
                                                <div class="btn-green-r"></div>
                                            </div>
                                        </div>
								</div>
								<div class="details-l-bottom"></div>
								<div class="details-r-bottom"></div>
								<div class="details-bottom"></div>
							</div>
							<div class="details">
								<div class="details-top"></div>
								<div class="details-l-top"></div>
                                <div class="details-r-top"></div>
								<div class="details-body">
									<div class="details-body-l" id="strip-c2"></div>
									<div class="details-body-r">المباني في قريتك والارتقاء بمستواهم. المباني قريتك تحسين البنية التحتية بشكل عام، زيادة الإنتاج الخاص والموارد تسمح لك للبحث وتدريب وترقية القوات الخاصة بك وسوف القرية <br /><br />
										<div class="btn-green">
											<div class="btn-green-l"></div>
											<div class="btn-green-c"><a class="npage popcon" href="#tutorial">دوره</a></div>
											<div class="btn-green-r"></div>
										</div>
									</div>
								</div>
								<div class="details-l-bottom"></div>
                                <div class="details-r-bottom"></div>
								<div class="details-bottom"></div>
							</div>
							<div class="details">
								<div class="details-top"></div>
								<div class="details-l-top"></div>
                                <div class="details-r-top"></div>
								<div class="details-body">
									<div class="details-body-l" id="strip-c3"></div>
									<div class="details-body-r">انظر لمن حولك وستجد الكثير من الاصدقاء . <br /><br />
									<div class="btn-green">
										<div class="btn-green-l"></div>
										<div class="btn-green-c"><a class="npage popcon" href="#tutorial">دوره</a></div>
										<div class="btn-green-r"></div>
									</div>
								</div>
							</div>
							<div class="details-l-bottom"></div>
                            <div class="details-r-bottom"></div>
							<div class="details-bottom"></div>
						</div>
						<div class="details">
							<div class="details-top"></div>
							<div class="details-l-top"></div>
                            <div class="details-r-top"></div>
							<div class="details-body">
								<div class="details-body-l" id="strip-c4"></div>
								<div class="details-body-r">مقارنة مع لاعبين آخرين وتقييم التقدم المحرز الخاص بك والنجاح. رؤية أفضل 10 الرتب ومحاولة للحصول على نظرة عامة ميداليات.<br /><br />
									<div class="btn-green">
										<div class="btn-green-l"></div>
										<div class="btn-green-c"><a class="npage popcon" href="#tutorial">دوره</a></div>
										<div class="btn-green-r"></div>
									</div>
								</div>
							</div>
							<div class="details-l-bottom"></div>
                            <div class="details-r-bottom"></div>
							<div class="details-bottom"></div>
						</div>
						<div class="details">
							<div class="details-top"></div>
							<div class="details-l-top"></div>
                            <div class="details-r-top"></div>
							<div class="details-body">
								<div class="details-body-l" id="strip-c5"></div>
								<div class="details-body-r">تطوير الحقول والاهتمام بالقرية للفوز باللعبه.<br /><br />
									<div class="btn-green">
										<div class="btn-green-l"></div>
										<div class="btn-green-c"><a class="npage popcon" href="#tutorial">دوره</a></div>
										<div class="btn-green-r"></div>
									</div>
								</div>
							</div>
							<div class="details-l-bottom"></div>
                      		<div class="details-r-bottom"></div>
							<div class="details-bottom"></div>
						</div>
						<div class="details">
							<div class="details-top"></div>
							<div class="details-l-top"></div>
                            <div class="details-r-top"></div>
							<div class="details-body">
								<div class="details-body-l" id="strip-c6"></div>
								<div class="details-body-r">التواصل مع لاعبين آخرين وإقامة العلاقات الدبلوماسية.<br /><br />
									<div class="btn-green">
										<div class="btn-green-l"></div>
										<div class="btn-green-c"><a class="npage popcon" href="#tutorial">دوره</a></div>
										<div class="btn-green-r"></div>
									</div>
								</div>
							</div>
							<div class="details-l-bottom"></div>
                            <div class="details-r-bottom"></div>
							<div class="details-bottom"></div>
						</div>
					</div>
				</div>
			</div>
			<div id="ssc-bg">
				<div id="ss-head">
					<div id="ss-head-left"></div>
					<div id="ss-head-right"></div>
					<h3 class="ss bold white">لقطآت من آللعبه</h3>
				</div>
				<div id="ss-container">
					<div id="g-widget">
                    	<a class="browse next"></a>
						<div id="gallery">
							<div id="g-items">
								<img src="img/x.gif" class="screen1" alt="" />
                                <img src="img/x.gif" class="screen2" alt="" />
                                <img src="img/x.gif" class="screen3" alt="" />
                                <img src="img/x.gif" class="screen4" alt="" />
                                <img src="img/x.gif" class="screen5" alt="" />
                                <img src="img/x.gif" class="screen6" alt="" />
                                <img src="img/x.gif" class="screen7" alt="" />
                                <img src="img/x.gif" class="screen8" alt="" />
							</div>
						</div>
						<a class="browse prev"></a>
					</div>
				</div>
			</div>
			<script type="text/javascript">
                window.addEvent('domready', function()
                {
                    //stage
                    var stagewidget = new stageWidget({
                        stagebg:$('stage-bg'),
                        stageduration: {
                            0:5000,
                            1:5000,
                            2:5000	        },
                        stagecon:$$(".stage-content"),
                        stagenav:$$("#buttons-click li"),
                        stagelink:$$(".stage-link"),
                    });
            
                    //tooltip
                    var tooltipwidget = new tooltipWidget({
                        tips: $$("#strips li"),
                        details:$$(".details")
                    });
                    //slider
                    var sliderwidget = new sliderWidget({
                        container: $$('#g-widget'),
                        pimgwidth:520,
                        head:$('prev_head'),
                        desc:$('prev_desc'),
                        prev_bg:$('overlaybg'),
                        prev_container:$('preview_container'),
                        prev_stage_container:$$('#preview_stage'),
                        prev_items:$('preview_items'),
                        close:$('close')
                    });
            
                    //slideshow [footer]
                    $('screenshotp').addEvents(
                    {
                        'click': function(e) {
                            e.stop();
                            this.fireEvent('show');
                        },
                        'show':function(e){
                            new sliderWidget({
                                container: $$('#g-widget'),
                                preview: false,
                                inpreview:true,
                                pimgwidth:520,
                                head:$('prev_head'),
                                desc:$('prev_desc'),
                                prev_bg:$('overlaybg'),
                                prev_container:$('preview_container'),
                                prev_stage_container:$$('#preview_stage'),
                                prev_items:$('preview_items'),
                                close:$('close'),
                                directcall:true
                            });
            
                        }
                    });
            
                    //popup anchor
                    var url = new URI();
                    var anchor = url.get('fragment');
                    if (anchor && anchor == 'screenshots')
                    {
                        $('screenshotp').fireEvent('show');
                    }
                });
            </script>
		</div>
		<div class="clear"></div>
	</div>
	<div id="footer-container">
		<div id="footer">
			<a class="flink popcon" href="support.php">الدعم</a>&nbsp;|&nbsp;
			<a class="flink popcon" href="/">المنتدى</a>&nbsp;|&nbsp;
            <a target="blank" class="flink" href="#screenshots" id="screenshotp">لقطات من اللعبه</a>
			<br />
			&copy; 2013 - <a target="blank" class="flink" href="#"></a> TatarMi - جميع الحقوق محفوظه
			</a><font color="FF00D8" size=2><br />------------------<br />Email:g201030@yahoo.com
		</div>
	</div>
	<div id="preview_container">
		<div id="p-top"></div>
		<div id="p-bg"></div>
		<div id="p-bottom"></div>
		<a class="close"></a>
		<div id="p-content">
			<div id="prev_head">
				<h3>Screenshots</h3>
			</div>
			<div id="preview_stage">
			<a class="browse next"></a>
			<div id="preview_img">
				<div id="preview_items"></div>
			</div>
			<a class="browse prev"></a>
			<div class="clear"></div>
		</div>
		<div id="prev_desc"></div>
	</div>
</div>
<div id="popup">
	<div id="popup-top"><a class="pclose"></a></div>
	<div id="popup-content">
		<div class="loading"></div>
	</div>
	<div id="popup-bottom"></div>
</div>
<div id="overlaybg"></div>
<script type="text/javascript">
	var screenshots = [
		{'img':'screenBig screenBig1','hl':'مركز القريه', 'desc':'هنآ مركز القرية وبدآية انطلآق قوآتك وبدآية تحصينك للقرية.'},
		{'img':'screenBig screenBig2','hl':'أفضل 10', 'desc':'الخشب والطين والحديد والمحاصيل الموارد الحيوية التي يمكن استخدامها لتحسين اقتصاداتها وتوفير الغذاء لسكان القرية، وهناك حاجة أيضا هذه الموارد للبناء، وحتى الحرب. مع هذا المورد الثمين لتدريب جيش كبير.'},
		{'img':'screenBig screenBig3','hl':'البطل', 'desc':'يمكنك إرسال البطل الخاص بك على مغامرة خطرة. إذا بطلك ناجحا كنت قد وجدت أشياء ثمينة معهم .'},
		{'img':'screenBig screenBig4','hl':'معلومات عن البناء', 'desc':'لجعل قرية قوية مع العديد من المباني التي بنيت في أنه يجب أن يكون لديك إنتاج عالية.'},
		{'img':'screenBig screenBig5','hl':'البيت الرئيسي', 'desc':'يمكنك الاختيار ما بين السلام او الحرب .'},
		{'img':'screenBig screenBig6','hl':'تقارير المعارك', 'desc':'انها بدأت أعتقد الجيش وتدريب لك أن تكون قادرة على الدفاع عن نفسها ومهاجمة الآخرين. بهذه الطريقة سوف تكون قادرة على سرقة المزيد من الموارد وبناء امبراطورية الخاص بك وسوف يكون أسرع..'},
		{'img':'screenBig screenBig7','hl':'الاشعارات', 'desc':'في الأسبوع الماضي لاعبين أفضل 10 ويتم اختيار التحالف في فئات مختلفة؛ وسوف يحصل على الميدالية كمكافأة على عمله.'},
		{'img':'screenBig screenBig8','hl':'مدير المهمات', 'desc':'هو الدليل؛ويساعدك على تطوير قريتك .يكون على اليمين انقر.'}
	];
</script>
</div>
</body>
</html>