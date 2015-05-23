<?php

/**
 * 	Question Survey.
 *  this class is used for holding a question.
 *
 * 	@author Shidil Boss
 * 	10-3-2014 12:13 PM
 *
 */
class Question {

    private $table = 'questions';
    public $text;
    public $survey;
    public $id;
    public $type = null;
    public $help;
    public $required;

    // methods

    function Question($ID, $survey, $type, $text, $help, $required) {
        $this->id = $ID;
        $this->survey = $survey;
        $this->type = $type;
        $this->text = $text;
        $this->help = $help;
        $this->required = $required;
    }

    public static function getQuestionByID($qID) {
        $value = Bolt::$db->fetchObject("SELECT * FROM `questions` WHERE `questionID` = '" . Bolt::$db->escape($qID) . "'");

        switch ($value->questionType) {
            case 'TF' :
                return new TFQuestion($value->questionID);
            case 'MC' :
                return new MCQuestion($value->questionID);
            case 'TXT' :
                return new TXTQuestion($value->questionID);
            case 'PARA' :
                return new PARAQuestion($value->questionID);
            case 'CB' :
                return new CBQuestion($value->questionID);
            case 'CL' :
                return new CLQuestion($value->questionID);
            case 'NUM' :
                return new NUMQuestion($value->questionID);
            case 'DATE' :
                return new DATEQuestion($value->questionID);
            default :
                return new Question($value->questionID, $value->surveyID, $value->questionType, $value->text, $value->help, $value->required);
        }
    }

    public function getID() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
    }

    public function getText() {
        return $this->text;
    }

    public function getHelp() {
        return $this->help;
    }

    public function getSurvey() {
        return $this->survey;
    }

    public function getTypeText() {
        if ($this->type == 'TF')
            return 'True or false';
    }

    public function toString() {
        return '';
    }

    public function getAnswers() {
        $details = Bolt::$db->fetchAll("SELECT * FROM answers WHERE questionID = " . $this->id);
        $answers = array();
        foreach ($details as $key => $value) {
            
            $answers[$key] = new Answer($value->answerID, $value->questionID,$value->answer, $value->date, $value->author);
        }
        return $answers;
    }
    public function getChoices(){
         $details = Bolt::$db->fetchAll("SELECT * FROM choices WHERE questionID = " . $this->id);
        $choices = array();
        foreach ($details as $key => $value) {
            
            $choices[$key] = new Choice($value->choiceID, $value->questionID,$value->values);
        }
        return $choices;
    }
}

?>
