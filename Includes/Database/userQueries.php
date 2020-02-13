<?php
    function createUserTableIfNeeded($db)
    {
        $query = "CREATE TABLE IF NOT EXISTS Users (
                              userid int NOT NULL,
                              username nvarchar(20),
                              password nvarchar(256),
                              PRIMARY KEY(userid))";
        $result = $db->query($query);
    }

    function checkUserLogin($db, $username, $password) {
        $return = null;
        $query = "SELECT userid FROM User WHERE username = ? and password = ?";
        $stmt = $db->prepare($query);
        //Prepared statement, string only
        $hashedPassword = sha1($password);
        $stmt->bind_param('ss', $username, $hashedPassword);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($return);
        $stmt->fetch();
        $stmt->free_result();
        return $return;
    }

    function insertUser($db, $username, $password) {
        $query = "INSERT INTO Users (username, password) VALUES (?, ?)";
        $hashedPassword = sha1($password);
        $stmt = $db->prepare($query);
        $stmt->bind_param('ss', $username, $hashedPassword);
        $stmt->execute();
        return ($stmt->affected_rows > 0);
    }

    function findUser($db, $username) {
        $result = array();
        $query = "SELECT userid FROM User WHERE username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result( $result[username]);
        $stmt->fetch();
        $stmt->free_result();
        return $result;
    }
