$(document).ready(function() {
    $("#highlights_login").on("click", function() {
        $('#login_form').w2popup();
    });
    $("#highlights_register").on("click", function() {
        $('#register_form').w2popup();
        // openPopup();
    });

    // survey name change
    $('#survey_name_save').on('click', function() {
        var val = $('#survey_name').val();
         $('#loading').fadeIn("fast");
        $.post("http://localhost/survey/ajax.php", {
            action: 'editS',
            name:val,
            sID: $('#survey_name').attr('rel')
        }).done(function(data) {
            console.log(data);
             $('#loading').fadeOut("fast");
        });
       
        //alert(val);
    });
    /*  $(document.body).on("click",'#register_button',function(e){
     
     e.preventDefault();
     validate();
     });*/
    //drawChart();
});
function addQuestion() {
    $('#type_select').w2popup();
}
$().ready(function() {
    /*$(document.body).on('change','#type_item',function() {
     //openPopup();
     //alert($('#type_item').val());
     });*/
    $(document.body).on('click', '#type_item div', function(e) {
        e.preventDefault();
        openPopup($(this).attr('value'));
    });
    $(document.body).on('click', '#analyze_summary', function(e) {
        e.preventDefault();
        $('#analyze_respondents').removeClass('analyze_button_selected');
        $('#analyze_summary').removeClass('analyze_button_selected');
        $('#analyze_questions').removeClass('analyze_button_selected');
        $('#analyze_summary').addClass('analyze_button_selected');

        w2ui.layout.content('main', '<div id="chart_summary" style="height:460px; width:1100px;margin: 15px 0px 0px 27px;"></div>', 'flip-left');
        drawSummaryChart('chart_summary');
    });
    $(document.body).on('click', '#analyze_respondents', function(e) {
        e.preventDefault();
        $('#analyze_respondents').removeClass('analyze_button_selected');
        $('#analyze_summary').removeClass('analyze_button_selected');
        $('#analyze_questions').removeClass('analyze_button_selected');
        $('#analyze_respondents').addClass('analyze_button_selected');
        w2ui.layout.content('main', '<div id="grid" style="width: 99%; height: 500px;"></div>', 'flip-left');
        drawRespondentsChart('chart_respondents');
    });
    $(document.body).on('click', '#analyze_questions', function(e) {
        e.preventDefault();
        $('#analyze_respondents').removeClass('analyze_button_selected');
        $('#analyze_summary').removeClass('analyze_button_selected');
        $('#analyze_questions').removeClass('analyze_button_selected');
        $('#analyze_questions').addClass('analyze_button_selected');
        w2ui.layout.content('main', '<div id="grid1" style="position: absolute; left: 0px; width: 49.9%;height: 488px;"></div><div id="grid2" style="position: absolute; right: 0px; width: 49.9%; height: 488px;"><div id="grid_content">Select a question from the left to see its statistics</div></div>', 'flip-left');
        drawQuestionsChart('chart_questions');
    });
    $(document.body).on('hover','.item_help_button',function(){
        
        $(this).w2overlay('<div style="padding: 10px; line-height: 150%">'+$(this).attr('data')+'</div>');
    });
    $(document.body).on('click','#design_form input[type=submit]',function(e){
       // e.preventDefault();
         $.post("http://localhost/survey/ajax.php", {
     action: 'design',
     theme: $('#design_form input[type=radio]').val(),
     sID:$('#design_form input[type=submit]').attr('rel')
     }).done(function(data) {
     if(data=='done');
     $('#design_changed').fadeIn('fast');
     });
    });
});


function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}
function deleteSurvey() {
    w2confirm('Are you sure?', function btn(answer) {
        alert(answer);
    });
    /* $.post("http://localhost/survey/ajax.php", {
     action: 'delS',
     sID: ID
     }).done(function(data) {
     console.log(data);
     });*/
}
function drawChart(target) {


    //var plot1 = $.jqplot(target, [[3, 7, 9, 1, 4, 6, 8, 2, 5]]);
    var line1 = [3, 7, 9, 1, 4, 6, 8, 2, 5, 3, 7, 9, 1, 4, 6, 8, 2, 5];
    var plot1 = $.jqplot(target, [line1], {
        title: 'Data Point Highlighting',
        highlighter: {
            show: true,
            sizeAdjust: 2.5
        },
        cursor: {
            show: false
        }
    });


}