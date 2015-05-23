<?php
/**
 *	NUMQuestion class.
 *  this class is used for holding a True or false question
 *  extends Question class
 *	@author Shidil Boss
 *	9-3-2014 12:13 PM
 *
 */
/**
 *
 */
class NUMQuestion extends Question {

	

	function NUMQuestion($ID) {
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
								<input type="number" name="' . $ide . '" size="100" '.$req.' />
							</div>
						</div>';
	}
	public function getTypeText(){
		return 'Number';
	}
}
?>