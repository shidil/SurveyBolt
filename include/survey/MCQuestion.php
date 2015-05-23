<?php
/**
 *	MCQuestion class.
 *  this class is used for holding a multiple choice question
 *  extends Question class
 *	@author Shidil Boss
 *	9-3-2014 12:13 PM
 *
 */
/**
 *
 */
class MCQuestion extends Question {

	protected $choices = array();

	function MCQuestion($ID) {
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
							<div class="item_feild">';
		foreach ($this->choices as $key => $value) {
			$out.= '<input type="radio" name="' . $ide . '" value="'.$value.'" '.$req.'/>'.$value;
		}

		$out.= '				</div>
						</div>';
		return $out;
	}
	public function getTypeText(){
		return 'Mulpiple choice';
	}
}
?>