<?php

require "../../config/connection.php";

if (!empty($_POST["e"])) {

    $email = $_POST["e"];
    $np = $_POST["n"];
    $rnp = $_POST["r"];
    $vcode = $_POST["v"];

    if (empty($np)) {
        echo ("Please insert a New Password");
    } else if (strlen($np) < 5 || strlen($np) > 20) {
        echo ("Password must be between 5 - 20 characters");
    } else if (empty($rnp)) {
        echo ("Please Re-type your New Password");
    } else if ($np != $rnp) {
        echo ("Password does not matched");
    } else if (empty($vcode)) {
        echo ("Please enter your Varification Code");
    } else {

        $rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "' AND `varification_code`='" . $vcode . "'");
        $n = $rs->num_rows;

        if ($n > 0) {

            Database::iud("UPDATE `admin` SET `password`='" . $np . "' WHERE `email`='" . $email . "' ");
            echo ("Success");
            
        } else {
            echo ("Invalid Varification Code");
        }
    }

} else {
    echo ("Something went wrong");
}
