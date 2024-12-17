<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "medical";
    $connection = "";

    try {
      $connection = mysqli_connect($db_server,$db_user,
                                   $db_pass,$db_name);

    } catch (mysqli_sql_exception) {
      echo "could not connect\n";
    }

?>