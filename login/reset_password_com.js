$(document).ready(function () {
    // if both email and phone number input is not empty, enable submit
    $('#email, #contact_no').keyup(function () {
        if ($('#email').val() != '' && $('#contact_no').val() != '') {
            // check if phone number matches regex pattern 
            if (($('#contact_no').val().match(/^01[0-9]{8}$/)) || ($('#contact_no').val().match(/^01[0-9]{9}$/)) ) {
                $('#submit').prop('disabled', false);
                $('#error').hide();
            }
            else {
                $('#error').show();
                $('#submit').prop('disabled', true);
            } 
        } else {
            $('#submit').prop('disabled', true);
        }
    });
    // click submit ajax post to backend and show the next form
    $('#submit').click(function () {
        $('#notFound').hide();
        $('#loadCheck').show();
        var formData = {
            email : $('#email').val(),
            contact_no : $('#contact_no').val()
        }
        $.ajax({
            type: "POST",
            url: "reset_password_com_process.php",
            data: formData,
            success: function(){
                $('#checkForm').hide();
                $('#loadCheck').hide();
                $('#changeForm').show();
            },
            error: function(){
                $('#notFound').show();
                $('#loadCheck').hide();
            }
      });
    });
    // password validation
    $('#confirm_password').keyup(function () {
        if ($('#password').val() != $('#confirm_password').val()) {
            $('#errorPass').show();
            $('#passSubmit').prop('disabled', true);
        }
        else{
            $('#errorPass').hide();
            $('#passSubmit').prop('disabled', false);
        }
    });
    // append username when posting form
    $('form#updatePassword').submit(function () {
        $('form#updatePassword').append('<input name="email" type="hidden" value="'+$('#email').val()+'" />');
    });
});