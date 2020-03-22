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
    content {
        justify-content: start;
    }
    #flash-content {
        display:flex;
        flex-direction: column;
        min-height:400px ;
        min-width: 600px;
    }
    .search-div {
        display:flex;
        align-items: center;
        flex-direction: row;
        justify-content: center;
        height:50px;
        width:100%;
        margin-top: 20px;
    }
    form input {
        margin: 0 10px 10px 10px;
        box-shadow: none;
        height: 20px;
        width: 300px;
        padding: 5px;
        border:none;
        border-bottom: 2px solid #427A37;
        outline: none;
        color: #427A37;
    }
    #search-button {
        height: 50px;
        width: 150px;
        padding: 10px;
        font-size: 1em;
        border-radius: 3px;
        cursor: pointer;
        border-style: none;
        background-color:#427A37 ;
        font-weight: bold;
        color: #fff;
        transition: color 0.3s, background-color 0.3s;
    }
    #search-button:hover {
        color:#427A37;
        background-color:  #E3AF34;
    }
    </style>
</head>
<body>
    <nav>
        <a href="../../index.php"><img src="../assets/logo.png" alt="TECHL4NG" id="logo-img"></a>
        <div class="button-div">
            <?php if($_SESSION["auth"]==1) echo '<a href="./administration.php"><button class="nav-button">Administration</button></a>'?>
            <a href="./vocabulary.php"><button class="nav-button">Vocabulary</button></a>
            <a href="#"><button class="nav-button">Flashcards</button></a>
            <a href="./game.php"><button class="nav-button">Game</button></a>
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
            <div id="flash-content">
                <div class="search-div">
                    <form action="./../../scripts/search_flash.php" method="get">
                        <input type="text" placeholder="Search..." name="search">
                        <button type="submit" id="search-button">Search</button>
                    </form>
                    <?php
                        if(isset($_GET["null"]))
                        {
                            echo '<span style="color:red;text-align:center;">Searching phrase ca not be empty</span>';
                        }
                    ?>
                </div>
                <div id="search-result">

                </div>
            </div>
        </content>
    </div>
</body>
</html>