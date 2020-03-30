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
        justify-content: center;
        min-height: 600px;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Memory */
    #plansza{
        margin: 30px auto;
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    .mem {
        height: 100px;
        width: 200px;
        margin: 10px;
        border: 1px solid black;
        background-color: #EEE;
        background-position: center;
        background-size: cover;
        perspective: 1000px;
        transition: transform 1s;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .clicked {
        perspective: 1000px;
        transition: transform 1s;
    }

    #win {
        visibility:hidden;
        color: #427A37;
        font-size: 2em;
    }

    .button-a {
        visibility:hidden;
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
        margin: 10px auto 0 auto;
    }
    .button-a:hover {
        color:#427A37;
        background-color:  #E3AF34;
    }
    </style>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="./../js/memory.js"></script>
</head>
<body>
    <nav>
        <a href="../../index.php"><img src="../assets/logo.png" alt="TECHL4NG" id="logo-img"></a>
        <div class="button-div">
            <?php if($_SESSION["auth"]==1) echo '<a href="./administration.php"><button class="nav-button">Administration</button></a>'?>
            <a href="./vocabulary.php"><button class="nav-button">Vocabulary</button></a>
            <a href="./flashcards.php"><button class="nav-button">Flashcards</button></a>
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
            <div id="plansza"></div>
            <div id="win">You win!</div>
            <a href="./game.php" ><button class="button-a">BACK</button></a>
            <button class="button-a" onclick="redirect()">TRY AGAIN</button>
        </content>
    </div>
    <script>
        function redirect() {
            var link = window.location.href;
            window.location.replace(link);
        }
    </script>
</body>
</html>