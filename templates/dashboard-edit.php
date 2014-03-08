<?php

includeFile('header-logout');
//$surveys=$sSys->getSurveys();
$surveyID = decryptMe(Bolt::$_get['id']);
?>sdsd
<div id="layout" style="width: 100%; height: 85%">
	<div id="main">
		<div id="survey_list">
			<div id="new_survey" onclick="window.location='<?php echo DOMAIN; ?>dashboard/?action=new'">
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
							w2alert('add');
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
						{ recid: 1, name: 'John', cdate: 'Doe', url: 'jdoe@gmail.com', mdate: '1/3/2012',actions:'fvvf'},
						{ recid: 2, name: 'Stuart', cdate: 'Motzart', url: 'motzart@gmail.com', mdate: '4/3/2012' ,actions:'fvvf'},
						{ recid: 3, name: 'Jin', cdate: 'Franson', url: 'franson@gmail.com', mdate: '2/3/2012' ,actions:'fvvf'},
						{ recid: 4, name: 'Frank', cdate: 'Ottie', url: 'ottie@gmail.com', mdate: '4/3/2012' ,actions:'fvvf'},
						{ recid: 5, name: 'Kelly', cdate: 'Silver', url: 'ksilver@gmail.com', mdate: '5/3/2012' ,actions:'fvvf'},
						{ recid: 6, name: 'Francis', cdate: 'Gatos', url: 'fgotya@gmail.com', mdate: '4/4/2012' ,actions:'fvvf'},
						{ recid: 7, name: 'Dimas', cdate: 'Welldo', url: 'dimas@gmail.com', mdate: '7/3/2012' ,actions:'fvvf'},
						{ recid: 8, name: 'Thomas', cdate: 'Bahh', url: 'bahhtee@gmail.com', mdate: '4/3/2012' ,actions:'fvvf'},
						{ recid: 9, name: 'Ottie', cdate: 'Welldo', url: 'doe@gmail.com', mdate: '4/3/2012' ,actions:'fvvf'},
						{ recid: 10, name: 'Thomas', cdate: 'Bahh', url: 'jane@gmail.com', mdate: '9/4/2012' ,actions:'fvvf'},
						{ recid: 11, name: 'Kolya', cdate: 'Doe', url: 'follow@gmail.com', mdate: '4/3/2012' ,actions:'fvvf'},
						{ recid: 12, name: 'Martha', cdate: 'Motzart', url: 'joe@gmail.com', mdate: '4/3/2012' ,actions:'fvvf'}
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
<?php
includeFile('footer');
?>
