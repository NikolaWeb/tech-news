$(document).ready(function(){
	
	$('#loginForm').validate({ 
        rules: {
            username: {
                required: true,
                minlength: 3
            },
            password: {
                required: true,
                minlength: 6
			}
		},
		messages: {
			username: {
				required: "Please enter your username",
				minlength: "Your username need to be at least 3 charaters long"
			},			
			password: {
				required: "Password field cannot be blank!",
				minlength: "Your password must be at least 6 characters long"
			}
		},
		submitHandler: function(form){
		form.submit();
		}
    });
	
	$('#registerForm').validate({ 
        rules: {
			email: {
                required: true,
                email: true
            },
            username: {
                required: true,
                minlength: 3
            },
            password: {
                required: true,
                minlength: 6
			},
			passwordAgain: {
				required: true,
                minlength: 6,
				equalTo: '#password'
			}
		},
		messages: {
			email: {
				required: "Email field cannot be blank!",
				email: "Your email is not in a valid format"
			},
			username: {
				required: "Please enter your username",
				minlength: "Your username need to be at least 3 charaters long"
			},			
			password: {
				required: "Password field cannot be blank!",
				minlength: "Your password must be at least 6 characters long"
			},
			passwordAgain: {
				required: "Please confirm your password!",
				minlength: "Your password must be at least 6 characters long",
				equalTo: "Your password and confirmation password do not match!"
			}
		},
		submitHandler: function(form){
		form.submit();
		}
    });
	
	$('#messageForm').validate({ 
        rules: {
            email: {
                required: true,
                email: true
            },
            subject: {
                required: true,
                minlength: 3
			},
			message: {
				required: true,
                minlength: 10
			}
		},
		messages: {
			email: {
				required: "Email field cannot be blank!",
				email: "Your email is not in a valid format"
			},			
			subject: {
				required: "Subject field cannot be blank!",
				minlength: "Your subject is too short"
			},
			message: {
				required: "Please enter a message!",
				minlength: "Your message could be longer..."
				
			}
		},
		submitHandler: function(form){
		form.submit();
		}
    });
	
	
});