<?php

	$host = "kkn-unimserver.database.windows.net";
    $user = "dicoding";
    $pass = "D1c0d1ng";
    $db = "kkn-unim";
    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    } 
 
?>
