<?php

require "../../config/connection.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    Database::iud("DELETE FROM `project_type` WHERE `id`='" . $id . "'");

    echo ("Success");
    
} else {
    echo ("Something went wrong.");
}
