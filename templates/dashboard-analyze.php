<?php

includeFile('header-logout');
//$surveys=$sSys->getSurveys();
$surveyID = decryptMe(Bolt::$_get['id']);
$sSys=new SurveySystem;
$uSys = new UserSystem;
$survey= $sSys->getSurveyByID($surveyID);
$url=DOMAIN . 'dashboard/?action=edit&id=' . encryptMe($surveyID);

if($survey==FALSE){
		includeFile('survey-404');
}
elseif($survey->getAuthor()!=$uSys->getUser()->getID()){
	includeFile('survey-404');
}
else {
	$questions= $survey->getQuestions();


?>
<div id="loading"></div>

<div id="survey_counts"></div>
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
    <div id="main">
        

    </div>
	<div id="content_summary">
	
            summary
	</div>
    	<div id="content_respondants">
            respondents
            
	</div>
        <div id="sidebar">
            <div id="sidebar_container">
                <div id="analyze_summary" class="analyze_button analyze_button_selected">
                    <span>
                        Summary
                    </span>
                </div>
                <div id="analyze_respondents" class="analyze_button">
                    <span>
                        Respondents
                    </span>
                </div>
                 <div id="analyze_questions" class="analyze_button">
                    <span>
                        Questions
                    </span>
                </div>
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
			{ type: 'left', size: 200, resizable: true, minSize: 120, content:$('#sidebar').html()},
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
                   // switch (event.target) {
		//	case 'access':
			//w2ui.layout.content('main',$('#main').html());
			//break;
		}
	}
}

$(function () {
	// initialization
	$('#layout').w2layout(config.layout);
	//w2ui.layout.content('left', $().w2sidebar(config.sidebar));
        w2ui.layout.content('main', '<div id="chart_summary" style="height:460px; width:1100px;margin: 15px 0px 0px 27px;"></div>', 'flip-left');
        drawSummaryChart('chart_summary');
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
<?php
    $days=$survey->getCountOfDays('03');
    $days=implode(',', $days);
?>
<script type="text/javascript">
    
        
    function drawSummaryChart(target) {
    $('#survey_counts').html('Total : '+<?php echo count($survey->getParticipants()); ?>)
    //var plot1 = $.jqplot(target, [[3, 7, 9, 1, 4, 6, 8, 2, 5]]);
    var line1 = [<?=$days ?>];
    var plot1 = $.jqplot(target, [line1], {
        title: 'Submissions in march',
         axes: {
        // options for each axis are specified in seperate option objects.
        xaxis: {
          label: "Days of march",
          // Turn off "padding".  This will allow data point to lie on the
          // edges of the grid.  Default padding is 1.2 and will keep all
          // points inside the bounds of the grid.
          pad: 0
        },
        yaxis: {
          label: "Number of submits",
          format:"%d"
        }
      },
        highlighter: {
            show: true,
            sizeAdjust: 2.5
        },
        cursor: {
            show: false
        }
    });
}
    function drawRespondentsChart(target) {     
        var a=parseInt(Math.random()*100+1);
        $('#grid').w2grid({ 
                name: a, 
                show: { lineNumbers: true ,
                                                toolbar: true,
                                                toolbarAdd: false,
                                                toolbarDelete: false,
                                                toolbarEdit: false
                        }, 
                columns: [				
                        { field: 'date', caption: 'Date', size: '24%', resizable:true,sortable: true },
                        { field: 'ip', caption: 'IP', size: '20%', resizable:true,sortable: true },
                        { field: 'email', caption: 'Email', size: '24%', resizable:true,sortable: true },
                        { field: 'id', caption: 'Participant ID', resizable:true,size: '24%', sortable: true }
                ],
                records: [
                        <?php 	
                            $records='';
                            $participants=$survey->getParticipants();
                            foreach ($participants as $key => $value) {
                                    $records.='{';
                                    $records.="recid: ".($key+1).',';
                                    $records.="id: '".encryptMe($value->getID())."',";
                                    $records.="date: '".$value->getDate()."',";
                                    $records.="ip: '".$value->getIP()."',";
                                    $records.="email: '".$value->getEmail()."',";
                                    $records.='},';

                            }
                            $records= rtrim($records,',');
                            echo $records;
                        ?>
                ]
        });	
}
function drawQuestionsChart(target) {     
        var aa=parseInt(Math.random()*1000+1);
        $('#grid1').w2grid({ 
                name: aa, 
                show: { lineNumbers: true ,
                                                toolbar: true,
                                                toolbarAdd: false,
                                                toolbarDelete: false,
                                                toolbarEdit: false
                        },
               
                columns: [				
                        { field: 'title', caption: 'Title', size: '24%', resizable:true,sortable: true },
                        { field: 'type', caption: 'Type', size: '20%', resizable:true,sortable: true },
                        { field: 'id', caption: 'ID', resizable:true,size: '24%', sortable: true }
                ],
                records: [
                        <?php 	
                        
                            $records='';
                            $questions=$survey->getQuestions();
                            foreach ($questions as $key => $value) {
                                    $records.='{';
                                    $records.="recid: ".($key+1).',';
                                    $records.="id: '".encryptMe($value->getID())."',";
                                    $records.="title: '".$value->getText()."',";
                                    $records.="type: '".$value->getTypeText()."',";
                                    $records.='},';

                            }
                            $records= rtrim($records,',');
                            echo $records;
                        ?>
                ],
                onClick: function (event) {
          
                        var ID=w2ui[''+event.target].get(event.recid).id;
                        $.post("http://localhost/survey/ajax.php", {
                            action: 'getQ',
                            qID: ID
                         }).done(function(data) {
                            var splits=data.split('##');
                            $('#grid_content').slideToggle("swift");
                            $('#grid_content').html(splits[0]);
                            var type=splits[1];
                            if(type=='TF'){
                            var dataP=splits[2];
                            var dataA=dataP.split('**');
                            drawTrueFalseChart(dataA);
                        }
                        else if(type=='MC'||type=='CB'||type=='CL'){
                                var dataP=splits[2];
                                var dataA=dataP.split('**');
                                var labels1=dataA[0].split('$$');
                                var values1=dataA[1].split('%%');
                                var labels=[];
                                var values=[];
                            for(i=0;i<labels1.length;i++){
                                labels[i]=[labels1[i]];
                            }
                             for(i=0;i<values1.length;i++){
                                values[i]=[values1[i]];
                            }
                            drawPieChart(labels,values);
                        }
                            $('#grid_content').slideToggle("swift");
                          })
			
		}
        });	
        
}
function drawTrueFalseChart(data){

        var s1 = [data[0],0];
    var s2 = [0,data[1]];
    // Can specify a custom tick Array.
    // Ticks should match up one for each y value (category) in the series.
    var ticks = ['True', 'False'];
     
    var plot1 = $.jqplot('q_chart', [s1, s2], {
        // The "seriesDefaults" option is an options object that will
        // be applied to all series in the chart.
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            rendererOptions: {fillToZero: true}
        },
        // Custom labels for the series are specified with the "label"
        // option on the series option.  Here a series option object
        // is specified for each series.
        series:[
            {label:'True'},
            {label:'False'}
        ],
        // Show the legend and put it outside the grid, but inside the
        // plot container, shrinking the grid to accomodate the legend.
        // A value of "outside" would not shrink the grid and allow
        // the legend to overflow the container.
        legend: {
            show: true,
            placement: 'outsideGrid'
        },
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks
               // pad:5
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
               // pad: 1.05,
                tickOptions: {formatString: '%d'}
            }
        },
            highlighter: {
            show: true,
            sizeAdjust: 2.5
        }
    });
        }
 function drawPieChart(labels,data){
    // alert(labels);
    // alert(data);
      var data1 = [];
     // alert(labels.length);
      for(i=0;i<labels.length;i++){
          
          data1[i]=[labels[i],parseInt(data[i])];
        }
       
  var plot2 = jQuery.jqplot ('q_chart', [data1], 
   { 
      seriesDefaults: {
        // Make this a pie chart.
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: {
          // Put data labels on the pie slices.
          // By default, labels show the percentage of the slice.
          showDataLabels: true
        }
      }, 
      legend: { show:true, location: 'e' }
    }
  );
 }
</script>

<?php } ?>
<?php
includeFile('footer');
?>

