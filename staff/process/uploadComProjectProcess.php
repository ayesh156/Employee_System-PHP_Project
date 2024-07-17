<?php

require "../../config/connection.php";

session_start();

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];

    if (!empty($_POST["pid"])) {

        $pid = $_POST["pid"];
        $pname = $_POST["pn"];
        $comment = $_POST["c"];

        if (empty($comment)) {
            echo ("Please description about the project !!!");
        } else if (empty($_FILES["file"])) {
            echo ("Please select project file !!!");
        } else {

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d");

            $res_file = $_FILES["file"];

            $allowed_image_ex = array("application/zip", "application/x-zip", "application/x-zip-compressed", "application/octet-stream");
            $file_ex = $res_file["type"];

            if (!in_array($file_ex, $allowed_image_ex)) {
                echo ("Please select a zip file.");
            } else {

                $new_file_extention = ".zip";

                // Upload files process

                $uniqid = uniqid();

                $file_name = "../../assets/src/Upload_projects/" . $pname . "_" . $uniqid . $new_file_extention;
                $file_name2 = "../assets/src/Upload_projects/" . $pname . "_" . $uniqid . $new_file_extention;

                move_uploaded_file($res_file["tmp_name"], $file_name);

                $uploaded_rs = Database::search("SELECT * FROM `uploaded_project` WHERE `project_id`='" . $pid . "' ");
                $uploaded_num = $uploaded_rs->num_rows;

                if ($uploaded_num > 0) {

                    $uploaded_data = $uploaded_rs->fetch_assoc();

                    if (!empty($uploaded_data["path"])) {

                        // Delete files process

                        $file = "../" . $uploaded_data["path"];

                        if (file_exists($file)) {
                            // Delete the file
                            unlink($file);
                        }
                    }

                    Database::iud("UPDATE `uploaded_project` SET `path`='" . $file_name2 . "', `date_uploaded`='" . $date . "', `description`='" . $comment . "'  WHERE `project_id`='" . $pid . "' AND `staff_email` = '" . $email . "'");

                } else {

                    Database::iud("INSERT INTO `uploaded_project` (`path`, `date_uploaded`, `description`,`project_id`,`staff_email`) VALUES ('" . $file_name2 . "','" . $date . "','" . $comment . "','" . $pid . "','" . $email . "')");

                    Database::iud("UPDATE `project` SET `status_id`='2'  WHERE `id`='" . $pid . "' AND `staff_email` = '" . $email . "'");

                }

                echo ("Success");
            }
        }
    } else {
        echo ("Something went wrong");
    }
} else {
    header("Location:../index.php");
}
