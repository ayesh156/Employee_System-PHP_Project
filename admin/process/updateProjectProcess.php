<?php

require "../../config/connection.php";

if (!empty($_POST["pid"])) {

    $pid = $_POST["pid"];
    $staff = $_POST["s"];
    $pname = $_POST["pn"];
    $ptype = $_POST["pt"];
    $pstart = $_POST["ps"];
    $pend = $_POST["pe"];
    $preq = $_POST["pr"];

    if ($staff == 0) {
        echo ("Please  select Staff !!!");
    } else if (empty($pname)) {
        echo ("Please enter Project Name !!!");
    } else if (strlen($pname) > 50) {
        echo ("Project Name must have less than 50 characters");
    } else if ($ptype == 0) {
        echo ("Please  select Project Type !!!");
    } else if (empty($pstart)) {
        echo ("Please enter Start Date !!!");
    } else if (empty($pend)) {
        echo ("Please enter End Date !!!");
    } else if (empty($preq)) {
        echo ("Please enter Requirements !!!");
    } else {

        $s_date_string = $pstart;
        $start_date = date('Y-m-d', strtotime($s_date_string));

        $e_date_string = $pend;
        $end_date = date('Y-m-d', strtotime($e_date_string));

        if (!empty($_FILES["file"])) {

            $res_file = $_FILES["file"];

            $allowed_image_ex = array("application/zip", "application/x-zip", "application/x-zip-compressed", "application/octet-stream");
            $file_ex = $res_file["type"];

            if (!in_array($file_ex, $allowed_image_ex)) {
                echo ("Please select a zip file.");
            } else {

                $new_file_extention = ".zip";

                // Upload files process

                $uniqid = uniqid();

                $file_name = "../../assets/src/Project_resources/" . $pname . "_" . $uniqid . $new_file_extention;
                $file_name2 = "../assets/src/Project_resources/" . $pname . "_" . $uniqid . $new_file_extention;

                move_uploaded_file($res_file["tmp_name"], $file_name);

                $resource_rs = Database::search("SELECT * FROM `project` WHERE `id`='" . $pid . "' ");
                $resource_data = $resource_rs->fetch_assoc();

                if (!empty($resource_data["res_path"])) {

                    // Delete files process

                    $file = "../" . $resource_data["res_path"];

                    if (file_exists($file)) {
                        // Delete the file
                        unlink($file);
                    }
                }

                Database::iud("UPDATE `project` SET `res_path`='" . $file_name2 . "' WHERE `id`='" . $pid . "'");
            }
        }

        Database::iud("UPDATE `project` SET `name`='" . $pname . "', `start_date`='" . $start_date . "', `end_date`='" . $end_date . "', `description`='" . $preq . "', `project_type_id`='" . $ptype . "', `staff_email`='" . $staff . "' WHERE `id`='" . $pid . "'");

        echo ("Success");
    }
} else {
    echo ("Something went wrong");
}
