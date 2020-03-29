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
        width: 444px;
        height: 444px;
        margin: 30px auto;
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    .mem {
        height: 200px;
        width: 200px;
        margin: 10px;
        border: 1px solid black;
        background-color: #EEE;
        background-position: center;
        background-size: cover;
        perspective: 1000px;
        transition: transform 1s;
    }

    .clicked {
        perspective: 1000px;
        transition: transform 1s;
    }
    </style>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
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
            
        </content>
    </div>

    <script>        
        var moduleW;
        var url = String(window.location.href);

        var id = "";
        for(let i=url.search("=")+1; i<=url.length-1; i++)
        {
            id += url[i];
        }
        id = Number(id);

        $(document).ready(function(){
            $.ajax({
                url: './../../scripts/search_flash_2.php',
                type: 'POST',
                data: ({id: id}),
                dataType: 'JSON',
                success: function(response){
                    var len = response.length;
                    length = len;
                    console.log(response);
                    moduleW = JSON.stringify(response);
                    console.log(moduleW);
                }
            });
        });


    </script>
</body>
</html>