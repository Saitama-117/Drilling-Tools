<?php

function validTubularData($tubularOD, $tubularID, $weight) {
    $areNumeric = is_numeric($tubularOD) && is_numeric($tubularID) && is_numeric($weight);
    $isPhysical = ($tubularOD > $tubularID);
    return  $areNumeric && $isPhysical;
}