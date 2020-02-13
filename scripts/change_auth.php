<?php
    session_start();
    if(!isset($_SESSION["userid"])) header("Location: ../index.php");
    require_once("./connect.php");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Techl4ng</title>

    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="shortcut icon" href="../src/assets/favicon.ico">

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
        display:flex;
        flex-direction: row;
    }
    .new form{
        display: flex;
        flex-direction: column;
        margin:15px;
    }
    .new {
        margin-left: 20px;
    }
    .new * {
        padding: 2px;
    }
    </style>
</head>
<body>
    <nav>
        <a href="../index.php"><img src="../src/assets/logo.png" alt="TECHL4NG" id="logo-img"></a>
        <div class="button-div">
            <?php if($_SESSION["auth"]==1) echo '<a href="../src/components/administration.php"><button class="nav-button">Administration</button></a>'?>
            <button class="nav-button">Vocabulary</button>
            <button class="nav-button">Flashcards</button>
            <button class="nav-button">Game</button>
            <?php
                if(isset($_SESSION["nick"]))
                echo '<div class="user-name">'.$_SESSION["nick"]."</div>";
            ?>
            <a href="./profile.php"><img src="../src/assets/user.png" alt="User" id="user-img"></a>
            <form action="./logout.php" method="get"><button class="nav-button logout-button">Logout</button></form>
        </div>
    </nav>
    <div class="main-div">   
        <content>
            <div class="div-table">
<?php    

    
    



    echo "<table>";

    while ($row = $result->fetch_assoc()) {    
      
    
        echo <<<ROW
    <tr>
    <th>Id</th>         <td>$row[id]</td>   
    </tr>
    <tr>
    <th>Nickname</th>   <td>$row[nickname]</td> 
    </tr>
    <tr>
    <th>Mail</th>       <td>$row[mail]</td> 
    </tr>
    <tr>
    <th>Name</th>       <td>$row[name]</td> 
    </tr>
    <tr>
    <th>Surname</th>    <td>$row[surname]</td> 
    </tr>
ROW;
        if($row["auth_id"]==1)        
            echo "<tr><th>Type of profile</th><td>Admin</td></tr>";
        else if($row["auth_id"]==2)        
            echo "<tr><th>Type of profile</th><td>User</td></tr>";
        else echo "<tr><th>Type of profile</th><td>Teacher</td></tr>";

    }

    echo "</table>";

    echo <<<CHANGE
    <div class="new">
                <form action="" method="post">
                    
                    <label for="new_nick">New nickname</label>
                    <input type="text" name="new_nick">
                    <label for="new_nick">New mail</label>
                    <input type="text" name="new_mail">
                    <label for="new_nick">New name</label>
                    <input type="text" name="new_name">
                    <label for="new_nick">New surname</label>
                    <input type="text" name="new_surname">
                    <label for="new_auth">New role</label>
                    <select name="auth">
                        <option value="2">User</option>
                        <option value="3">Teacher</option>
                        <option value="1">Admin</option>
                    </select>
                    <button type="submit">SUBMIT</button>
                </form>
            </div>
CHANGE;
?>
            </div>
        </content>
    </div>
</body>
</html>