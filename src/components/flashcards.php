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
    input {
        margin: 10px;
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

    #user-table {
        border-collapse: collapse;
        background-color:#fff;
    }
    th, td {
        border-bottom: 1px solid #427A37;
        padding:10px;
    }

    #search-result {
        border: 2px solid #427A37;
        padding: 35px;
        background-color:#fff;
        border-radius: 4px;
    }

    #in-flash-content {
        width:528px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-content: center;
        margin: 30px auto 0 auto;
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
            <div id="flash-content">
                <div class="search-div">
                        <input type="text" placeholder="Search module..." name="search" id="search-input">
                        <button id="search-button" onclick="search()">Search</button>
                </div>
                    
                    <span id="info-span" style="color:red; text-align:center; margin-top:5px; visibility:hidden;">Searching phrase can not be empty</span>
                                
                <div id="in-flash-content">
                    <div id="search-result">
                        <table id='userTable'>
                            <th>ID</th>
                            <th>Module name</th>
                            <th>Owner</th>
                        </table>
                    </div>
                </div>
            </div>
        </content>
    </div>
    <script>
        function search() {
        var search = document.getElementById("search-input").value;
        console.log(search);
        
        if(search !== "")
        {
            document.getElementById("info-span").style.visibility = "hidden";
            
            var trAmount = document.querySelectorAll(".tr-result");
            console.log(trAmount.length+"trA");
            for(let i=0; i<trAmount.length; i++)
            {
                trAmount[i].remove();
            }
            
            $(document).ready(function(){
                $.ajax({
                    url: './../../scripts/search_flash.php',
                    type: 'POST',
                    data: ({search: search}),
                    dataType: 'JSON',
                    success: function(response){
                        console.log(response);
                        var len = response.length;
                        console.log(len);
                        for(var i=0; i<len; i++){
                            var id = response[i].id;
                            var moduleName = response[i].name;
                            var owner = response[i].owner;

                            var tr_str = '<tr class="tr-result">' +
                                "<td align='center'>" + id + "</td>" +
                                "<td align='center'>" + moduleName + "</td>" +
                                "<td align='center'>" + owner + "</td>" +
                                "</tr>";

                            $("#userTable").append(tr_str);
                        }

                    }
                });
            });
        } else {
        document.getElementById("info-span").style.visibility = "visible";
        var trAmount = document.querySelectorAll(".tr-result");
            console.log(trAmount.length+"trA");
            for(let i=0; i<trAmount.length; i++)
            {
                trAmount[i].remove();
            }
        }
    } 
    </script>
</body>
</html>