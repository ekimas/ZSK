<?php
    session_start();
    if(!isset($_SESSION["userid"])) header("Location: ../index.php");
    require_once("./connect.php");
    unset($_SESSION["change-id"]);
    
    $search = $_POST["search"];
    
    if(!empty($search)){
        $return_arr = array();

        $query = 'SELECT * FROM `modules` WHERE `name` LIKE "%'.$search.'%";';
        $result = mysqli_query($con, $query);

        if($result) {
            while ($row = mysqli_fetch_assoc($result)) {    
                $id = $row["id"];
                $name = $row["name"];
                $owner = findOwner($row["owner_id"]);

                $return_arr[] = array(
                                "id" => $id,
                                "name" => $name,
                                "owner" => $owner);
            }

            echo json_encode($return_arr);
        } else {
            echo mysqli_error($con);
        }
    } else {
        header('Location: ./../src/components/flashcards.php?null=0');
    }

    function findOwner($owner_id)
    {
        require("./connect.php");
        
        $query = "SELECT `nickname` FROM `users` WHERE `id` = \"$owner_id\"";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $owner_nick = $row["nickname"];

        return $owner_nick;
    }
?>