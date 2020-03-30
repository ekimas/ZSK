<?php
    session_start();
    if(isset($_SESSION["userid"])) header("Location: ./main.php");
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
        <a href="."><img src="./src/assets/logo.png" alt="TECHL4NG" id="logo-img"></a>
    </nav>
    <div class="main-div">
        <content>
            <form action="./scripts/login.php" method="post" class="login-form">
                <label for="mail">MAIL</label>
                <input type="text" name="mail" >
                <label for="password">PASSWORD</label>
                <input type="password" name="password" >
                <div class="form-button-div">
                    <button name="button" value="0">Login</button>
                    <button name="button" value="1">Registration</button>
                </div>
            <?php
            if(isset($_GET["t"]))
            {
                echo '<span style="color:red; margin-top:15px; text-align:center;">Wrong e-mail address or password</span>';
            }
            ?>
            </form>
            
        </content>
    </div>
</body>
</html>