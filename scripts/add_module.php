<?php
    session_start();
    if(!isset($_SESSION["userid"])) header("Location: ../index.php");
    require_once("./connect.php");
    unset($_SESSION["change-id"]);

    $userid = $_SESSION["userid"];
    
    if(!empty($_POST["moduleName"]))
    {
        $moduleName = $_POST["moduleName"];
        
        $query = "INSERT INTO `modules` (`id`, `name`, `owner_id`) VALUES (NULL, \"$moduleName\",\"$userid\");";

        if(mysqli_query($con, $query)) {
            header('Location: ../src/components/vocabulary.php');
        } else {
            echo "Błąd: ". mysqli_connect_errno($con);
        }

    } else {
        header("Location: ../src/components/vocabulary.php?chk=0");
    }
?>