<?php

require "../../config/connection.php";

session_start();

if (isset($_SESSION["u"])) {

	$email = $_SESSION["u"]["email"];

$fname = $_POST["fn"];
$lname = $_POST["ln"];
$mobile = $_POST["m"];
$pwd = $_POST["p"];
$line1 = $_POST["l1"];
$bday = $_POST["dob"];
$line2 = $_POST["l2"];
$gender = $_POST["g"];
$district = $_POST["dis"];
$position = $_POST["pos"];

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
} else if (empty($line1)) {
    echo ("Please enter Address Line1 !!!");
} else if (empty($bday)) {
    echo ("Please enter Birthday !!!");
} else if (empty($line2)) {
    echo ("Please enter Address Line2 !!!");
} else if ($gender == 0) {
    echo ("Please select Gender !!!");
} else if ($district == 0) {
    echo ("Please select District !!!");
} else if ($position == 0) {
    echo ("Please  select Position !!!");
} else {

    $date_string = $bday;
    $sql_date = date('Y-m-d', strtotime($date_string));

    Database::iud("UPDATE `staff` SET `password`='" . $pwd . "', `gender_id`='" . $gender . "', `position_id`='" . $position . "' WHERE `email`='" . $email . "'");

    Database::iud("UPDATE `staff_details` SET `first_name`='" . $fname . "', `last_name`='" . $lname . "', `birthday`='" . $sql_date . "',`mobile`='" . $mobile . "', `address_line1`='" . $line1 . "', `address_line2`='" . $line2 . "', `staff_email`='" . $email . "', `district_id`='" . $district . "' WHERE `staff_email`='" . $email . "'");

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

            $file_name = "../../assets/images/staff_img/" . $fname . "_" . $uniqid . $new_file_extention;
            $file_name2 = "../assets/images/staff_img/" . $fname . "_" . $uniqid . $new_file_extention;

            move_uploaded_file($image["tmp_name"], $file_name);

            $img_rs = Database::search("SELECT * FROM `staff_image` WHERE `staff_email`='" . $email . "' ");
            $img_num = $img_rs->num_rows;

            if ($img_num == 0) {

                Database::iud("INSERT INTO `staff_image` (`path`,`staff_email`) VALUES ('" . $file_name2 . "','" . $email . "') ");
            } else {

                $img_data = $img_rs->fetch_assoc();

                // Delete files process

                $file = "../" . $img_data["path"];

                if (file_exists($file)) {
                    // Delete the file
                    unlink($file);
                }

                Database::iud("UPDATE `staff_image` SET `path`='" . $file_name2 . "' WHERE `staff_email`='" . $email . "'");
            }
        }
    }

    echo ("Success");
}

} else {
	header("Location:../index.php");
}

?>