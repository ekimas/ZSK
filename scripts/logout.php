<?php
    session_start();
    unset($_SESSION['userid']);
    unset($_SESSION['nick']);
    unset($_SESSION["auth"]);
    session_destroy();
    header("Location: ./../index.php");
?>