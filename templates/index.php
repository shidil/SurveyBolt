
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
							<input type="text" size="20" placeholder="Full name" name="name" id="name" data-validation="required"/>
						</div>
						<span>Username:</span>
						<div>
							
							<input type="text" size="12" placeholder="username" name="username" id="username" data-validation="length alphanumeric" 
		 data-validation-length="3-12" data-validation-error-msg="The user name has to be an alphanumeric value between 3-12 characters"/>
						</div>
						<span>Email:</span>
						<div>
							
							<input type="text" size="20" placeholder="Email" name="email" id="email" data-validation="email" />
						</div>
						<span>Password:</span>
						<div>
							
							<input  type="password" name="pass_confirmation"    data-validation="length" data-validation-length="min8"/>
						</div>
						<span>Re-enter password:</span>
						<div>
							
							<input  type="password" name="pass"  data-validation="confirmation"/>
						</div>
						<input type="submit" value="Signup"  id="register_button"/>
					</form>
					<div class="error_msg" id="register_error">username or email already exists</div>
                                        
                                        <script>

                                          $.validate({
                                            modules :   'security'
                                          });


                                        </script>
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
						<div style="margin-top:12px;"><a href="./forgot" style="text-decoration:none;">Forgot password?</a></div>
					</form>
					
					<div class="error_msg" id="login_error">Invalid username or password</div>
				</div>
			</div>


