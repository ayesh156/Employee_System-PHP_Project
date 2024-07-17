<?php

require "../../config/connection.php";

session_start();

if (isset($_SESSION["a"])) {

    $aemail = $_SESSION["a"]["email"];

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $mobile = $_POST["m"];
    $pwd = $_POST["p"];
    $bday = $_POST["dob"];
    $gender = $_POST["g"];

    if (empty($fname)) {
        echo ("Please enter First Name !!!");
    } else if (strlen($fname) > 50) {
        echo ("First Name must have less than 50 characters");
    } else if (empty($lname)) {
        echo ("Please enter Last Name !!!");
    } else if (strlen($lname) > 50) {
        echo ("Last Name must have less than 50 characters");
    } else if (empty($mobile)) {
        echo ("Please enter Mobile !!!");
    } else if (strlen($mobile) != 10) {
        echo ("Mobile must have 10 characters");
    } else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
        echo ("Invalid Mobile Number !!!");
    } else if (empty($pwd)) {
        echo ("Please enter Password !!!");
    } else if (strlen($pwd) < 5 || strlen($pwd) > 20) {
        echo ("Password must be between 5 - 20 characters");
    } else if (empty($bday)) {
        echo ("Please enter Birthday !!!");
    } else if ($gender == 0) {
        echo ("Please select Gender !!!");
    } else {

        $date_string = $bday;
        $sql_date = date('Y-m-d', strtotime($date_string));

        Database::iud("UPDATE `admin` SET `password`='" . $pwd . "', `gender_id`='" . $gender . "' WHERE `email`='" . $aemail . "'");

        Database::iud("UPDATE `admin_details` SET `first_name`='" . $fname . "', `last_name`='" . $lname . "', `birthday`='" . $sql_date . "',`mobile`='" . $mobile . "' WHERE `admin_email`='" . $aemail . "'");

        $rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $aemail . "'");
        $n = $rs->num_rows;

        if ($n > 0) {
            $d = $rs->fetch_assoc();

            $_SESSION["a"] = $d;
            
        }

        if (isset($_FILES["image"])) {
            $image = $_FILES["image"];

            $allowed_image_ex = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
            $file_ex = $image["type"];

            if (!in_array($file_ex, $allowed_image_ex)) {
                echo ("Please select a valid image.");
            } else {

                $new_file_extention;

                if ($file_ex == "image/jpg") {
                    $new_file_extention = ".jpg";
                } else if ($file_ex == "image/jpeg") {
                    $new_file_extention = ".jpeg";
                } else if ($file_ex == "image/png") {
                    $new_file_extention = ".png";
                } else if ($file_ex == "image/svg+xml") {
                    $new_file_extention = ".svg";
                }

                // Upload files process

                $uniqid = uniqid();

                $file_name = "../../assets/images/admin_img/" . $fname . "_" . $uniqid . $new_file_extention;
                $file_name2 = "../assets/images/admin_img/" . $fname . "_" . $uniqid . $new_file_extention;

                move_uploaded_file($image["tmp_name"], $file_name);

                $img_rs = Database::search("SELECT * FROM `admin_image` WHERE `admin_email`='" . $aemail . "' ");
                $img_num = $img_rs->num_rows;

                if ($img_num == 0) {

                    Database::iud("INSERT INTO `admin_image` (`path`,`admin_email`) VALUES ('" . $file_name2 . "','" . $aemail . "') ");
                } else {

                    $img_data = $img_rs->fetch_assoc();

                    // Delete files process

                    $file = "../" . $img_data["path"];

                    if (file_exists($file)) {
                        // Delete the file
                        unlink($file);
                    }

                    Database::iud("UPDATE `admin_image` SET `path`='" . $file_name2 . "' WHERE `admin_email`='" . $aemail . "'");
                }
            }
        }

        echo ("Success");
    }
} else {
    header("Location:index.php");
}
