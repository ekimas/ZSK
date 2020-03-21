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
        #voc-content {
            display:flex;
            flex-direction: column;
            min-height:400px ;
            min-width: 600px;
        }
        #button-content-div {
            height: 100px;
            min-width: 600px;
            display:flex;
            flex-direction: row;
            justify-content: flex-end;
            flex-wrap: wrap;
            align-content: center;
        }
        #add-module-button, #add-word-button {
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
        #add-module-button:hover, #add-word-button:hover {
            color:#427A37;
            background-color:  #E3AF34;
        }
        #add-form input {
            margin: 0 30px 10px 10px;
            border-radius: 4px;
            border: 1px solid rgba(0,0,0,0.15);
            box-shadow: none;
            height: 20px;
            width: 300px;
            padding: 5px;
        }
        #add-form #shorter-input {
            width: 150px;
        }
        #add-form select {
            margin: 0 30px 10px 10px;
            border-radius: 4px;
            border: 1px solid rgba(0,0,0,0.15);
            box-shadow: none;
            height: 30px;
            width:100px;
            padding: 5px;
        }
        #add-form label {
            color:#427A37;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav>
        <a href="../../index.php"><img src="../assets/logo.png" alt="TECHL4NG" id="logo-img"></a>
        <div class="button-div">
            <?php if($_SESSION["auth"]==1) echo '<a href="./administration.php"><button class="nav-button">Administration</button></a>'?>
            <a href="#"><button class="nav-button">Vocabulary</button></a>
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
            <div id="voc-content">
                <div id="button-content-div">
                    <form action="./../../scripts/add_module.php" method="post" id="add-form">
                        <input type="text" placeholder="Module name" name="moduleName">
                        <button id="add-module-button" onClick="addModule">Add module</button>
                    </form>
                </div>
                <?php
                    if(isset($_GET["chk"])) echo '<span style="color:red;text-align:center;">You must name the module.</span>';
                ?>
                <div id="button-content-div">
                    <form action="./../../scripts/add_word.php" method="post" id="add-form">
                        <input type="text" placeholder="Polish" name="wordPL" id="shorter-input">
                        <input type="text" placeholder="English" name="wordANG" id="shorter-input">
                        <label for="moduleName">Module: </label>
                        <select name="moduleName" id="moduleName">

                            <?php
                                $userid =  $_SESSION['userid'];
                                $sql = "SELECT `name` FROM `modules` WHERE owner_id = \"$userid\";";
                                $result = mysqli_query($con, $sql); 

                                while ($row = mysqli_fetch_assoc($result)){
                                    echo '<option>',$row["name"],"</option>";
                                }
                            ?>

                        </select>
                        <button id="add-word-button" onClick="addModule">Add word</button>
                    </form>
                </div>
                <div>
                
                </div>
            </div>
        </content>
    </div>
</body>
</html>