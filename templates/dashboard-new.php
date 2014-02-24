<?php
$sSys = new SurveySystem;
if ($_POST) {
	// we have the POST so lets create a new survey
	// addSurvey returns the surveyID or false if failed.
	
	$surveyID = $sSys->addSurvey();
	
	if (is_numeric($surveyID)) {
		redirect(DOMAIN . 'dashboard/?action=edit&id=' . encryptMe($surveyID));
	} else {
		includeFile('dashboard');
	}
} else {
	includeFile('dashboard');
}
?>