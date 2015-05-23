<?php


//$surveys=$sSys->getSurveys();
$surveyID = decryptMe(Bolt::$_get['id']);
$sSys=new SurveySystem;
$uSys = new UserSystem;
$survey= $sSys->getSurveyByID($surveyID);
$url=DOMAIN . 'dashboard/?action=edit&id=' . encryptMe($surveyID);
if($_POST){
       // print_r($_POST);
	if(isset($_POST['type'])and isset($_POST['title'])){
		$q_title=$_POST['title'];
		$q_help=$_POST['help'];
		$q_type=$_POST['type'];
		$q_req=$_POST['required'];
                $q_req=($q_req=='on')?'true':'false';
		$q_options=$_POST['options'];
		if($survey->addQuestion($q_title,$q_type,$q_req,$q_help,$q_options)){
                    
                }
	}

}

if($survey==FALSE){
		includeFile('404');
}
elseif($survey->getAuthor()!=$uSys->getUser()->getID()){
	includeFile('404');
}
else {includeFile('header-logout');
	$questions= $survey->getQuestions();
	$records='';
foreach ($questions as $key => $value) {
	$records.='{';
	$records.="recid: ".($key+1).',';
        $records.="qID: '".encryptMe($value->getID())."',";
	$records.="title: '".$value->getText()."',";
	$records.="type: '".$value->getTypeText()."',";
	$records.='},';
	
}$records= rtrim($records,',');

?><div id="loading"></div>
<div id="content_design" style="display: none">
    <div id="design_body">
<h3 style="margin: 48px 46px 27px;">Themes</h3>
<div id="design_form">
	<form action="" method="post">
		
            <div><input type="radio" name="theme" value="1">
		<img src="<?php echo DOMAIN; ?>contents/images/design1.png" style="width:100; "/>Notebook</div>
		<div><input type="radio" name="theme" value="2">
		<img src="<?php echo DOMAIN; ?>contents/images/design2.png" style="width:100; "/>Theme 2</div>
		<div><input type="radio" name="theme" value="3">
		<img src="<?php echo DOMAIN; ?>contents/images/design3.png" style="width:100; "/>Theme 3</div>
		<div><input type="radio" name="theme" value="4">
		<img src="<?php echo DOMAIN; ?>contents/images/design4.png" style="width:100; "/>Theme 4</div>
		<div><input rel="<?php echo encryptMe($survey->getID());?>" type="submit" value="Save" id="login_button" style="margin-top: 71px;margin-right: -146px;"></div>
                
	</form>
</div>
<div id="design_changed">
    Design successfully changed
</div>
</div>
</div>
<div id="layout" style="width: 100%; height: 85%;position: relative" >
	
	<div id="edit_name">
				<fieldset style="margin: 5px;padding: 4px;border: 1px solid #B6B6B6;">
					<legend>Name</legend>
					<div class="field_body">
                                            <input rel="<?php echo encryptMe($survey->getID());?>" type="text" value="<?php echo $survey->getName();?>" id="survey_name"/>
						<button id="survey_name_save">Save</button>
					</div>
				</fieldset>
			</div>
    <div id="main" style="display: none">
		<div id="survey_list">
			
			
			<div id="grid" style="width: 99%; height: 500px;"></div>
                        <div id="access_control" style="width: 99%;height: 500px">
                            <div id="access_container" style="width: 99%;height: 500px">
                                <h2>Select a strategy</h2>
                                <div class="access_item">
                                    <form action="" method="post">
                                    <span>Public</span>
                                    <input type="radio" name="access" value="public" /> 
                                    <span>Password protected</span>
                                    <input type="radio" name="access" value="password" /> 
                                    <div>
                                        <input type="password" name="access_pass" placeholder="password here.."/>
                                    </div>
                                     <div>
                                        <input type="submit" />
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
		</div>
            
	</div>
</div>
<div id="type_select">
				<div rel="title">
					Choose a question type
				</div>
				<div rel="body">
					
					<span style="margin-top: 36px;display: block;margin-left: 30px;">Question type:</span>
					<div id="type_item"  style="margin-top: 20px; display: block;margin-left: 30px;">
						<!--<div value="">- Select a question type -</div>-->
						<div value="TXT">Text</div>
						<div value="PARA">Paragraph text</div>
                                                <div value="NUM">Number</div>
						<div value="DATE">Date</div>
						<div value="TF">True of False</div>
						<div value="MC">Multiple choice</div>
						<div value="CB">Check boxes</div>
						<div value="CL">Choose from a list</div>
	
					</div>
					
					
				</div>
			</div>
<script type="text/javascript">
	var pstyle = 'border: 1px solid #dfdfdf; padding: 0px;';
	var config = {
	layout: {
		name: 'layout',
		padding: 0,
		panels: [
			{ type: 'top', size: 90, resizable: false, content:$('#edit_name').html(),style:'padding: 0px 9px 0px 3px;border-bottom:1px solid rgb(196, 196, 196)' },
			{ type: 'left', size: 200, resizable: true, minSize: 120 },
			{ type: 'main', overflow: 'hidden', 
				content : $('#main').html(),
			style : pstyle + 'border-top: 0px;'
			}
		]
	},
	sidebar: {
		name: 'sidebar',
		nodes: [ 
			{ id: 'general', text: 'Edit survey', group: true, expanded: true, nodes: [
				{ id: 'questions', text: 'Questions', img: 'icon-page',selected:true },
				{ id: 'design', text: 'Design', img: 'icon-page' },
				{ id: 'access', text: 'Access Control', img: 'icon-page' },
				{ id: 'publish', text: 'Publication', img: 'icon-page' }
			]}
		],
		onClick: function (event) {
                    switch (event.target) {
                        case 'questions':
                        window.location='<?php echo DOMAIN.'dashboard/?action=edit&id='.encryptMe($surveyID);?>';
                        break;
			case 'design':
			window.location='<?php echo DOMAIN.'dashboard/?action=design&id='.encryptMe($surveyID);?>';
			break;
                        case 'access':
			window.location='<?php echo DOMAIN.'dashboard/?action=access&id='.encryptMe($surveyID);?>';
			break;
		}
            }
	}
};

$(function () {
	// initialization
	$('#layout').w2layout(config.layout);
	w2ui.layout.content('left', $().w2sidebar(config.sidebar));
        <?php
            if(Bolt::$_get['action']=='design'){
                echo "w2ui.layout.content('main', $('#content_design').html(),'slide-left')";
            }
            if(Bolt::$_get['action']=='access'){
                echo "w2ui.layout.content('main', $('#access_control').html(),'slide-left')";
            }
           if ($_POST['theme']  ) {
               
                
                if(Bolt::$db->update('surveys', array('design'), array($_POST['theme']), 'surveyID=\'' . $surveyID . '\'')){
                     //echo "$('#design_changed').fadeIn('fast');";
                }
                }
           if ($_POST['access']  ) {
               
                if($_POST['access_pass']){
                    
               
                if(Bolt::$db->update('surveys', array('access','password'), array($_POST['access'],$_POST['access_pass']), 'surveyID=\'' . $surveyID . '\'')){
                
                
                }
                }
                
                else
                    if(Bolt::$db->update('surveys', array('access'), array($_POST['access']), 'surveyID=\'' . $surveyID . '\'')){
                    
           }
           }
        ?>
});
	
</script>
<script type="text/javascript">
			$(function () {
				$('#grid').w2grid({ 
					name: 'questions', 
					show: { lineNumbers: true ,
									toolbar: true,
									toolbarAdd: true,
									toolbarDelete: true,
									toolbarEdit: true
						},
						searches: [				
							{ field: 'title', caption: 'Question title', type: 'text' }
						],	
						onAdd: function (event) {
							addQuestion();
						},
						onEdit: function (event) {
							w2alert('edit');
						},
						onDelete: function (event) {
                                                    var ID=w2ui['questions'].get(w2ui['questions'].getSelection()).qID;
                                                    console.log( w2ui['questions'].get(w2ui['questions'].getSelection()).qID);
                                                       $.post("<?php echo DOMAIN; ?>ajax.php", {
                                                         action:'delQ',
                                                        qID: ID
                                                }).done(function(data) {
							console.log(data);
                                                    });
						},
					columns: [				
						{ field: 'title', caption: 'Question Title', size: '60%', resizable: true,sortable: true },
						{ field: 'type', caption: 'Type', size: '40%', resizable: true,sortable: true },
                                                { field: 'qID', caption: 'QID', size: '0%', sortable: true }
					],
					records: [
						<?php echo $records; ?>
					]
				});	w2ui['questions'].toggleColumn('qID');
                               
			});
			</script>
<script type="text/javascript">
function openPopup (type) {
	var form='<form id="new_form" method="post" action="<?php echo $url;?>">'+
			'<div class="w2ui-page page-0">'+
                        '<div style="overflow: scroll;height: 326px;">'+
			'	<div class="w2ui-label">Question Title</div>'+
			'	<div class="w2ui-field">'+
			'		<input name="title" type="text" size="35" placeholder="wording.."/>'+
			'	</div>'+
			'	<div class="w2ui-label">Help Text</div>'+
			'	<div class="w2ui-field">'+
			'		<input name="help" type="text" size="35" placeholder="additinal info.."/>'+
			'	</div><div class="w2ui-label">Required?</div>'+
			'	<div class="w2ui-field">'+
			'		<input name="required" type="checkbox" size="20" placeholder="option.."/>'+
			'	</div>';
			
	
	if(type=='MC' || type=='CB' || type=='CL'){ form+='<div class="w2ui-label">Option 1</div>'+
			'	<div class="w2ui-field">'+
			'		<input name="options[]" type="text" size="20" placeholder="option.." required/>'+
			'	</div>'+
			'<div class="w2ui-label">Option 2</div>'+
			'	<div class="w2ui-field">'+
			'		<input name="options[]" type="text" size="20" placeholder="option.." required/>'+
			'	</div>'+
			'<div class="w2ui-label">Option 3</div>'+
			'	<div class="w2ui-field">'+
			'		<input name="options[]" type="text" size="20" placeholder="option.."/>'+
			'	</div>'+
			'<div class="w2ui-label">Option 4</div>'+
			'	<div class="w2ui-field">'+
			'		<input name="options[]" type="text" size="20" placeholder="option.."/>'+
			'	</div>';
			}
			
			if(type!='')	form+='<input type="hidden" name="type" value="'+type+'"';
	form=form+'</div>'+
			'<div class="w2ui-buttons" style="bottom: 0px;">'+
			'	<input type="button" value="Reset" name="reset">'+
			'	<input type="button" value="Save" name="save">'+
			'</div></div></form>';
			var a=parseInt(Math.random()*100);
	$().w2form({
		name: ''+a,
		url : '<?php echo $url;?>',
		style: 'border: 0px; background-color: transparent;',
		formHTML: form,
		fields: [
			{ name: 'title', type: 'text', required: true },
			{ name: 'help', type: 'text', required: false},
			{ name: 'required', type: 'checkbox', required: false},
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
		height	: 450, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form').w2render(''+a);
				form='';
			}
		}
	});
}
</script>

<?php } ?>
<?php
includeFile('footer');
?>

