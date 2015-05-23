<?php
if ($uSys -> isLoggedIn()) 
		includeFile('header-logout');
else
		includeFile('header');
?>
<!--section id="highlights">
	<!--div class="about_text"!-->
		
	<!--/div>
	<!--div class="big_photo"></div>
<!--/section>
<!--div id="theame"-->
<section id="form_container">Demo
	<h3>sample</h3>
        <form id="survey_form" method="post" action="http://localhost/survey/Demo" style="padding-bottom: 40;">
		
						<div class="survey_item">
							<div class="item_title">What is your name?</div>
							<div class="item_help_button" data=""></div>
							<div class="item_feild">
								<input type="text" name="76cc" size="100" required="">
							</div>
						</div>
						<div class="survey_item">
							<div class="item_title">Your contry?</div>
							<div class="item_help_button" data=""></div>
							<div class="item_feild">
							<select name="76cd" required"=""><option value="India" required="">India</option><option value="USA" required="">USA</option><option value="UK" required="">UK</option><option value="Others" required="">Others</option>				</select></div>
						</div>
						<div class="survey_item">
							<div class="item_title">sex</div>
							<div class="item_help_button" data=""></div>
							<div class="item_feild"><input type="radio" name="76cf" value="Male" notrequired="">Male<input type="radio" name="76cf" value="Female" notrequired="">Female				</div>
						</div>
						<div class="survey_item">
							<div class="item_title">Do you know english?</div>
							<div class="item_help_button" data=""></div>
							<div class="item_feild">
								<input type="radio" name="76c8" value="true" notrequired="">True
								<input type="radio" name="76c8" value="false" notrequired="">False
							</div>
						</div>
						<div class="survey_item">
							<div class="item_title">Feedback about this site</div>
							<div class="item_help_button" data=""></div>
							<div class="item_feild">
								<textarea name="76c9" rows="5" cols="77" notrequired=""></textarea>
							</div>
						</div>
						<!--div class="survey_item">
							<div class="item_title">Do you know english?</div>
							<div class="item_help_button" data=""></div>
							<div class="item_feild">
								<input type="radio" name="76ca" value="true" notrequired="">True
								<input type="radio" name="76ca" value="false" notrequired="">False
							</div>
						</div-->
						<div class="survey_item">
							<div class="item_title">sex</div>
							<div class="item_help_button" data=""></div>
							<div class="item_feild"><input type="radio" name="76cb" value="Male" notrequired="">Male<input type="radio" name="76cb" value="Female" notrequired="">Female				</div>
						</div>		<input type="submit">
	</form>
</section>
<!--/div!-->
<?php
includeFile('footer');
?>