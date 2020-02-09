<?php
    session_start();
    require_once('./connect.php');

    $mail = $_POST["mail"];
    $pass = $_POST["password"];
    $hashPassword = base64_encode($pass);
    
    if($_POST["button"]==1)
    {
        header("Location: ./registration.php");
    } else if(!empty($mail) && !empty($pass))
    {
        
        $sql = "SELECT `id`, `nickname`, `auth_id` FROM `users` WHERE `password` LIKE \"$hashPassword\" AND `mail` LIKE \"$mail\"";
       
        if($result = mysqli_query($con, $sql)) {
            $row = mysqli_fetch_assoc($result);      
            $id = $row["id"];
            $nick = $row["nickname"];
            $auth = $row["auth_id"];
            $_SESSION["userid"] = $id;
            $_SESSION["nick"] = $nick;
            $_SESSION["auth"] = $auth;
            header("Location: ../main.php");          
        } 
    } else {       
        header('Location: ../index.php'); 
    }
    


?>