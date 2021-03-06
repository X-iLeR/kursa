<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap.css" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<header>
    <h1><span style="color: #98CA68">Our</span>Way</h1>
</header>
    <nav id="mainmenu">
        <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'Главная', 'url'=>array('/site/index')),
                array('label'=>'Бой', 'url'=>array('/battle'),
                    'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Поиск боя', 'url'=>array('/battle/init'),
                    'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Регистрация', 'url'=>array('/site/register'),
                    'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Войти', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Выйти ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ));
        ?>
    </nav>
    <!-- mainmenu -->

<div class="container" id="page">


	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->


	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

    <div class="clear"></div>



</div><!-- page -->

<?php if(in_array(Yii::app()->controller->id , Yii::app()->params['CONTROLLERS_WITH_CHAT']) ): ?>
<div class="clear"></div>
<div class="panel-footer clear" id="system_chat_block">
    <h2 class="center-block text-center">Системный чат: </h2>
    <div id="system_chat" class="col-xs-12">
        <p>&nbsp;</p>
    </div>
</div>
<?php endif; ?>

<div class="clear"></div>

<footer style="display: none";>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#"><a href="#"><a href="#">News2</a></a></a></a></li>
            <li><a href="#"><a href="#">About us</a></a></a></li>
            <li><a href="#">Contacts</a></a></li>
        </ul>
    </nav>
</footer>
<div id="copyright" class="center-block">Ourway (c) 2014</div>
</body>
</html>
