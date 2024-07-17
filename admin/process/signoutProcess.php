<?php

session_start();

// Delete session process

if(isset($_SESSION["a"])){

    $_SESSION["a"] = null;
    session_destroy();

    echo ("success");

}

?>