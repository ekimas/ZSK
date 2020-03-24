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
        flex-direction: row;
        align-items: center;
    }
    #flash {
        display:flex;
        flex-direction: column;
        justify-content:center;
        min-height:200px ;
        min-width: 300px;
        align-items:center;
        background-color: #fff;
        border-radius: 10px;
    }
    #left, #right {
        height:50px;
        width:50px;
        margin-left:25px;
        margin-right:25px;
        display:flex;
        justify-content:center;
        align-items:center;
        background-color:#427A37;
        font-weight:bold;
        border-radius:10px;
        color: #fff;
    }
    #left:hover {
        border-color:#E3AF34;
        background-color:#e2e2e2;
        color:#E3AF34;
    }
    </style>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

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
            <button id="left"><</button>
            <div id="flash">
                flash
            </div>
            <button id="right">></button>
        </content>
    </div>
    <script>
        var flash = 0;
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

                    // rand = randWord(len-1);
                    // queue(len);
                    // document.getElementById("flash").innerText = response[0].pl;
                    moduleW = JSON.stringify(response);
                    see();
                }
            });
        });

        function see(){
            moduleW = JSON.parse(moduleW);
            console.log(moduleW);
            document.getElementById("flash").innerText = moduleW[0].pl;
            }


        // function queue(len) {
        //     var q = [];
        //     for(let i = 0; i<len; i++)
        //     {
        //         q[i] = Math.floor(Math.random()*(len-1));
        //         console.log("Właściwe q[i] - "+q[i]+" - "+i);
        //         for(let j = 0; j<i; j++)
        //         {
        //             console.log(q[i]+" "+q[j])
        //             if(q[i] == q[j])
        //             {
        //                 while() 
        //                 {
        //                     q[i] = randWord(len);
        //                     console.log("Wylosowane "+q[i]);
        //                 }
        //             }
        //         }
        //     }
        //     console.log(q);

        //     function check() {
        //         console.log(q);

        //     }
        // }
        
        // function randWord(len) {
        //     var rand = Math.floor(Math.random()*(len-1));

        //     return rand;
        // }
    </script>
</body>
</html>