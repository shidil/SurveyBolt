<?php

$uSys = new UserSystem;
$surveyID = decryptMe(Bolt::$_get[0]);
$sSys = new SurveySystem;

$survey_item = $sSys -> getSurveyByID($surveyID);
if($survey_item==false and !$_POST){
    includeFile('404');
    exit();
}

if ($survey_item -> access == 'password' and !$_POST['email']) {
	if (isset($_POST['password'])) {
		if ($_POST['password'] == $survey_item -> password) {
			goto print_survey;
		} else {
			includeFile('survey-access-fail');
		}
	} else {
		includeFile('survey-access');
	}
	goto end_this;
}

print_survey:
if ($_POST and !isset($_POST['password'])) {
    $questions = $survey_item -> getQuestions();
    
	$participant = Participant::addParticipant($survey_item -> getID(),$_POST['email']);
	$date = date('Y-m-d H:i:s');
	foreach ($questions as $key => $value) {
		$ide = encryptMe($value -> getID());
		if (is_array($_POST[$ide])) {
			foreach ($_POST[$ide] as $lang) {
				Bolt::$db -> insert(array('questionID','surveyID', 'answer', 'date', 'author'), array($value -> getID(),$survey_item->getID(), $lang, $date, $participant->getID()), 'answers');
			}
		} else
			Bolt::$db -> insert(array('questionID','surveyID', 'answer', 'date', 'author'), array($value -> getID(),$survey_item->getID(), $_POST[$ide], $date, $participant->getID()), 'answers');
	}
        redirect(DOMAIN.'?msg=thanks');
} else
{
   if($survey_item!=null) {$questions = $survey_item -> getQuestions();
includeFile('survey-print');}}

end_this:
$asfsaf = null;
?>