<?php
    session_start();
    unset($_SESSION['userid']);
    unset($_SESSION['nick']);
    unset($_SESSION["auth"]);
    session_destroy();
    mysql_close();
    header("Location: ../index.php");

?>