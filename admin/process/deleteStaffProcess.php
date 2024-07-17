<?php

require "../../config/connection.php";

if (isset($_GET["email"])) {

    $email = $_GET["email"];

    $img_rs = Database::search("SELECT * FROM `staff_image` WHERE `staff_email`='" . $email . "' ");
    $img_num = $img_rs->num_rows;

    if ($img_num != 0) {
        $img_data = $img_rs->fetch_assoc();

        // Delete files process

        $file = "../" . $img_data["path"];

        if (file_exists($file)) {
            // Delete the file
            unlink($file);
        }
    }

    Database::iud("DELETE FROM `staff_image` WHERE `staff_email`='" . $email . "'");
    Database::iud("DELETE FROM `staff_details` WHERE `staff_email`='" . $email . "'");
    Database::iud("DELETE FROM `staff` WHERE `email`='" . $email . "'");

    echo ("Success");
} else {
    echo ("Something went wrong.");
}
