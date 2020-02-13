<?php
    function checkCreateUserData($userName, $password) {
        $feedback = null;
        // Check for a user name
        if (!isSetandNotEmpty($userName)) {
            $feedback .= 'Please enter a username<br />';
        }

        // check password address
        if (!isSetandNotEmpty($password)) {
            $feedback .= 'Please enter a password<br />';
        }
        return $feedback;
    }
    function isSetandNotEmpty($value) {
        $valid = true;
        if (isset($value))
        {
            if ($value == '') {
                $valid = false;
            }
        } else {
            $valid = false;
        }
        return $valid;
    }

