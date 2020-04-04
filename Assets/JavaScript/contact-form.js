
$(function()
    {
        //set up the click handler of the send button.
        $("#send").click(function()
            {
                var message = validForm();
                if (message === "") {
                    alert("Email Sent - We Will Be In Touch");
                } else {
                    alert(message);
                }
            }
        );

    }
);

function validForm() {
    var firstname =$("#fname").val();
    var lastname =$("#lname").val();
    var email =$("#email").val();
    var subject =$("#subject").val();
    var message = "";

    if (firstname === "") message += "Please enter a first name \n\n";
    if (lastname === "") message += "Please enter a last name \n\n";
    if (!/\S+@\S+\.\S+/.test(email)) message += "Please enter a valid email address \n\n";
    if (subject === "") message += "Please Enter a message text";

    return message;
}
