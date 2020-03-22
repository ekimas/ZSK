<?php
    session_start();
    if(!isset($_SESSION["userid"])) header("Location: ../index.php");
    require_once("./connect.php");
    unset($_SESSION["change-id"]);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    
    $sql = "DELETE FROM `words` WHERE `words`.`id` = '$id'";
    
    if (mysqli_query($con, $sql)) {
        header('location: ./../../src/components/vocabulary.php');
    }
?>