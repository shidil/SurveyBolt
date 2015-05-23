<?php
/**
 *	Survey class.
 *  this class is used for holding a survey.
 *
 *	@author Shidil Boss
 *	9-3-2014 12:13 PM
 *
 */

class Survey {

	private $table = 'surveys';
	public $name;
	public $id;
	public $author = null;
	protected $questions = array();
	public $access;
	public $password;
	// methods

	function Survey($ID, $name, $user) {
		$this -> id = $ID;
		$this -> author = $user;
		$this -> name = $name;
		$value = Bolt::$db -> fetchObject("SELECT * from surveys WHERE surveyID=" . Bolt::$db -> escape($ID));
		$this -> access = $value -> access;
		$this -> password = $value -> password;
		$this -> updateQuestions();
	}
public function getDesignById($surveyId) {
		$details = Bolt::$db -> fetchAll("SELECT * FROM surveys where surveyID=" .$surveyId);
		foreach ($details as $key => $value)
		$i=$value->design;
		return $i;
	}
	public function updateQuestions() {
		$surveyID = Bolt::$db -> connection -> real_escape_string($this -> id);
		$details = Bolt::$db -> fetchAll("SELECT * FROM questions WHERE surveyID = " . $surveyID);
		$this -> questions = array();
		foreach ($details as $key => $value) {
			switch ($value->questionType) {
				case 'TF' :
					$this -> questions[$key] = new TFQuestion($value -> questionID);
					break;
				case 'MC' :
					$this -> questions[$key] = new MCQuestion($value -> questionID);
					break;
				case 'TXT' :
					$this -> questions[$key] = new TXTQuestion($value -> questionID);
					break;
				case 'PARA' :
					$this -> questions[$key] = new PARAQuestion($value -> questionID);
					break;
				case 'CB' :
					$this -> questions[$key] = new CBQuestion($value -> questionID);
					break;
				case 'CL' :
					$this -> questions[$key] = new CLQuestion($value -> questionID);
					break;
                                case 'NUM' :
					$this -> questions[$key] = new NUMQuestion($value -> questionID);
					break;
                                case 'DATE' :
					$this -> questions[$key] = new DATEQuestion($value -> questionID);
					break;
				default :
					$this -> questions[$key] = new Question($value -> questionID, $value -> surveyID, $value -> questionType, $value -> text, $value -> help, $value -> required);
					break;
			}

		}
	}

	public function getQuestions() {
		$this -> updateQuestions();
		return $this -> questions;
	}
	
	public function getID() {
		return $this -> id;
	}

	public function getAuthor() {
		return $this -> author;
	}

	public function getName() {
		return $this -> name;
	}

	public function addQuestion($q_title, $q_type, $q_req, $q_help, $choices) {
		$res=Bolt::$db -> insert(array('surveyID', 'questionType', 'required', 'text', 'help'), array($this -> id, $q_type, $q_req, $q_title, $q_help), 'questions');
		$value = Bolt::$db -> fetchObject("SELECT questionID from questions WHERE surveyID=".Bolt::$db->escape($this->id)."  AND questionType='".Bolt::$db->escape($q_type)."' AND text='".Bolt::$db->escape($q_title)."' ORDER BY questionID DESC LIMIT 0,1");
		$qID=$value->questionID;
		if (is_array($choices)) {
			foreach($choices as $key => $choice){
                                if($choice!='')
                                    Bolt::$db->insert(array('questionID','`values`'), array($qID,$choice), 'choices');
                              
			}
			
		}
                return $res;
	}
        public function getParticipants(){
            $details = Bolt::$db -> fetchAll("SELECT * FROM participants WHERE surveyID = " . $this->id);
            $participants=array();
            foreach ($details as $key => $value) {
                $participants[$key]=new Participant($value->participantID, $value->ip, $value->date, $value->surveyID,$value->email);
            }
            return $participants;
        }
        public function getParticipantsOfMonth($month){
            $participants=  $this->getParticipants();
            $Nparticipants = array();
            $i=-1;
            foreach ($participants as $key => $value) {
                $date=$value->getDate();
                if(substr($date, 5,2)==$month){
                    $i++;
                    $Nparticipants[$i]=$value;
                }
            }
            return $Nparticipants;
        }
        public function getCountOfDays($month){
            $participants=  $this->getParticipantsOfMonth($month);
            $days=array();
            for($i=0;$i<31;$i++) $days[$i]=0;
            foreach ($participants as $key => $value) {
                $days[substr($value->date, 8,2)-1]++;
            }
            return $days;
        }
}
?>
