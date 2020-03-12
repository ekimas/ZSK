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
        <a href="../../index.php"><img src="../assets/logo.png" alt="TECHL4NG" id="logo-img"></a>
        <div class="button-div">
            <?php if($_SESSION["auth"]==1) echo '<a href="#"><button class="nav-button">Administration</button></a>'?>
            <button class="nav-button">Vocabulary</button>
            <button class="nav-button">Flashcards</button>
            <button class="nav-button">Game</button>
            <?php
                if(isset($_SESSION["nick"]))
                echo '<div class="user-name">'.$_SESSION["nick"]."</div>";
            ?>
            <a href="./profile.php"><img src="../assets/user.png" alt="User" id="user-img"></a>
            <form action="../../scripts/logout.php" method="get"><button class="nav-button logout-button">Logout</button></form>
        </div>
    </nav>
    <div class="main-div">   
        <content>
            <div class="div-table">
<?php    

    $sql = "SELECT * FROM `users` WHERE `id` NOT LIKE ". $_SESSION["userid"];
    $result = mysqli_query($con, $sql); 

    echo "<table>";
    

    echo <<<TABLE
    <tr>
        <th>Id</th>
        <th>Nickname</th>
        <th>Mail</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Type of profile</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
TABLE;

    while ($row = mysqli_fetch_assoc($result)) {    
    echo <<<ROW
    <tr>
        <td>$row[id]</td>
        <td>$row[nickname]</td>
        <td>$row[mail]</td>
        <td>$row[name]</td>
        <td>$row[surname]</td>
ROW;
        if($row["auth_id"]==1)        
            echo "<td>Admin</td>";
        else if($row["auth_id"]==2)        
            echo "<td>User</td>";
        else echo "<td>Teacher</td>";
    
    echo <<<BUTTONS
        <td>   
        <a href="../../scripts/change_auth.php/?id=$row[id]&back=0"><button>EDIT</button></a>
        </td>

BUTTONS;
    echo <<<BUTTONS2
        
        <td>
        <a href="../../scripts/delete_user.php/?id=$row[id]"><button>DELETE</button></a>
        </td>

BUTTONS2;
    $_SESSION["change-id"] = $row["id"];

    echo "</tr>";
    }

    echo "</table>";
?>
            </div>
        </content>
    </div>
</body>
</html>