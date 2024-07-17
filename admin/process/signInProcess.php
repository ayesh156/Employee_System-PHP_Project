<?php

session_start();

require "../../config/connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

if (empty($email)) {
    echo ("Please enter your Email !!!");
} else if (strlen($email) >= 100) {
    echo ("Email must must have 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email !!!");
} else if (empty($password)) {
    echo ("Please enter your Password");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must be between 5-20 characters");
} else {

    $rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");
    $n = $rs->num_rows;

    if ($n == 1) {
        $d = $rs->fetch_assoc();

            echo ("Success");

            // Set session process

            $_SESSION["a"] = $d;

            // Set cookies process

            if ($rememberme == "true") {
                setcookie("email", $email, time() + (86400 * 30 * 365), "/");
                setcookie("password", $password, time() + (86400 * 30 * 365), "/");
            } else {
                setcookie("email", "", time() - (86400 * 30 * 366));
                setcookie("password", "", time() - (86400 * 30 * 366));
            }
            
    } else {
        echo ("Invalid Username or Password");
    }
}
