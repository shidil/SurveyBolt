<?php
class Choice {
	public $id;
	public $question;
        public $value;
	function Choice($ID, $questionID,$value) {
		$this->value = $value;
		$this->question=$questionID;
		$this->id=$ID;
	}
	public function getID(){
		return $this->id;
	}
        public function getQuestion(){
            return $this->question;
        }
        public function getValue(){
            return $this->value;
        }

}
?>