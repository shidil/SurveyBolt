<?php

includeFile('header-logout');
//$surveys=$sSys->getSurveys();
$userID = decryptMe(Bolt::$_get['id']);
$sSys=new SurveySystem;
$uSys = new UserSystem;

$surveys=$sSys->getAllSurveyList($userID);
$records='';
foreach ($surveys as $key => $value) {
	$records.='{';
	$records.="recid: ".($key+1).',';
       //  $records.="uID: '".encryptMe($value->surveyID)."',";
	$records.="name: '".$value->surveyName."',";
	$records.="cdate: '".$value->date."',";
	$records.="mdate: '".$value->modified."',";
	$records.="url: '".DOMAIN."app/".encryptMe($value->surveyID)."',";
	$records.="actions: '<a href=\"".DOMAIN."dashboard/action=viewquest&id=".encryptMe($value->surveyID)."\">View Questions</a>'";
	$records.='},';
	
}$records= rtrim($records,',');
?>
<div id="layout" style="width: 100%; height: 85%">
	<div id="main">
		<div id="survey_list">
			
			
			<div id="grid" style="width: 100%; height: 500px;"></div>
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
							{ field: 'name', caption: 'Survey Name', type: 'text' },
						],	
						onAdd: function (event) {
							openPopup();
						},
						onEdit: function (event) {
							w2alert('edit');
						},
						onDelete: function (event) {
					
						},
					columns: [				
						{ field: 'name', caption: 'Survey Name', size: '26%', sortable: true },
						{ field: 'cdate', caption: 'Created', size: '15%', sortable: true },
						{ field: 'mdate', caption: 'Modified', size: '15%', sortable: true },
						{ field: 'url', caption: 'URL', size: '20%', sortable: false },
						{ field: 'actions', caption: 'Actions', size: '20%', sortable: false }
					],
					records: [
						<?php echo $records; ?>
					]
				});w2ui['surveys'].toggleColumn('uID');	
			});
			</script>
			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function() {
		var pstyle = 'border: 1px solid #dfdfdf; padding: 5px;';
		$('#layout').w2layout({
			name : 'layout',
			panels : [{
				type : 'main',
				style : pstyle + 'border-top: 0px;',
				content : $('#main').html(),

			}]
		});
	}); 
</script>

<?php
includeFile('footer');
?>
