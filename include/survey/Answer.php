<?php
class Answer {
	public $id;
	public $question;
	public $date;
        public $answer;
        public $author;
	function Answer($answerID, $questionID,$answer, $date, $author) {
		$this->date = $date;
		$this->question=$questionID;
                $this->answer=$answer;
		$this->id=$answerID;
                $this->author=$author;
	}
	public function getID(){
		return $this->id;
	}
        public function getQuestion(){
            return $this->question;
        }
        public function getDate(){
            return $this->date;
        }
        public function getAuthor(){
            return $this->author;
        }   
        public function getAnswer(){
            return $this->answer;
        }

}
?>