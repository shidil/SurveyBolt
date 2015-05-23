<?php
global $survey_item;
	includeFile('header'); ?>
	
	<section id="survey_access">
		<div class="center_sqare">
			<h4>Protected survey</h4>
			<p>Enter the password to unlock the survey</p>
			<form action="<?php echo DOMAIN.'app/'.  encryptMe($survey_item->getID()) ?>" method="post">
				<input type="password" name="password"/>
				<input type="submit" />
			</form>
			<h5 class="error">Incorrect password</h5>
		</div>
	</section>
	
	<?
	includeFile('footer');

?>