<?php
/**
 *	PARAQuestion class.
 *  this class is used for holding a True or false question
 *  extends Question class
 *	@author Shidil Boss
 *	9-3-2014 12:13 PM
 *
 */
/**
 *
 */
class PARAQuestion extends Question {

	

	function PARAQuestion($ID) {
		$value = Bolt::$db -> fetchObject("SELECT * from questions WHERE questionID=" . Bolt::$db -> escape($ID));
		parent::Question($value -> questionID, $value -> surveyID, $value -> questionType, $value -> text, $value -> help, $value -> required);

	}

	public function toString() {
		$ide = encryptMe($this -> getID());
		$req=($this->required=='true')?'required':'notrequired';
		return '
						<div class="survey_item">
							<div class="item_title">' . $this -> getText() . '</div>
							<div class="item_help_button" data="' . $this -> getHelp() . '"></div>
							<div class="item_feild">
								<textarea  name="' . $ide . '" rows="5" cols="77" '.$req.' ></textarea>
							</div>
						</div>';
	}
	public function getTypeText(){
		return 'Paragraph text';
	}
}
?>