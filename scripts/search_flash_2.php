<?php
    session_start();
    if(!isset($_SESSION["userid"])) header("Location: ../index.php");
    require_once("./connect.php");
    unset($_SESSION["change-id"]);
    
    $id = $_POST["id"];
    
    if(!empty($id)){

        $return_arr = array();
        
        $query = "SELECT `pl_word`,`eng_word` FROM `words` WHERE `mod_id` = \"$id\";";
        $result = mysqli_query($con, $query);

        if($result) {
            $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $number;    
                $pl = $row["pl_word"];
                $eng = $row["eng_word"];

                $return_arr[] = array(
                                "id" => $id,
                                "pl" => $pl,
                                "eng" => $eng);
                
                $number++;
            }

            echo json_encode($return_arr);
        } else {
            echo mysqli_error($con);
        }
    } 
?>