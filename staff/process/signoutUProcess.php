<?php

session_start();

// Delete session process

if(isset($_SESSION["u"])){

    $_SESSION["u"] = null;
    session_destroy();

    echo ("success");

}

?>