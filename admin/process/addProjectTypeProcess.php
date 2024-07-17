<?php

require "../../config/connection.php";

$ptname = $_POST["n"];
$ptdec = $_POST["d"];

if (empty($ptname)) {
    echo ("Please enter Project type name !!!");
} else if (empty($ptdec)) {
    echo ("Please enter Project type description !!!");
} else {

    $pt_rs = Database::search("SELECT * FROM `project_type` WHERE `name`='".$ptname."'");
    $pt_n = $pt_rs -> num_rows;

    if($pt_n > 0) {
        echo ("This Project type is already registered.");
    } else {

        Database::iud("INSERT INTO `project_type` (`name`,`description`) VALUES ('".$ptname."' , '".$ptdec."')");

        echo ("Success");
    }

}
