<?php
    session_start();
    if(!isset($_SESSION["userid"])) header("Location: ./index.php");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Techl4ng</title>

    <link rel="stylesheet" href="./src/styles/style.css">
    <link rel="shortcut icon" href="./src/assets/favicon.ico">


</head>
<body>

        <nav>
            <a href="./index.php"><img src="./src/assets/logo.png" alt="TECHL4NG" id="logo-img"></a>
            <div class="button-div">
                <?php if($_SESSION["auth"]==1) echo '<a href="./src/components/administration.php"><button class="nav-button">Administration</button></a>'?>
                <button class="nav-button">Vocabulary</button>
                <button class="nav-button">Flashcards</button>
                <button class="nav-button">Game</button>
                <?php
                    if(isset($_SESSION["nick"]))
                    echo '<div class="user-name">'.$_SESSION["nick"]."</div>";
                ?>
                <a href="./src/components/profile.php"><img src="./src/assets/user.png" alt="User" id="user-img"></a>
                <form action="./scripts/logout.php" method="get"><button class="nav-button logout-button">Logout</button></form>
            </div>
        </nav>
        <div class="main-div">
        <content>
            
        </content>
    </div>
</body>
</html>