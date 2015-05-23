<?php

includeFile('header-logout');
//$surveys=$sSys->getSurveys();
$surveyID = decryptMe(Bolt::$_get['id']);
$sSys=new SurveySystem;
//$survey= new Survey;
//$uSys = new UserSystem;
//$survey= $sSys->getSurveyByID($surveyID);
//$url=DOMAIN . 'dashboard/?action=viewquest&id=' . encryptMe($surveyID);


//if($survey==FALSE){
	//	includeFile('survey-404');
//}

	$questions= $sSys->getQuestionsById($surveyID);
	$records='';
foreach ($questions as $key => $value) {
	switch($value->questionType){
		case 'TXT':$typ='TEXT';break;
		case 'MC':$typ='MULTIPLE CHOICE';break;
		case 'PARA':$typ='PARAGRAPH TEXT';break;
		case 'DATE':$typ='DATE';break;
		case 'TF':$typ='TRUE OR FALSE';break;
		case 'CB':$typ='CHECK BOx';break;
		case 'CL':$typ='CHOOSE FROME A LIST';
	}
	$records.='{';
	$records.="recid: ".($key+1).',';
	$records.="title: '".$value->text."',";
	$records.="type: '".$typ."',";
	$records.='},';
	
}$records= rtrim($records,',');

?>
		<div id="survey_list">
			
			
			<div id="grid" style="width: 99%; height: 500px;"></div>
			
		</div>
</script>
<script type="text/javascript">
			$(function () {
				$('#grid').w2grid({ 
					name: 'surveys', 
					show: { lineNumbers: true ,
									toolbar: true,
									toolbarAdd: false,
									toolbarDelete: true,
									toolbarEdit: false
						},
						searches: [				
							{ field: 'wording', caption: 'Question title', type: 'text' },
						],	
						onAdd: function (event) {
							addQuestion();
						},
						onEdit: function (event) {
							w2alert('edit');
						},
						onDelete: function (event) {
							console.log('delete has default behaviour');
						},
					columns: [				
						{ field: 'title', caption: 'Question Title', size: '60%', sortable: true },
						{ field: 'type', caption: 'Type', size: '40%', sortable: true }
					],
					records: [
						<?php echo $records; ?>
					]
				});	
			});
			</script>
<?php
includeFile('footer');
?>

