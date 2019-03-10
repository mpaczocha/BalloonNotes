// Ajax Call for the sign up form
// Once the form is submitted
$("#signupform").submit(function(event){
    // prevent default php processing
    event.preventDefault();
    // collect user inputs
    var datatopost = $(this).serializeArray();
    // console.log(datatopost);
    // send them to signup.php using AJAX
        // $.post({}).done().fail(); Alternative method for ajax call
        // $.get().done().fail(); Alternative method for ajax call
    $.ajax({
        url: "signup.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data){
                $("#signupmessage").html(data);
            }
        },
        error: function(){
            $("#signupmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later</div>");
        },
    });
});

// Ajax Call for the login form
// Once the form is submitted
$("#loginform").submit(function(event){
    // prevent default php processing
    event.preventDefault();
    // collect user inputs
    var datatopost = $(this).serializeArray();
    // console.log(datatopost);
    // send them to login.php using AJAX
        // $.post({}).done().fail(); Alternative method for ajax call
        // $.get().done().fail(); Alternative method for ajax call
    $.ajax({
        url: "login.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data == "success"){
                window.location = "http://mpaczocha.pl/mainpageloggedin.php";
            }else{
                $("#loginmessage").html(data);
            }
        },
        error: function(){
            $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later</div>");
        },
    });
});

// Ajax Call for the forgot password form
// Once the form is submitted
$("#forgotpasswordform").submit(function(event){
    // prevent default php processing
    event.preventDefault();
    // collect user inputs
    var datatopost = $(this).serializeArray();
    // console.log(datatopost);
    // send them to forgotpassword.php using AJAX
        // $.post({}).done().fail(); Alternative method for ajax call
        // $.get().done().fail(); Alternative method for ajax call
    $.ajax({
        url: "forgotpassword.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            $("#forgotpasswordmessage").html(data);
        },
        error: function(){
            $("#forgotpasswordmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later</div>");
        },
    });
});

// Ajax Call for the contact form
// Once the form is submitted
$("#contact-form").submit(function(event){
    // prevent default php processing
    event.preventDefault();
    // collect user inputs
    var datatopost = $(this).serializeArray();
    // console.log(datatopost);
    // send them to forgotpassword.php using AJAX
        // $.post({}).done().fail(); Alternative method for ajax call
        // $.get().done().fail(); Alternative method for ajax call
    $.ajax({
        url: "contact.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            $("#contactmessage").html("<div class='alert alert-success'>The e-mail was sent.</div>");
        },
        error: function(){
            $("#contactmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later</div>");
        },
    });
});

