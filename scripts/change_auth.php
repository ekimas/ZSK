<?php
    session_start();
    if(!isset($_SESSION["userid"])) header("Location: ../index.php");
    require_once("./connect.php");
    unset($_SESSION["change-id"]);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Techl4ng</title>

    <link rel="stylesheet" href="../../src/styles/style.css">
    <link rel="shortcut icon" href="../../src/assets/favicon.ico">

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
        <a href="../../index.php"><img src="../../src/assets/logo.png" alt="TECHL4NG" id="logo-img"></a>
        <div class="button-div">
            <?php if($_SESSION["auth"]==1) echo '<a href="../../src/components/administration.php"><button class="nav-button">Administration</button></a>'?>
            <button class="nav-button">Vocabulary</button>
            <button class="nav-button">Flashcards</button>
            <button class="nav-button">Game</button>
            <?php
                if(isset($_SESSION["nick"]))
                echo '<div class="user-name">'.$_SESSION["nick"]."</div>";
            ?>
            <a href="../../src/components/profile.php"><img src="../../src/assets/user.png" alt="User" id="user-img"></a>
            <form action="./logout.php" method="get"><button class="nav-button logout-button">Logout</button></form>
        </div>
    </nav>
    <div class="main-div">   
        <content>
            <div class="div-table">

            <?php    

if(isset($_GET["id"])) {

    $id = $_GET["id"];
    $sql1 = "SELECT * FROM `users` WHERE id = $id";
    $result1 = mysqli_query($con, $sql1);
    if($result1){
    $user = mysqli_fetch_assoc($result1);

    echo <<<FORMUPDATE
    <h3>Aktualizacja</h3>
    ID: $user[id] <br><br>
    <form action="./../update_user.php" method="post">
    <input type="text" name="nick" value="$user[nickname]"><br><br>
    <input type="text" name="mail" value="$user[mail]"><br><br>
    <input type="text" name="name" value="$user[name]"><br><br>
    <input type="text" name="surname" value="$user[surname]"><br><br>
    <select name="auth" value="$user[auth_id]">
FORMUPDATE;
        if($user["auth_id"]==1){
        echo <<<FORMUPDATE2
        <option value="1" selected="selected">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    <input type="hidden" name="id" value="$id"><br><br>
    <input type="submit" name="button" value="Aktualizuj">
  </form>
FORMUPDATE2;
    } else if($user["auth_id"]==2){
        echo <<<FORMUPDATE2
        <option value="1">1</option>
        <option value="2" selected="selected">2</option>
        <option value="3">3</option>
    </select>
    <input type="hidden" name="id" value="$id"><br><br>
    <input type="submit" name="button" value="Aktualizuj">
  </form>
FORMUPDATE2;
    } else 
    echo <<<FORMUPDATE2
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3" selected="selected">3</option>
    </select>
    <input type="hidden" name="id" value="$id"><br><br>
    <input type="submit" name="button" value="Aktualizuj">
  </form>
FORMUPDATE2;
    }
}
?>

            </div>
        </content>
    </div>
</body>
</html>