<?php
 $back =  $_GET["back"];
 echo $back;

if (!empty($_POST['nick']) && !empty($_POST['mail']) && !empty($_POST['name']) && !empty($_POST['surname'])) {
  $nick = $_POST['nick'];
  $mail = $_POST['mail'];
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $auth = $_POST['auth'];
  $id = $_POST['id'];

  require_once("./connect.php");

  $sql = "UPDATE `users` SET `nickname`=\"$nick\", `mail` = \"$mail\", `name`=\"$name\", `surname`=\"$surname\", `auth_id`=$auth WHERE `id`=$id;";

  echo mysqli_error($con);
  if(!mysqli_query($con, $sql))
    echo mysqli_error($con);
  else
    if($back==0)
      header("Location: ./../../src/components/administration.php");
    else
      header("Location: ./../../src/components/profile.php");
}
?>