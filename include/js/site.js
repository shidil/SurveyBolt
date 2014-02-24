$(document).ready(function() {
	$("#highlights_login").on("click", function() {
		$('#login_form').w2popup();
	});
	$("#highlights_register").on("click", function() {
		$('#register_form').w2popup();
	});
});

$().ready(function() {

	// validate signup form on keyup and submit
	$("#reg_form").validate({
		rules : {
			name : "required",
			username : {
				required : true,
				minlength : 2
			},
			password : {
				required : true,
				minlength : 5
			},
			passwordconf : {
				required : true,
				minlength : 5,
				equalTo : "#password"
			},
			email : {
				required : true,
				email : true
			}
		},
		messages : {
			name : "Please enter your full name",
			username : {
				required : "Please enter a username",
				minlength : "Your username must consist of at least 2 characters"
			},
			password : {
				required : "Please provide a password",
				minlength : "Your password must be at least 5 characters long"
			},
			passwordconf : {
				required : "Please provide a password",
				minlength : "Your password must be at least 5 characters long",
				equalTo : "Please enter the same password as above"
			},
			email : "Please enter a valid email address"
		}
	});
});
