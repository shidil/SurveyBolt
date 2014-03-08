
			<section id="highlights">
				<div class="description">
					<div>Fast and simple survey tool</div>
					<div class="quote">SurveyBolt is an online application that allows you to design and share surveys to your contacts on Internet. Besides, you will be able to collect and export the data of your surveys in order to analyse them as you need.</div>
				</div>
				
				<div id="highlights_login">
					Log In
				</div>
				<div id="highlights_register">
					Join Now
				</div>
				<div class="big_photo"></div>
			</section>
			<section id="features">
				<div class="feature_tabs">

				</div>
				<div class="feature">

				</div>
			</section>
			<div id="register_form">
				<div rel="title">
					Register
				</div>
				<div rel="body">
					<form action="<?php echo DOMAIN; ?>register" method="post" id="reg_form" class="register_form">
						<span>Name:</span>
						<div>
							<input type="text" size="20" placeholder="Full name" name="name" id="name"/>
						</div>
						<span>Username:</span>
						<div>
							
							<input type="email" size="20" placeholder="username" name="username" id="username"/>
						</div>
						<span>Email:</span>
						<div>
							
							<input type="text" size="20" placeholder="Email" name="email" id="email"/>
						</div>
						<span>Password:</span>
						<div>
							
							<input type="password" size="20" placeholder="password" name="password" id="password"/>
						</div>
						<span>Re-enter password:</span>
						<div>
							
							<input type="password" size="20" placeholder="password" name="passwordconf" id="passwordconf"/>
						</div>
						<input type="submit" value="Signup"  id="register_button"/>
					</form>
					<div class="error_msg" id="register_error">Errors in one or more fields!</div>
				</div>
			</div>
			<div id="login_form">
				<div rel="title">
					Log In
				</div>
				<div rel="body">
					<form action="<?php echo DOMAIN; ?>login" method="post" class="login_form">
						<span>Username:</span>
						<div>
							<input type="text" size="20" placeholder="Username" name="username"/>
						</div>
						<span>Password:</span>
						<div>
							<input type="password" size="20" placeholder="Password" name="password"/>
						</div>
						<input type="submit" value="login" id="login_button"/>
					</form>
					<div class="error_msg" id="login_error">Invalid username or password</div>
				</div>
			</div>

