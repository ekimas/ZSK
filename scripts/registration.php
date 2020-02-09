<?php
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


</head>
<body>
    
    <nav>
        <a href="../index.php"><img src="../src/assets/logo.png" alt="TECHL4NG" id="logo-img"></a>
    </nav>
    <div class="main-div">


    <form action="" method="post" class="login-form" >
        <label for="mail">MAIL</label>
        <input type="text" name="mail" required>
        <label for="password">PASSWORD</label>
        <input type="text" name="password" required>
        <label for="nickname">NICKNAME</label>
        <input type="text" name="nickname" required>
        <label for="surname">SURNAME</label>
        <input type="text" name="surname" required>
        <label for="name">NAME</label>
        <input type="text" name="name" required>
        
        <button class="reg-button">Register</button>


    </form>
    <a href="../index.php"><button class="reg-button not-in-form">< Back</button></a>

<?php
function filter($var)
{
    if(get_magic_quotes_gpc())
        $var = stripslashes($var);
        $var = htmlspecialchars(trim($var));
        $con = mysqli_connect("localhost","root","","techlang");
    return mysqli_real_escape_string($con, $var);
}

if (!empty($_POST["mail"]) && !empty($_POST["password"]) && !empty($_POST["nickname"]) && !empty($_POST["surname"]) && !empty($_POST["name"]))
{
    $mail = filter($_POST["mail"]);
    if(preg_match('/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,4}$/D', $mail))
    {
        $pass = filter($_POST["password"]);
        $hashPassword = base64_encode($pass);
        $nick = filter($_POST["nickname"]);
        $surname = filter($_POST["surname"]);
        $name = filter($_POST["name"]);

        if (mysqli_num_rows(mysqli_query($con, "SELECT `mail` FROM `users` WHERE `mail` = '".$mail."';")) == 0)
        {     
            if (mysqli_num_rows(mysqli_query($con, "SELECT `nickname` FROM `users` WHERE `nickname` = '".$nick."';")) == 0)
            {    
                $query = "INSERT INTO `users` (`id`, `nickname`, `password`, `mail`, `name`, `surname`, `auth_id`) VALUES (NULL, \"$nick\",\"$hashPassword\", \"$mail\", \"$name\", \"$surname\", 2);";

                if(mysqli_query($con, $query)) {
                    header('Location: ../index.php');
                } else {
                    echo "Błąd: ". mysqli_connect_errno($con);
                }

            }
            else echo '<span style="color:red; margin-top:15px;">This nickname is used.</span>';
        }
        else echo '<span style="color:red; margin-top:15px;">This mail is used.</span>';
    }
    echo '<span style="color:red; margin-top:15px;">Wrong e-mail address!</span>';
} 
    ?>
    </div>
</body>
</html>


