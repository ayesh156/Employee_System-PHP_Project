<?php

require "../../config/connection.php";

if (!empty($_POST["id"])) {

    $id = $_POST["id"];
    $ptname = $_POST["n"];
    $ptdec = $_POST["d"];

    if (empty($ptname)) {
        echo ("Please enter Project type name !!!");
    } else if (empty($ptdec)) {
        echo ("Please enter Project type description !!!");
    } else {

        Database::iud("UPDATE `project_type` SET `name`='" . $ptname . "', `description`='" . $ptdec . "' WHERE `id`='" . $id . "' ");

        echo ("Success");
    }
} else {
    echo ("Something went wrong");
}
