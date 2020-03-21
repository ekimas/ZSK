<?php
    session_start();
    if(!isset($_SESSION["userid"])) header("Location: ../index.php");
    require_once("./connect.php");
    unset($_SESSION["change-id"]);

    $userid = $_SESSION["userid"];
    
    if(!empty($_POST["wordPL"]) && !empty($_POST["wordANG"]) && !empty($_POST["moduleName"]))
    {
        $moduleName = $_POST["moduleName"];
        $pl = $_POST["wordPL"];
        $ang = $_POST["wordANG"];
        $moduleId = getModuleId($moduleName);

        $query = "INSERT INTO `words` (`mod_id`, `pl_word`, `eng_word`) VALUES (\"$moduleId\",\"$pl\", \"$ang\");";

        if(mysqli_query($con, $query)) {
            header('Location: ../src/components/vocabulary.php');
        } else {
            echo mysqli_error($con);
        }
    }

    function getModuleId($moduleName) {
        require("./connect.php");

        $sql = "SELECT `id` AS moduleID FROM `modules` WHERE name = \"$moduleName\";";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row["moduleID"]/1;

        return $id;
    }
?>