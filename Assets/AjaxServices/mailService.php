<?php

function validFormData($firstName, $lastName, $email, $subject) {

    $validFirstName = preg_match("/^[a-zA-Z]*$/",$firstName);
    $validLastName = preg_match("/^[a-zA-Z]*$/",$lastName);
    $validEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    $validSubject = preg_match("/^[a-zA-Z0-9]*$/",$subject);

    $validForm = $validFirstName && $validLastName && $validEmail;
    //$validForm = $validForm && $validSubject;

    return  $validForm;
}

if (IsSet($_POST) && IsSet($_POST["firstname"]) && IsSet($_POST["lastname"])
    && IsSet($_POST["email"]) && IsSet($_POST["subject"])) {

    // POST parameters have been set
    $firstName = trim($_POST['firstname']);
    $lastName = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);

    header("Content-type: application/json");
    $message = "";
    if (validFormData($firstName, $lastName, $email, $subject)) {
        // Valid form data so build email message
        $toEmail = "1813014@rgu.ac.uk";
        $fromEmail = "specialist-site@gmail.com";
        $emailSubject = "Specialist Cutting Tools Enquiry";
        $emailBody = "Enquiry from: " . $firstName . " " . $lastName . "\n\n";
        $emailBody .= "Email Address: " . $email . "\n\n";
        $emailBody .= $subject;
        $headers = "From: " . $fromEmail;

        // PHP.ini file must be correctly setup
        // If using Gmail SSL/TLS must be used which requires an SSL certificate
        // $return = mail($toEmail, $emailSubject, $emailBody, $headers);
        $return = true;
        if ($return) {
            $message = "Message sent to the Specialist Cutting Tools team";
        } else {
            $message = "Message not sent - contact the site administrator";
        }

    } else {
        // Invalid form data
        $message = "Error in Form Data";
    }

    echo json_encode(['message' => $message]);
    http_response_code(200);

} else {
    http_response_code(400);    //does not support other methods
}