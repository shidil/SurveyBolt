<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>SurveyBolt | Ultimate survey system</title>

		<link rel="stylesheet" href="<?php echo DOMAIN; ?>contents/css/w2ui-1.3.1.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo DOMAIN; ?>contents/css/style.css" type="text/css" />
		<script src="<?php echo DOMAIN; ?>include/js/jquery-1.8.3.min.js" type="text/javascript"></script>
		<script src="<?php echo DOMAIN; ?>include/js/w2ui-1.3.1.js" type="text/javascript"></script>
		<script src="<?php echo DOMAIN; ?>include/js/jquery.validate.min.js" type="text/javascript"></script>
		<script src="<?php echo DOMAIN; ?>include/js/site.js" type="text/javascript"></script>
		<style type="text/css">
			#header {
				width: 100%;
				height: 11%;
				padding: 10px 0px;
				background: #292929;
				display: block;
				position: relative;
				box-shadow: 0px 2px 5px #090707;
				margin-bottom: 1px;
			}
			.logo {
				height: 100%;
				width: 26%;
				float: left;
				margin-left: 2%;
			}
			.logo img {
				position: absolute;
				top: 25%;
				width: 18%;
			}
			.nav {
				width: 58%;
				float: left;
			}
			ul.main_nav {
				list-style: none;
				list-style: none;
				width: 100%;
				height: 53%;
				/* padding-top: 30px; */
				padding-left: 143px;
				margin: 0;
			}
		</style>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css' />
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	</head>
	<body>
		<div id="wrapper">
			<div id="content">
				<div id="header">
					<div class="logo">
						<a href="<?php echo DOMAIN; ?>"><img src="<?php echo DOMAIN; ?>contents/images/bolt.png" /></a>
					</div>
					<!--<div>
					<form action="login.php" method="post" >
					<input type="text" size="20" placeholder="Username" name="username"/>
					<input type="password" size="20" placeholder="password" name="password"/>
					<input type="submit" value="Login"  />
					</form>
					<div>
					<a href="forgot.php" >Forgot password?</a>
					</div>
					</div>-->
					<nav id="header_nav" class="nav">
						<ul class="main_nav">
							<li style="float:right">
								<a href="<?php echo DOMAIN; ?>logout" style="background: #388819;border-radius: 26px 26px;">Logout</a>
							</li>
							<li style="float:right">
								<a href="<?php echo DOMAIN; ?>help" >Help</a>
							</li>
							<li style="float:right">
								<a href="<?php echo DOMAIN; ?>dashboard/?action=settings" >Settings</a>
							</li>
						</ul>
					</nav>
				</div>
