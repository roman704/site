   <?php
    $cs = Yii::app()->clientScript;
	$baseUrl = Yii::app()->baseUrl;	
	$baseThemeUrl = Yii::app()->theme->baseUrl;
	
    ?>
	<?php 
		//Регистрируем jquery ui для меню категорий
		
	Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
	Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
	Yii::app()->clientScript->registerScript('menu', '     
	    $(function(){
	       $( "#cat_menu" ).menu();
	
	    }); 
	     
//	    $("#cat_menu").css("display","none");
	     
	    $(".category").mouseover(function(){
	        $("#cat_menu").show();
	    });

	    $(".category").mouseout(function(){
	        $("#cat_menu").hide();
	    }); 

    ');
	$categories = ApartmentObjType::model()->findAll();
	if (!empty($categories))
    	$menuTemplate = '{menu}'.ApartmentObjType::getMenu($categories);
	else
	    $menuTemplate = '{menu}';

?>


<?php
	//ОСНОВНОЙ LAYOUT 
	$this->beginContent('//layouts/main'); 
?>
	<?php
		if(issetModule('advertising')) {
			$this->renderPartial('//modules/advertising/views/advert-top', array());
		}
	?>
<div class="main-content">
		<div id="homeheader">
			<div class="slider-wrapper theme-default">
					<div id="slider" class="nivoSlider">
					
		<?php 
		
		
			$this->widget(
				'booster.widgets.TbCarousel',
				array(
					'items' => array(
						array(
							'image' => Yii::app()->getBaseUrl('/www/images/slide1.gif').'/images/t1.jpg',
							'label' => 'First Thumbnail label',
							'caption' => 'First Caption.'
						),
						array(
							'image' => Yii::app()->getBaseUrl('/www/images/slide2.gif').'/images/t2.jpg',
							'label' => 'Second Thumbnail label',
							'caption' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'
						),
						array(
							'image' => Yii::app()->getBaseUrl('/www/images/slide3.gif').'/images/t3.jpg',
							'label' => 'Third Thumbnail label',
							'caption' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'
						),
					),
				)
			);
		?>
		
		

						<div style="clear:both"></div>
					</div>
				<div style="clear:both"></div>
			</div>

				<div id="homeintro">
					<?php //панель с поиском
						Yii::app()->controller->renderPartial('//site/index-search'); 
					
					?>
				</div>
		</div>


		<div class="main-content-wrapper">
			<?php
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
					if ($key=='error' || $key == 'success' || $key == 'notice'){
						echo "<div class='flash-{$key}'>{$message}</div>";
					}
				}
			?>
			
			<?php
   				/*$categories = ApartmentObjType::model()->findAll();
			    echo ApartmentObjType::getMenu($categories);
			*/?>			
			
			
			
			<?php echo $content; ?>
			
		
		</div>

</div>
<?php $this->endContent(); ?>	