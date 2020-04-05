
$(function()
    {
        //set up the click handler of the send button.
        $("#send").click(function()
            {
                var firstname =$("#fname").val();
                var lastname =$("#lname").val();
                var email =$("#email").val();
                var subject =$("#subject").val();

                var feedback = validForm(firstname, lastname, email, subject);
                if (feedback === "") {
                    sendEmail(firstname, lastname, email, subject);
                } else {
                    alert(feedback);
                }
            }
        );

    }
);

function validForm(firstname, lastname, email, subject) {
    var message = "";

    if (firstname === "") message += "Please enter a first name \n\n";
    if (lastname === "") message += "Please enter a last name \n\n";
    if (!/\S+@\S+\.\S+/.test(email)) message += "Please enter a valid email address \n\n";
    if (subject === "") message += "Please Enter a message text";

    return message;
}

function sendEmail(firstname, lastname, email, subject) {
    var url="./Assets/AjaxServices/mailService.php";
    var data={  "firstname":firstname,
                "lastname":lastname,
                "email":email,
                "subject":subject
    };

    $.post(url, data, function(result){
        alert(result.message);
    });
}