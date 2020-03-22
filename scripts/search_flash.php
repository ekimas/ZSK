<?php
    $search = $_GET["search"];
    if(!empty($search)){

    } else {
        header('Location: ./../src/components/flashcards.php?null=0');
    }
?>