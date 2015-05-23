<?php

include 'config.php';

function getConfig() {
    global $config;
    return($config);
}

session_start();
include 'include/loader.php';
Bolt::connect();
$uSys = new UserSystem;
$sSys = new SurveySystem;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ($_POST) {
    switch ($_POST['action']) {
        case 'design':
            if ($_POST['theme'] and $_POST['sID']) {
                $surveyID=  decryptMe($_POST['sID']);
                if(Bolt::$db->update('surveys', array('design'), array($_POST['theme']), 'surveyID=\'' . $surveyID . '\''))
                     echo 'done';
            }
            exit();
        case 'delQ':
            $qID = $_POST['qID'];
            echo $sSys->deleteQuestion(decryptMe($qID));
            exit();
            break;
         case 'delU':
            $uID = $_POST['uID'];
            echo $uSys->deleteUser(decryptMe($uID));
            exit();
            break;
        case 'delS':
            $sID = $_POST['sID'];
            echo $sSys->deleteSurvey(decryptMe($sID));
            exit();
            break;
        case 'editS':
            $sID = $_POST['sID'];
            $sID = decryptMe($sID);
            $name = $_POST['name'];
            echo Bolt::$db->update('surveys', array('surveyName'), array($name), "`surveyID`=" . Bolt::$db->escape($sID) . "");
            exit();
            break;
        case 'getQ':
            $qID = $_POST['qID'];
            $qID = decryptMe($qID);
            $question = Question::getQuestionByID($qID);
            $answers = $question->getAnswers();
            //var_dump($answers);
            if ($question->getType() == 'TF') {
                $true = 0;
                $false = 0;
                foreach ($answers as $key => $value) {
                    //  var_dump($value);
                    if ($value->getAnswer() == 'true')
                        $true++;
                    elseif ($value->getAnswer() == 'false')
                        $false++;
                }
                $data = $true . '**' . $false;
            }
            if ($question->getType() == 'MC' or $question->getType() == 'CB' or $question->getType() == 'CL') {
                $choices = $question->getChoices();
                //var_dump($choices);
                $labels = array();
                $counts = array();
                foreach ($choices as $key => $value) {
                    $counts[$value->getValue()] = 0;
                }

                foreach ($choices as $key => $value) {
                    $labels[$key] = $value->getValue();
                }
                //var_dump($labels);
                foreach ($answers as $key => $value) {
                    foreach ($choices as $value1) {
                        if ($value->getAnswer() == $value1->getValue())
                            $counts[$value1->getValue()] ++;
                    }
                }
                $data = implode('$$', $labels) . '**' . implode('%%', $counts);
            }
			            echo'
                <div class="stat_title">' . $question->getText() . '<span>' . $question->getTypeText() . '</span></div>';
                  if($question->getType() == 'TXT' or $question->getType() == 'PARA'){
				foreach ($answers as $key => $value){
					echo '<br>';
					echo $key+1;
                                        echo '. ';
					echo $value->getAnswer();
					
				}
			}
                        else echo '
                <div id="q_chart"style="height:300px; width:500px;margin: 30px 0px 0px 27px;"></div> ';

                echo '<div class="stat_details">Total answers : ' . count($answers) . '</div>
                ##' . $question->getType() . '##' . $data;
				
				
            exit();
        default : break;
    }
}
?>