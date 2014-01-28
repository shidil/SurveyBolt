<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>SurveyBolt | Ultimate survey system</title>
		<link rel="stylesheet" href="contents/css/style.css" type="text/css" />
	</head>
	<body>
		<div id="wrapper">
			<div id="content">
				<div id="header">
					<div class="logo"><img src="contents/images/bolt.png" />
					</div>
					<div form action="\login.php" method="post">
					<input type="text" size="20" placeholder="Username" name="username"/>
					<input type="password" size="20" placeholder="password" name="password"/>
					<input type="submit" value="Login"  />
					</form>
					<div><a href="forgot.php" >Forgot password?</a></div>
				</div>
					<nav id="header_nav" class="nav">
						<ul class="main_nav">
							<li>
								<a href="index.php" >Home</a>
							</li>
							<li>
								<a href="/about">About</a>
							</li>
							<li>
								<a href="/demo">Demo</a>
							</li>
							<li>
								<a href="/register">Register</a>
							</li>
						</ul>
					</nav>
				</div>
				<section id="highlights">
					<div class="description">
						Survey Management solution is a php survey creation and analysis tool
					</div>
					<div class="big_photo"><img src="contents/images/highlight.png" />
					</div>
				</section>
				<section id="features">
					<div class="feature_tabs">

					</div>
					<div class="feature">

					</div>
				</section>
				<section id="register">
					<form action="register.php" method="post">
						<div><span>Name:</span><input type="text" size="20" placeholder="Full name" name="name"/></div>
						<div><span>Username:</span><input type="text" size="20" placeholder="username" name="username"/></div>	
						<div><span>Email:</span><input type="text" size="20" placeholder="Email" name="email"/></div>
						<div><span>Password:</span><input type="password" size="20" placeholder="password" name="password"/></div>
						<div><span>Re-enter password:</span><input type="password" size="20" placeholder="password" name="password"/></div>
				
							
						<input type="submit" value="Signup"  />
					</form>
				</section>
				<footer>
					<div class="footer_container">
						<div class="fotter_content">
							copyright Mobezer
						</div>
					</div>
				</footer>
			</div>
		</div>

	</body>
</html>
