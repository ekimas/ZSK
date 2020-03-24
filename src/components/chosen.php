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
    #flash-front, #flash-back{
        display:flex;
        flex-direction: column;
        justify-content:center;
        min-height:200px ;
        min-width: 300px;
        align-items:center;
        background-color: #fff;
        border-radius: 10px;
        text-decoration:none;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size:1.5em;
    }
    #flash:hover {
        cursor: pointer;
    }

    #left, #right {
        height:50px;
        width:50px;
        margin-left:25px;
        margin-right:25px;
        display:flex;
        justify-content:center;
        align-items:center;
        background-color:#fff;
        font-weight:bold;
        border-radius:10px;
        color: #427A37;
        border: 2px solid #427A37;
    }
    #left:hover, #right:hover {
        color: #E3AF34;
        border: 2px solid #E3AF34;
        background-color: #e2e2e2;
    }
    #buttons-div {
        display: flex;
        flex-direction: row;
        margin-top:20px;
        margin-bottom:20px;
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
            <div id="flash-front">
                
            </div>
            <div id="flash-back">
                
            </div>
            <div id="buttons-div">
                <button type="button" id="left" onclick="left()"><</button>
                <button type="button" id="right" onclick="right()">></button>
            </div>
            
        </content>
    </div>
    <script>
        document.getElementById("flash-back").style.display = "none";
        
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
                    see();
                }
            });
        });

        document.getElementById("flash-front").addEventListener("click", function(){ 
            document.getElementById("flash-back").style.display = "flex";
            document.getElementById("flash-front").style.display = "none";
        });

        document.getElementById("flash-back").addEventListener("click", function(){ 
            document.getElementById("flash-front").style.display = "flex";
            document.getElementById("flash-back").style.display = "none";
        });

        var length;
        var number = 0;
        function see(){
            moduleW = JSON.parse(moduleW);

            document.getElementById("flash-front").innerHTML = moduleW[number].pl+'<img src="./../assets/flagapl.jpg" alt="PL" style="margin:10px; height:40px;">';
            document.getElementById("flash-back").innerHTML = moduleW[number].eng+'<img src="./../assets/flagaGB.jpg" alt="PL" style="margin:10px; height:40px;">';

            }
        function left() {
            if(number == 0)
            {
                number = 0;
                document.getElementById("flash-front").style.display = "flex";
                document.getElementById("flash-back").style.display = "none";
                document.getElementById("flash-front").innerHTML = moduleW[number].pl+'<img src="./../assets/flagapl.jpg" alt="PL" style="margin:10px; height:40px;">';;
                document.getElementById("flash-back").innerHTML = moduleW[number].eng+'<img src="./../assets/flagaGB.jpg" alt="PL" style="margin:10px; height:40px;">';
            } else {
                number--;
                document.getElementById("flash-front").style.display = "flex";
                document.getElementById("flash-back").style.display = "none";
                document.getElementById("flash-front").innerHTML = moduleW[number].pl+'<img src="./../assets/flagapl.jpg" alt="PL" style="margin:10px; height:40px;">';;
                document.getElementById("flash-back").innerHTML = moduleW[number].eng+'<img src="./../assets/flagaGB.jpg" alt="PL" style="margin:10px; height:40px;">';
            }
        }
        function right() {
            if(number == length-1)
            {
                number = length-1;
                document.getElementById("flash-front").style.display = "flex";
                document.getElementById("flash-back").style.display = "none";
                document.getElementById("flash-front").innerHTML = moduleW[number].pl+'<img src="./../assets/flagapl.jpg" alt="PL" style="margin:10px; height:40px;">';;
                document.getElementById("flash-back").innerHTML = moduleW[number].eng+'<img src="./../assets/flagaGB.jpg" alt="PL" style="margin:10px; height:40px;">';
            } else {
                number++;
                document.getElementById("flash-front").style.display = "flex";
                document.getElementById("flash-back").style.display = "none";
                document.getElementById("flash-front").innerHTML = moduleW[number].pl+'<img src="./../assets/flagapl.jpg" alt="PL" style="margin:10px; height:40px;">';;
                document.getElementById("flash-back").innerHTML = moduleW[number].eng+'<img src="./../assets/flagaGB.jpg" alt="PL" style="margin:10px; height:40px;">';
            }
        }

    </script>
</body>
</html>