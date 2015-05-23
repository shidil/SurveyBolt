<?php

includeFile('header-logout');
$sSys=new SurveySystem;
$surveys=$sSys->getSurveyList();
$records='';
foreach ($surveys as $key => $value) {
	$records.='{';
	$records.="recid: ".($key+1).',';
        $records.="sID: '".encryptMe($value->surveyID)."',";
	$records.="sname: '".$value->surveyName."',";
	$records.="cdate: '".$value->date."',";
	$records.="mdate: '".$value->modified."',";
	$records.="url: '<a href=\"".DOMAIN."app/".encryptMe($value->surveyID)."\">".DOMAIN."app/".encryptMe($value->surveyID)."</a>',";
	$records.="actions: '<a style=\"background: url(../contents/images/pie.png) no-repeat left;background-size:30%;padding: 5px 5px 5px 29px;border-right: 1px solid #867474;\"href=\"".DOMAIN."dashboard/action=analyze&id=".encryptMe($value->surveyID)."\">Analyze</a><a style=\"background: url(../contents/images/pen.png) no-repeat left;background-size: 44%;padding: 7px 5px 8px 29px;border-right: 1px solid #867474;\"href=\"".DOMAIN."dashboard/action=edit&id=".encryptMe($value->surveyID)."\">Edit</a><a style=\"background: url(../contents/images/del.png) no-repeat left;background-size: 39%;padding: 7px 0px 8px 29px;\"href=\"#\" onclick=\"deleteSurvey(".encryptMe($value->surveyID).")\">Delete</a>'";
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
					name: 'surveyslist', 
					show: { lineNumbers: true ,
									toolbar: true,
									toolbarAdd: true,
									toolbarDelete: true,
									toolbarEdit: false
						},
						searches: [				
							{ field: 'sname', caption: 'Survey Name', type: 'text' },
						],	
						onAdd: function (event) {
							openPopup();
						},
						onEdit: function (event) {
							w2alert('edit');
						},
						onDelete: function (event) {
							  var ID=w2ui['surveyslist'].get(w2ui['surveyslist'].getSelection()).sID;
                                                    console.log( w2ui['surveyslist'].get(w2ui['surveyslist'].getSelection()).sID);
                                                       $.post("<?php echo DOMAIN; ?>ajax.php", {
                                                         action:'delS',
                                                        sID: ID
                                                }).done(function(data) {
							console.log(data);
						});
                                            },
					columns: [{ field: 'sname', caption: 'Survey Name', size: '26%', resizable:true,sortable: true },
						// { field: 'sID', caption: '', size: '0%', resizable:true,sortable: false },
                                                { field: 'cdate', caption: 'Created', size: '14%', resizable:true,sortable: true },
						{ field: 'mdate', caption: 'Modified', size: '14%', resizable:true,sortable: true },
						{ field: 'url', caption: 'URL', size: '23%', resizable:true,sortable: false },
						{ field: 'actions', caption: 'Actions', size: '20%', resizable:true,sortable: false }
					],
					records: [
						<?php echo $records; ?>
					]
				});	w2ui['surveyslist'].toggleColumn('sID');
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
