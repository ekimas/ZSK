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

    h2 {
        color: #427A37;
        margin-top: 0;
    }
    form {
        display:flex;
        flex-direction:column;
    }
    form input {
        border-radius: 4px;
        border: 1px solid rgba(0,0,0,0.15);
        box-shadow: none;
        height: 20px;
        padding: 5px;
    }
    form label {
        margin-bottom: 5px;
        color:#427A37;
        font-weight: bold;
    }
    form select {
        border-radius: 4px;
        border: 1px solid rgba(0,0,0,0.15);
        padding: 5px;
    }
    #button_change {
        border-radius: 4px;
        padding: 5px;
        height: 50px;
        cursor: pointer;
        border: 2px solid #427A37;
        background-color: #fff;
        color: #427A37;
        font-weight: bold;
    }
    #button_change:hover {
        color: #E3AF34;
        border: 2px solid #E3AF34;
        background-color: #e2e2e2;
    }
    </style>
</head>
<body>
    <nav>
        <a href="../../index.php"><img src="../../src/assets/logo.png" alt="TECHL4NG" id="logo-img"></a>
        <div class="button-div">
            <?php if($_SESSION["auth"]==1) echo '<a href="../../src/components/administration.php"><button class="nav-button">Administration</button></a>'?>
            <a href="./../../src/components/vocabulary.php"><button class="nav-button">Vocabulary</button></a>
            <a href="./../../src/components/flashcards.php"><button class="nav-button">Flashcards</button></a>
            <a href="./../../src/components/game.php"><button class="nav-button">Game</button></a>
            <?php
                if(isset($_SESSION["nick"]))
                echo '<div class="user-name"><p>'.$_SESSION["nick"]."</p></div>";
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

    $back = $_GET["back"];
    
    $id = $_GET["id"];
    $sql1 = "SELECT * FROM `users` WHERE id = $id";
    $result1 = mysqli_query($con, $sql1);
    
    if($result1)
    {
        $user = mysqli_fetch_assoc($result1);

        echo "<h2>Aktualizacja</h2>";
        
        if($back!=1)
            echo "ID: $user[id] <br><br>";

        if($user["auth_id"]==1 || $back == 0)
        {
            echo <<<FORMUPDATE
            <form action="./../update_user.php/?back=$back" method="post">
                <label for="nick">Nickname</label>
                <input type="text" name="nick" value="$user[nickname]"><br>
                <label for="mail">Mail</label>
                <input type="text" name="mail" value="$user[mail]"><br>
                <label for="name">Name</label>
                <input type="text" name="name" value="$user[name]"><br>
                <label for="surname">Surname</label>
                <input type="text" name="surname" value="$user[surname]"><br>
                <label for="auth">Authorisation</label>
                <select name="auth" value="$user[auth_id]">
FORMUPDATE;
            if($user["auth_id"]==1)
            {
            echo <<<FORMUPDATE2
                <option value="1" selected="selected">1 - Admin</option>
                <option value="2">2 - User</option>
                <option value="3">3 - Teacher</option>
            </select>
            <input type="hidden" name="id" value="$id"><br>
            <input type="submit" name="button" value="Aktualizuj" id="button_change">
        </form>
FORMUPDATE2;
            } 
            else if($user["auth_id"]==2)
            {
            echo <<<FORMUPDATE2
                <option value="1">1 - Admin</option>
                <option value="2" selected="selected">2 - User</option>
                <option value="3">3 - Teacher</option>
            </select>
            <input type="hidden" name="id" value="$id"><br>
            <input type="submit" name="button" value="Aktualizuj" id="button_change">
        </form>
FORMUPDATE2;
            } else 
            echo <<<FORMUPDATE2
                <option value="1">1 - Admin</option>
                <option value="2">2 - User</option>
                <option value="3" selected="selected">3 - Teacher</option>
            </select>
            <input type="hidden" name="id" value="$id"><br>
            <input type="submit" name="button" value="Aktualizuj" id="button_change">
        </form>
FORMUPDATE2;
        } else {
            echo <<<FORMUPDATE
            <form action="./../update_user.php/?back=$back" method="post">
                <label for="nick">Nickname</label>
                <input type="text" name="nick" value="$user[nickname]"><br>
                <label for="mail">Mail</label>
                <input type="text" name="mail" value="$user[mail]"><br>
                <label for="name">Name</label>
                <input type="text" name="name" value="$user[name]"><br>
                <label for="surname">Surname</label>
                <input type="text" name="surname" value="$user[surname]"><br>
                <input type="hidden" name="id" value="$id"><br>
                <input type="hidden" name="auth" value="$user[auth_id]"><br>
                <input type="submit" name="button" value="Aktualizuj" id="button_change">
            </form>
FORMUPDATE;
        }
    }
}
?>

            </div>
        </content>
    </div>
</body>
</html>