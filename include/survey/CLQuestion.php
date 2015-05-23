<?php
/**
 *	CLQuestion class.
 *  this class is used for holding a multiple choice question
 *  extends Question class
 *	@author Shidil Boss
 *	13-3-2014 2:49 AM
 *
 */
/**
 *
 */
class CLQuestion extends Question {

	protected $choices = array();

	function CLQuestion($ID) {
		$value = Bolt::$db -> fetchObject("SELECT * from questions WHERE questionID=" . Bolt::$db -> escape($ID));
		parent::Question($value -> questionID, $value -> surveyID, $value -> questionType, $value -> text, $value -> help, $value -> required);
		// fetch choices

		$choices = Bolt::$db -> fetchAll("SELECT * from choices WHERE questionID=" . Bolt::$db -> escape($ID));
		foreach ($choices as $key => $value) {
			$this -> choices[$key] = $value -> values;
		}

	}

	public function toString() {
		$ide = encryptMe($this -> getID());
		$req=($this->required=='true')?'required':'notrequired';
		$out = '
						<div class="survey_item">
							<div class="item_title">' . $this -> getText() . '</div>
							<div class="item_help_button" data="' . $this -> getHelp() . '"></div>
							<div class="item_feild">
							<select name="' . $ide . '" '.$req.'">';
		foreach ($this->choices as $key => $value) {
			$out.= '<option  value="'.$value.'" '.$req.'/>'.$value.'</option>';
		}

		$out.= '				</select></div>
						</div>';
		return $out;
	}
	public function getTypeText(){
		return 'Choose from a list';
	}
}
?>