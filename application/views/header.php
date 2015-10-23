<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="<?php echo $meta_d; ?>" />
		<meta name="keywords" content="<?php echo $meta_k; ?>" />
		<link href="http://rmaker.ru/favicon.ico" rel="shortcut icon" type="image/ico" />
		
		
		<!-- Load jQuery  -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

		<!-- Load WysiBB JS and Theme -->
		<script src="http://cdn.wysibb.com/js/jquery.wysibb.min.js"></script>
		<link rel="stylesheet" href="http://cdn.wysibb.com/css/default/wbbtheme.css" />
		
		
		<script type="text/javascript" src="<?php echo base_url(); ?>/jsibox/jsibox_basic.js"></script>
		<title><?php echo $title; ?></title>
		<?php echo $this->load->view('style', '', TRUE); 
			$this->load->helper('url');
		?>
		<script>
			$(document).ready(function() {
			var wbbOpt = {
				buttons: "bold,italic,underline,strike,|,img,link,|,fontcolor,fontsize,|,code,quote"
			}
			$("#editor").wysibb(wbbOpt);
			});
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<h1><a href="<?php echo site_url(); ?>">RMaker
					<img class='alignleft' src="<?php echo base_url().'forum/styles/basic/theme/images/logo.png'; ?>" alt=''></a></h1>
				</div>
				<div id="menu">
					<ul>
						<li class="first active"><a href="<?php echo site_url(); ?>">Главная</a></li>
						<li><a href="<?php echo site_url('catalog') ?>">Игры</a></li>
						<li class="last"><a href="<?php echo site_url('forum') ?>">Форум</a></li>
					</ul>
					<br class="clearfix" />
				</div>
			</div>
			<div id="sidebar">
				<?php
				if ( $this->ion_auth->logged_in() ) {
					$user = $this->ion_auth->user()->row();
					echo 'С возвращением, '.$user->username.'! || <a href="'.base_url().'index.php/panel">Панель управления</a> || <a href="'.base_url().'index.php/auth/logout">Выйти</a>';
				}
				else {
					echo 'Добро пожаловать в сообщество RMaker.ru! Пожалуйста, 
					<a href="'.base_url().'index.php/auth/create_user">зарегистрируйтесь</a> или 
					<a href="'.base_url().'index.php/auth/login">войдите</a>.';
				} ?>
			</div>
		<div id="content">
			