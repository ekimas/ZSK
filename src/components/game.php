<?php
    session_start();
    if(!isset($_SESSION["userid"])) header("Location: ../../index.php");
    require_once("../../scripts/connect.php");
    unset($_SESSION["change-id"]);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Techl4ng</title>

    <link rel="stylesheet" href="../styles/style.css">
    <link rel="shortcut icon" href="../assets/favicon.ico">

    <style>
    table {
        border-collapse: collapse;
        background-color:#fff;
    }
    th, td {
        border-bottom: 1px solid #427A37;
    }
    th, td {
        padding:10px;
    }

    .div-table {
        border: 2px solid #427A37;
        padding: 35px;
        background-color:#fff;
        border-radius: 4px;
    }
    </style>
</head>
<body>
    <nav>
        <a href="../../index.php"><img src="../assets/logo.png" alt="TECHL4NG" id="logo-img"></a>
        <div class="button-div">
            <?php if($_SESSION["auth"]==1) echo '<a href="./administration.php"><button class="nav-button">Administration</button></a>'?>
            <a href="./vocabulary.php"><button class="nav-button">Vocabulary</button></a>
            <a href="./flashcards.php"><button class="nav-button">Flashcards</button></a>
            <a href="#"><button class="nav-button">Game</button></a>
            <?php
                if(isset($_SESSION["nick"]))
                echo '<div class="user-name"><p>'.$_SESSION["nick"]."</p></div>";
            ?>
            <a href="./profile.php"><img src="../assets/user.png" alt="User" id="user-img"></a>
            <form action="../../scripts/logout.php" method="get"><button class="nav-button logout-button">Logout</button></form>
        </div>
    </nav>
    <div class="main-div">   
        <content>

<?php    
    echo "Game";
?>

        </content>
    </div>
</body>
</html>