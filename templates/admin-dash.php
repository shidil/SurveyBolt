<?php
	includeFile('header-logout');
	$uSys=new UserSystem;
	$users=$uSys->getUserList();
$records='';
foreach ($users as $key => $value) {
	$records.='{';
	$records.="recid: ".($key+1).',';
            $records.="uID: '".encryptMe($value->userID)."',";
	$records.="name: '".$value->userName."',";
	$records.="cdate: '".$value->dateCreate."',";
	if($value->prevl=='admin')
		$records.="actions: 'Admin'";
	else
		$records.="actions: '<a href=\"".DOMAIN."dashboard/action=view&id=".encryptMe($value->userID)."\">View Survey</a>'";
	$records.='},';
}
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
							{ field: 'name', caption: 'User Name', type: 'text' },
						],	
						onAdd: function (event) {
							openPopup();
						},
						onEdit: function (event) {
							w2alert('edit');
						},
						onDelete: function (event) {
									 var ID=w2ui['surveys'].get(w2ui['surveys'].getSelection()).uID;
                                                    console.log( w2ui['surveys'].get(w2ui['surveys'].getSelection()).uID);
                                                       $.post("<?php echo DOMAIN; ?>ajax.php", {
                                                         action:'delU',
                                                        uID: ID
                                                           }).done(function(data) {
							console.log(data);
                                                    });
						},
					columns: [				
						{ field: 'name', caption: 'User Name', size: '26%', sortable: true },
						
						{ field: 'cdate', caption: 'Created', size: '15%', sortable: true },
						{ field: 'actions', caption: 'Actions', size: '20%', sortable: false },
                                                
                                                { field: 'uID', caption: 'UID', size: '0%', sortable: true }
					],
					records: [
						<?php echo $records; ?>
					]
				});	
			});
			</script>
		</div>
	</div>
</div>
<?php
	includeFile('footer');
?>