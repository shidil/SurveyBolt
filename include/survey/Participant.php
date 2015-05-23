<?php
class Participant {
	public $id;
	public $ip='';
	public $date;
        public $answers=array();
        public $survey;
        public $email;
	function Participant($pID,$ip,$date,$sID,$email) {
		$this->date = $date;
		$this->ip=$ip;
		//$this->ip=$ip;
		$this->id=$pID;
                $this->survey=$sID;
                $this->email=$email;
	}
        public static function addParticipant($ID,$email){
                $date = date('Y-m-d H:i:s');
		$ip=sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
		Bolt::$db->insert(array('ip','date','surveyID','email'),array($ip,$date,$ID,$email),'participants');
		//echo "SELECT * FROM participants WHERE ip='".$ip."' AND surveyID='".$ID."' ORDER BY `participantID` DESC LIMIT 0,1";
                $value= Bolt::$db->fetchObject("SELECT * FROM participants WHERE ip='".$ip."' AND surveyID='".$ID."' ORDER BY `participantID` DESC LIMIT 0,1");
		
                return new Participant($value->participantID,$ip,$date,$ID,$email);
        }
	public function getID(){
		return $this->id;
	}
        public function getIP(){
            return $this->ip;
        }
        public function getDate(){
            return $this->date;
        }
        public function getSurvey(){
            return $this->survey;
        }
        public function getEmail(){
            return $this->email;
        }

        public function getAnswers($sID){
            $surveyID = Bolt::$db -> connection -> real_escape_string($sID);
            $value= $details = Bolt::$db -> fetchAll("SELECT questionID FROM questions WHERE surveyID = " . $surveyID);
		$details = Bolt::$db -> fetchAll("SELECT * FROM answers WHERE questionID = " . $surveyID);
        }
}
?>