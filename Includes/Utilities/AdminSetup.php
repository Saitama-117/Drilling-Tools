<?php
// Development ONLY setup of user table and admin user if required
createAdminsTableIfNeeded($db);     // Create user table if required

$result = findUser($db, 'admin'); // Attempt to find default admin
if ($result['username'] == null) {
    insertUser($db, 1, 'admin', 'password');
}