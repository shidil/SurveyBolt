<?php

includeFile('header-logout');
$sSys=new SurveySystem;
$surveys=$sSys->getSurveyList();
$records='';
foreach ($surveys as $key => $value) {
	$records.='{';
	$records.="recid: ".($key+1).',';
	$records.="name: '".$value->surveyName."',";
	$records.="cdate: '".$value->date."',";
	$records.="mdate: '".$value->modified."',";
	$records.="url: '".DOMAIN."survey/".encryptMe($value->surveyID)."',";
	$records.="actions: '<a href=\"".DOMAIN."dashboard/action=edit&id=".encryptMe($value->surveyID)."\">Edit</a>'";
	$records.='},';
	
}$records= rtrim($records,',');
?>
<div id="layout" style="width: 100%; height: 85%">
	<div id="main">
		<div id="survey_list">
			
			<div id="new_survey" onclick="openPopup()">
				New Survey
			</div>
			<div id="grid" style="width: 100%; height: 500px;"></div>
			<script type="text/javascript">
			$(function () {
				$('#grid').w2grid({ 
					name: 'surveys', 
					show: { lineNumbers: true ,
									toolbar: true,
									toolbarAdd: true,
									toolbarDelete: true,
									toolbarEdit: true
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
							console.log('delete has default behaviour');
						},
					columns: [				
						{ field: 'name', caption: 'Survey Name', size: '26%', sortable: true },
						{ field: 'cdate', caption: 'Created', size: '15%', sortable: true },
						{ field: 'mdate', caption: 'Modified', size: '15%', sortable: true },
						{ field: 'url', caption: 'URL', size: '20%', sortable: false },
						{ field: 'actions', caption: 'Actions', size: '20%', sortable: false },
					],
					records: [
						<?php echo $records; ?>
					]
				});	
			});
			</script>
			<?php// $sSys -> printSureyList(); ?>
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
<script type="text/javascript">
function openPopup () {
	$().w2form({
		name: 'foo',
		url : 'http://localhost/survey/dashboard/?action=edit',
		style: 'border: 0px; background-color: transparent;',
		formHTML: '<form id="new_form" method="post" action="<?php echo DOMAIN;?>dashboard/?action=new">'+
			'<div class="w2ui-page page-0">'+
			'	<div class="w2ui-label">Survey Name:</div>'+
			'	<div class="w2ui-field">'+
			'		<input name="name" type="text" size="35"/>'+
			'	</div>'+
			'</div>'+
			'<div class="w2ui-buttons">'+
			'	<input type="button" value="Reset" name="reset">'+
			'	<input type="button" value="Save" name="save">'+
			'</div></form>',
		fields: [
			{ name: 'name', type: 'text', required: true }
		],
		actions: {
			"save": function () { 			
				var errors = this.validate(true);
				if (errors.length !== 0) {
					return;
				}$('#new_form').submit();
			},
			"reset": function () { this.clear(); },
		}
	});
	$().w2popup('open', {
		title	: 'Create a new Survey',
		body	: '<div id="form" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form').w2render('foo');
			}
		}
	});
}
</script>

<?php
includeFile('footer');
?>
