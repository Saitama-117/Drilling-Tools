<?php

function validToolData($toolOD, $minPressure, $maxPressure, $minTemp, $maxTemp, $CADurl) {
    $areNumeric = is_numeric($toolOD) && is_numeric($minPressure) && is_numeric($maxPressure);
    $areNumeric = $areNumeric && is_numeric($minTemp) && is_numeric($maxTemp);
    $isPhysical = ($maxPressure > $minPressure) && ($maxTemp > $minTemp);

    // Validate CAD URL if present
    if ($CADurl === '') {
        $validURL = true;
    } else {
        if (strpos($CADurl, "3dvieweronline.com/members/")) {
            $validURL = filter_var($CADurl, FILTER_VALIDATE_URL);
        } else {
            $validURL = false;
        }
    }

    return  $areNumeric && $isPhysical && $validURL;
}